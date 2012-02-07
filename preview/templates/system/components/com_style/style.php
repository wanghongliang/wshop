<?php
import('application.module.helper');
class StyleController extends Controller
{
	function StyleController()
	{
		parent::__construct();
	}

	function display()
	{
	
 	  
	}

	/** 
	 * ajax方式加载
	 */
	function ajaxgetmodule(){
		global $app;

		$id = intval($_REQUEST['loadmodule']);
		if( $id > 0 )
		{
			$db = &Factory::getDB();

			//输出指定的模块信息
			$sql = " select * from #__modules where uid='".$app->uid."' and id='".$id."' ";

 			$db->query($sql);
			$obj= $db->loadObjectList();
			
			$module = $obj[0];
			//print_r($obj);
			import('html.format.ini');
			$params = FormatINI::stringToArray( $module->params );
			$module->module = preg_replace('/[^A-Z0-9_\.-]/i', '', $module->module);

			$path = $app->getPreviewModulePath().DS.$module->module.DS.$module->module.'.php';
			
			//自定义内容后就输出自定义内容
			if ( file_exists( $path )  )
			{
				$content = '';
				ob_start();
				require $path;
				$module->content = ob_get_contents().$content;
				ob_end_clean();
			}

			unset($obj);

			echo $module->content;
		}
	}
 
}

 
?>