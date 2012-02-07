<?php
import( 'application.component.view');
class TuanView extends View
{

	var $baseurl = null;
	var $categroy = array();
	
	var $info = array();

	function TuanView(){
		$_REQUEST['tmpl'] = 'user';
	}
 	function display($tpl = null)
	{
		global $app,$com;
		$pathway = &$app->getPathWay();
		$pathway->addItem('团购信息','#');


		$this->baseuri = 'index.php?com=users&view=tuan';
		$tmpl = 'default';
		$act = trim($_GET['act']);
		switch( $act ){
			case 'view':
				$lists = $this->get('order');
				$order_data = &$lists['order'];
				$ms = &$lists['goods'];

				$model = &$this->getModel();
				$log = $model->getLog($order_data['id']);
				$ship = $model->getShip($order_data['postage']);
				$pay = $model->getPay($order_data['pay']);
 			    $tmpl = 'order';
				break;
			case 'cancel':
				$model = $this->getModel();
				$model->cancel();
				
			
			default:
				$lists = $this->get('list');
		}
		

  		include(dirname(__FILE__).DS.'tmpl'.DS.$tmpl.'.php');
 	}

  

}
?>
