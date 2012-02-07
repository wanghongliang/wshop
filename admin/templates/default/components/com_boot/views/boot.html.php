<?php
import('application.component.view');
class BootView extends View
{
 	var $rows;
	var $baseuri;	//URI
	var $depth = 0;
	function BootView()
	{
		$this->baseuri = 'index.php?com=boot';
		$this->path = dirname(__FILE__);
	}

	function display()
	{
 		include($this->path.DS.'tmpl'.DS.'default.php');
	}

	/**
	 * 视图显示
	 */
	function step1()
	{
		global $app;
		$path = PATH_PREVIEW.DS.'templates'.DS.$app->getPreviewTemplate().DS.'installdata.php';
		if( file_exists($path) )
		{
			include($path);
		}
 		include($this->path.DS.'tmpl'.DS.'step1.php');

	}
	/**
	 * 视图显示
	 */
	function step2()
	{
		global $app;
		

		//保存菜单数据
		$session = &Factory::getSession();
		$session->set('menu',array('menu_name' => $_REQUEST['menu']));

		//print_r($data);

 		include($this->path.DS.'tmpl'.DS.'step2.php');

	}

	/**
	 * 视图显示
	 */
	function step3()
	{
		global $app;
		
		//保存菜单数据
		$session = &Factory::getSession();

		$custom_menu = $session->get('menu');	//用户自定义的菜单

		//从模型中取上传的图片数据
		$imgs = $this->get('productImages');
		
 		$session->set('products',array('product_type' => $_REQUEST['type'],//商品分类信息
				'product_name' => $_REQUEST['name'],		//商品名称
				'product_img'=>$imgs					//商品图片信息
				));
 
 
		

   		include($this->path.DS.'tmpl'.DS.'step3.php');

	}

 }
?>