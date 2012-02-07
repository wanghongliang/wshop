<?php
import('application.component.view');
class CompanyView extends View
{
 	var $rows;
	var $menuid;	//当前菜单分类ID
	var $depth = 0;
	function CompanyView()
	{	
		$this->path = dirname(__FILE__);
 	}

	function display()
	{
	
		import('html.form');	//获取表单对象
  		//print_r($options);
 		$item = $this->get('item');
 		include($this->path.DS.'tmpl'.DS.'form.php');
	}

}
?>