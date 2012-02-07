<?php
import('application.component.model');
class MenuModel extends Model
{
	var $menutypeid;
	

	//var $select_com = null;		//当选择链接组件时，当前的组件

	
	function MenuModel()
	{
		parent::__construct();
		$this->tableName = '#__menu';
		$this->menutypeid = intval($_REQUEST['mtid']);


	}


	//取所有菜单,以数组类型反回
	function getList()
	{
		import('application.tree');
		$tree = new Tree();
		//$result = $tree->getcatagory(1,2);
		$result = $tree->getAll();
		return $result;
	}



	function getAllmenu()
	{
		$sql=" select id,tid,name,component,parent_id from ".$this->tableName;
		//$sql.=" where published =1 ";
		$sql .= " order by lft ";
		$this->db->query($sql);
		$results = $this->db->getResult('tid',true);

		$sql=" select * from #__menu_types ";
		$this->db->query($sql);
		$types = $this->db->getResult('id');
		
		$rows = array();
		$tem = array();
		foreach( $types as $type )
		{
			if( isset( $results[$type['id']] ) )
			{
				$tem = $results[$type['id']];
				foreach( $tem  as $v )
				{
					$rows[$type['id']][$v['parent_id']][] = $v;
				}
			}
		}
		unset( $results, $tem);
		return array('types'=>$types,'rows'=>$rows);
	}


	/**
	 * 取当前编辑项
	 */
	function getItem()
	{
		global $app;
		import('filesystem.xml');

		$id =intval($_REQUEST['id']);
		if( $id < 1 )
		{
			//if( !isset($_REQUEST['url']) ){
			//	Error::throwError('无效的ID!');
			//}
			$row = array(
				'link'=>'index.php?',
				'type'=>'component'
			);
		}else{
			$sql = " select * from ".$this->tableName." where id='".$id."' ";
			$this->db->query($sql);
			$row = $this->db->getRow();	//获取菜单项数据
			
			$lt = Language::getLanguageType();

			if( count($lt)>1 ){
				/** 语言版本 **/
				$sql = "select * from #__menu_description where menu_id=".$row['id'];
				$this->db->query($sql);
				$results = $this->db->getResult();
				foreach( $results as $r )
				{
					$row['name'.$r['language_id']] = $r['menu_name'];
					$row['icon'.$r['language_id']] = $r['menu_icon'];
					$row['metakey'.$r['language_id']] = $r['menu_metakey'];
					$row['metadesc'.$r['language_id']] = $r['menu_metadesc'];
				}
			}

	
		}
		

		//这里有个BUG ，当用POST提变时，GET总是修改不了POST的数据
		if( isset($_REQUEST['type']) ){ $row['type'] = $_REQUEST['type'];	}
		if(  $_GET['type']  ){ $row['type'] = $_GET['type'];			}


		//根据菜单类型加载对应的参数
		if( $row['type'] == 'menulink' )
		{
			//加载metadata 文件
			$metadataFile = dirname(__FILE__).DS.'metadata'.DS.'menulink.xml';
			if( file_exists( $metadataFile ) )	//分析对应的参数
			{	
				import('html.parameter');
				$parameter = new Parameter($metadataFile);
				$parameter->bind( $row['params'] );
				$row['typeparameter'] = $parameter->render();
			}else{
				$row['typeparameter']='<i>没有相关参数.</i>';
			}
			$row['view_path'] = '菜单别名';

 		}else if( $row['type'] == 'url'){

			$row['typeparameter']='<i>没有相关参数.</i>';
			$row['view_path'] = '外部链接';
		
		}else{

			//分析相关菜单URL类型参数
			$link = parse_url($row['link']);
			parse_str($link['query'],$linkParameter);
			
			$urls = $_REQUEST['url'];	//重写URL选择组件参数
			if( is_array($urls) )
			{
				if( isset($urls['com']) )
				{
					$linkParameter['com'] = $urls['com'];
				}

				if( isset($urls['view']) )
				{
					$linkParameter['view'] = $urls['view'];
				}

				if( isset($urls['layout']) )
				{
					$linkParameter['layout'] = $urls['layout'];
				}else{
					unset($linkParameter['layout']);
				}
			}
			$linkParameter['id'] = $row['id'];
			unset($linkParameter['itemid']);
 			$row['link'] = 'index.php?'.http_build_query($linkParameter);	//重建URL

		
			//加载metadata 文件
			$metadataFile = $app->getPreviewComponentPath().DS.'com_'.$linkParameter['com'].DS.'views'.DS.$linkParameter['view'].DS.'tmpl';
			
			
		 
			if( $linkParameter['layout'] ){
				$metadataFile .= DS.$linkParameter['layout'].'.xml';
			}else{
				$metadataFile .= DS.'default.xml';
			}

			//echo $metadataFile;
			if( file_exists( $metadataFile ) )	//分析对应的参数
			{	
				import('html.parameter');
				$parameter = new Parameter($metadataFile);
				$parameter->bind( $row['params'] );
				$row['typeparameter'] = $parameter->render();
			}else{
				$row['typeparameter']='<i>没有相关参数.</i>';
			}
			
			
			
			//组件名称
			$row['com'] = $linkParameter['com']; // $row['component'];
			

			//构建视图路径:组件名称
			$com_xml_path = dirname(PATH_COMPONENT).DS.'com_'.$row['com'].DS.$row['com'].'.xml';

 			if( file_exists( $com_xml_path ) )
			{
				 $params = XML_unserialize( file_get_contents( $com_xml_path ) );
				 $view_path = $params['install']['name'];
			}

	 
			$com_preview_view = PATH_PREVIEW.DS.'components'.DS.'com_'.$row['com'].DS.'views'.DS.$linkParameter['view'];

			$com_preview_view_path = $com_preview_view.DS.'metadata.xml';


 			if( file_exists( $com_preview_view_path ) )
			{
				 $params = XML_unserialize( file_get_contents( $com_preview_view_path ) );
				 $view_path .= ' > '.$params['metadata']['view attr']['title'];
			}

			if( $linkParameter['layout'] ){
				$com_preview_layout_path = $com_preview_view.DS.'tmpl'.DS.$linkParameter['layout'].'.xml';
			}else{
				$com_preview_layout_path = $com_preview_view.DS.'tmpl'.DS.'default.xml';
			}

			if( file_exists( $com_preview_layout_path ) )
			{
				 $params = XML_unserialize( file_get_contents( $com_preview_layout_path ) );
				 $view_path .= ' > '.$params['metadata']['state']['name'];
			}

			$row['view_path'] = $view_path;
			
			//构建完成
		}






		//print_r($parameter);
 		//print_r($linkParameter);
		return $row;
	}

