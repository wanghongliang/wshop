<?php
class WebsiteController extends Controller
{
	function WebsiteController()
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
	function saveview(){
		global $app;
		if( $app->uid > 0 ){
			$model	= &$this->getModel('site');
			$model->saveview();
		}else{
			import('utilities.securimage');
			if( Simge::check($_REQUEST['code']) ){
				$model	= &$this->getModel('site');
				$model->saveview();
			}
		}
		$this->redirect(URI::current());
	}


	function ajax(){
		$view = &$this->getView('ajaxweb');
		$model	= &$this->getModel('ajaxweb');
 		$view->setModel($model, true);
 		$view->display();
	}

	function update(){
		$db = &Factory::getDB();
		$page = intval($_REQUEST['page']);
		if( $page < 1){ $page=1; }
		$start = $page*20;

		//$sql = " update #__website set modified='".date('Y-m-d H:i:s')."' where uid>0 order by id desc limit ".$start.",".($start+20);
		$sql = " select id from #__website order by modified desc limit ".$start.",20  ";
		$db->query($sql);

		$result = $db->getResult();
		$ids = array();
		foreach( $result as $re ){
			$ids[] = $re['id'];
		}
		$sql = " update #__website set modified='".date('Y-m-d H:i:s')."' where id in (".implode(',',$ids).") ";
 		$db->query($sql);
	}
}
?>