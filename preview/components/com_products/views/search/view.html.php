<?php
import( 'application.component.view');
require(dirname(PATH_COMPONENT).DS.'com_products'.DS.'helpers'.DS.'route.php');

class SearchView extends View
{
	function display($tpl = null)
	{
		global $app;
		//$params 	   =& $app->getParams('com_products');
 		$this->lists = $this->get('list');
 		parent::display($tpl);
	}
 
}
?>