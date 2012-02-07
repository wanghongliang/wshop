<?php
import( 'application.component.view');
include(PATH_COMPONENT.DS.'helpers'.DS.'route.php');
class ServicesView extends View
{
	function display($tpl = null)
	{
		global $app;
		$model = &$this->getModel();

		$p = dirname(__FILE__).DS.'tmpl';	
		if( $_POST['act'] == 'save' ){
			$model->save(); 
		}

		$rows = $this->get('items');  
		include($p.DS.'default.php');
	 
	}

}
?>
