<?php
import('application.component.model');
class ModuleModel extends Model
{
	var $client_id=0;
	var $item = null;	//保存后的item对象
 	function ModuleModel()
	{
		parent::__construct();
		$this->tableName = '#__modules';

		$this->client_id = intval($_REQUEST['client_id']);
 	}
 
	/**
	 * 取当前编辑项
	 */
	function getItem()
	{
		global $app;

		$id =intval($_REQUEST['id']);
		if( $id < 1 )
		{
			if( !$_REQUEST['select'] ){ Error::throwError('没有选择模块类型!'); }
			$row = array(
				'client_id'=>$_REQUEST['client_id'],
 				'module'=>$_REQUEST['select']	//选择的模块类型
			);
			//print_r($row);
		}else{
			$sql = " select * from ".$this->tableName." where id='".$id."' ";
			$this->db->query($sql);
			$row = $this->db->getRow();	//获取菜单项数据

 

		}
		if( $row['client_id'] == '0' ){
			$xmlFile = $app->getPreviewModulePath().DS.$row['module'].DS.$row['module'].'.xml';
		}else{
			$xmlFile = PATH_BASE.DS.'modules'.DS.$row['module'].DS.$row['module'].'.xml';
		}
		
 
 		
		//分析属性
		if( file_exists( $xmlFile ) )	//分析对应的参数
		{	
  			import('html.parameter');
			if( $id < 1 ){
				import('filesystem.xml');

				$params = XML_unserialize( file_get_contents($xmlFile) );
				//print_r($params);
				$row['title'] = '新建 '.$params['install']['name'];
				$row['position'] = $params['install']['position'];
				$parameter = new Parameter( $params );
			}else{
				$parameter = new Parameter( $xmlFile );
				$parameter->bind( $row['params'] );		
			}
			$row['parameter'] = $parameter->render();
			unset($parameter,$xmlFile);
 		}else{
			$row['parameter']='<i>此项没有对应的参数.</i>';
 		}

 
		
		
		
		return $row;
	}

	function getComponent(){
		$sql =" select id,name from #__components ";
		$this->db->query($sql);
		return $this->db->getResult();
	}

	/**
	 * 保存
	 */
	function save()
	{
		global $app;
	 
		//是否为自定义内容模块
		$cust = intval($_REQUEST['cust']);
		$data = array(
			'title'=>$_REQUEST['title'],
			'content'=>$_REQUEST['content'],
			'position'=>trim($_REQUEST['position']),
			'published'=>$_REQUEST['published'],
			'cid'=>(int)$_POST['cid'],
			'cache_way'=>(int)$_POST['cache_way'],
			'cust'=>$cust,
 		);
		

 		if( is_array($_REQUEST['params'] ) )	//保存参数列表
		{
			import('html.format.ini');
			$data['params'] = FormatINI::arrayToString($_REQUEST['params']);
		}

		$parent_id = intval($_REQUEST['parent_id']);	//父栏目的ID
		$id = intval( $_REQUEST['id'] );

		if( $id > 0 )
		{	
			$sql=" select position,ordering from ".$this->tableName." where id=".$id;
			$this->db->query($sql);
			$row = $this->db->getRow();

			if( $row['position'] != $data['position'] )
			{
				 $data['ordering'] = $this->getNextOrder(" position='".$data['position']."' ");
				 $sql = " update ".$this->tableName." set ordering = ordering-1 where ordering>".intval($row['ordering'])." and position='".$row['position']."' ";
				 $this->db->query($sql);
			}else{
				$data['ordering'] = $_REQUEST['ordering'];
			}
			$this->db->updateArray( $this->tableName, $data , " id='{$id}' " );
 		}else{
 			$data['uid'] = $this->uid;
			$data['module'] = $_REQUEST['module'];
			$data['ordering'] = $this->getNextOrder(" position='".$data['position']."' ");
			$this->db->insertArray( $this->tableName, $data  );
			$id = $this->db->insertid();
 		}
		$data['id'] = $id;
		$this->item = $data;
		unset($data);

		//选择菜单方式
		$menus = $_REQUEST['menus'];

		$selections = (array)$_REQUEST['selections'];


		if( $id ){
 			$query = 'DELETE FROM #__modules_menu'
			. ' WHERE moduleid = '.$id
			;
			$this->db->query($query);
		}

		if ($menus == 'all') {
 			$query = 'INSERT INTO #__modules_menu'
			. ' SET moduleid = '.$id.' , menuid = 0'
			;
			$this->db->query($query);
		}
		else
		{
			$sign = ($menus == 'deselect') ? -1 : 1;
			foreach ($selections as $menuid)
			{
				$menuid = (int) $menuid;
				if ($menuid >= 0) {
 					$query = 'INSERT INTO #__modules_menu'
					. ' SET moduleid = ' .$id . ', menuid = ' . ($sign * $menuid)
					;
					$this->db->query($query);
				}
			}
		}

 
 
		return true;
	}

