<?php
/****
 * 说明：常用类工厂生成器
 */

class Factory
{

	//返回对应用对象
	function &getApplication($name = 'site')
	{
		static $instance;
		
		if( empty($instance) )
		{
			import('application.application');
			$instance = Application::getInstance($name);
		}
		return $instance;
	}
	function &getLanguage()
	{
		static $instance;
		if( empty($instance) ){
 
			$instance = Factory::_createLanguage();
 		}

		return $instance;
	}
	//当前文档解析类
	function getDocument()
	{
		static $instance;

		if (!is_object( $instance )) {
			$instance = Factory::_createDocument();
		}

		return $instance;
	}

 
	/**
	 * 获取数据库对象
	 */
	function &getDB()
	{
		static $instance;
		
		if( empty($instance) )
		{
			global $config;
			import('db.db');
			$options = array(
				'host'=>$config['host'],
				'user'=>$config['user'],
				'password' => $config['password'],
				'database' => $config['database']

			 
			);
			$instance = new DB($options ); 
 		}
		return $instance;
	}


	/***
	 * 获取路由器对象
	 */
	function getRouter()
	{
		static $instance;
		
		if( empty($instance) )
		{
			global $config;
			$instance = new Router(); 
		}
		return $instance;
	}

	function getConfig()
	{

	}

	/**
	 * 获取SESSION类
	 */
	function &getSession()
	{
		static $instance;
		
		if( empty($instance) )
		{
			import('session.session');
			$instance = new Session(); 
		}
		return $instance;
	}


	/**
	 * 获取邮件发送类
	 */
	function &getEmail()
	{
		static $instance;
		
		if( empty($instance) )
		{
			global $config;	
 			import('email.smail.smail');
			$instance = new smail( $config['smtpuser'], $config['smtppass'], $config['smtphost'] ); 
			

 		}
		return $instance;
	}


	/**
	 * 获取文件上传类
	 */
	function getFile()
	{
		static $instance;
		
		if( empty($instance) )
		{
			global $config;
			import('filesystem.dir');
			//$config['uploads']
			$instance=new WDir();
			$instance->path = $config['upload_path'];
 		}
		return $instance;
	}

 
	/**
	 *	创建文档对象
	 */
	function &_createDocument()
	{
 		import('document.document');
 		 
		$raw	= $_REQUEST['no_html'];

 		$type	= $raw ? 'raw' : 'html';
		
 		$attributes = array (
			'charset'	=> 'utf-8',
			'lineend'	=> 'unix',
			'tab'		=> '  ',
		);
		$doc =& Document::getInstance($type, $attributes);
		return $doc;
	}

	function &_createLanguage()
	{
		import('language.language');

 		$lang	= &Language::getInstance();
 		return $lang;
	}
}
?>