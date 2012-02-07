<?php
import('application.component.view');
class QuestionView extends View
{
 	var $rows;
	var $baseuri;	//URI
	var $depth = 0;
	function QuestionView()
	{
		$this->baseuri = 'index.php?com=questions&type_id='.(int)$_GET['type_id'];
		$this->path = dirname(__FILE__);
	}

	function display()
	{
		import('html.form');	//获取表单对象
		import('html.form');	//获取表单对象
		$attr_value = Form::textarea('attr_values',$item['attr_values'],' cols=30 rows=8 ');

		//类型列表
 		$type = $this->get('type');
		$type[0] = '请选择...';
 
 		$type_id = Form::dropdown('type_id',$type,intval($_GET['type_id']));
		include($this->path.DS.'tmpl'.DS.'form.php');
	}
 
	/** 添加 **/
	function edit()
	{
		$item = $this->get('item');
		import('html.form');	//获取表单对象
		$attr_value = Form::textarea('attr_values',$item['attr_values'],' cols=30 rows=8  ');

		//类型列表
 		$type = $this->get('type');
		$type[0] = '请选择...';
 
 		$type_id = Form::dropdown('type_id',$type,intval($item['type_id']));

 		include($this->path.DS.'tmpl'.DS.'form.php');
	}

}
?>