	/**
	 * 保存
	 */
	function save()
	{
		global $app;
		//创建树结构,用树结构来执行相应的操作
		import('application.tree');
		$tree = new Tree();

		$data = array(
			'name'=>$_REQUEST['name'],
			'icon'=>$_REQUEST['icon'],
			'link'=>$_REQUEST['link'],
			'alias'=>preg_replace('/[\s|　]+/','',$_REQUEST['alias']),
			'component'=>$_REQUEST['component'],
			'view_path'=>$_REQUEST['view_path'],
			'type'=>$_REQUEST['type'],
			'metakey'=>$_REQUEST['metakey'],
			'metadesc'=>$_REQUEST['metadesc'],
			'elite'=>$_REQUEST['elite'],
			'iscontent'=>$_REQUEST['iscontent']
		);
		



		 
		//没有写相关分类名称
		if( !$data['name'] )
		{
			$data['name'] = date('YmdHis');
		}

		if( $_REQUEST['autoalias']  ){
			import('chinesespell.chinesespell');
			$spell = new ChineseSpell();
			$alias = str_replace('_','',$spell->getFullSpell( mb_convert_encoding(String::substr($data['name'],0,6),'gb2312','utf-8'),'' ) );


			$sql = " select count(*) from ".$this->tableName." where  alias='".$alias."' ";

			if( $id > 0 )
			{
				$sql.=" and id<>".$id;
			}
			$this->db->query($sql);
			$row = $this->db->getRow();

			$alias = preg_replace('/[\s\v]+/','',$alias);
			if( $row['n'] > 0 ){
				$data['alias'] = $alias.'2';
			}else{
				$data['alias'] = $alias;
			}
		}

		//没有写相关别名
		if( !$data['alias'] )
		{
			$data['alias'] = date('YmdHis');
		}

		if( is_array($_REQUEST['params'] ) )	//保存参数列表
		{
			import('html.format.ini');
			$data['params'] = FormatINI::arrayToString($_REQUEST['params']);
		}


		//菜单别名时，链接要变一下
		if( $data['type'] == 'menulink')
		{
			$data['link'] = 'index.php?itemid='.intval($_REQUEST['params']['menu_item']);
		}




		


		$parent_id = intval($_REQUEST['parent_id']);	//父栏目的ID
		$id = intval( $_REQUEST['id'] );

		if( $id > 0 )
		{

			//print_r($_REQUEST);exit;

			//先判断是否有原内容，并是否转移
			if(  $shiftway = intval($_REQUEST['shiftway'])  )
			{

				//必需取出对应数据，否则可能会错误的表名
				$sql = " select component from ".$this->tableName." where id='".$id."' ";
				$this->db->query($sql);
				$row = $this->db->getRow();

				$shiftmenuid = intval($_REQUEST['shiftmenuid']);
				switch($shiftway)
				{
					case 1:	//清空内容
						$sql = " delete from #__".$row['component']." where menuid='".$id."' ";
						$this->db->query($sql);
						break;
					case 2:	//放入回收站
						$sql = " update #__".$row['component']." set menuid=0 where menuid='".$id."' ";
						$this->db->query($sql);
						break;
					case 3:	//转移到其它同类菜单
						$shiftmenuid = intval($_REQUEST['shiftmenuid']);

						if( $shiftmenuid > 0 ){
							$sql = " update #__".$row['component']." set menuid=".$shiftmenuid." where menuid='".$id."' ";
							$this->db->query($sql);
						}
						break;
				}
			}

			$data['parent_id'] = $parent_id;	//父栏目ID
			$tree->update($id,$data);

		}else{
			$data['tid'] = $this->menutypeid;
			$data['uid'] = $app->uid;
			$id = $tree->addsort($parent_id,$data);
			
			if( $data['type'] == 'component' ){
				//分析相关菜单URL类型参数
				$link = parse_url($data['link']);
				parse_str($link['query'],$linkParameter);
				$linkParameter['id'] = $id;	//链接ID
				$linkString = $link['path'].'?'.http_build_query($linkParameter);	//重建URL
				
				$data = array('link'=>$linkString);
				$this->db->updateArray($this->tableName,$data, " id='".$id."' ");
				unset($link);
			}
			unset($data,$linkParameter);

		}



		/*** 多语言版面的更新 **/

		/**
		$lt = Language::getLanguageType();
		foreach( $lt as $k=>$v )
		{
			$menu_name = $_REQUEST['name'.$k];
			$menu_icon = $_REQUEST['icon'.$k];
			$menu_metakey = $_REQUEST['metakey'.$k];
			$menu_metadesc = $_REQUEST['metadesc'.$k];
			

			$sql = " INSERT INTO #__menu_description ( menu_id,language_id,menu_name,menu_icon,menu_metakey,menu_metadesc)  VALUES({$id},{$k},'{$menu_name}','{$menu_icon}','{$menu_metakey}','{$menu_metadesc}')   ON DUPLICATE KEY UPDATE menu_name='{$menu_name}',menu_icon='{$menu_icon}',menu_metakey='{$menu_metakey}',menu_metadesc='{$menu_metadesc}' ";
			$this->db->query($sql);

		}
		**/
		


		return true;
	}


