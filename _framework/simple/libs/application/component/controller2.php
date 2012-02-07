<?php
/**
* @ 版本		$Id: controller.php 2009-6-26
* @ 作用		控制器类文件
* @ 包			libraries
* @ 团队        团队One网
* @ copyright   Copyright (c) 2006-2009 TuanduiOne Inc. All rights reserved {@link http://www.daybillion.com}
* @ 作者        王洪亮
* @ E-mail      daybillion@yahoo.com.cn
* @ 认证		需商业许可认证,详细请查看根目录下 LICENSE.txt
* @ 备注：		本系统基于团队协作开发
* @ 团队成员	王洪亮 唐国胜 熊进超 金慧芬
*/

defined('PATH_BASE') or die();

/**
 * 控制器基类
 */
class WController extends WObject
{
	/**
	 * 控制器的文件路径
	 */
	var $_basePath = null;

	/**
	 * 控制器名称
	 */
	var $_name = null;

	/**
	 * 类方法
	 */
	var $_methods 	= null;

	/**
	 * 相关任务的映射
	 */
	var $_taskMap 	= null;

	/**
	 * 当前执行的任务
	 */
	var $_task 		= null;

	/**
	 * 任务映射
	 */
	var $_doTask 	= null;

	/**
	 * 视图类文件目录
	 */
	var $_path = array(
		'view'	=> array()
	);

	/**
	 * 重定向的URL
	 */
	var $_redirect 	= null;

	/**
	 * 重定向的消息
	 */
	var $_message 	= null;

	/**
	 * 消息类型
	 */
	var $_messageType 	= null;

	/**
	 * 权限控制器
	 */
	var $_acoSection 		= null;

	/**
	 * 默认控制器相关值
	 */
	var $_acoSectionValue 	= null;

	/**
	 * 构造器
	 *
	 * @param	配置信息数组
	 */
	function __construct( $config = array() )
	{
		//实始化私有的变量
		$this->_redirect	= null;
		$this->_message		= null;
		$this->_messageType = 'message';
		$this->_taskMap		= array();
		$this->_methods		= array();
		$this->_data		= array();

		// 获取类方法
		$thisMethods	= get_class_methods( get_class( $this ) );
		$baseMethods	= get_class_methods( 'WController' );
		$methods		= array_diff( $thisMethods, $baseMethods );

		//添加默认的任务
		$methods[] = 'display';

		// 任务关联映射
		foreach ( $methods as $method )
		{
			if ( substr( $method, 0, 1 ) != '_' ) {
				$this->_methods[] = strtolower( $method );
				//自动注册公共方法
				$this->_taskMap[strtolower( $method )] = $method;
			}
		}

		// 名称
		if (empty( $this->_name ))
		{
			if (array_key_exists('name', $config))  {
				$this->_name = $config['name'];
			} else {
				$this->_name = $this->getName();
			}
		}

		// 基本的搜索路径
		if (array_key_exists('base_path', $config)) {
			$this->_basePath	= $config['base_path'];
		} else {
			$this->_basePath	= PATH_COMPONENT;// PATH_COMPONENT;
		}

		// 注册默认的任务
		if ( array_key_exists( 'default_task', $config ) ) {
			$this->registerDefaultTask( $config['default_task'] );
		} else {
			$this->registerDefaultTask( 'display' );
		}

		// 设置模型类路径
		if ( array_key_exists( 'model_path', $config ) ) {
	  
			$this->addModelPath($config['model_path']);
		} else {
			$this->addModelPath($this->_basePath.DS.'models');
		}

		// 视图类路径
		if ( array_key_exists( 'view_path', $config ) ) {
		 
			$this->_setPath( 'view', $config['view_path'] );
		} else {
			$this->_setPath( 'view', $this->_basePath.DS.'views' );
		}

		//让子类初始化
		$this->init();
	}

	function init(){}

	/**
	 * 执行相关任务，直接调用控制器的相关子类方法
	 */
	function execute( $task )
	{
		$this->_task = $task;

		$task = strtolower( $task );
		if (isset( $this->_taskMap[$task] )) {
			$doTask = $this->_taskMap[$task];
		} elseif (isset( $this->_taskMap['__default'] )) {
			$doTask = $this->_taskMap['__default'];
		} else {
			return WError::raiseError( 404, WText::_('Task ['.$task.'] not found') );
		}
 		$this->_doTask = $doTask;



		//认证
		if ($this->authorize( $doTask ))
		{
			$retval = $this->$doTask();
			return $retval;
		}
		else
		{
			return WError::raiseError( 403, WText::_('Access Forbidden') );
		}
 	}

