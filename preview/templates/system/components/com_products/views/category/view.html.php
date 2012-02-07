<?php
import( 'application.component.view');
require(PATH_PREVIEW.DS.'components'.DS.'com_products'.DS.'helpers'.DS.'route.php');

class CategoryView extends View
{
	function display($tpl = null)
	{
		global $app;
		$params 	   =& $app->getParams('com_products');
		
		//print_r($params);
		//echo 'ok'; 
		$this->lists = $this->get('list');

		parent::display($tpl);
	}
 
}
?>