<?php
import( 'application.component.view');
require(dirname(PATH_COMPONENT).DS.'com_contents'.DS.'helpers'.DS.'route.php');

class CategoryView extends View
{
	function display($tpl = null)
	{
		global $app;
		$params 	   =& $app->getParams('com_contents');
		
		//print_r($params);
		//echo 'ok'; 
		$this->lists = $this->get('list');

		parent::display($tpl);
	}
 
}
?>