	/**
	 * 认证检查
	 */
	function authorize( $task )
	{
 		if ($this->_acoSection)
		{
 			if ($this->_acoSectionValue) {
 				$task = $this->_acoSectionValue;
			}
 			$user = & WFactory::getUser();
			return $user->authorize( $this->_acoSection, $task );
		}
		else
		{
 			return true;
		}
	}

	/**
	 * 典型的MVC执行方式
	 */
	function display($cachable=false)
	{
		$document =& WFactory::getDocument();

		$viewType	= $document->getType();
		$viewName	= WRequest::getCmd( 'view', $this->getName() );
		$viewLayout	= WRequest::getCmd( 'layout', 'default' );
	
  
		$view = & $this->getView( $viewName, $viewType, '', array( 'base_path'=>$this->_basePath));

		//print_r($view);
 		if ($model = & $this->getModel($viewName)) {
			$view->setModel($model, true);
		}
 

		$view->setLayout($viewLayout);

	 
		if ($cachable) {
			global $option;
			$cache =& WFactory::getCache($option, 'view');
			$cache->get($view, 'display');
		} else {
			$view->display();
		}

	}

	/**
	 * 转向其它页面
	 */
	function redirect()
	{
		if ($this->_redirect) {
			global $app;
			$app->redirect( $this->_redirect, $this->_message, $this->_messageType );
		}
		return false;
	}

	/**
	 * 取相关模型方法
	 */
	function &getModel( $name = '', $prefix = '', $config = array() )
	{
		if ( empty( $name ) ) {
			$name = $this->getName();
		}

		if ( empty( $prefix ) ) {
			$prefix = $this->getName() . 'Model';
		}

		if ( $model = & $this->_createModel( $name, $prefix, $config ) )
		{
			// 设置模型的相关属性
			$model->setState( 'action', $this->_task );

			// 把菜单的设置，存入模型类中
			$app	= &WFactory::getApplication();
			$menu	= &$app->getMenu();
			if (is_object( $menu ))
			{
				if ($item = $menu->getActive())
				{
					$params	=& $menu->getParams($item->id);
					// Set Default State Data
					$model->setState( 'parameters.menu', $params );
				}
			}
		}
		return $model;
	}

	/**
	 * 添加一个模型搜索路径
	 */
	function addModelPath( $path )
	{
		wimport('core.application.component.model');
		WModel::addIncludePath($path);
	}

	/**
	 * 获取任务列表
	 */
	function getTasks()
	{
		return $this->_methods;
	}

