<?php
import('application.component.view');
class CreatesView extends View
{
 	var $rows;
	var $menuid;	//当前菜单分类ID
	var $depth = 0;
	function CreatesView()
	{	
		$this->path = dirname(__FILE__);
 	}

	function display()
	{
 		$lists = $this->get('list');
 		include($this->path.DS.'tmpl'.DS.'list.php');
	}
}
?>