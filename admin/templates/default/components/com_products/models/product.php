<?php
import('application.component.model');
class ProductModel extends Model
{
	var $menuid = 0;

	var $nav = null;
	function ProductModel()
	{
		parent::__construct();
		$this->tableName = '#__products';
		$this->menuid = intval($_REQUEST['menuid']);
	}


	//取规格信息
	function getSpec($ids){ 
		$data = array();
		if( $ids ){
			$sql = "select v.spec_value,v.spec_value_id, s.name,s.id from #__products_spec_values as v left join #__products_specification as s on v.spec_id=s.id where v.spec_id in ( '".str_replace(',',"','",$ids)."' )";
			$this->db->query($sql);
			$data = $this->db->getResult('id',true); 
		}
		return $data;
	}
		

	//取规格列表
	function getSpecValue($id){
		if( $id>0 ){
			$sql = "select * from #__products_spec where products_id='".$id."' ";
			$this->db->query($sql);
			return $this->db->getResult('products_spec_id');
		}
	}




	//通过分类ID，取属性分类ID
	function getTypeID($catid){
		$sql="select type_id from #__category where id='".$catid."' ";
		$this->db->query($sql);
		return $this->db->getRow();
	}
	function getSelectList()
	{
		global $app;
		
		$context = $_REQUEST['com'];

		$order = $app->getUserStateFromRequest( 'filter_order',		'',		$context);
		$order_dir = $app->getUserStateFromRequest('filter_order_dir',		'',		$context  );
		$key =	 $_REQUEST['key'];
		$lists['key'] = trim($key);
		$lists['order'] = $order;
		$lists['order_dir'] = $order_dir;

		//分类ID，分类名
		$catid = intval($_REQUEST['catid']); 
		$select =" , m.name as typename ";  
		$where = array();
		if( $catid > 0 )
		{
			$where[] = "  c.catid=".$catid."  ";
		} 
	 
		if( $key )
		{
			$where[] = "  c.name like ('%".$key."%')  ";
		}


		$where = count($where)>0 ? " where ".implode(' and ',$where):'';

		//排序
		if( $order )
		{
			$order  = " order by ".$order." ".$order_dir;
		}else{
			$order = " order by c.id desc  ";
		}

 
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName." as c ";

 		//过滤菜单项
		$sql .= " left join #__category as m on c.catid=m.id ";  
 		$sql .= $where;
		

		$this->db->query($sql);
		$result = $this->db->getRow();
		$this->nav = new Navigations(6,$result['n']);
		

 

		//过滤菜单项
		$sql = " select c.id,c.name,c.isfront,c.thumbnail,c.images,c.catid,  c.modified   ".$select." from ".$this->tableName." as c ";
 		$sql .= " left join #__category as m on c.catid=m.id "; 
		$sql .= $where;
		$sql .= $order;
		$sql.= $this->nav->getLimit($_REQUEST['page']);


 		$this->db->query($sql); 
		$lists['rows'] =$this->db->getResult();
		return $lists;

	}


	function getCat(){
		$sql = "select name,id,parent_id,type_id,spec_ids from #__category ";
		$this->db->query($sql);
		return $this->db->getResult('parent_id',true);
	}


	//商品属性列表
	function getAttr($type_id){
		
		if( $type_id>0 ){
		$sql = " select attr_id,attr_name,	attr_input_type,attr_type,	attr_values from #__products_attribute where type_id='".$type_id."' order by ordering ";
		$this->db->query($sql); 
		return $this->db->getResult();
		}

		return array();
	}

	//获取商品值列表
	function getAttrValue($id){
		$data  = array();
		if( $id>0 ){
			$sql = " select * from #__products_attr where products_id='".$id."'  ";
			$this->db->query($sql); 
			$data = $this->db->getResult('attr_id',true);
		} 
	    return $data;
	}

	//获取商品值列表
	function getAttrV($id){
		$data  = array();
		if( $id>0 ){
			$sql = " select * from #__products_attr_v where products_id='".$id."'  ";
			$this->db->query($sql); 
			$data = $this->db->getResult('attr_value_id');
		}
	    return $data;
	}

