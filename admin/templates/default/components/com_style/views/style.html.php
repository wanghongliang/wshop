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
		$modules_list = $this->get('moduleList');	//�Ѿ�������ģ��

		$modules = $this->get('select');

 		include($this->path.DS.'tmpl'.DS.'default.php');
	}


	/**
	 * ajax ��ʽ��ʾ����ģ����Ϣ
	 */
	function showSelectModule()
	{
		$modules_list = $this->get('moduleList');	//�Ѿ�������ģ��

		$modules = $this->get('select');
		include($this->path.DS.'tmpl'.DS.'select.php');
	}
 

	/**
	 *iframe ��ʽ��ʾ 
	 */
	function selecttemplate()
	{
		//global $app;
		$list = $this->get('templateList');
		include($this->path.DS.'tmpl'.DS.'selecttemplate.php');

	}
}
?>