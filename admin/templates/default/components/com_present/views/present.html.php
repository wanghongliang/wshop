<?php
import('application.component.view');
class PresentView extends View
{
 	var $rows;
 	var $depth = 0;
	function PresentView()
	{	
		$this->path = dirname(__FILE__);
		$this->baseuri = 'index.php?com=present';
		if( isset($_REQUEST['tmpl']) ){
			$this->baseuri .="&tmpl=".$_REQUEST['tmpl'];
		}
 	}

	/**
	 * 添加界面
	 */
	function display()
	{
		//import('html.form');	//获取表单对象
  		//print_r($options);
		$lists=$this->get('item');
 		$item = $lists['row'];

		$replay = $lists['replay'];

 		if( $_REQUEST['tmpl'] == 'component' ){
			include($this->path.DS.'tmpl'.DS.'form_component.php');
		}else{
			include($this->path.DS.'tmpl'.DS.'form.php');
		}

	}

	/**
	 * 编辑界面
	 */
	function edit()
	{		
		//取当前编辑的内容
		$lists=$this->get('item');
 		$item = $lists['row']; 
		$replay = $lists['replay'];
		  
		if( $_REQUEST['tmpl'] == 'component' ){
			include($this->path.DS.'tmpl'.DS.'form_component.php');
		}else{
			include($this->path.DS.'tmpl'.DS.'form.php');
		}
		
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