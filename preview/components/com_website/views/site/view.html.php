<?php
import( 'application.component.view');
class SiteView extends View
{
	function display($tpl = null)
	{
		global $app;
		$GLOBALS['body_id'] = 'cate3';
		$_REQUEST['tmpl'] = 'home-list';
		$this->item = $this->get('item');
 		include($app->getMemberOptionPath());//ÍøÕ¾ËùÊô·ÖÀà
 		//parent::display($tpl);
		include(dirname(__FILE__).DS.'tmpl'.DS.'default.php');
	}

}
?>
