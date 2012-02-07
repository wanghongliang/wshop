<?php
import('application.component.view');
class ContentView extends View
{
 	var $rows;
	var $menuid;	//当前菜单分类ID
	var $depth = 0;
	function ContentView()
	{	
		$this->path = dirname(__FILE__);
		$this->menuid = intval( $_REQUEST['menuid'] );
	}

	function display()
	{
	
		//文章属性
		$attr  = $this->get('attr');
 		include($this->path.DS.'tmpl'.DS.'form.php');
	}


	/**
	 * 编辑界面
	 */
	function edit()
	{		

		//文章属性
		$attr  = $this->get('attr');

		//取当前编辑的内容
		$item = $this->get('item');
  		include($this->path.DS.'tmpl'.DS.'form.php');
	}
 
	/**
	 * 显示选择的组件
	 */
	function showSelectComponent()
	{
		$lists = $this->get('cominfo');
		//print_r($lists);
		//echo $this->path.DS.'tmpl'.DS.'selectcomponent.php';

		$linkType= $this->get('linkType');

		include($this->path.DS.'tmpl'.DS.'selectcomponent.php');
	}


	function selectarticle()
	{
		$this->rows = $this->get('selectList');
		$nav = $this->get('nav');
		include($this->path.DS.'tmpl'.DS.'selectlists.php');
	}

	function selectmenu()
	{
		$_REQUEST['tmpl'] = 'component';
		include($this->path.DS.'tmpl'.DS.'selectmenu.php');
	}


}
?>