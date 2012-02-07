<?php
import( 'application.component.view');
class PageView extends View
{
	function display($tpl = null)
	{
		global $app;
 
		$this->item = $this->get('item');
		$menu = &$app->getMenu();
		$active = & $menu->getActive();		
		if( $active['tid'] == 11 ){
			include(dirname(__FILE__).DS.'tmpl'.DS.'default_services.php');
		}else{
 			parent::display($tpl);
		}
	}

}
?>
