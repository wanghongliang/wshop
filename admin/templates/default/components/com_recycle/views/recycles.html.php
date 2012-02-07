<?php
import('application.component.view');
class RecyclesView extends View
{
 	var $rows;
	var $menuid;	//当前菜单分类ID

	var $depth = 0;

	var $path = null;
	function RecyclesView()
	{		
		
		$this->path = dirname(__FILE__);

		$this->menuid = intval( $_REQUEST['menuid'] );
		$this->baseuri = 'index.php?com=contents&menuid='.$this->menuid;
	}

	function display()
	{
		import('html.html');
		$lists = $this->get('List');
 		$this->rows = &$lists['rows'];
 
		$nav = $this->get('nav');
		include($this->path.DS.'tmpl'.DS.'list.php');
	}
 
}
?>