<?php
import('application.component.view');
class ElitesView extends View
{
 	var $rows;
	var $baseuri;	//URI
	var $depth = 0;
	function ElitesView()
	{
		$this->baseuri = 'index.php?com=elites';
	
	}

	function display()
	{
		$this->rows = $this->get('list');
		$this->path = dirname(__FILE__);
		include($this->path.DS.'tmpl'.DS.'toolbar.php');
		include($this->path.DS.'tmpl'.DS.'list.php');
	}
 
 
}
?>