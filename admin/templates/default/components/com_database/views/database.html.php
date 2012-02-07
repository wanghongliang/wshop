<?php
import('application.component.view');
class DatabaseView extends View
{
 	var $rows;
 	var $depth = 0;
	function DatabaseView()
	{	
		$this->path = dirname(__FILE__);
		$this->baseuri = 'index.php?com=database&client_id='.intval($_REQUEST['client_id']);
 	}

	function display()
	{
		import('html.form');	//获取表单对象
  		//print_r($options);
		$item=$this->get('item');
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
	 * 编辑成功后的界面
	 */
	function success()
	{
  		include($this->path.DS.'tmpl'.DS.'success.php');

	}


	/** 选择模块类型 **/
	function select()
	{
		$modules = $this->get('select');
  		include($this->path.DS.'tmpl'.DS.'select.php');

	}
 }
?>