 	//取规格信息
	function getSelected($id){   
		$sql=" select p.id, p.name,l.is_double from #__products_link as l left join ".$this->tableName." as p on l.products_link_id = p.id where l.products_id=".$id;
		$this->db->query($sql);
		return $this->db->getResult(); 
		  
	}
 	function getGroup($id){  
		$sql=" select p.id, p.name,g.products_price from #__products_group as g left join ".$this->tableName." as p on g.products_id = p.id where g.parent_id=".$id;
		$this->db->query($sql);
		return $this->db->getResult();  
	}


	//品牌列表
	function getBrand(){
		$sql = "select brand_id,brand_name from #__brand   ";
		$this->db->query($sql);
		$data =array();
		while($this->db->next_record()){
			$data[$this->db->Record['brand_id']]=$this->db->Record['brand_name'];
		}
		return $data;
	}

	/**
	 * 取当前编辑项
	 */
	function getItem()
	{
		$id =intval($_REQUEST['id']);

		$row = array();
		if( $id >0 )
		{

		
			$sql = " select * from ".$this->tableName." where id='".$id."' ";
			$this->db->query($sql); 
			$row = $this->db->getRow();	//获取菜单项数据
			//Error::throwError('无效的ID!');


			$sql = "select cat_id from #__products_cat where products_id=".$id;
			$this->db->query($sql);
			$row['other_cat'] = $this->db->getResult();
		}
		

		return $row;
	}


	//清除商品链接商品
	function getDeletelink(){
		$sql = "delete from #__products_link where products_id = 0 or products_link_id=0  ";
		$this->db->query($sql);
	}

	//商品附件
	function getAccessories(){

		$id = intval($_GET['id']);
		$sql = "select * from #__products_accessories where product_id=".$id;
		$this->db->query($sql);
		return $this->db->getResult();
	}

	
	function getAcctype(){
		$sql = "select type,language_id from #__products_accessories group by type ";
		$this->db->query($sql);
		return $this->db->getResult();
	}

