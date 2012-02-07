<?php
import('application.component.view');
class StyleView extends View
{
 	var $rows;
	var $baseuri;	//URI
	var $depth = 0;
	function StyleView()
	{
		$this->baseuri = 'index.php?com=style';
		$this->path = dirname(__FILE__);
	}

	function display()
	{
		$modules_list = $this->get('moduleList');	//已经创建的模板

		$modules = $this->get('select');

 		include($this->path.DS.'tmpl'.DS.'default.php');
	}


	/**
	 * ajax 方式显示单个模块信息
	 */
	function showSelectModule()
	{
		$modules_list = $this->get('moduleList');	//已经创建的模板

		$modules = $this->get('select');
		include($this->path.DS.'tmpl'.DS.'select.php');
	}
 

	/**
	 *iframe 方式显示 
	 */
	function selecttemplate()
	{
		//global $app;
		$list = $this->get('templateList');
		include($this->path.DS.'tmpl'.DS.'selecttemplate.php');

	}
}
?>