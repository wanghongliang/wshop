<?php
import( 'application.component.view');
class PageView extends View
{
	function display($tpl = null)
	{
		global $app;
 
		$this->item = $this->get('item');
 	 
 		parent::display($tpl);
	}

}
?>