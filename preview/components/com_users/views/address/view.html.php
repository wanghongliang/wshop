<?php
import( 'application.component.view');
class AddressView extends View
{

	var $baseurl = null;
	var $categroy = array();
	
	var $info = array();

	function AddressView(){
		$_REQUEST['tmpl'] = 'user';
	}
 	function display($tpl = null)
	{
		global $app,$com;
		$pathway = &$app->getPathWay();
		$pathway->addItem('收货地址','#');

		$tmpl = 'default';
		$act = trim($_REQUEST['act']);
		switch( $act ){
			case 'view':
				$lists = $this->get('order');
				$order_data = &$lists['order'];
				$ms = &$lists['goods'];

 			    $tmpl = 'order';
				break;
			case 'delete':
				$model = $this->getModel();
				$model->delete(); 
				//$lists = $this->get('list');
				$app->redirect('index.php?com=users&view=address','删除成功.');
				return;
				break;

			case 'get':
				$model = $this->getModel();
				$item = $model->ajaxGetInfo(); 
				//print_r($item);
				include(dirname(__FILE__).DS.'tmpl'.DS.'default_ajaxget.php');
				return;

				break;
			case 'save':
				$model = $this->getModel();
				$model->save(); 
				$app->redirect('index.php?com=users&view=address','保存成功.');
				return;

			case 'setdefault':
				$model = $this->getModel();
				$model->setdefault(); 
				$app->redirect('index.php?com=users&view=address','设置成功.');
				return;

				 
			default:
				 
				$lists = $this->get('list');
		}
		

  		include(dirname(__FILE__).DS.'tmpl'.DS.$tmpl.'.php');
 	}

	

}
?>
