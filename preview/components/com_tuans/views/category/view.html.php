<?php
import( 'application.component.view');
require(dirname(PATH_COMPONENT).DS.'com_tuans'.DS.'helpers'.DS.'route.php');

class CategoryView extends View
{
	var $address = null;
	function display($tpl = null)
	{
		global $app;
		$params 	   =& $app->getParams('com_buys');
		//$_REQUEST['tmpl'] = 'buys'; 
  		
 

		switch( $_GET['a'] ){
			case 'historyteam':
				$this->item = $this->get('list');
				$tpl = "historyteam";
				break;
			case 'c':	//确认团购信息
				if( ($id = intval($_GET['id']) )>0 ){
					$tpl = "buy";
					$this->item = $this->get('item');
					//会员的地址薄信息
					$this->address = $this->get('address');

					break;
				}  
			case 'sa':	//填写订单信息

				$s = &Factory::getSession();
				if( $s->get('uid') < 1 ){ $app->redirect('/?com=users&return='.urlencode(URI::current()) ); }
				if( ($id = intval($_POST['id']) )>0 ){
					$tpl = "sa"; //选择地址信息
					$this->item = $this->get('item');

					//会员的地址薄信息
					$this->address = $this->get('address');

					break;
				}  

				break;

			case 'checkoutsubmit':	//保存订单信息
				$model = &$this->getModel();
				$this->order_data = $model->saveOrder();
				 
				$tpl = "checkoutsubmit"; //选择地址信息
				break;
			case 'tour':
				$tpl = "tour";
				break;

			case 'quest':
				$tpl = "quest";
				break;

			case 'subscribe':
				$tpl ="subscribe_success";
				$model = &$this->getModel();
				$model->saveSubscribe();
				break;
			

			case 'invites':
				$tpl='invites';
				break;
			default:
				if( ($id = intval($_GET['id']) )>0 ){
					$tpl = "detail";
					$this->item = $this->get('item');
				}else{
					$this->item = $this->get('item');
				}
		}
			
		
		parent::display($tpl);
	}
 
}
?>