	/** 判断那些组件是内容管理组件，可以和菜单关联的组件 **/
	function isContents($table)
	{
		$array = array('contents','pages');

		if( in_array($table,$array) )
		{
			return true;
		}
		return false;
	}

	/** 取组件信息 **/
	function getCominfo()
	{
		global $app;

		import('filesystem.dir');
		import('filesystem.xml');

		$menuid = intval($_REQUEST['id']);	//当前菜单
		if( $_REQUEST['next'] == 'add' ){
			$baseuri = 'index.php?com=menu&type=component&mtid='.$this->menutypeid;
			$task= 'add';
			
			//构建基本的URI
		}else if( $_REQUEST['type'] == 'component' || $_REQUEST['type']=='' ) {
		
			//原菜单ID，查看是否有原内容需要转移
			if( $menuid > 0 && isset($_REQUEST['url']['com'])  && $_REQUEST['next'] != 'no' )
			{
				//echo $_REQUEST['url']['com'];	 
				$tableName = $_REQUEST['url']['com'];	//组件和表名对应
				
				
				//确认是否选择了其它类型
				$sql = "select component from #__menu where id=".$menuid;
				$this->db->query($sql);
				$row = $this->db->getRow();
				$formerTableName = $row['component'];

				//确定是否为内容和菜单关系的组件表
				if( $tableName != $formerTableName && $tableName  && $this->isContents( $formerTableName ) ){	//有些为空 	
					
					$sql = "select count(*) as n from #__".$formerTableName." where menuid='".$menuid."' ";

					//echo $sql;
					$this->db->query($sql);
					$row = $this->db->getRow();
					
					if( $row['n'] > 0 )
					{
						$app->redirect('index.php?com=menu&type=component&task=shiftcontent&no_html=1&id='.$menuid.'&mtid='.$this->menutypeid.'&max='.$row['n'].'&url[com]='.$formerTableName);
					}
				}
			}
			$baseuri = 'index.php?com=menu&type=component&mtid='.$this->menutypeid;	
			$task= 'edit';
			//构建基本的URI
		}




		//设置取 组件视图的程序
		if( isset($_REQUEST['url']['com']) ){ $select_com = $_REQUEST['url']['com']; }
			
 		// 找出对应的组件信息
		$sql = "select * from  #__components where parent=0 and link <>'' ";
		$this->db->query($sql);
		$rows = $this->db->getResult();



		//选择视图
		$dir = new WDir();
		foreach( $rows as $k=>$row )
		{
			$directory = $app->getPreviewComponentPath().DS.'com_'.$row['option'].DS.'views';
 			if( !is_dir($directory) ){ unset($rows[$k]);continue; }	//是否有该前台组件

			if( $select_com == $row['option'] ){
				
				if( $data = $dir->getFolders($directory) ){
					
					$str ='<ul>';
					foreach( $data as $d )
					{
						 $metaFile= $directory.DS.$d['name'].DS.'metadata.xml';
						 if( !file_exists($metaFile) ){ continue; };
						 $diectoryMeta = XML_unserialize( file_get_contents($metaFile) );

						 $str .= '<li> <div class="node" >'.$diectoryMeta['metadata']['view attr']['title'].'</div>';

						 $href = "&url[com]=".$row['option']."&url[view]=".$d['name'];
						 $tmplDirectory = $directory.DS.$d['name'].DS.'tmpl';
						 if( $layout = $dir->getFiles($tmplDirectory,'xml') )
						 {
							$layoutNum = count($layout)-1;
							$str .='<ul>';
							foreach( $layout as $index=>$lay )
							 {
								$href2 = '';
								 //布局文件
								 $xmlFile = $tmplDirectory.DS.$lay['name'];
								 
								 $xmlParameter = XML_unserialize(file_get_contents($xmlFile));


								 $layoutName = substr($lay['name'],0,-4);
								 if( $layoutName != 'default' )
								 {
									 $href2 = '&url[layout]='.$layoutName;
								 }
								 //print_r($xmlParameter);
								 if( $index < $layoutNum )
								 {
									$str .= '<li><div class="link-node" >';

								 }else{
									$str .= '<li><div class="link-bottom" >';
								 }

								 //当新添加一个菜单时，不能用脚本提交，直接用URL方式提交
								 if( $_REQUEST['next'] == 'add' ){
									 $str .= '<a href="'.$baseuri.'&id='.$menuid.$href.$href2.'&task='.$task.'" >';
								 }else{
									 $str .= '<a href="javascript:submit(\''.$baseuri.'&id='.$menuid.$href.$href2.'\',\''.$task.'\')" >';

								 }
								 $str .= $xmlParameter['metadata']['state']['name'];
								 $str .= '</a></div>';
								 $str .= '</li>';
							 }
							$str .= '</ul>';
						 }

						 $str .= '</li>';
					}
					$str .= '</ul>';

					$rows[$k]['parameter'] = $str;
					 
				}


				$rows[$k]['path'] = $directory;
			}//找到视图结束
			 
		}
		return $rows;
 	}



