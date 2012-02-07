<?php
import('application.component.view');
class DealerView extends View
{
 	var $rows;
 	var $depth = 0;
	function DealerView()
	{	
		$this->path = dirname(__FILE__);
		$this->baseuri = 'index.php?com=dealer';
 	}

	function display()
	{
		import('html.form');	//获取表单对象

		$this->rows = $this->get('group');
		
 
		$options = Form::_buildTreeOptions($this->rows);
		$pid = Form::dropdown('gid',$options,0,' class="select" size="10" ');
 
		$item=$this->get('item');

 		include($this->path.DS.'tmpl'.DS.'form_add.php');
	}
	/**
	 * 编辑界面
	 */
	function edit()
	{		

		$item=$this->get('item');

		import('html.form');	//获取表单对象

		$this->rows = $this->get('group');
		
 
		$options = Form::_buildTreeOptions($this->rows);
		$pid = Form::dropdown('gid',$options,$item['gid'],' class="select" size="10" disabled  ');
 


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