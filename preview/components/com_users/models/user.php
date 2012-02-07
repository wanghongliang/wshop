<?php
import( 'application.component.model');

class UserModel extends Model
{
	function getProvince($area=1){
 

		//数据列表
		$list = array();
 			
		$query = "select id,name,parent_id from #__area where lft>1 and rgt<784  order by lft ";
		$this->db->query($query);
		$lists = $this->db->getResult();
		return $lists;
	}


	function getInfo(){

		global $app;
		$session = &Factory::getSession();
		$uid = $session->get('uid');
		$act = $_POST['act2'];
		
		if( $act == 'save' ){

			$data = array(
				'nickname'=>$_POST['nickname'],  
			); 
			$this->db->updateArray('#__users',$data,' id='.$uid); 

			//print_r($data);
			//exit;

			$data = array(
				'sex'=>$_REQUEST['sex'],			//产品名称
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

			$this->db->updateArray( '#__user_info', $data , " uid='".$app->uid."' "  );

			$app->enqueueMessage(' 个人资料修改成功.');
		}
		$query = "select * from #__users as u left join #__user_info as f on u.id=f.uid where u.id=".$uid;
		$this->db->query($query);
 		$row = $this->db->getRow(); 
		
 		return $row;
	}


	function getSetpwd(){
		global $app;
		$old = trim($_POST['oldpass']);
		$pass = trim($_POST['pass']);
		$pass2 = trim($_POST['pass2']);
		if( trim($old) == '' ){
			$app->enqueueMessage(' 修改失败,原密码为空.');
			return false;
		}
		if( strlen(trim($pass))<6 ){
			$app->enqueueMessage(' 修改失败,新密码必需为6-20个字符.');
			return false;
		}
		if( $pass != $pass2 ){
			$app->enqueueMessage(' 修改失败,两次密码输入不一致.');
			return false;
		}

		$sql = " select password from #__users where id=".$app->uid;
		$this->db->query($sql);
		$row = $this->db->getRow();

		if( $row['password'] != sha1( sha1($old) ) ){
			$app->enqueueMessage(' 修改失败,原密码不正确.');
			return false;
		}
		

		$newpass = sha1(sha1($pass));
		$sql = " update #__users set password='".$newpass."' where id=".$app->uid;
		$this->db->query($sql); 
		$app->enqueueMessage(' 密码修改成功.');
		
		return true;
	}

}
?>