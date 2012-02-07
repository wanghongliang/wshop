<?php

class UsersController extends Controller
{
	function UsersController()
	{
		parent::__construct();
		

		if( !isset($_REQUEST['no_html'])){ 
			$s = &Factory::getSession();
			$gid = $s->get('gid');

			if( $gid == 17 ){
			//	$this->redirect('/member/');
			}else if( $gid == 22 ){
				$this->redirect('/admin/');
			}
		}
	}

	function display()
	{
		global $app;
		$_REQUEST['view'] = $_REQUEST['view']?$_REQUEST['view']:'user';
		if( $_REQUEST['view'] == 'login' ){ $_REQUEST['view']= 'user'; }
 		$vName		=  $_REQUEST['view'];
		$vFormat	=  'html';
		$lName		=  $_REQUEST['layout'];
		 
		if( $vName != 'user' && $app->uid<1 ){
			 $_REQUEST['view'] = $vName = 'user';
		}
		$pathway = &$app->getPathWay();
		$pathway->addItem('会员中心','index.php?com=users'); 
		
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
	function dologin()
	{
		global $app;

		$return_uri = '/index.php?com=users&view=login';
		
		if( $_REQUEST['return'] ){
			//echo $_REQUEST['return'];exit;
			$return_uri .= '&return='.urlencode($_REQUEST['return']); 
		}
 		if( isset($_REQUEST['no_html']) ){
			$return_uri .= '&no_html='.$_REQUEST['no_html'];
		} 
		$session = &Factory::getSession();
	    $valify = $session->get('valify');

		if( $valify && $valify != $_REQUEST['valify'] ){
			$session->unregister('valify');
			return 'Prohibition';exit;
		}		
 
		$name = trim($_REQUEST['username']);
		$pass = trim($_REQUEST['pass']);
		//是否存在同名用户
		$db  = &Factory::getDB();

		$sql = " select id,gid,username,password,block from #__users where username='".$name."' ";
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


		//更新登陆的时间
		$sql = " update #__users set lastvisitDate='".date('Y-m-d H:i:s')."' where id='".$row['id']."' ";
		$db->query($sql);

		
		//SESSION值 
		$session = &Factory::getSession();
		$session->set('uid',$row['id']);
		$session->set('gid',$row['gid']);
		$session->set('username',$row['username']);

		if(  $_REQUEST['return'] ){
			$this->redirect($_REQUEST['return']);
		}else{
			$this->redirect( '/index.php?com=users');
		}
		//$this->redirect('/member/','登陆成功.');
		
	}

	function reg()
	{

		//用户注册的信息
		$data = array();
		
 
		$name = trim($_REQUEST['username']);	//用户 账号
		$pass = trim($_REQUEST['pass']);
		$repass = trim($_REQUEST['repass']);
		$email = trim($_REQUEST['email']);
		$firstname = trim($_REQUEST['firstname']);

		import('utilities.securimage');
		if( !Simge::check($_REQUEST['code']) ){

			$return_uri = '/index.php?com=users&view=user&layout=registor&username='.$name.'&email='.$email.'&firstname='.$firstname;

			$this->redirect($return_uri,'验证码不正确.');
			return;

		}
		 

		//测试用户名是否大于五个字符,并且是否已被占用
		$name_len =	strlen($name);
		if( $name_len < 6 || $name_len > 12 )
		{
			$this->redirect($return_uri,'用户名是由 6-20 个字符或数字组成,请重新填写.');
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
		$data['block'] = 0;
		$data['gid'] = 1;

		$db->insertArray('#__users',$data);
		$uid= $db->insertid();

		//如果需要邮箱激活，就跳转到邮箱激活页面

		//注册成功后的激活邮箱提示
		//$return_uri = '/index.php?com=users&view=user&act=success&account='.$name.'&email='.$email;

		//$this->redirect($return_uri, '注册成功.');
	

		//没有邮箱激活，就直接登陆
				//SESSION值 
		$session = &Factory::getSession();
		$session->set('uid',$uid);
		$session->set('gid',1);	//默认为注册会
		$session->set('username',$name);
		$this->redirect(URI::root());

		/**
		//print_r($_POST);

 		$vName = 'user';
		$_REQUEST['view'] = $vName;
		$view = $this->getView($vName);

		$model = &$this->getModel($vName);

		$view->setModel($model, true);
  		$view->reg();
		**/
	}

	//注册成功
	function success(){
 	}
 
	/**
	 * 保存用户注册的信息
	 */
	function registor()
	{
		global $app;

		//注册成功后的激活邮箱提示
		//$return_uri = '/index.php?com=users&view=users&task=activateemail&account='.$name.'&email='.$email;
		//$this->redirect($return_uri, '注册成功.');
		//return;



		//用户注册的信息
		$data = array();
		
 
		$name = trim($_REQUEST['username']);	//用户 账号
		$pass = trim($_REQUEST['pass']);
		$repass = trim($_REQUEST['repass']);
		$email = trim($_REQUEST['email']);
		

		$return_uri = '/index.php?com=users&task=reg';

		

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
		
		$uid = $db->insertid();


		//插入企业信息之前，需要处理一下对应的数据

		//插入企业信息
		$company_data = array(
		'company_name'=>$_POST['company_name'],
		'contact_name'=>$_POST['contact_name'],  
		'contact_sex'=>$_POST['contact_sex'],
		'contact_jobs'=>$_POST['contact_jobs'],  

		'phone'=>$_POST['telcountrycode'].$_POST['telareacode'].$_POST['phone'],
		'mobile'=>$_POST['mobile'],  
		'fax'=>$_POST['faxcountrycode'].$_POST['faxareacode'].$_POST['fax'],
		'http'=>$_POST['http'],  
		'address'=>$_POST['address'],
		'uid'=>$uid,  
		'intro'=>$_POST['intro'],
		'introimg'=>$_POST['introimg'],  
		'uname'=>$name,
		'catid'=>$_POST['catid'],
		'email'=>$_POST['email'],
		'contact_department'=>$_POST['contact_department'],  
		'contact_post'=>$_POST['contact_post'],
		'country'=>$_POST['country'],
		'province'=>$_POST['province'],  
		 
		'city'=>$_POST['city'],
		'zip'=>$_POST['zip'],
		'company_type'=>$_POST['company_type'],  //分开插入到企业类型表中
		'keywords'=>$_POST['keywords'],    //分开插入到关键字表
		'employees_number'=>$_POST['employees_number'],
		'turnover'=>$_POST['turnover'],  

		'logo'=>$_POST['logo'],  
		'trademark'=>$_POST['trademark'],
		  
		);

		$db->insertArray('#__companies',$company_data);




		//注册成功后的激活邮箱提示
		$return_uri = '/index.php?com=users&view=users&task=activateemail&account='.$name.'&email='.$email;

		$this->redirect($return_uri, '注册成功.');

	}


	/**
	 * 发送一个激活Email
	 */
	function activateemail()
	{
		$_REQUEST['view'] = 'user';
		$view = $this->getView('user');
	 
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
			$email_tmpl = PATH_COMPONENT.DS.'tmpl'.DS.'active_email.html';

			
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
				$link = URI::base().'index.php?com=users&task=activateemail&account='.$account.'&code='.$code;

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


	function checkusername()
	{
		$username = trim($_REQUEST['username']);
	
		//是否存在同名用户
		$db  = &Factory::getDB();
		$sql = " select username from #__users where username='".$username."' ";
		$db->query($sql);
		$num = $db->getNumRows();

		if( $num > 0 ){ 
 			echo '0';
		}
		
	}



	/** 会员退出 **/
	function logout()
	{
		$session =& Factory::getSession();
		$session->destroy();
		$this->redirect('/');
	}


	/** 找回密码，填写相应密码 **/
	function repass(){
		$_REQUEST['view'] = 'user';
		$view = $this->getView('user');

		//print_r($view);
		$view->repass();
	}
	
	/** 发送激活码 **/
	function sendpassactive(){
		$account = trim($_REQUEST['uname']);
		
		//没有填写用户名
		if( $account == '' ){ 
			$this->redirect('index.php?com=users&task=repass','请输入会员名!');
		}

		//是否存在同名用户
		$db  = &Factory::getDB();
		$sql = " select email from #__users where username='".$account."' ";
		$db->query($sql);
		$row = $db->getRow();
	
		//是否存在该用户
		if( !is_array($row) ){
			
			$this->redirect('index.php?com=users&task=repass','该会员不存在！');
			return;
		}
 		$email_address = $row['email'];
 		$email_tmpl = PATH_COMPONENT.DS.'tmpl'.DS.'repass.html';
 		if( file_exists($email_tmpl)  ){
			
			$title = iconv('UTF-8','GB2312','找回密码-ui58.com');
			


			//为视图赋值
			//$view->assignRef('username',$_REQUEST['account'] );
			//$view->assignRef('email', $email_address );


			$code = md5($account.rand(23567, 99999));
			setCookie('code',$code,time()+3600*24);		//注册到SESSION中去


			//链接
			$link = URI::base().'index.php?com=users&task=sepass&account='.$account.'&code='.$code;

			$email = &Factory::getEmail();

			//读模板内容
			$content = file_get_contents($email_tmpl);

			//替换标记
			$content = str_replace(array('<{$name}>','<{$email}>','<{$activatelink}>','<{$date}>'),array($account,$email_address,$link,date('Y-m-d')),$content);

			//发送邮件
			$email->send($email_address,'whl@126.com',$title, $content);

			
			$_REQUEST['view'] = 'user';
			$view = $this->getView('user');

			$view->assignRef('email', $email_address );
			//发送激活信息
			$view->sendpassactive();
		}
 	}

	/** 找回密码 **/
	function sepass(){

		$_REQUEST['view'] = 'user';
		$view = $this->getView('user');
 		$code =  $_REQUEST['code'];
		//是否为激活账号
		if( $_COOKIE["code"] == $code   )
		{
			//$data= array('block'=>0 );
			//$db = &Factory::getDB();
			//$db->updateArray("#__users" , $data ," username='".trim($_REQUEST['account'])."' ");
			$view->assignRef('username',$_REQUEST['account']);
			$view->assignRef('code',$code);
			

 			//$view->activateemail_success();
		}else{	
		 
			 
		}
		$view->sepass();

	}

	//提交新密码
	function confirmpass(){
 		$code = $_REQUEST['code'];
		$pass = trim( $_REQUEST['pass'] );
		$repass = trim( $_REQUEST['repass'] );
		//是否为激活账号
		if( ($_COOKIE["code"] == $code) && $pass == $repass && strlen($pass)>3  )
		{
			$data= array('password'=>sha1(sha1($pass)) );
			$db = &Factory::getDB();
			$db->updateArray("#__users" , $data ," username='".trim($_REQUEST['username'])."' ");
			//echo $_COOKIE["code"];
			echo '重设密码成功!';
			//$_COOKIE["code"] = null;
 		}else{
			echo '重设失败，密码必需大于5个字符!';
		}
	}

	function memberstatus(){
		$_REQUEST['view'] = 'user';
		$view = $this->getView('user');
		$view->showMemeberStatus();
	}


	function reload(){
		echo '<script>location.reload();</script>';
	}
}

 
?>