<?php
import('application.component.view');
class OrderView extends View
{
 	var $rows;
	var $menuid;	//当前菜单分类ID
	var $depth = 0;
	function OrderView()
	{	
		$this->path = dirname(__FILE__);
		$this->menuid = intval( $_REQUEST['menuid'] );
		$this->baseuri = 'index.php?com=orders';

		if( isset( $_REQUEST['tmpl'] ) ){ $this->baseuri.='&tmpl='.$_REQUEST['tmpl']; }
		if( isset( $_REQUEST['id'] ) ){ $this->baseuri.='&id='.$_REQUEST['id']; }
	}

	function display()
	{

		$model = &$this->getModel();
		switch($_GET['act'])
		{
			case 'pay':		//付款单
				$order_data = $this->get('item');  
				//print_r($order_data);
				$tmpl="pay.php";
				break;

			case 'ship':	//发货单
				$order_data = $this->get('item'); 
				$ms = $model->getOrderProducts($order_data['id']);
				$tmpl="ship.php";
				break; 


 			case 'refund':		//退款单
				$order_data = $this->get('item');  
				//print_r($order_data);
				$tmpl="refund.php";


				break;

			case 'back':	//退货单
				$order_data = $this->get('item'); 
				$ms = $model->getOrderProducts($order_data['id']);
				$tmpl="back.php";
				break; 


			default:
				$tmpl="none.php";
				break;
		}
		//$model = &$this->getModel();
 		//$order_data = $this->get('item'); 
		//$ms = $model->getOrderProducts($order_data['id']);
 
 		include($this->path.DS.'tmpl'.DS.$tmpl);
	}


	/**
	 * 编辑界面
	 */
	function edit()
	{		
		import('html.form');	//获取表单对象

		$model = &$this->getModel();
 		$order_data = $this->get('item'); 
		$ms = $model->getOrderProducts($order_data['id']);

 		//订单状态
		$order_status = array(0=>'待处理','1'=>'已发货');
		$order_pay = array(0=>'未支付',1=>'已支付'); //支付状态
		
		$status_option = Form::dropdown('order_status',$order_status,$order_data['order_status']);
		$pay_option = Form::dropdown('pay_status',$order_pay,$order_data['pay_status']);


  		include($this->path.DS.'tmpl'.DS.'form.php');
	}

	function save(){
		$model = &$this->getModel();
		switch( $_POST['act']){
			case 'pay':
				$model->savePay();
				$tmpl="pay_succ.php";
				break; 
			case 'ship':
				$model->saveShip();
				$tmpl="ship_succ.php";
				break; 

			case 'refund':
				$model->saveRefund();
				$tmpl="refund_succ.php";
				break; 
			case 'back':
				$model->saveBack();
				$tmpl="back_succ.php";
				break; 
			default:
				$tmpl="none.php";
				break;
		}

 		include($this->path.DS.'tmpl'.DS.$tmpl);
	}
 
	/**
	 * 显示选择的组件
	 */
	function showSelectComponent()
	{
		$lists = $this->get('cominfo');
		//print_r($lists);
		//echo $this->path.DS.'tmpl'.DS.'selectcomponent.php';

		$linkType= $this->get('linkType');

		include($this->path.DS.'tmpl'.DS.'selectcomponent.php');
	}


	function selectarticle()
	{
		$this->rows = $this->get('selectList');
		$nav = $this->get('nav');
		include($this->path.DS.'tmpl'.DS.'selectlists.php');
	}

	function selectmenu()
	{
		$_REQUEST['tmpl'] = 'component';
		include($this->path.DS.'tmpl'.DS.'selectmenu.php');
	}


}
?>