<?php
import('application.component.view');
class DealersView extends View
{
 	var $rows;
 
	var $depth = 0;
	function DealersView()
	{
 		$this->baseuri = 'index.php?com=dealer';
	}

	function display()
	{
		$lists = $this->get('list');
		$this->rows=$lists['rows'];
		$this->path = dirname(__FILE__);
		$nav = $this->get('nav');
		include($this->path.DS.'tmpl'.DS.'list.php');
	}

 

}
?>