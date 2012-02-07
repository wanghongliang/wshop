<?php
class ProductsController extends Controller
{
	function ContentsController()
	{
		parent::__construct();
	}

	function display()
	{
	
 		$vName		=  $_REQUEST['view'];
		$vFormat	=  'html';
		$lName		=  $_REQUEST['layout'];

 		if ($view = &$this->getView($vName, $vFormat))
		{
 			$model	= &$this->getModel($vName);

 			$view->setModel($model, true);
			$view->setLayout($lName);
 			$view->display();
		}
	}

	function ajax(){
		$_REQUEST['view'] = 'product';
		$view = &$this->getView('product','html');
		$model	= &$this->getModel('product');
		$view->setModel($model, true);
 		$view->ajax();
	}
 
}
?>