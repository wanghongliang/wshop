<?php
class BuysController extends Controller
{
	function BuysController()
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
}
?>