<?php
import( 'application.component.view');
class WsView extends View
{
	function display($tpl = null)
	{
		global $app;
		$GLOBALS['body_id'] = 'cate3';
 		$this->item = $this->get('item');
 		include($app->getMemberOptionPath());//��վ��������
 		//parent::display($tpl);
		include(dirname(__FILE__).DS.'tmpl'.DS.'default.php');
	}

}
?>
