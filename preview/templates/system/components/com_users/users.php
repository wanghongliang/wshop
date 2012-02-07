<?php
class UsersController extends Controller
{
	function UsersController()
	{
		parent::__construct();
	}

	function display()
	{
	
 		$vName		=  $_REQUEST['view'];
		$vFormat	=  'html';
		$lName		=  $_REQUEST['layout'];
		
		/** 检测是否是登陆状态
 		if( $vName =='user' && $lName == '' )
		{
			//SESSION值 
			$session = &Factory::getSession();
			if( $session->get('uid')>0 )
			{
				$this->redirect('/menage/');
			}

		}
		**/


 		if ($view = &$this->getView($vName, $vFormat))
		{
 			$model	= &$this->getModel($vName);

 			$view->setModel($model, true);
			$view->setLayout($lName);
 			$view->display();
		}
	}

	/**
	 * 会员登陆
	 */
	function login()
	{
		$return_uri = 'index.php?com=user';


		$name = trim($_REQUEST['username']);
		$pass = trim($_REQUEST['pass']);
		//是否存在同名用户
		$db  = &Factory::getDB();

		$sql = " select id,username,password,block from #__users where username='".$name."' ";
		$db->query($sql);
		$row = $db->getRow();

		if( !is_array($row) ){ 
			$this->redirect($return_uri,'该用户不存在.');
			return;
		}

		if( $row['block'] == 1)
		{
			$this->redirect($return_uri,'用户没有激活.');
			return;
		}

		if( sha1(sha1($pass)) != $row['password'] )
		{
			$this->redirect($return_uri,'密码错误.');
			return;
		}


		
		//SESSION值 
		$session = &Factory::getSession();
		$session->set('uid',$row['id']);
		$session->set('username',$row['username']);

		$this->redirect('/menage/','登陆成功.');



	}


	/**
	 * 保存用户注册的信息
	 */
	function registor()
	{
		global $app;

		//用户注册的信息
		$data = array();
		
 
		$name = trim($_REQUEST['username']);	//用户 账号
		$pass = trim($_REQUEST['pass']);
		$repass = trim($_REQUEST['repass']);
		$email = trim($_REQUEST['email']);
		

		$return_uri = 'index.php?com=user&view=user&layout=registor2';

		

		//测试用户名是否大于五个字符,并且是否已被占用
		$name_len =	strlen($name);
		if( $name_len < 6 || $name_len > 12 )
		{
			$this->redirect($return_uri,'用户名是由 6-12 个字符或数字组成,请重新填写.');
			return;
		}



		//是否存在同名用户
		$db  = &Factory::getDB();
		$sql = " select username from #__users where username='".$name."' ";
		$db->query($sql);
		$num = $db->getNumRows();

		if( $num > 0 ){ 
			$this->redirect($return_uri,'该用户已经存在.');
			return;
		}


		//检测密码是否是相同 
		if( $pass != $repass )
		{
			$this->redirect($return_uri,'两次输入密码不一致.');
			return;
		}

		//检测密码长度是否过长
		if( strlen($pass)>50 )
		{
			$this->redirect($return_uri,'密码长度过长.');
			return;
		}

		if (!preg_match("~^[_.0-9a-z\-]+@([0-9a-z]([0-9a-z\-]*)\.)+[a-z]{2,3}$~i",$email)){ 
			$this->redirect($return_uri, '邮箱格式不正确.'.$email);
			return;
		}

		$data['username'] = $name;								//用户名
		$data['password'] = sha1(sha1($pass));					//密码
		$data['email'] = $email;					//密码
		$data['registerDate'] = date('Y-m-d H:i:s');
		$data['block'] = 1;
		$db->insertArray('#__users',$data);

		//注册成功后的激活邮箱提示
		$return_uri = 'index.php?com=user&view=user&task=activateemail&account='.$name.'&email='.$email;

		$this->redirect($return_uri, '注册成功.');

	}


	/**
	 * 发送一个激活Email
	 */
	function activateemail()
	{
		$view = $this->getView();

		$code = md5($_REQUEST['account']);
		//是否为激活账号
		if( ($_COOKIE["code"] == $code) && ( $code == $_REQUEST['code'] )  )
		{
			$data= array('block'=>0 );
			$db = &Factory::getDB();
			$db->updateArray("#__users" , $data ," username='".trim($_REQUEST['account'])."' ");
			$view->assignRef('username',$_REQUEST['account']);
 			$view->activateemail_success();


		}else{	
			$email_tmpl = PATH_COMPONENT.DS.'email_tmpl'.DS.'default.html';

			
			if( file_exists($email_tmpl) ){
				
				$title = iconv('UTF-8','GB2312','天亿网账号激活邮箱');
				
				$account = $_REQUEST['account'];	//用记账号
				$email_address = $_REQUEST['email'];	//EMAIL


				//为视图赋值
				$view->assignRef('username',$_REQUEST['account'] );
				$view->assignRef('email', $email_address );


				$code = md5($account);
				setCookie('code',$code,time()+3600*24);		//注册到SESSION中去


				//链接
				$link = URI::base().'index.php?com=user&task=activateemail&account='.$account.'&code='.$code;

				$email = &Factory::getEmail();

				//读模板内容
				$content = file_get_contents($email_tmpl);

				//替换标记
				$content = str_replace(array('<{$name}>','<{$email}>','<{$activatelink}>'),array($account,$email_address,$link),$content);
 
				//发送邮件
				$email->send($email_address,'whl@126.com',$title, $content);

				//发送激活信息
				$view->activateemail();
			}
		}
 	}


	/** 会员退出 **/
	function logout()
	{
		$session =& Factory::getSession();
		$session->destroy();
		$this->redirect('/');
	}
}

 
?>