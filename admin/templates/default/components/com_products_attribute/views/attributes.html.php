<?php
import('application.component.view');
class AttributesView extends View
{
 	var $rows;
	var $baseuri;	//URI
	var $depth = 0;
	var $nav = null;
	function AttributesView()
	{
		$this->baseuri = 'index.php?com=products_attribute&type_id='.(int)$_GET['type_id'];
	}

	function display()
	{
		$lists = $this->get('list');
		$this->nav = $this->get('nav');
		$this->path = dirname(__FILE__);

		$type = $this->get('type');
		$attr_input_values = array(0=>'手工录入',1=>'列表中选择',2=>'多行文本框');
		$attr_type = array(0=>'唯一属性',1=>'搜索属性',2=>'多个属性');
		include($this->path.DS.'tmpl'.DS.'toolbar.php');
		include($this->path.DS.'tmpl'.DS.'list.php');
	}
 
 
}
?>