<?php
import('application.component.view');
class ComponentsView extends View
{
 	var $rows;
 
	var $depth = 0;
	function ComponentsView()
	{
 		$this->baseuri = 'index.php?com=components';
	}

	function display()
	{
		$this->rows = $this->get('list');
		$this->path = dirname(__FILE__);
		include($this->path.DS.'tmpl'.DS.'list.php');
	}

 

}
?>