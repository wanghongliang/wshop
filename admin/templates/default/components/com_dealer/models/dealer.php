<?php
import('application.component.model');
class DealerModel extends Model
{
  	function DealerModel()
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
	 
		$name = trim($_REQUEST['username']);	//用户 账号
		$pass = trim($_REQUEST['password']);
		$repass = trim($_REQUEST['repassword']);
		$email = trim($_REQUEST['email']);
		$firstname = trim($_REQUEST['firstname']);


		//测试用户名是否大于五个字符,并且是否已被占用
		$name_len =	strlen($name);
		if( $name_len < 6 || $name_len > 12 )
		{
 			$app->enqueueMessage('用户名是由 6-20 个字符或数字组成,请重新填写.','error');
			return;
		}
 
		//是否存在同名用户
		$db  = &Factory::getDB();
		$sql = " select username from #__users where username='".$name."' ";
		$db->query($sql);
		$num = $db->getNumRows();

		if( $num > 0 ){ 
			$app->enqueueMessage('该用户已经存在,请重新填写用户名.','error');
			return;
		}


		//检测密码是否是相同 
		if( $pass != $repass )
		{
			$app->enqueueMessage('两次输入密码不一致.','error');
			return;
		}

		//检测密码长度是否过长
		if( strlen($pass)>50 )
		{
			$app->enqueueMessage('密码长度过长.','error');
			return;
		}

		if (!preg_match("~^[_.0-9a-z\-]+@([0-9a-z]([0-9a-z\-]*)\.)+[a-z]{2,3}$~i",$email)){ 
			$app->enqueueMessage('邮箱格式不正确.','error');
			return;
		}


 
		if( $id > 0 )
		{
			$this->db->updateArray( $this->tableName, $data , " id='{$id}' " );


 		}else{
 			
			$data = array();

			$data['username'] = $name;								//用户名
			$data['password'] = sha1(sha1($pass));					//密码
			$data['email'] = $email;					//密码
			$data['registerDate'] = date('Y-m-d H:i:s');
			$data['block'] = $_POST['block']; 
			$data['gid'] = GROUP_DEALER;
			$data['province']  = $_REQUEST['province'];
			if( $_REQUEST['city']>0 ){
			$data['city'] = $_REQUEST['city'];
			}else{
				$data['city'] = $_REQUEST['province'];
			}
 

			$this->db->insertArray( $this->tableName, $data  );
			$id = $this->db->insertid();

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
			$data['uid'] = $id;
			$this->db->insertArray( '#__user_info',$data);
 		}

		/**
	 
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

		**/

		return true;
	}

	function save2(){
		global $app;
	 
		$data = array(
			'email'=>$_REQUEST['email'],
			'block'=>$_REQUEST['block'],
			//'gid'=>$_REQUEST['gid'],
			'province'=>$_REQUEST['province'], 
 		);

		if( $_REQUEST['city']>0 ){
			$data['city'] = $_REQUEST['city'];
			}else{
				$data['city'] = $_REQUEST['province'];
		}


		$id = intval( $_REQUEST['id'] );

		if( $id > 0 )
		{
			$pass = trim($_REQUEST['password']);
			$repass = trim($_REQUEST['repassword']);
			
  			if( strlen( $pass )>3 && $pass == $repass ){
				$data['password'] = sha1(sha1($pass)); //密码				
			}else if( $pass != $repass ){
				$app->enqueueMessage('两次密码不一致.','error');
				return false;
			}

			$this->db->updateArray( $this->tableName, $data , " id='{$id}' " ); 
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
 			$this->db->updateArray( '#__user_info', $data , " uid='".$id."' "  );
 		 
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

	function setDefault(){
		$city = (int)$_GET['city'];
		$id = (int)$_GET['ids'];
		$sql = " update #__area set default_uid =0 where default_uid='".$id."'  ";
		$this->db->query($sql);


		$sql = " update #__area set default_uid ='".$id."' where id=( select city from #__users where id='".$id."' ) ";
		$this->db->query($sql);
	}


	function ajax(){
		switch($_GET['act']){
			case 'checkname':
				$name = trim($_GET['name']);
				if( strlen($name)>5 ){
					$sql = "select id from ".$this->tableName." where username='".$name."' ";
					$this->db->query($sql);
					$row=$this->db->getRow();
					if( $row['id']>0 ){
						echo '0';
					}else{
						echo '1';
					}
				}
				
				break;
		}
		
		return true;
	}
 }
?>