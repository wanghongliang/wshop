<?php
import('application.component.view');
class ProductsView extends View
{
 	var $rows;
	var $menuid;	//当前菜单分类ID

	var $depth = 0;

	var $path = null;
	function ProductsView()
	{		
		
		$this->path = dirname(__FILE__);

		$this->menuid = intval( $_REQUEST['menuid'] );
		$this->baseuri = 'index.php?com=series&menuid='.$this->menuid;

		if( isset( $_REQUEST['tmpl'] ) ){ $this->baseuri.='&tmpl='.$_REQUEST['tmpl']; }
	}
	function display()
	{
		import('html.form');	//获取表单对象

 		$lists = $this->get('List'); 
 		$this->rows = &$lists['rows']; 
		$nav = $this->get('nav');
		if( $_GET['tmpl'] == 'component' ){
			include($this->path.DS.'tmpl'.DS.'list_component.php');
		}else{
			include($this->path.DS.'tmpl'.DS.'list.php');
		}
	}
	function accessories()
	{
		import('html.html');
		$lists = $this->get('List');
 		$this->rows = &$lists['rows'];
 
		$nav = $this->get('nav');
 
 		include($this->path.DS.'tmpl'.DS.'list_accessories.php');
	}
	function recycle()
	{
		$this->rows =$this->get('recycleList');
		$nav = $this->get('nav');
  		include($this->path.DS.'tmpl'.DS.'recyclelist.php');
	}
}
?>