	/** 拷贝一份 **/
	function copy()
	{
 		
		$copy_ids = &$this->_filterID( $_REQUEST['ids'] );
		if( count($copy_ids) )
		{
			$sql = " select * from ".$this->tableName." where id in (".implode(',',$copy_ids).") ";
			$this->db->query($sql);
			$rows = $this->db->getResult();
			foreach( $rows as $row )
			{
				unset($row['id']);
				$row['title'] = "新建 ".$row['title'];
				$row['content'] = addslashes($row['content']);
				$row['ordering'] =  (int)($this->getNextOrder(" position='".$row['position']."' "));
				$this->db->insertArray( $this->tableName,$row );

 			}
		}
 		return true;
	}


	/** 全部删除 **/
	function deleleall(){
		$copy_ids =  $this->_filterID( $_REQUEST['ids'] );

 		if( count($copy_ids) )
		{
			$sql = " delete from ".$this->tableName." where uid = ".$this->uid." and id in (".implode(',',$copy_ids).") ";

			//echo $sql;exit;
			$this->db->query($sql);
			$sql = " delete from #__modules_description where module_id in (".implode(',',$copy_ids).") ";
			$this->db->query($sql);
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

	/** 模块目录 **/
	function &getSelect()
	{
		global $app;	
		import('filesystem.dir');
		import('filesystem.xml');
		$dir = new WDir();

		if( $this->client_id == 0 ){
			$directory = $app->getPreviewModulePath();
			
			//PATH_PREVIEW.DS.'modules';

		}else{
			$directory = PATH_BASE.DS.'modules';
		}

 
		$modules = array();
		if( $data = $dir->getFolders($directory) ){
			foreach( $data as $mod ){
				$xmlFile = $directory.DS.$mod['name'].DS.$mod['name'].'.xml';

				if( file_exists($xmlFile) ){
					$params = XML_unserialize( file_get_contents($xmlFile) );
					//print_r($params);
					$title = $params['install']['name'];
				}else{
					$title = $mod['name'];
				}

				$modules[] = array(
					'name'=>$mod['name'],
					'title'=>$title,
					'description'=>''
				);
			}
			unset( $data, $xmlFile, $params ,$title );
		}
		unset( $dir ,$directory );

		return $modules;
	}

	/** 删除内容 **/
	function delete($id)
	{
		if( $id > 0 )
		{
			$sql = "delete from ".$this->tableName." where ( id=".$id."  ) and uid=".$this->uid;
			$this->db->query($sql);

			$sql = " delete from #__modules_description where ( module_id=".$id."  ) ";
			$this->db->query($sql);

			return true;
		}
		return false;
	}

	/** 保存排序 **/
	function saveorder($cid = array(), $order)
	{

		//先决条件，必需按位置排序时才能更新排序值
		$groupings = array();

 		for( $i=0; $i < count($cid); $i++ )
		{
			$row->load( (int) $cid[$i] );
 			$groupings[] = $row->position;

			if ($row->ordering != $order[$i])
			{
				$row->ordering = $order[$i];
				if (!$row->store()) {
					$this->setError($this->_db->getErrorMsg());
					return false;
				}
			}
		}

 		$groupings = array_unique( $groupings );
		foreach ($groupings as $group){
			$this->reorder(" position = '".$group."'");
		}

		return true;
	}


	function moveorder()
	{
		$ostring = trim( $_REQUEST['ostring'] );
		$order = trim( $_REQUEST['order'] );
		$ids = trim( $_REQUEST['ids'] );
		if( $ostring != $nstring )
		{
			$old_order = explode(',',$ostring);

			$norder = explode(',',$order);

			$ids_array = explode(',',$ids );
			foreach( $ids_array as $k=>$id )
			{
				if( ($k+1) != $norder[$k] )
				{	//更新的排序值一定要取 old_order 中的
					$sql =" update ".$this->tableName." set ordering=".(int)($old_order[$norder[$k]])." where id=".$id;
					$this->db->query($sql);

					//echo $sql;
				}
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
 }
?>