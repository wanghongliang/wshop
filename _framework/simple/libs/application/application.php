<?php

/**
* @ 版本		$Id: index.php 2009-10-4
* @ 作用		控制器,调用对应的模板文件
* @ 团队        daybillion团队
* @ copyright   Copyright (c) 2006-2009 Daybillion Inc. All rights reserved {@link http://www.daybillion.com}
* @ 作者        王洪亮
* @ E-mail      daybillion@yahoo.com.cn
* @ 认证		需商业许可认证,详细请查看根目录下 LICENSE.txt
* @ 备注：		本系统基于团队协作开发
*/
import('application.component.controller');
class Application
{

	var $session = null;

	/**
	 * 调用对应的模板文件
	 */
	var $namespace = 'default';


	var $client_id = 0;

	var $name = null;

	var $uid = 0;
	/**
	 * 消息队列
	 */
	var $_messageQueue = null;
	function __construct( $name=null ){
		$this->Application($name);
	}
	function Application($name=null)
	{
		$this->name = $name;
		$this->session = &Factory::getSession(); 
		//print_r($_SESSION);
		$this->uid = intval($this->session->get('uid'));
 		$this->init();

		//设定时区
		if(function_exists('date_default_timezone_set')){
			date_default_timezone_set('Etc/GMT-8');
		}

	}
	

	function getInstance( $name = 'site')
	{
		$file = PATH_BASE.DS.'includes'.DS.$name.'.php';
		if( file_exists( $file ) )
		{
			$className = ucfirst($name).'Application';
			include($file);	//加载类文件
			if( class_exists( $className ) )
			{
				return new $className($name );
			}
		}
		return new Application();
	}
	function dispatch( $com )
	{
		//配置文件
		global $config;
		//实始化
		/********** init() 方法中的程序段 ********/
		//模板文件下的初始化文件
		$file =PATH_TEMPLATE.DS.$this->getTemplate().DS.'init.php';

		if( file_exists($file) )
		{
			/**
			 * 直接声明为smarty对象
			 */
			include($file);
		}else{
			//Error::throwError('没有找到对应的初始化文件:'.$file);
		}
	
 
		$document	=& Factory::getDocument();

		$this->defineComponentPath($com);
 
		//是否为后台管理组件
		if( $this->isAdmin() )
		{
			$com_path=PATH_COMPONENT.DS.'admin.'.$com.'.php';
		}else{
			$com_path=PATH_COMPONENT.DS.$com.'.php';
			
			

			/** 仅用于设置当前布局时用 **/
			/**
			//这里重设调用系统组件
			if( isset($_REQUEST['custom']) && isset($_REQUEST['loadmodule']) )
			{	
				$com = 'style';
				$com_path=PATH_TEMPLATE.DS.'system'.DS.'components'.DS.'com_'.$com.DS.$com.'.php';
			}
			**/
			/** 完成 **/
			
		}


		if( file_exists($com_path) )
		{
			/**
			 * 直接声明为smarty对象
			 */
			ob_start();
			include($com_path);
			$controllerName=ucfirst($com).'Controller';

			//执行控制器
			if(class_exists($controllerName)){

				$task = $_REQUEST['task'];
				$controller=new $controllerName();
				$controller->execute($task);
				$controller->redirect();
			}

			//echo '开始分析组件!';
			//echo $component;
			$contents = ob_get_contents();
			ob_end_clean();
		}else{
			Error::throwError('没有找到对应的模板组件:'.$com_path);
		}

 		/*******************  初始化完成 ************/
		$document->setBuffer( $contents, 'component');
		return $this->rander();
	}

	//定义组件的路径
	function defineComponentPath($com)
	{
		//定义组件量,以方便后面路径的引用
		define('PATH_COMPONENT',PATH_BASE.DS.'components'.DS.'com_'.$com);
	}