	/**
	 * 获取任务
	 */
	function getTask()
	{
		return $this->_task;
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
				WError::raiseError(500, "WController::getName() : Cannot get or parse class name.");
			}
			$name = strtolower( $r[1] );
		}

		return $name;
	}

	/**
	 * 获取视图类
	 */
	function &getView( $name = '', $type = '', $prefix = '', $config = array() )
	{
		static $views;

		if ( !isset( $views ) ) {
			$views = array();
		}

		if ( empty( $name ) ) {
			$name = $this->getName();
		}

		if ( empty( $prefix ) ) {
			$prefix = $this->getName() . 'View';
		}

		if ( empty( $views[$name] ) )
		{
			if ( $view = & $this->_createView( $name, $prefix, $type, $config ) ) {
				$views[$name] = & $view;
			} else {
				$result = WError::raiseError(
					500, WText::_( 'View File not found [name, type, prefix]:' )
						. ' ' . $name . ',' . $type . ',' . $prefix
				);
				return $result;
			}
		}

		return $views[$name];
	}

	/**
	 * 添加一个视图类，文件搜索路径
	 */
	function addViewPath( $path )
	{
		$this->_addPath( 'view', $path );
	}

	/**
	 * 注册一个任务映射方法，替换原方法
	 */
	function registerTask( $task, $method )
	{
		if ( in_array( strtolower( $method ), $this->_methods ) ) {
			$this->_taskMap[strtolower( $task )] = $method;
		}
	}

	/**
	 * 注册一个默认的方法
	 */
	function registerDefaultTask( $method )
	{
		$this->registerTask( '__default', $method );
	}

	/**
	 *设置一个内部的消息
	 */
	function setMessage( $text )
	{
		$previous		= $this->_message;
		$this->_message = $text;
		return $previous;
	}

	/**
	 * 重定向其它的URL
	 */
	function setRedirect( $url, $msg = null, $type = 'message' )
	{
		$this->_redirect = $url;
		if ($msg !== null) {
			 
			$this->_message	= $msg;
		}
		$this->_messageType	= $type;
	}

	/**
	 * 设置访问控制等级
	 *
	 * @access	public
	 * @param	string  组件
	 * @param	string  等级值
	 */
	function setAccessControl( $section, $value = null )
	{
		$this->_acoSection = $section;
		$this->_acoSectionValue = $value;
	}

	/**
	 * 加载一个模型对象
	 *
	 * @param	string  模型名称
	 * @param	string	模型的前缀
	 * @param	array	配置信息数组
	 * @return	mixed	模型对象
	 */
	function &_createModel( $name, $prefix = '', $config = array())
	{
		$result = null;

		// Clean the model name
		$modelName	 = preg_replace( '/[^A-Z0-9_]/i', '', $name );
		$classPrefix = preg_replace( '/[^A-Z0-9_]/i', '', $prefix );
		
		$result =& WModel::getInstance($modelName, $classPrefix, $config);
		return $result;
	}

	/**
	 * 方法加载并返回一个视图对象。该方法首先会在当前的模板目录的对比，并没有使用默认设置路径加载视图类的文件。
	 *
	 * 注意参数的顺序
	 * @param	string  视图的名称
	 * @param	string	类前缀
	 * @param	string	视图类型
	 * @param	array	配置信息
	 * @return	mixed	视图对象
	 */
	function &_createView( $name, $prefix = '', $type = '', $config = array() )
	{
		$result = null;

		// 整理文件名称
		$viewName	 = preg_replace( '/[^A-Z0-9_]/i', '', $name );
		$classPrefix = preg_replace( '/[^A-Z0-9_]/i', '', $prefix );
		$viewType	 = preg_replace( '/[^A-Z0-9_]/i', '', $type );

		// 视图类名
		$viewClass = $classPrefix . $viewName;


		//echo $viewClass;

		if ( !class_exists( $viewClass ) )
		{
			wimport( 'core.filesystem.path' );
			$path = WPath::find(
				$this->_path['view'],
				$this->_createFileName( 'view', array( 'name' => $viewName, 'type' => $viewType) )
			);
			//print_r($this->_path['view']);
			//print_r($this->_createFileName( 'view', array( 'name' => $viewName, 'type' => $viewType)));exit;
 			if ($path) {
				require_once $path;

				if ( !class_exists( $viewClass ) ) {
					$result = WError::raiseError(
						500, WText::_( 'View class not found [class, file]:' )
						. ' ' . $viewClass . ', ' . $path );
					return $result;
				}
			} else {
				return $result;
			}
		}

		$result = new $viewClass($config);
		return $result;
	}



	/**
	* 设置视图和模型类的文件夹路径
	*/
	function _setPath( $type, $path )
	{
 		$this->_path[$type] = array();

 		$this->_addPath( $type, $path );
	}

	/**
	*添加一个搜索文件路径
	*
	* @param	string 路径类型如： 'model', 'view'.
	* @param	string|array 目录
	* @return	void
	*/
	function _addPath( $type, $path )
	{
		// just force path to array
		settype( $path, 'array' );

		// loop through the path directories
		foreach ( $path as $dir )
		{
			// no surrounding spaces allowed!
			$dir = trim( $dir );

			// add trailing separators as needed
			if ( substr( $dir, -1 ) != DIRECTORY_SEPARATOR ) {
				// directory
				$dir .= DIRECTORY_SEPARATOR;
			}

			// add to the top of the search dirs
			array_unshift( $this->_path[$type], $dir );
		}
	}


	function _createFileName( $type, $parts = array() )
	{
		$filename = '';

		switch ( $type )
		{
			case 'view':
				if ( !empty( $parts['type'] ) ) {
					$parts['type'] = '.'.$parts['type'];
				}

				$filename = strtolower($parts['name']).DS.'view'.$parts['type'].'.php';
			break;
		}
		return $filename;
	}
}