<?php
import('application.component.model');
class BootModel extends Model
{
	var $nav = null;
	function BootModel()
	{
		parent::__construct();
 
	}

	//上传图片，返加数组
	function getProductImages()
	{
		if( count($_FILES) > 0  )
		{
			 
			import('filesystem.dir');

			
			//商品是以数组形式上传的
			if( count($_FILES['img']['name']) > 0 ){
				$imgs = array();	//图片数组

				//上传的图片文件
				$files = array();

				foreach( $_FILES['img']['name'] as $k=>$v)
				{

					if( $v ){
						//避免重复上传图片
						if( isset($files[$v]) )
						{
							$imgs[$k] = $files[$v];	//上传后的URI路径
							continue;
						}
						$f = array(
							'name'=>$v,
							'type'=>$_FILES['img']['type'][$k],
							'tmp_name'=>$_FILES['img']['tmp_name'][$k],
							'error'=>$_FILES['img']['error'][$k],
							'size'=>$_FILES['img']['size'][$k]
						);
						//返回是数组
						$img = WDir::uploadFile( $f,$GLOBALS['config']['upload_dir'] );
						$imgs[$k] = $img['uri_path'];	//上传后的URI路径
						$files[$v] = $img['uri_path'];
					}
				}
				return $imgs;
			}
   			
			return false;
		}
	}




	/**
	 * 清空数据
	 */
	function emptyUserData()
	{
		global $app;
		import('cache.cache');
		$uid = intval($_REQUEST['id']);

		if( $uid > 0 )
		{
			//开始清空
			$tables = array(
				'#__menu_types',
				'#__menu',
				'#__companies',
				'#__configs',
				'#__contents',
				'#__products',
				'#__pages',
				'#__modules'
			);
			foreach($tables as $t )
			{
				$this->db->query("delete from ".$t." where uid=".$uid );
			}
			Cache::delCache($uid);
			$app->enqueueMessage(' 该会员数据清空成功.');
		}
	}

	function import(){

		global $app;
		
		import('cache.cache');
		if( Cache::isCache($this->uid) ){
			//是否生成缓存配置信息
			echo '该用户已生成缓存信息!';
			return false;
		}
 
		$path = PATH_PREVIEW.DS.'templates'.DS.$app->getPreviewTemplate().DS.'installdata.php';
		if( file_exists($path) )
		{
			include($path);
		}

 		
		//session
		$session = &Factory::getSession();

		//开始导入菜单数据
		if( isset($menu_types) )
		{
			//导入菜单分类
			foreach( $menu_types as $k=>$v )
			{
				$v['uid'] = $this->uid;
				$this->db->insertArray("#__menu_types",$v);
				//print_r($v);
				$menu_type[$k]['id'] = $this->db->insertid();
			}


			//导入菜单信息
			import('application.tree');
			$tree = new Tree();
			$menu_data = $session->get('menu');

			//商品分类菜单
			$menu_product_type = null;
			
			$id = 0;	//插入菜单的ID信息



 			foreach( $menu_data['menu_name'] as $k=>$name )
			{
				$data = array(
						'uid'=>$this->uid,
						'tid'=>$menu_type[0]['id'],
						'component'=>'pages',	//组件名称
						'name'=>$name,			//菜单名称
 						'type'=>'component',	//菜单类型
						'published'=>1
 					);
			
				//print_r($data);
				$id = $tree->addsort(0,$data);	
				
				if(  $menu[$k]['component'] == 'products' ){
					$data['parent_id'] = $id;	//商品分类菜单
					$menu_product_type = $data;	
				}

				//设为首页
				if( $menu[$k]['home'] == 1 )
				{
 					$this->db->query("update #__menu set home=1 ,  link='index.php?com=pages&view=homepage&id=$id ' where id=".$id);
				}else{
					//加链接
					$this->db->query("update #__menu set link='index.php?com=pages&view=page&id=$id' where id=".$id);
				}
				//$this->db->insertArray("#__menu",$data);
			}



			/**
			 * 补救,让最后一个添加的菜单为商品菜单
		
			//是否有菜单分类信息
			if( empty($menu_product_type) )
			{
				$data['parent_id'] = $id;	//商品分类菜单
				$menu_product_type = $data;	
			}
		  */



			//导入模块信息
			foreach( $modules as $m )
			{	
				$m['uid'] = $this->uid;
				//print_r($m);
				$this->db->insertArray("#__modules",$m);
			}


			//导入商品信息
			$products = $session->get('products');
			
			//是否需要插入商品
			if( $menu_product_type ){
				$type = array();	//商品分类信息 
				foreach( $products['product_type'] as $k=>$ptype )
				{
					//商品分类是否已经生成
					if( isset($type[$ptype]) )
					{
				
					}else{
						//生成分类并
						$menu_product_type['component'] = 'products';
						$menu_product_type['name'] = $ptype;	//分类名称

						$pid = $menu_product_type['parent_id'];	//取出父ID，并清除
						unset($menu_product_type['parent_id']);
						$type[$ptype] = $tree->addsort($pid,$menu_product_type);	
					}
					
					$data = array(
							'uid'=>$this->uid,
							'title'=>$products['product_name'][$k], 
							'introtext'=>$products['product_name'][$k], 
							'thumbnail'=>$products['product_img'][$k],
							'menuid'=>intval($type[$ptype]),
							'isfront'=>1,
							'published'=>1
						);
					$this->db->insertArray("#__products" , $data);
				}
			}
		
			



		
			//插入系统配置信息
			$data = array(
			'title'=>'',
			'email'=>'',
			'metakey'=>'',
			'metadesc'=>'',
			'template'=>'default'
			);
	 
 			$data['uid'] = $this->uid;
			$this->db->insertArray( "#__configs" , $data  );
 		 

		
			

			//最后
			Cache::cacheConfig();	//生成缓存配置信息
			echo '导入完成!';

		}
	}
}
?>