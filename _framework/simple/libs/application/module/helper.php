<?php
import('html.format.ini');
class ModuleHelper
{
	/**
	 * 通实际的模块名，得到模块
	 */
	function &getModule($name, $title = null )
	{
		$result		= null;
		$modules	=& ModuleHelper::_load();
		
		//print_r($modules);
 		foreach( $modules as $k => $v )
		{
			if( is_array($v) ){
				$total		= count($v);
				for ($i = 0; $i < $total; $i++)
				{
					// 名称匹配的模块
					if ($v[$i]->module == $name)
					{
						// 指定标题后，需要匹配标题
						if ( ! $title || $v[$i]->title == $title )
						{
							$result =& $v[$i];
							break;	// 找到
						}
					}
				}
			}

		}


		/**
		$total		= count($modules);
		for ($i = 0; $i < $total; $i++)
		{
			// 名称匹配的模块
			if ($modules[$i]->name == $name)
			{
				// 指定标题后，需要匹配标题
				if ( ! $title || $modules[$i]->title == $title )
				{
					$result =& $modules[$i];
					break;	// 找到
				}
			}
		}
		**/



		// 没有找到，将创建一个标准模块
		if (is_null( $result ) && substr( $name, 0, 4 ) == 'mod_')
		{
			$result				= new stdClass;
			$result->id			= 0;
			$result->title		= '';
			$result->module		= $name;
			$result->position	= '';
			$result->content	= '';
			$result->showtitle	= 0;
			$result->control	= '';
			$result->params		= '';
			$result->user		= 0;
		}

		return $result;
	}

	/**
	 * 通过模块的位置找到模块
	 */
	function &getModules($position)
	{
		$position	= strtolower( $position );
		$result		= array();

		$modules =& ModuleHelper::_load();
		
		
		if( is_array( $modules[$position] ) ){
			$result = $modules[$position];
		} 
	
		//print_r($modules);
		return $result;
 
	}

	/**
	 * 检查模块是否可用
	 */
	function isEnabled( $module )
	{
		$result = &ModuleHelper::getModule( $module);
		return (!is_null($result));
	}

	function renderModule($module, $attribs = array())
	{
		global $app;
		static $chrome;
		
		//是否缓存
		$cpath = PATH_CACHE.DS.'modules'.DS.$module->id.'.php';
		
 	    if( $GLOBALS['config']['options']['cache'] == 1 && file_exists( $cpath ) ){
 			return file_get_contents($cpath);
		}


		//print_r($module);
		$params = FormatINI::stringToArray( $module->params );
		$module->module = preg_replace('/[^A-Z0-9_\.-]/i', '', $module->module);
		$path = PATH_MODULES.DS.$module->module.DS.$module->module.'.php';
		

		
		
  		//自定义内容后就输出自定义内容
   		if ( file_exists( $path )  )
		{
			$content = '';
			ob_start();
			require $path;
			$module->content = ob_get_contents().$content;
			ob_end_clean();
		}

		//print_r($module);

		// 模块修饰函数文件
		if (!$chrome) {
			$chrome = array();
		}

 		$chromePath = PATH_BASE.DS.'templates'.DS.$app->getTemplate().DS.'html'.DS.'modules.php';
		
 
		if (!isset( $chrome[$chromePath]))
		{
			if (file_exists($chromePath)) {
				require_once ($chromePath);
			}
			$chrome[$chromePath] = true;
		}



		//是否设定样式
		if(!isset($attribs['style'])) {
			$attribs['style'] = 'none';
		}

		//动态设定样式
		//if(WRequest::getBool('tp')) {
		//	$attribs['style'] .= ' outline';
		//}

		foreach(explode(' ', $attribs['style']) as $style)
		{
			$chromeMethod = 'modDecorate_'.$style;

 			if (function_exists($chromeMethod))
			{
				$module->style = $attribs['style'];

				ob_start();
				$chromeMethod($module, $params, $attribs);
				$module->content = ob_get_contents();
				ob_end_clean();
			}
		} 

		return $module->content;
	}