	/** 取菜单类型 **/
	function getLinkType()
	{
		$type = array(
			'component'=>''	,	
			'url'=>'',
			'menulink'=>''

		);

		return $type;
	}


	/** 删除 **/
	function del()
	{
		global $app;
		if( ($id=intval($_REQUEST['id'])) > 0 ){

 			//删除单页信息
			$sql = " delete from #__pages where uid=".$this->uid." and menuid=".$id;
			$this->db->query($sql);
 
			//删除单页信息
			$sql = " delete from #__pages_description where   menu_id=".$id;
			$this->db->query($sql,true);


			//删除多语言信息
			$sql = " delete from #__menu_description where   menu_id=".$id;
			$this->db->query($sql,true);

			import('application.tree');
			$tree = new Tree();
			$tree->deletesort($id);
 

			$app->enqueueMessage(' 删除成功.');
		}
	}

	function delmenu(){
		global $app;
		if( ($id=intval($_REQUEST['id'])) > 0 ){

			if( isset($_REQUEST['del']['com']) && $_REQUEST['del']['com'] != 'pages' )
			{


				//echo $_REQUEST['url']['com'];	
				$tableName = $_REQUEST['del']['com'];	//组件和表名对应
				
				if( $tableName ){	//有些为空
				
					$sql = "select count(*) as n from #__".$tableName." where menuid='".$id."' ";
					$this->db->query($sql);
					$row = $this->db->getRow();
					
					if( $row['n'] > 0 )
					{
						$app->redirect('index.php?com=menu&task=shiftcontent&no_html=1&id='.$id.'&mtid='.$this->menutypeid.'&max='.$row['n'].'&del[com]='.$_REQUEST['del']['com']);
					}
				}
			
				
			}
		}
	}
	

