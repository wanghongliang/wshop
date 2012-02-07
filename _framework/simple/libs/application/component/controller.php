<?php

/**
* @ 版本		$Id: site.php 2009-6-26
* @ 作用		应用程序的具体类
* @ 包			libraries
* @ 团队        团队One网
* @ copyright   Copyright (c) 2006-2009 TuanduiOne Inc. All rights reserved {@link http://www.TuanduiOne.com}
* @ 作者        王洪亮
* @ E-mail      tuanduione@yahoo.cn
* @ 认证		需商业许可认证,详细请查看根目录下 LICENSE.txt
* @ 备注：本框架基于团队协作开发
*/

class Controller
{
	/*
	 * 方法的映射关联数组
	 */
	var $_taskMap;


	//当前执行的方法
	var $_task;


	//控制器所在目录
	var $_basePath;

	function Controller($config = array()){
		$this->__construct( $config );
	}
	/*
	 * 构造方法
	 */
	function __construct( $config = array() )
	{
	
		//获取当前实例控制器的方法
		$thisMethods	= get_class_methods( get_class( $this ) );

		//控制器基类的方法
		$baseMethods	= get_class_methods( 'Controller' );

		//只是控制器子类的方法
		$methods		= array_diff( $thisMethods, $baseMethods );

		//添加控制默认的方法
		$methods[] = 'display';

		
		// 把方法保存到映射数组
		foreach ( $methods as $method )
		{
			if ( substr( $method, 0, 1 ) != '_' ) {
				$this->_methods[] = strtolower( $method );
				// 仅映射公用方法
				$this->_taskMap[strtolower( $method )] = $method;
			}
		}
		//当前控制器所在目录
		if(defined('PATH_COMPONENT'))
		{
		   $this->_basePath=PATH_COMPONENT;
		}
		
		//注册默认的方法
		$this->registerDefaultTask('display');
	}


	/*
	 * 执行控制器
	 */
	function execute( $task )
	{
		$this->_task = $task;
		
		$task = strtolower( $task );
			
	 
		if (isset( $this->_taskMap[$task] )) {
			$doTask = $this->_taskMap[$task];
		} elseif( isset( $this->_taskMap['__default'] ) )
		{
			$doTask = $this->_taskMap['__default'];
		}else {
			return Error::throwError('此任务没有找到! 提示:'.$task );
		}
		$this->_doTask = $doTask;

	

		// 认证
		if ($this->authorize( $doTask ))
		{ 
			$retval = $this->$doTask();
			return $retval;
		}
		else
		{
			return Error::throwError('拒绝访问!' );
		}
	}


	/**
	 * 取模型类
	 */
	function getModel($name)
	{
		static $instance = array();
		if( empty($instance[$name]) ){
			$view_path = $this->_basePath.DS.'models'.DS.$name.'.php';
			if( file_exists($view_path) )
			{
				include($view_path);
				$className = ucfirst($name).'Model';
				if( class_exists($className) )
				{
					$instance[$name] = new $className();
				}
			}
		}
		return $instance[$name];
	}

	/**
	 * 取视图类
	 */
	function getView( $name = null )
	{
		static $instance = array();
		if ( empty( $name ) ) {
			$name = $this->getName();
		}
 
 		if( empty($instance[$name]) ){
			
			if( $view=trim( $_REQUEST['view'] ) ){
				$name = $view;	//这里应该是 控制器的名称，这里修改为视图的名称
				$view_path = $this->_basePath.DS.'views'.DS.$view.DS.'view.html.php';
			}else{
				$view_path = $this->_basePath.DS.'views'.DS.$name.'.html.php';
			}

			

  			if( file_exists($view_path) )
			{
				include($view_path);
				$className = ucfirst($name).'View';

				if( class_exists($className) )
				{
					$instance[$name] = new $className();
				}


			} 
			unset($view,$view_path); 
		}

 
		return $instance[$name];
	}

 	/**
	 * 控制器的名称
	 */
	function getName()
	{
		$name = $this->_name;
		
 		if (empty( $name ))
		{
			$r = null;
			if ( !preg_match( '/(.*)Controller/i', get_class( $this ), $r ) ) {
				Error::throwError("Controller::getName() : 不能够获得控制器的名称.");
			}
			$name = strtolower( $r[1] );
		}

		return $name;
	}

	function authorize( $task )
	{
		return true;
	}


	function display()
	{
		
	}

	function redirect($uri='',$msg=''){
		global $app;
		$app->redirect($uri,$msg);
	}

	//注册方法
	function registerTask( $task, $method )
	{
		if ( in_array( strtolower( $method ), $this->_methods ) ) {
			$this->_taskMap[strtolower( $task )] = $method;
		}
	}

	
	//注册默认的方法
	function registerDefaultTask( $method )
	{
		$this->registerTask( '__default', $method );
	}

}
?>