	/**
	 * 保存
	 */
	function save()
	{
		global $app;
		$id = intval( $_REQUEST['id'] );
		$image_str = trim($_POST['images'],',');
 		$data = array(
			'name'=>$_POST['name'],			//商品名称
			'model'=>$_POST['model'],			//商品型号
			'introtext'=>$_POST['introtext'],	//简介
			'fulltext'=>$_POST['fulltext'], 
			'packaging'=>$_POST['packaging'],
			'catid'=>(int)$_POST['catid'],
			'shop_price'=>round($_POST['shop_price'],2),
			'market_price'=>round($_POST['market_price'],2),
			'market_time'=>$_POST['market_time'],
  			'price_s'=>round($_POST['price_s'],2),
			'price_e'=>round($_POST['price_e'],2),	
			'weight'=>round($_POST['wei'],2),
			'store'=>(int)$_POST['sto'],	 
			'give_integral'=>$_POST['give_integral'],
			
			'brand_id'=>(int)$_POST['brand_id'],
			'images'=>$image_str,
			'title'=>$_POST['title'],			//页面标题
			'metakey'=>$_POST['metakey'],			//页面关键字
			'metadesc'=>$_POST['metadesc'],	//页面描述 

			'thumbnail'=>$_POST['oldthumbnail'],
		);

		$pos = 0;	//是否为根目录
		if( $_POST['thumbnail'] ){
			$data['thumbnail'] = $_POST['thumbnail'];
			
			$pos = strpos($data['thumbnail'],'/media');
		}else if( $_POST['recreate'] == '1' ){ 
			if( $pos = strpos($image_str,'|1') ){
				$tmp=substr($image_str,0,$pos);
				$tmp_a = explode(',',$tmp);
				$outimg = $tmp_a[count($tmp_a)-1]; 
				$data['thumbnail'] = substr($outimg,0,-4).'_s.jpg';

				$pos = strpos($data['thumbnail'],'/media');
			} 
		}
		if( $pos > 1 ){
			$image_str = substr($image_str,$pos);
		}

		$this->correction($data,$id);
 
		

		//if( is_array($_REQUEST['params'] ) )	//保存参数列表
		//{
			//import('html.format.ini');
			//$data['params'] = FormatINI::arrayToString($_REQUEST['params']);
		//}

 
		//把商品属性列到字段中
		$attr_values = (array)$_POST['attr_value_list'];
		$attr_ids = (array)$_POST['attr_id_list']; //attr_id 

		$attrs = array();
		foreach( $attr_values as $k=>$v ){
			if( !empty( $v ) ){
				$attrs[$attr_ids[$k]][]= $v ;
			}
		}

 		$data['attribs'] = serialize( array('attr'=>$attrs,'aimg'=>$_POST['attr_img_list'] ) );
		//商品属性已完成
		
		



		//规格属性
		
		$pn = (array)$_POST['pn'];
		$spec_ids = (array)$_POST['products_spec_id'];
		$cost = (array)$_POST['cost'];
		$weight = (array)$_POST['weight'];
		$price = (array)$_POST['price'];
		$store = (array)$_POST['store'];
		
		$spec_ = (array)$_POST['spec_'];

		//print_r($spec_);exit;
		
		$specs = array();
		foreach( $pn as $k=>$v ){

			$a = '';
			foreach( $spec_ as $x=>$y){ $a.=$y[$k].','; }
			$specs[] = array(
				'pn'=>$v,
				'cost'=>$cost[$k],
				'weight'=>$weight[$k],
				'price'=>$price[$k],
				'store'=>$store[$k],
				'attr'=>substr($a,0,-1) 
			);
		}
		$data['specs'] = serialize( $specs );

        //print_r($specs);exit;



		if( $id > 0 )
		{
			$data['modified'] = date('Y-m-d H:i:s');
			$this->db->updateArray( $this->tableName, $data , " id='{$id}' " );
 		}else{
 			$data['uid'] = $this->uid;
			$data['ordering'] = $this->getNextOrder("");	//获取排序值
			$data['created'] = date('Y-m-d H:i:s');
			$data['published']=1;

			$this->db->insertArray( $this->tableName, $data  );
			$id = $this->db->insertid();
 		}



		$cat_list = (array)$_POST['other_cat'];
 		$exist_list = array();

		/* 查询现有的扩展分类 */
		$sql = "SELECT cat_id FROM #__products_cat WHERE products_id = '$id'";
		$this->db->query($sql);
		while( $this->db->next_record() ){
			$exist_list[] = $this->db->Record['cat_id'];
		}
 

		/* 删除不再有的分类 */
		$delete_list = array_diff($exist_list, $cat_list);
		if ($delete_list)
		{
			$sql = "DELETE FROM #__products_cat  WHERE products_id = '$id' " .
					"AND cat_id in (".implode(',',$delete_list).")";
			$this->db->query($sql);
		}

		/* 添加新加的分类 */
		$add_list = array_diff($cat_list, $exist_list, array(0));
		foreach ($add_list AS $cat_id)
		{
			// 插入记录
			$sql = "INSERT INTO #__products_cat  (products_id, cat_id) " .
					"VALUES ('$id', '$cat_id')";
			$this->db->query($sql);
		}






		//商品相关搜索的属性保存到相应表中去
		$attr_value_id = (array) $_POST['attr_value_id'];

		$attr_value_id2 = array_flip( (array) $_POST['attr_value_id2'] );

		$attr_value_id += $attr_value_id2;

 

		$sql = "select products_id,attr_id,attr_value_id from  #__products_attr_v  where products_id='".$id."' ";
		$this->db->query($sql);
		$attr_result = $this->db->getResult('attr_value_id');


		$attr_ids_del = $attr_ids_new = $attr_ids_update = array();
		$attr_ids_result =array();
		foreach( $attr_result as $k=>$v ){
			//$attr_ids_result[$v['attr_id']][] = $v['attr_value_id'];
			if( isset( $attr_value_id[$k]) ){	
				//已添加该属性 
				unset($attr_value_id[$k]);
			}else{
				$attr_ids_del[]=$k;
			}
		}

		

	

 		//如果设置相关属性值，则进行更新操作
		if( count($attr_ids_del)>0 ){
 
			//先清除没有值的属性
			$sql = "delete from #__products_attr_v where products_id='".$id."' and attr_value_id  in (".implode(',',$attr_ids_del).")";
			$this->db->query($sql); 
			 //echo $sql;
		}
		//新添加相关属性
		if( count($attr_value_id)>0 ){
			foreach( $attr_value_id as $k=>$v ){ 
				$sql = "insert into #__products_attr_v set products_id='".$id."', attr_id = '".$v."', attr_value_id='".$k."' ";
				$this->db->query($sql); 
 			}
		}








		
		/** 商品属性管理 **/
		
		/**
		$sql = "select * from  #__products_attr  where products_id='".$id."' ";
		$this->db->query($sql);
		$attr_result = $this->db->getResult('products_attr_id');

		$attr_ids_result =array();
		foreach( $attr_result as $k=>$v ){
			$attr_ids_result[$k] = $v['attr_id'];
		}

		//print_r($attr_ids_result);
		
		//商品属性
		$attr_values = (array)$_POST['attr_value_list'];
		$attr_ids = (array)$_POST['attr_id_list']; //attr_id 
		$attr_prices = (array)$_POST['attr_price_list'];
		$attr_tb = (array)$_POST['attr_img_list'];
		
		$attr_ids_del = $attr_ids_new = $attr_ids_update = array();

		foreach( $attr_values as  $k=>$val ){
				
 
				//是否已有值
				if( in_array($attr_ids[$k],$attr_ids_result) ){
					
					//在存在的属性中查找对应的ID
					foreach( $attr_ids_result as $k2=>$v ){
						if( $attr_ids[$k] == $v ){
							if( $val == '' || $val == '0' ){
								$attr_ids_del[] = $k2;
							}else{

								unset($attr_ids_result[$k2]);
							  
								$attr_ids_update[$k2] = array('value'=>$attr_values[$k],'attr_id'=>$attr_ids[$k],'price'=>$attr_prices[$k],'tb'=>$attr_tb[$k]);
							}
 
						break;
						}
					}

				}else{
					if( $val != '' && $val != '0' ){
						$attr_ids_new[] = array('value'=>$attr_values[$k],'attr_id'=>$attr_ids[$k],'price'=>$attr_prices[$k],'tb'=>$attr_tb[$k]);
					}
				}
		}
		$attr_ids_del = $attr_ids_del + array_keys($attr_ids_result);
 		 
		//如果设置相关属性值，则进行更新操作
		if( count($attr_ids_del)>0 ){
			//先清除没有值的属性
			$sql = "delete from #__products_attr where products_id='".$id."' and products_attr_id  in (".implode(',',$attr_ids_del).")";
			$this->db->query($sql); 
			//echo $sql;
		}
	 
		if( count($attr_ids_update)>0 ){

			foreach( $attr_ids_update as $k=>$v ){
				//先清除没有值的属性
				$sql = "update #__products_attr set attr_value='".$v['value']."',attr_price='".$v['price']."',tb='".$v['tb']."' where products_id='".$id."' and products_attr_id ='".$k."' ";
				$this->db->query($sql); 
			}
		}
		if( count($attr_ids_new)>0 ){
			foreach( $attr_ids_new as $k=>$v ){ 
				$sql = "insert into #__products_attr set products_id='".$id."', attr_id = '".$v['attr_id']."', attr_value='".$v['value']."',attr_price='".$v['price']."',tb='".$v['tb']."' ";
				$this->db->query($sql); 
 			}
		}

 
		unset($attr_result,$attr_values,$attr_ids,$attr_prices,$attr_ids_del,$attr_ids_update,$attr_ids_new);
		**/


 


		//print_r($pn);
		//print_r($spec_ids);
		//
		//exit;

		//print_r($pn);exit;



		/***
		 //商品规格
		$sql = "select * from  #__products_spec where products_id='".$id."' ";
		$this->db->query($sql);
		$spec_result = $this->db->getResult('products_spec_id');
			
		$pn = (array)$_POST['pn'];
		$spec_ids = (array)$_POST['products_spec_id'];
		$cost = (array)$_POST['cost'];
		$weight = (array)$_POST['weight'];
		$price = (array)$_POST['price'];
		$store = (array)$_POST['store'];
	
		//规格选择参数
		$spec_id_str = trim($_POST['spec_id_str']);
		$spec_id_list =  explode(',',$spec_id_str);

		$spec_ = (array)$_POST['spec_'];

 		//print_r($spec_value);exit;
 		$spec_news =  $spec_update  = $spec_del = array();

		foreach( $pn as $k=>$value ){
			$spec_id = $spec_ids[$k]; 
			
			$spec_value = array();
			foreach( $spec_id_list as $spec ){
				 $spec_value[] =  $spec_[$spec][$k];
			}


			//是否已经添加的该规格值
			if( $spec_result[$spec_id] ){
				//更新
				//if(  $value ){
					$spec_update[]= array(
						'products_spec_id'=>$spec_id,
						'pn'=>$value,
						'spec_price'=>$price[$k], 
						'weight'=>$weight[$k], 
						'cost'=>$cost[$k], 
						'spec_value'=>implode(',',$spec_value),
						'store'=>$store[$k],
					);

					//print_r($spec_update);
				//}else{
				//	$spec_del[]=$spec_id;
				//}
			}else{
				$spec_news[] = array( 
						'pn'=>$value,
						'spec_price'=>$price[$k], 
						'weight'=>$weight[$k], 
						'cost'=>$cost[$k], 
						'spec_value'=>implode(',',$spec_value),
						'store'=>$store[$k],
				);

			}
		}
		
		$delstr = trim($_POST['delspec'],',');

		//echo $delstr;exit;
		//print_r($spec_update);exit;

		//如果设置相关属性值，则进行更新操作
		if( $delstr ){

			//print_r($spec_del);

			//先清除没有值的属性
			$sql = "delete from #__products_spec where products_id='".$id."' and products_spec_id  in (".$delstr.")";
			$this->db->query($sql); 
			 //echo $sql;
		}

		if( count($spec_update)>0 ){
			
			//print_r($spec_update);exit;
			foreach( $spec_update as $k=>$v ){
				//先清除没有值的属性
				$sql = "update #__products_spec set pn='".$v['pn']."',spec_price='".$v['spec_price']."',weight='".$v['weight']."',cost='".$v['cost']."',spec_value='".$v['spec_value']."',store='".$v['store']."'  where products_spec_id='".$v['products_spec_id']."'  ";
				$this->db->query($sql); 
 
			}
		}
		//print_r($spec_news);exit;

		if( count($spec_news) > 0 ){
			foreach( $spec_news as $k=>$v ){ 
			$sql = "insert into #__products_spec set products_id='".$id."', pn = '".$v['pn']."', spec_price='".$v['spec_price']."',weight='".$v['weight']."',cost='".$v['cost']."',spec_value='".$v['spec_value']."' ,store='".$v['store']."' ";
			$this->db->query($sql); 
 			}
		}   
		**/

		//
		$sql = "update #__products_link set products_id='".$id."' where products_id=0 ";
		$this->db->query($sql);
		$sql = "update #__products_link set products_link_id='".$id."' where products_link_id=0 ";
		$this->db->query($sql);

		//配件
		$sql = "update #__products_group set parent_id='".$id."' where parent_id=0 ";
		$this->db->query($sql);


		//print_r($attr_ids_update);
		//exit;
		
		/***
		//附件排序
		$downloads_ordering = trim($_REQUEST['downloads_ordering'],',');
		$order_downloads = explode(',',$downloads_ordering);

		$ds = array();
		foreach( $order_downloads as $v ){
			$order_d = explode('|',$v);
			$ds[$order_d[1]] = $order_d[0];
		}
		
		//print_r($ds);

		//是否有附件信息
		$download_file = trim($_REQUEST['new_downloads'],',');
		$files = explode(',',$download_file);

		if( count($files)>0 ){
			foreach( $files as $v ){
				$file = explode('|',$v);
				if( $file[0] && $file[1] && $file[2] ){
					$data = array(
						'name'=>$file[0],
						'type'=>$file[1],
						'language_id'=>$file[3],
						'file_path'=>$file[2],
						'ordering'=>$ds[$file[0]],
						'product_id'=>$id
						
					);
					
					$this->db->insertArray('#__products_accessories',$data);
				}

				
			}
			 
		}
		**/


		return true;
	}

