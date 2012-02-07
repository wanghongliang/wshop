<?php
import('application.component.view');
class BrandsView extends View
{
 	var $rows;
	var $baseuri;	//URI
	var $depth = 0;
	function BrandsView()
	{
		$this->baseuri = 'index.php?com=brands';
	}

	function display()
	{
		$lists = $this->get('list');
		$this->rows = &$lists['rows'];
		$this->nav=$this->get('nav');

		$this->path = dirname(__FILE__);
 		include($this->path.DS.'tmpl'.DS.'list.php');
	}
 
 
}
?>