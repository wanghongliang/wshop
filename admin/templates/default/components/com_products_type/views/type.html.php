<?php
import('application.component.view');
class TypeView extends View
{
 	var $rows;
	var $baseuri;	//URI
	var $depth = 0;
	function TypeView()
	{
		$this->baseuri = 'index.php?com=products_type';
		$this->path = dirname(__FILE__);
	}

	function display()
	{
		import('html.form');	//��ȡ������
		$description = Form::textarea('description','',' cols=50 rows=6 ');
		include($this->path.DS.'tmpl'.DS.'form.php');
	}
 
	/** ��� **/
	function edit()
	{
		$item = $this->get('item');
		import('html.form');	//��ȡ������
		$description = Form::textarea('description',$item['description'],' cols=50 rows=6 ');
		include($this->path.DS.'tmpl'.DS.'form.php');
	}

}
?>