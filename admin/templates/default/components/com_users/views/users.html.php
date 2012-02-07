<?php
import('application.component.view');
class UsersView extends View
{
 	var $rows;
 
	var $depth = 0;
	function UsersView()
	{
 		$this->baseuri = 'index.php?com=users';
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