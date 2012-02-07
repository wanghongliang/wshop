<?php
import('application.component.view');
class MenutypeView extends View
{
 	var $rows;
	var $baseuri;	//URI
	var $depth = 0;
	function MenutypeView()
	{
		$this->baseuri = 'index.php?com=menutype';
		$this->path = dirname(__FILE__);
	}

	function display()
	{
		import('html.form');	//获取表单对象
		$description = Form::textarea('description','',' cols=50 rows=6 ');
		include($this->path.DS.'tmpl'.DS.'form.php');
	}
 
	/** 添加 **/
	function edit()
	{
		$item = $this->get('item');
		import('html.form');	//获取表单对象
		$description = Form::textarea('description',$item['description'],' cols=50 rows=6 ');
		include($this->path.DS.'tmpl'.DS.'form.php');
	}

}
?>