	/** 选择方式后删除 **/
	function delmenuconfirm(){

		global $app;

		if( ($id=intval($_REQUEST['id'])) > 0 ){
			//print_r($_REQUEST);exit;

			if(  $shiftway = intval($_REQUEST['shiftway'])  )
			{

				//必需取出对应数据，否则可能会错误的表名
				$sql = " select component from ".$this->tableName." where id='".$id."' ";
				$this->db->query($sql);
				$row = $this->db->getRow();

				$shiftmenuid = intval($_REQUEST['shiftmenuid']);
				switch($shiftway)
				{
					case 1:	//清空内容
						$sql = " delete from #__".$row['component']." where menuid='".$id."' ";
						$this->db->query($sql);
						break;
					case 2:	//放入回收站
						$sql = " update #__".$row['component']." set menuid=0 where menuid='".$id."' ";
						$this->db->query($sql);
						break;
					case 3:	//转移到其它同类菜单
						$shiftmenuid = intval($_REQUEST['shiftmenuid']);

						if( $shiftmenuid > 0 ){
							$sql = " update #__".$row['component']." set menuid=".$shiftmenuid." where menuid='".$id."' ";
							$this->db->query($sql);
						}
						break;
					default:
						$app->enqueueMessage(' 删除失败.');
						return false;
						break;
				}

				//另外加一个添空单页
				$sql = " delete from #__pages where menuid='".$id."' ";
				$this->db->query($sql);
				$sql = " delete from #__pages_description where menu_id='".$id."' ";
				$this->db->query($sql);


				import('application.tree');
				$tree = new Tree();
				$tree->deletesort($id);
				$app->enqueueMessage(' 删除成功.');
			}


		}
			
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



	/** 设为默认菜单 **/
	function setHome()
	{
		if( ($id = intval($_REQUEST['ids']) )>0  )
		{
			$arr = array('home'=>0 );
			$this->db->updateArray($this->tableName,$arr,"   uid='".$this->uid."' ");


			$arr = array('home'=>1 );
			$this->db->updateArray($this->tableName,$arr," id='".$id."' and  uid='".$this->uid."' ");

			return true;
		}
	}


	/** 解锁和锁定 **/
	function unlock()
	{
		global $app;

 		$ids =  $this->_filterID( $_REQUEST['ids'] );

 		if( count($ids) )
		{
			$sql = " update ".$this->tableName." set published=1 where uid = ".$this->uid." and id in (".implode(',',$ids).") ";
			//echo $sql;exit;
			$this->db->query($sql);
 			$app->enqueueMessage(' 操作成功,共解锁 '.$this->db->getAffectedRows().'项.');
		}
		return true;
		 
	}
	function lock()
	{
		global $app;
		$ids =  $this->_filterID( $_REQUEST['ids'] );
 		if( count($ids) )
		{
			$sql = " update ".$this->tableName." set published=0 where uid = ".$this->uid." and id in (".implode(',',$ids).") ";
			//echo $sql;exit;
			$this->db->query($sql);
 			$app->enqueueMessage(' 操作成功,共锁定 '.$this->db->getAffectedRows().'项.');
		}
		return true;
	}






	/** AJAX方式获取菜单数据 **/
	function getAjaxmenu(){
		$sql=" select id,tid,name,component,parent_id from ".$this->tableName;
		//$sql.=" where published =1 ";
		$sql .= " order by lft ";
		$this->db->query($sql);
		$results = $this->db->getResult('tid',true);
		return $results;
	}
}
?>