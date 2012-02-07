<?php
/**
* @ 版本		$Id: application.php 2009-6-26
* @ 作用		应用程序的主基类
* @ 包		libraries
* @ 团队        团队One网
* @ copyright   Copyright (c) 2006-2009 TuanduiOne Inc. All rights reserved {@link http://www.TuanduiOne.com}
* @ 作者        王洪亮
* @ E-mail      tuanduione@yahoo.cn
* @ 认证		需商业许可认证,详细请查看根目录下 LICENSE.txt
* @ 备注：本框架基于团队协作开发
*/

//确认文件正确引用执行
defined('PATH_BASE') or die();

class WComponentHelper
{

	function &getComponent( $name, $strict = false )
	{
		$result = null;
		$components = WComponentHelper::_load();
		
 		if (isset( $components[$name] ))
		{
			$result = &$components[$name];
		}
		else
		{
			$result				= new stdClass();
			$result->enabled	= $strict ? false : true;
			$result->params		= null;
		}

		return $result;
	}

	function &getParams( $name )
	{
		static $instances;
		if (!isset( $instances[$name] ))
		{
			//把 ini 字符串分析为数组
			import('html.format.ini');
 			$component = &WComponentHelper::getComponent( $name );
			$instances[$name] = (array)unserialize($component->params);//&FormatINI::stringToArray($component->params);
		}
		return $instances[$name];
	}



	//构建控制器，并执行控制器的方法
	function renderComponent($component)
	{
		global $app;

		define('PATH_COMPONENT',PATH_BASE.DS.'components'.DS.'com_'.$component);
 		define( 'PATH_COMPONENT_ADMIN',	PATH_ADMIN.DS.'components'.DS.'com_'.$component);


		$task=WRequest::getVar('task', 'default', 'cmd');

		if ( $app->isAdmin()) {
			$controllerFile = PATH_COMPONENT.DS.'admin.'.$component.'.php';
		} else {
			$controllerFile = PATH_COMPONENT.DS.$component.'.php';
		}

		//echo $controllerFile ;exit;

		/**
		 * 加载组件的语言包文件
		 */
		$lang =& WFactory::getLanguage();
 		$lang->load('com_'.$component);
		

		//echo $controllerFile;exit;
 		if( file_exists($controllerFile) ){
			ob_start();
			include($controllerFile);
			$controllerName=ucfirst($component).'Controller';

			//执行控制器
			if(class_exists($controllerName)){
				$controller=new $controllerName();
				$controller->execute($task);
				$controller->redirect();

			}
			//echo '开始分析组件!';
			//echo $component;
			$contents = ob_get_contents();
			ob_end_clean();
		}else{
			if( $app->isAdmin() ){
				WError::throwError(501,'组件没有找到 ,请检查后台的组件入口文件：admin.'.$component.'.php　是否存在 ');

			}else{
				WError::throwError(501,'组件没有找到 ,请检查组件入口文件：'.$component.'.php 是否存在 ');

			}
		}


		// Build the component toolbar
		wimport( 'core.application.helper' );
		if (($path = WApplicationHelper::getPath( 'toolbar' )) && $app->isAdmin()) {

			// Get the task again, in case it has changed
			$task = WRequest::getString( 'task' );

			// Make the toolbar
			include_once( $path );
		}




		return $contents;
		
	}

	function _load()
	{
		static $components;

		if (isset($components)) {
			return $components;
		}

		$db = &Factory::getDB();

		$query = 'SELECT *' .
				' FROM #__components' .
				' WHERE parent = 0';
		$db->query( $query );

		if (!($components = $db->loadObjectList( 'option' ))) {
			WError::raiseWarning( 'SOME_ERROR_CODE', "Error loading Components: " . $db->getErrorMsg());
			return false;
		}

		return $components;

	}
	
}
?>