	//把图片的路径修正为以每1-200个产品为目录
	function correction(&$data,$id){
		if( $id<1 ){
			$sql = "select max(id) as m from ".$this->tableName;
			$this->db->query($sql);
			$row = $this->db->getRow();
			$id = $row['m']+1;
		}
		$id = (intval($id/200)+1)*200;

		$images = explode(',', $data['images']);
		foreach( $images as $k=>$v ){
			$tmp  = explode('/',dirname($v));
		 
			if( $tmp[count($tmp)-1] == 'products' ){
				$new_uri_path=dirname($v).'/'.$id;//.basename($v);
				$path = PATH_ROOT.$new_uri_path;
				if( !is_dir($path) ){
					mkdir($path);
				}

				//把后缀去掉
				$v2 = explode('|',basename($v));
				$v3 = explode('|',$v);

				rename(PATH_ROOT.$v3[0],$path.DS.$v2[0]);
				
				$s = substr(PATH_ROOT.$v3[0],0,-4).'_s.jpg';
				if( file_exists( $s ) ){
					rename( $s, dirname($s).DS.$id.DS.basename($s) );
				}
				

 				$images[$k]=dirname($v).'/'.$id.'/'.basename($v);
			}
		}
		$data['images'] = implode(',',$images);

 
		$tmp  = explode('/',dirname($data['thumbnail']));

		//print_r($tmp);exit;
		if( $tmp[count($tmp)-1] == 'products' ){
			$s = PATH_ROOT.$data['thumbnail'];
			if( file_exists( $s ) ){
				rename( $s, dirname($s).DS.$id.DS.basename($s) );
			}
			$data['thumbnail']=dirname( $data['thumbnail'] ).'/'.$id.'/'.basename($data['thumbnail']);
		}
		return $data;
		
	}
	

