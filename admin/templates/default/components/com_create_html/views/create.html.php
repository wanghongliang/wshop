<?php
import('application.component.view');
class CreateView extends View
{
 	var $rows;
	var $menuid;	//当前菜单分类ID
	var $depth = 0;
	function CreateView()
	{	
		$this->path = dirname(__FILE__);
 	}

	function display()
	{
  		$item = $this->get('item');
 		include($this->path.DS.'tmpl'.DS.'form.php');
	}
}
?>