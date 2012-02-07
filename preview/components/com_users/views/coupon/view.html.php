<?php
import( 'application.component.view');
class CouponView extends View
{

	var $baseurl = null;
	var $categroy = array(); 
	var $info = array();

	function CouponView(){
		$_REQUEST['tmpl'] = 'user';
		$this->baseurl = "index.php?com=users&view=coupon";
	}
 	function display($tpl = null)
	{
		global $app,$com;
		$pathway = &$app->getPathWay();
		$pathway->addItem('商品评价','#');

		$tmpl = 'default';
		$act = trim($_REQUEST['a']);
		switch( $act ){
			case 'view':
				$lists = $this->get('order');
				$order_data = &$lists['order'];
				$ms = &$lists['goods'];

 			    $tmpl = 'order';
				break;
		 
			case 'get':
				$model = $this->getModel();
				$item = $model->ajaxGetInfo(); 
				//print_r($item);
				include(dirname(__FILE__).DS.'tmpl'.DS.'default_ajaxget.php');
				return;

				break;
			case 'r':
				$item = $this->get('item'); 
				include(dirname(__FILE__).DS.'tmpl'.DS.'add.php');
				return;
  			case 's':
				$model = $this->getModel();
				$model->save(); 
				$app->redirect($this->baseurl);
				return;
				break;
			default:
				 
				$lists = $this->get('list');
		}
		

  		include(dirname(__FILE__).DS.'tmpl'.DS.$tmpl.'.php');
 	}

	

}
?>
