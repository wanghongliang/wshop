<?php
import('application.component.view');
class UninstallView extends View
{
 	var $rows;
	var $menuid;	//当前菜单分类ID
	var $depth = 0;
	function UninstallView()
	{	
		$this->path = dirname(__FILE__);
		$this->menuid = intval( $_REQUEST['menuid'] );
	}

	function display()
	{
	

		import('html.form');	//获取表单对象
  		//print_r($options);
 	 
 		include($this->path.DS.'tmpl'.DS.'form.php');
	}


	/**
	 * 编辑界面
	 */
	function edit()
	{		
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
}
?>