<?php
import('application.component.view');
class TuansView extends View
{
 	var $rows;
 
	//var $depth = 0;
	function TuansView()
	{
 		$this->baseuri = 'index.php?com=tuans';

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