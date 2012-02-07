<?php

class DocumentRenderModules
{
	
	/**
	 * ��λ�ü�����Ӧģ��
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