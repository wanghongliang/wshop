<?php
import('application.component.view');
class SelectareaView extends View
{
 	var $rows;
 	var $depth = 0;
	function SelectareaView()
	{	
		$this->path = dirname(__FILE__);
		$this->baseuri = 'index.php?com=shippings&task=selectarea';
		if( isset($_REQUEST['tmpl']) ){
			$this->baseuri .="&tmpl=".$_REQUEST['tmpl'];
		}
 	}

	/**
	 * 添加界面
	 */
	function display()
	{

		switch( $_GET['act'] ){

			case 'getarea':
				$rows=$this->get('area');
				include($this->path.DS.'tmpl'.DS.'area.php');
				break;

			default:
			//import('html.form');	//获取表单对象
			//print_r($options);
			$item=$this->get('item');
			//是否有已添加的地区 
			
			$selAreas = $this->get('selAreas');

			//print_r($selAreas);
			include($this->path.DS.'tmpl'.DS.'selectarea.php');
		 
		}
	}

	/**
	 * 编辑界面
	 */
	function edit()
	{		
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