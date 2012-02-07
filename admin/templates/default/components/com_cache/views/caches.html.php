<?php
import('application.component.view');
class CachesView extends View
{
 	var $rows;
	var $path;
 
	var $depth = 0;
	function CachesView()
	{ 		
		$this->path = dirname(__FILE__);
 		$this->baseuri = 'index.php?com=cache&client_id='.intval($_REQUEST['client_id']);
	}

	function display()
	{
		$lists = $this->get('list');
 		include($this->path.DS.'tmpl'.DS.'list.php');
	}

 

}
?>