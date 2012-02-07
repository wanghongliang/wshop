<?php
import('application.component.view');
class GroupView extends View
{
 	var $rows;

	var $depth = 0;
	function GroupView()
	{
		$this->path = dirname(__FILE__);

	}

	function display()
	{
		$this->path = dirname(__FILE__);

		import('html.form');
		$this->rows = $this->get('list');
		
		$options = Form::_buildTreeOptions($this->rows);
		$pid = Form::dropdown('parent_id',$options,0,' class="select" size="10" ');
		include($this->path.DS.'tmpl'.DS.'form.php');
	}
 	/**
	 * 编辑界面
	 */
	function edit()
	{		
		//取当前编辑的内容
		$item = $this->get('item');


		import('html.form');	//获取表单对象
		$this->rows = $this->get('list');	//取模型类数据
		$options = array(0=>'顶部');	//为列表框设 "顶部" 值
		$options = $options + Form::_buildTreeOptions($this->rows,0,0,$item['id']);

 
		
		$pid = Form::dropdown('parent_id',$options,$item['parent_id'],'  class="select"  size="10" ');
		include($this->path.DS.'tmpl'.DS.'form.php');
	}
 
}
?>