	/** 删除内容 **/
	function delete($id)
	{
		if( $id > 0 )
		{ 
			//删除前，先把其它排序值减一
			$sql = "select ordering,images,menuid from ".$this->tableName." where   id=".$id;
			$this->db->query($sql);
			$row = $this->db->getRow();
			$sql =" update ".$this->tableName." set ordering = ordering-1 where ordering > ".(int)$row['ordering'];
			$this->db->query($sql);


 
			//删除图片
			$imgs = explode(',',$row['images']);
			foreach( $imgs as $x=>$y ){
				$y = explode('|',$y);
				$img = PATH_ROOT.str_replace('/',DS,$y[0]);  
				
				if( file_exists($img) ){
					unlink($img); 
				}
				$thumbIMG = substr($img,0,-4).'_s.jpg'; 
				if( file_exists($thumbIMG) ){
					unlink($thumbIMG); 
				}
			}
		 

			$sql = "delete from ".$this->tableName." where id=".$id." ";
			$this->db->query($sql);
 
			$sql = "delete from #__products_spec where products_id='".$id."' ";
			$this->db->query($sql); 

			$sql = "delete from #__products_attr_v where products_id='".$id."'  ";
			$this->db->query($sql); 


			$sql = "delete from #__products_link where products_id='".$id."' or products_link_id='".$id."' ";
			$this->db->query($sql); 
			return true;
		}

		return false;
	}


