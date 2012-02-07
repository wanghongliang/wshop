<?php
import('application.component.view');
class ProductView extends View
{
 	var $rows;
	var $menuid;	//当前菜单分类ID
	var $depth = 0;
	function ProductView()
	{	
		$this->path = dirname(__FILE__); 
		$this->baseuri = 'index.php?com=series'; 
		if( isset( $_REQUEST['tmpl'] ) ){ $this->baseuri.='&tmpl='.$_REQUEST['tmpl']; }
		if( isset( $_REQUEST['id'] ) ){ $this->baseuri.='&id='.$_REQUEST['id']; }
	}

	function display()
	{
	

		import('html.form');	//获取表单对象  
 		include($this->path.DS.'tmpl'.DS.'form.php');
	}


	/**
	 * 编辑界面
	 */
	function edit()
	{		
		import('html.form');	//获取表单对象 
		//取当前编辑的内容
		$item = $this->get('item'); 
  		include($this->path.DS.'tmpl'.DS.'form.php');
	}
 
 
	/**
	 * 显示选择的组件
	 */
	function showSelectComponent()
	{
		$lists = $this->get('cominfo');
		//print_r($lists);
		//echo $this->path.DS.'tmpl'.DS.'selectcomponent.php';

		$linkType= $this->get('linkType');
		include($this->path.DS.'tmpl'.DS.'selectcomponent.php');
	}


	function selectarticle()
	{
		$this->rows = $this->get('selectList');
		$nav = $this->get('nav');
		include($this->path.DS.'tmpl'.DS.'selectlists.php');
	}

	function selectmenu()
	{
		$_REQUEST['tmpl'] = 'component';
		include($this->path.DS.'tmpl'.DS.'selectmenu.php');
	}
	

	function ajaxattr(){
		import('html.form');	//获取表单对象
		include($this->path.DS.'tmpl'.DS.'ajaxattr.php');
	}

}
?>