	function rander()
	{
		
		$document = &Factory::getDocument();
		$file 		=  'index';

		if( $_REQUEST['tmpl'] )
		{
			$file = $_REQUEST['tmpl'];
		}

  		$params = array(
					'template' 	=> $this->getTemplate(),
					'file'		=> $file.'.php',
					'directory'	=> PATH_TEMPLATE 
				);

  		return $document ->render(false,$params);
	}
	/**
	 * 系统初始化
	 * 主要查询相关的全局变量
	 */

	function init()
	{
 
	}
	function registerEvent($event, $handler)
	{
		$dispatcher =& Dispatcher::getInstance();
		$dispatcher->register($event, $handler);
	}


	function setNamespace($name)
	{
		$this->namespace = $name;
	}


	function getTemplate(){
		return 'default';
	}


	function getName(){ return $this->name; }

	/**
	 * 取当前用户的环境变量
	 * 例： $app->getUserStateFromRequest(
		$option.'.levellimit','levellimit',10,'int' 
		);

	 * $kay			String | 数组键
	 * $default		String | 默认值空字符
	 * $com			String | 组件空间
	 */
	function getUserStateFromRequest($key,$default=null,$com=null )
	{
		if( empty( $com ) ){
			$key2 = $this->namespace.'_'.$key;
		}else{
			$key2 = $com.'_'.$key;
		}
 
		//首先取当前的请求信息
		if( isset($_REQUEST[$key]) )
		{
			$this->session->set($key2,$_REQUEST[$key]);
			return $_REQUEST[$key];
		}else{

			//然后判断是否在SESSION中存在这个值
			if(  $this->session->exists($key2) )
			{
				return $this->session->get($key2);
			}else{
				if( $default ){
					$this->session->set($key2,$default);
					return $default;
				}
			}
		}
		return false;
	}


	/**
	 * 设置
	 */
	function setUserStateFromRequest($key,$default=null,$com=null )
	{
		if( empty( $com ) ){
			$key2 = $this->namespace.'_'.$key;
		}else{
			$key2 = $com.'_'.$key;
		}
 		$this->session->set($key2,$default);
		return $default;
	}
	
	function getMessageQueue()
	{

 		if (!count($this->_messageQueue))
		{
 			$sessionQueue = $this->session->get('msg');
			if (count($sessionQueue)) {
				$this->_messageQueue = $sessionQueue;

				
				$this->session->set('msg', null);


			}
		}
		return $this->_messageQueue;
	}

 

	function enqueueMessage( $msg, $type = 'message' )
	{
 		if (!count($this->_messageQueue))
		{
 			$sessionQueue = $this->session->get('msg');
			if (count($sessionQueue)) {
 
				$this->_messageQueue = $sessionQueue;
				$this->session->set('msg', null);
			}
		}
  		$this->_messageQueue[] = array('message' => $msg, 'type' => strtolower($type));
	}
	
	function getMsg()
	{
		$msg ='';

		$messageQueue = $this->getMessageQueue();

 		if (count($messageQueue))
		{
			$msg ="<div class='message' >";
			foreach( $messageQueue as $item )
			{
				$msg .=" <div class='msg_".$item['type']."' >";
				$msg .= $item['message'];
				$msg .="</div>";
			}
			$msg.="</div>";
		}
		return $msg;
	}

	/***
	 * 重定向
	 */
	function redirect($uri,$msg='')
	{
		if (trim($msg)) {
			$this->enqueueMessage($msg, $msgType);
		}
		if( $uri ){
			

			if (count($this->_messageQueue))
			{
				$session =& Factory::getSession();
				$session->set('msg', $this->_messageQueue);
			}
			if (headers_sent()) {
				echo "<script>document.location.href='$url';</script>\n";
			} else {
				header( 'HTTP/1.1 301 Moved Permanently' );
				header( 'Location: ' . $uri );
			}
		}
 
	}
		
	function isAdmin(){ return $this->client_id==1; }

	function getClientId(){ return $this->client_id; }
	/**
	 * 退出信息
	 */
	function logout(){
		
		$this->session->destroy();
	}
}
?>