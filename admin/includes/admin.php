<?php
$GLOBALS['USERID'] =0;
/**
 * 管理应用类
 */
class AdminApplication extends Application
{
	var $uid = 0;

	function AdminApplication()
	{
		parent::__construct();
 		$this->client_id = 1;

		//初始化上传目录
		$GLOBALS['config']['upload_dir'] = PATH_UPLOAD.DS.$this->uid;
		if( !is_dir( $GLOBALS['config']['upload_dir'] ) )
		{
			import('filesystem.dir');
			WDir::mkdir( $GLOBALS['config']['upload_dir'] );
		}
 		if( $this->uid < 1 )
		{
		 
			$this->login();
			return;
		}
  		$gid =$this->session->get('gid');
 		if( $gid < 20 ){
			//$this->session->set('msg', null);
			if( !$this->session->get('msg')){
				$this->enqueueMessage('您不是管理员，请登陆管理员账号，谢谢。');
			}
			$this->login();
		}
 
		$GLOBALS['USERID']  = $this->uid;
		
		import('cache.cache');
		$config = Cache::getConfigCache();
		//反系列化
		$config['options'] = unserialize($config['options']);
		//print_r($config);
		$GLOBALS['config'] = array_merge($GLOBALS['config'],(array)$config);
	}
	function init(){

	}

	function &getMenu()
	{
		static $menu = null; 

 		if( empty( $menu ) )
		{
			include(dirname(__FILE__).DS.'menu.php');
			$menu = new Menu();

		}else{
			if( !is_object($menu) ){
 				//Error::throwError('asfd');
			}
		}
 		return $menu;
	}

	//定义组件的路径
	function defineComponentPath($com)
	{
		//定义组件量,以方便后面路径的引用
		define('PATH_COMPONENT',PATH_TEMPLATE.DS.$this->getTemplate().DS.'components'.DS.'com_'.$com);
	}

 
	/**
	 * 前台组件和和模块同样是变化的,这里加两个方法,用于构造用户选择的模板,对应的组件和模块方法
	 */
	function  getPreviewModulePath()
	{
		return PATH_PREVIEW.DS.'modules';//PATH_PREVIEW.DS.'templates'.DS.$this->getPreviewTemplate().DS.'modules';
	}

	/** 
	 * 会员前台模板
	 */
	function getMemberModulePath()
	{
		return PATH_ROOT.DS.'china'.DS.'modules';
	}

	/**
	 * 前台组件路径
	 */
	function getPreviewComponentPath()
	{
		//echo PATH_PREVIEW.DS.'templates'.DS.$this->getPreviewTemplate().DS.'components';
		//return PATH_PREVIEW.DS.'templates'.DS.$this->getPreviewTemplate().DS.'components';

		return PATH_PREVIEW.DS.'components';

	}

	/**
	 * 前台模板
	 */
	function getPreviewTemplate(){
		static $preview_template;
		if( empty($preview_template) ){
			import('cache.cache');
			$config = Cache::getConfigCache();
 			$preview_template = $config['template'];
 			//echo $preview_template;
			if( !$preview_template ){
				$preview_template = $GLOBALS['config']['template'];//'default';
			}
		}

 		return $preview_template;
	}

	function getTemplate(){
		global $config;
		
 		if( $_REQUEST['tmpl'] == 'error' ){
			return 'system';
		}
		return 'default';
	}

	//会员登陆界面
	function login()
	{
		//$this->redirect('../');
		 
		if( $_REQUEST['task'] == 'login' )
		{
			$return_uri = "/admin/";

			$name = trim($_REQUEST['username']);
			$pass = trim($_REQUEST['pass']);
			//是否存在同名用户
			$db  = &Factory::getDB();

			$sql = " select id,gid,username,password,block from #__users where username='".$name."' ";
			$db->query($sql);
			$row = $db->getRow();

			$this->session->set('msg', null);
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
			$session->set('gid',$row['gid']);
			$session->set('username',$row['username']);

			$this->redirect('/admin/','登陆成功.');

		}else{
			$_REQUEST['tmpl'] = 'login';
 		}
	}

	function getCompanyInfo(){
		static $data;
		if( !isset($data) ){
			$db = &Factory::getDB();
			$sql = "select * from #__companies where uid=".$this->uid;
			$db->query($sql);
			$data = $db->getRow();
		}
		return $data;
	}
}
?>