<?php

import( 'application.component.view');
require(dirname(PATH_COMPONENT).DS.'com_products'.DS.'helpers'.DS.'route.php');

class SendmsgView extends View
{
	function display($tpl = null)
	{
		global $app;
		$params 	   =& $app->getParams('com_products');

				
		$pathway = &$app->getPathWay();
 		$pathway->addItem('发联系信','#');

		$this->item = $this->get('item');

		//print_r($this->item);
  		parent::display($tpl);
	}
 
}
?>