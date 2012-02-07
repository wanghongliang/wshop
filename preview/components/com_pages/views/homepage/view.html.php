<?php
import( 'application.component.view');
include(PATH_COMPONENT.DS.'helpers'.DS.'route.php');

class HomepageView extends View
{
	function display($tpl = null)
	{
		global $app;
		$_REQUEST['tmpl'] = 'home';
		$this->item = $this->get('item');
    	parent::display($tpl);
	}

}
?>
