<?php
import('application.component.view');
class ShippingsView extends View
{
 	var $rows;
 
	//var $depth = 0;
	function ShippingsView()
	{
 		$this->baseuri = 'index.php?com=shippings';

		if( isset($_REQUEST['tmpl']) ){
			$this->baseuri .="&tmpl=".$_REQUEST['tmpl'];
		}
	}

	function display()
	{
		$this->rows = $this->get('list');
		$this->path = dirname(__FILE__);
		$nav = $this->get('nav');
		if( $_REQUEST['tmpl'] == 'component' ){
			include($this->path.DS.'tmpl'.DS.'list_component.php');
		}else{
			include($this->path.DS.'tmpl'.DS.'list.php');
		}
	}

 

}
?>