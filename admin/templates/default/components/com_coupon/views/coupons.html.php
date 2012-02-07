<?php
import('application.component.view');
class CouponsView extends View
{
 	var $rows;
	var $baseuri;	//URI
	var $depth = 0;
	function CouponsView()
	{
		$this->baseuri = 'index.php?com=coupon';
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