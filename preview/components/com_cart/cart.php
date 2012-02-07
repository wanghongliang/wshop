<?php
class CartController extends Controller
{
	function UsersController()
	{
		parent::__construct();
	}

	function display()
	{ 
 		$vName=$_REQUEST['view'] = 'cart';
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
	function notify_url(){
		echo 'notify_url ...';

		$this->redirect('/');
	}
	function return_url(){
		echo 'return_url ...';
		$this->redirect('/');
	}
 
}

 
?>