	/** 移动所选择的文章到指定菜单 **/
	function moveall()
	{
		global $app;
		$ids =  $this->_filterID( $_REQUEST['ids'] );
		$moveToID = intval(  $_REQUEST['movetoid'] );
 		if( count($ids) && $moveToID>0 )
		{
			$sql = " update ".$this->tableName." set catid=".$moveToID." where uid = ".$this->uid." and id in (".implode(',',$ids).") ";
			//echo $sql;exit;
			$this->db->query($sql);

			$app->enqueueMessage(' 移动成功,共移动 '.count($ids).'项.');
		}
		return true;
	}

	/** 拷贝一份 **/
	function copy()
	{
 		global $app;
		$copy_ids = &$this->_filterID( $_REQUEST['ids'] );
		if( count($copy_ids) )
		{
			$sql = " select * from ".$this->tableName." where id in (".implode(',',$copy_ids).") ";
			$this->db->query($sql);
			$rows = $this->db->getResult();
			foreach( $rows as $row )
			{
				unset($row['id']);
				$row['name'] = "新建 ".$row['name'];
				$row['introtext'] = addslashes($row['introtext']);
				$row['fulltext'] = addslashes($row['fulltext']);
				//$row['ordering'] =  (int)($this->getNextOrder(" position='".$row['position']."' "));
				$this->db->insertArray( $this->tableName,$row );

 			}

			$this->reorder();	//重新排序

			$app->enqueueMessage(' 复制成功,共复制 '.count($copy_ids).'项.');
		}
 		return true;
	}
	/** 全部删除 **/
	function deleleall(){
		global $app;
		$copy_ids =  $this->_filterID( $_REQUEST['ids'] );

 		if( count($copy_ids) )
		{
			$sql = " select images from ".$this->tableName." where  id in (".implode(',',$copy_ids).") ";
			//echo $sql;exit;
			$this->db->query($sql);
			$data = $this->db->getResult();
			foreach( $data as $k=>$v ){
				 
				$imgs = explode(',',$v['images']);
				foreach( $imgs as $x=>$y ){
					$y = explode('|',$y);
					$img = PATH_ROOT.str_replace('/',DS,$y[0]);  
					
					if( file_exists($img) ){
						unlink($img); 
					}
					$thumbIMG = substr($img,0,-4).'_s.jpg'; 
					if( file_exists($thumbIMG) ){
						unlink($thumbIMG); 
					}
 				}
			}

			$sql = " delete from ".$this->tableName." where  id in (".implode(',',$copy_ids).") ";
			//echo $sql;exit;
			$this->db->query($sql);

			$this->reorder();	//重新排序

			$sql = "delete from #__products_spec where products_id in (".implode(',',$copy_ids).") ";
			$this->db->query($sql); 

			$sql = "delete from #__products_attr_v where products_id in (".implode(',',$copy_ids).") ";
			$this->db->query($sql); 

			$sql = "delete from #__products_link where  products_id in (".implode(',',$copy_ids).") or products_link_id in (".implode(',',$copy_ids).")  ";
			$this->db->query($sql); 


			$app->enqueueMessage(' 删除成功,共删除 '.count($copy_ids).'项.');
		}
		return true;
	}
	
