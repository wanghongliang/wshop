<?php

class DocumentRenderModules
{
	
	/**
	 * 按位置加载相应模块
	 */
	function render( $position, $params = array(), $content = null )
	{

 		$doc = & Factory::getDocument();
		$renderer =&  $doc->loadRenderer('module');
		
		//echo $position;

		$contents = '';

 		foreach (ModuleHelper::getModules($position) as $mod)  {
			$contents .= $renderer->render($mod, $params, $content);
		}
		return $contents;
	}
}

?>