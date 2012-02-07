<?php
class CacheController extends Controller
{
	function CacheController()
	{
		parent::__construct();
	}

	function display()
	{
	
 
	}

	//更新对应的组件缓存
	function update(){
		$db = &Factory::getDB();
		$id = (int)$_GET['id'];
		$sql = "update #__components set cache=0 where id=".$id;
		$db->query($sql);



		import( 'application.module.helper');
		$modules =& ModuleHelper::_load();
		
		$cache_path = PATH_CACHE.DS.'modules';
		if( !file_exists( $cache_path) ){
			mkdir($cache_path);
		}
		foreach( $modules as $pos=>$mod ){
			foreach($mod as $m){

				if( $id==$m->cid ){
					$con = $this->renderModule($m);
					$cpath = PATH_CACHE.DS.'modules'.DS.$m->id.'.php';
					file_put_contents($cpath,preg_replace("/\s+/i"," ",$con));
				}
			}
		}





		echo '1';
		return true;
	}
 
	function renderModule($module, $attribs = array())
	{
		global $app;
		static $chrome;
		
 
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
	
	
}
?>