	function movetorecycle()
	{
		global $app;
		$copy_ids =  $this->_filterID( $_REQUEST['ids'] );

 		if( count($copy_ids) )
		{
			$sql = " update ".$this->tableName." set menuid=0 where uid = ".$this->uid." and id in (".implode(',',$copy_ids).") ";
			//echo $sql;exit;
			$this->db->query($sql);
			$app->enqueueMessage(' 放入回收站成功,共移动 '.count($copy_ids).'项.');
		}
		return true;
	}

	function  _filterID($string){
		if( $string )
		{
			$id_array = explode( ',',$string);
			$copy_ids = array();
			foreach( $id_array as $id )
			{
				if( $id = intval($id) )
				{
					$copy_ids[] = $id;
				}
			}
		}

		return $copy_ids;
	}

	function getNav(){
		return $this->nav;
	}
	/** 修改状态 **/
	function toggle()
	{
		if( ($id = intval($_REQUEST['id']) )>0 && $_REQUEST['attr'] )
		{
			$arr = array( $_REQUEST['attr'] =>$_REQUEST['value'] );
			$this->db->updateArray($this->tableName,$arr," id='".$id."' and uid='".$this->uid."' ");
		}
	}

	/** 修改排序值 **/
	function ordering()
	{
		global $app;
		$id = intval( $_REQUEST['id'] );
		$from = intval( $_REQUEST['from'] );
		$to = intval( $_REQUEST['to'] );
		
		if( $id>0 && $to>0 )
		{
			$sql = "select ordering,menuid from ".$this->tableName." where  id=".$id;
			$this->db->query($sql);

			$row = $this->db->getRow();
			$from = (int)$row['ordering'];	//更新排序值
			$menuid = $row['menuid'];

			$sql = " select count(*) as n from ".$this->tableName;
			$this->db->query($sql);
			$result = $this->db->getRow();
			
			$count = $result['n'];

			if( $count < $to )
			{
				$app->enqueueMessage(' 排序失败，排序值大于最大值.');
				return false;
			}
			if( $from > $to ){		//向上移
				$sql = " update ".$this->tableName." set ordering = ordering+1 where ordering>=".$to." and ordering<".$from;
 			}else if( $from < $to )//向后移
			{
				$sql = " update ".$this->tableName." set ordering = ordering-1 where  ordering>".$from." and ordering<=".$to;
 			}
			//echo $sql;exit;
			$this->db->query($sql);

			$data = array('ordering'=>$to);
			$this->db->updateArray($this->tableName,$data," id=".$id." ");
			$app->enqueueMessage(' 排序成功.');

		}
	}

	function deleteImg($img){
		$suffix = substr($img,-3);
		$imgfilter = array('jpg','bmp','png','gif');
		if( in_array($suffix,$imgfilter) ){
			$img = '/media'.substr($img,6);
			$img = PATH_ROOT.str_replace('/',DS,$img);  
			
			if( file_exists($img) ){
				unlink($img); 
			}
			$thumbIMG = substr($img,0,-4).'_s.jpg'; 
			if( file_exists($thumbIMG) ){
				unlink($thumbIMG); 
			}
			echo '1';
		}
	}

	function saveImg($img){
		$id = (int)$_GET['id'];
		if( $id > 0 ){
			$data = array('images'=>$img); 
			$this->db->updateArray($this->tableName,$data," id='".$id."' ");
		}
	}


 }



?>