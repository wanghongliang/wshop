<?php
class FeedbacksController extends Controller
{
	function FeedbacksController()
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
	function securimage()
	{
		import('utilities.securimage');
		Simge::show(78,24,14);
	}

	function save()
	{
		global $app;

		import('utilities.securimage');
		$data = array(
			'name'=>$_REQUEST['name'],
			'email'=>$_REQUEST['email'],
			'phone'=>$_REQUEST['phone'],
			'company_name'=>$_REQUEST['company_name'],
			'content'=>$_REQUEST['content'],
		);


		if( Simge::check($_REQUEST['code']) ){

			$data = array(
				'author'=>$_REQUEST['name'],
				'email'=>$_REQUEST['email'],
				'phone'=>$_REQUEST['phone'],
				'company'=>$_REQUEST['company_name'],
				'content'=>$_REQUEST['content'],
 				'release_date'=>date('Y-m-d H:i:s')
			);
			
			$db = &Factory::getDB();
			$db->insertArray('#__feedbacks',$data);
			$msg = '提交成功,谢谢您的留言.';

			$data = array();
 		}else{
			//$app->enqueueMessage
			$msg = '验证码错误,请重新输入验证码.';
		}
		if( $_REQUEST['return'] ){
			$pos = strpos($_REQUEST['return'],'?');
			if( $pos>0 ){
				$this->redirect(substr($_REQUEST['return'],0,$pos) . '?'.http_build_query($data) , $msg);
			}else{
				$this->redirect($_REQUEST['return']. '?'.http_build_query($data) , $msg);
			}

		}
	}


}
?>