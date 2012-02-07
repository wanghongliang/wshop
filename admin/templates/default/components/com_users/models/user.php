<?php
import('application.component.model');
class UserModel extends Model
{
  	function UserModel()
	{
		parent::__construct();
		$this->tableName = '#__users';

  	}
 
	function getGroup()
	{
		$helperFile = dirname(PATH_COMPONENT).DS.'com_group'.DS.'helper'.DS.'group.php';
		include($helperFile);

		$tree = new GroupHelper();
		//$result = $tree->getcatagory(1,2);
		$result = $tree->getAll();


		return $result;
		
	}
 	function getProvince($area=1){
 		//数据列表
		$list = array();
		$query = "select id,name,parent_id from #__area where lft>1 and rgt<784  order by lft ";
		$this->db->query($query);
		$lists = $this->db->getResult();
		return $lists;
	}
	
	/**
	 * 取当前编辑项
	 */
	function getItem()
	{
		$id =intval($_REQUEST['id']);
		if( $id < 1 )
		{

 			$row = array(
 			); 
		}else{ 
			$sql = " select * from ".$this->tableName." as u left join #__user_info as info on u.id=info.uid where id='".$id."' ";
			$this->db->query($sql);
			$row = $this->db->getRow();	//获取菜单项数据
		}
 		
		return $row;
	}

	/**
	 * 保存
	 */
	function save()
	{
		global $app;
	 
		$data = array(
			'email'=>$_REQUEST['email'],
			'block'=>$_REQUEST['block'],
			'gid'=>$_REQUEST['gid'],
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
			$password = trim($_POST['password']);
			if( strlen($password) > 2 ){
				$data['password'] = sha1(sha1($password));
				
			}
			$this->db->updateArray( $this->tableName, $data , " id='{$id}' " );


 		}else{
 			$data['uid'] = $this->uid;
			$data['module'] = $_REQUEST['module'];
			$this->db->insertArray( $this->tableName, $data  );
			$id = $this->db->insertid();

			
 		}
		$sql = "select uid from #__user_info where uid=".$id;
		$this->db->query($sql);
		$row = $this->db->getRow();

		$data = array(
			'sex'=>$_REQUEST['sex'],			//商品名称
			'intro'=>$_REQUEST['intro'],	//简介
 			'year'=>$_REQUEST['year'],
			'month'=>$_REQUEST['month'],
			'day'=>$_REQUEST['day'],
 			'province'=>$_REQUEST['province'],
			'city'=>$_REQUEST['city'],

 			'contact_name'=>$_REQUEST['contact_name'],
			'mobile'=>$_REQUEST['mobile'],
			'phone'=>$_REQUEST['phone'],
 			'address'=>$_REQUEST['address'],
			'zip'=>$_REQUEST['zip'],

 			'c_name'=>$_REQUEST['c_name'],
			'c_contact_name'=>$_REQUEST['c_contact_name'],
			'c_contact_jobs'=>$_REQUEST['c_contact_jobs'],
 			'c_phone'=>$_REQUEST['c_phone'],
			'c_fax'=>$_REQUEST['c_fax'],
 			'c_address'=>$_REQUEST['c_address'],
			'c_http'=>$_REQUEST['c_http'],
 		);

		if( $row['uid'] > 0 ){
			$this->db->updateArray( '#__user_info', $data , " uid='".$id."' "  );
		}else{
			$data['uid'] = $id;
			$this->db->insertArray( '#__user_info',$data);
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
		import('filesystem.dir');
		import('filesystem.xml');
		$dir = new WDir();

		if( $this->client_id == 0 ){
			$directory = PATH_ROOT.DS.'modules';
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
		global $app;
		if( $id > 0 )
		{
			import('cache.cache');
			if( Cache::isCache($id) ){
				//是否生成缓存配置信息
				$app->enqueueMessage(' 请先清空该用户数据数据.','error');
				return false;
			}
	 
			$sql = "delete from ".$this->tableName." where  id=".$id;
			$this->db->query($sql);
			return true;
		}

		return false;
	}

 }
?>