	/**
	 * 取得模块布局的样式
	 */
	function getLayoutPath($module, $layout = 'default')
	{
		global $app;

		// 构建布局文件路径
		$tPath = PATH_BASE.DS.'templates'.DS.$app->getTemplate().DS.'html'.DS.$module.DS.$layout.'.php';
		$bPath = $app->getPreviewModulePath().DS.$module.DS.'tmpl'.DS.$layout.'.php';
 
		// 如果模板中有布局文件，将覆盖它
		if (file_exists($tPath)) {
			return $tPath;
		} else {
			return $bPath;
		}
	}


	/**
	 * Load published modules
	 *
	 * @access	private
	 * @return	array
	 */
	function &_load()
	{
		global $app, $itemid;
		
		static $modules;

 		if (isset($modules)) {
			return $modules;
		}

		//多加一个方法，用于会员的管理界面
		if( method_exists($app,'loadModules')){
			$modules = $app->loadModules();
			return  $modules;
		}
 		$db		=& Factory::getDB();

 
		$modules	= array();
		
		$wheremenu =  $itemid>0 ? ' AND ( mm.menuid = '. (int) $itemid .' OR mm.menuid = 0 )' : '';

 
		$query = 'SELECT id, title, module, position, content, showtitle, control,cid, params'
			. ' FROM #__modules AS m'
			. ' LEFT JOIN #__modules_menu AS mm ON mm.moduleid = m.id'
			. ' WHERE m.published = 1';
			//. ' AND m.access <= '. (int)$aid //暂不加访问控制

		if( isset($GLOBALS['USERID']) ){
			//$query .= " and m.uid='".$GLOBALS['USERID']."' ";
		}

		$query .= ' AND m.client_id = '. (int)$app->getClientId()
			. $wheremenu
			. ' ORDER BY ordering';
		
  		$db->query( $query );
 
 		if (null === ($modules = $db->loadObjectList('position',true))) {
			exit( '没有加载任何模块。');
			return false;
		}

		//print_r($modules);
 		return $modules;

		/***
		$total = count($modules);
		for($i = 0; $i < $total; $i++)
		{
			//determine if this is a custom module
			$file					= $modules[$i]->module;
			$custom 				= substr( $file, 0, 4 ) == 'mod_' ?  0 : 1;
			$modules[$i]->user  	= $custom;
			// CHECK: custom module name is given by the title field, otherwise it's just 'om' ??
			$modules[$i]->name		= $custom ? $modules[$i]->title : substr( $file, 4 );
			$modules[$i]->style		= null;
			$modules[$i]->position	= strtolower($modules[$i]->position);
		}
		***/ 
		//print_r($modules);
		return $modules;
	}


	/**
	 * 加载模块
	 */
	function &_load2()
	{

		$modules = array(
			ModuleHelper::_createModule('menu','wrap'),
			ModuleHelper::_createModule('login'),
			ModuleHelper::_createModule('news'),
			ModuleHelper::_createModule('topmenu','top'),
			ModuleHelper::_createModule('breadcrumbs','top'),
			ModuleHelper::_createModule('mod_login','admin'),
			ModuleHelper::_createModule('menu','adminmenu'),
			ModuleHelper::_createModule('toolbar','toolbar'),	
			
				ModuleHelper::_createModule('logo','admintop'),	
				ModuleHelper::_createModule('online','admintop'),	
				ModuleHelper::_createModule('statu','admintop'),	
				ModuleHelper::_createModule('title','title'),	
				ModuleHelper::_createModule('submenu','submenu'),	
		);
		//暂不加载
		return $modules;

		$total = count($modules);
		for($i = 0; $i < $total; $i++)
		{
			//确定这是否是一个自定义模块
			$file					= $modules[$i]->module;
			$custom 				= substr( $file, 0, 4 ) == 'mod_' ?  0 : 1;
			$modules[$i]->user  	= $custom;
			//检查：自定义模块名称是由指定的标题
			$modules[$i]->name		= $custom ? $modules[$i]->title : substr( $file, 4 );
			$modules[$i]->style		= null;
			$modules[$i]->position	= strtolower($modules[$i]->position);
		}

		return $modules;
	}


	function _createModule($name , $position = 'left', $params=array() )
	{
			$result				= new stdClass;
			$result->id			= 0;
			$result->title		= $name;
			$result->module		= 'mod_'.$name;
			$result->position	= $position;
			$result->content	= '';
			$result->showtitle	= 0;
			$result->control	= '';
			$result->params		= $params;
			$result->user		= 0;
			return $result;
	}

}

