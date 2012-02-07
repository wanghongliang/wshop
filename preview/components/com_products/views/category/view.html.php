<?php
import( 'application.component.view');
require(dirname(PATH_COMPONENT).DS.'com_products'.DS.'helpers'.DS.'route.php');

class CategoryView extends View
{
	function display($tpl = null)
	{
		global $app;
 
 		$this->lists = $this->get('list');  
		parent::display($tpl);
	}
 
}
?>