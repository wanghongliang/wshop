<?php
import('application.component.view');
class TemplatesView extends View
{
 	var $rows;
 
	var $depth = 0;
	function TemplatesView()
	{
 		$this->baseuri = 'index.php?com=templates&client_id='.intval($_REQUEST['client_id']);
	}

	function display()
	{
		$this->rows = $this->get('list');
		$this->path = dirname(__FILE__);
		$nav = $this->get('nav');
		include($this->path.DS.'tmpl'.DS.'list.php');
	}

 

}
?>