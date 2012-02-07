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
	 * ��ͼ��ʾ
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
	 * ��ͼ��ʾ
	 */
	function step2()
	{
		global $app;
		

		//����˵�����
		$session = &Factory::getSession();
		$session->set('menu',array('menu_name' => $_REQUEST['menu']));

		//print_r($data);

 		include($this->path.DS.'tmpl'.DS.'step2.php');

	}

	/**
	 * ��ͼ��ʾ
	 */
	function step3()
	{
		global $app;
		
		//����˵�����
		$session = &Factory::getSession();

		$custom_menu = $session->get('menu');	//�û��Զ���Ĳ˵�

		//��ģ����ȡ�ϴ���ͼƬ����
		$imgs = $this->get('productImages');
		
 		$session->set('products',array('product_type' => $_REQUEST['type'],//��Ʒ������Ϣ
				'product_name' => $_REQUEST['name'],		//��Ʒ����
				'product_img'=>$imgs					//��ƷͼƬ��Ϣ
				));
 
 
		

   		include($this->path.DS.'tmpl'.DS.'step3.php');

	}

 }
?>