<?php
import( 'application.component.view');
class CartView extends View
{

	var $baseurl = null;
	var $categroy = array();
 	function display($tpl = null)
	{
		global $app,$com;
		
		$model = &$this->getModel();

		$_REQUEST['tmpl'] = 'component';
		import('utilities.cart');
		$cart =  Cart::getInstance();
		
   		$act = trim($_GET['act']); 
		$tmpl='default.php';
		switch($act){
			case 'add':
				if( $id = (int)$_POST['id'] ){

					//支付方式 1为定金，2为全额
					$pays = 2;//$_POST['pays']; 
			 
					//数量
					$num = (int)$_POST['num'];

					//相关属性
					$a = trim($_POST['attr']);
					if( $a == '' ){  $a = $model->getDefalutAttribute($id);    $a = $a['param'];  }
					 
					//是否有活动参加
					$act_type = (int)$_POST['act_type'];
					//如果是活动商品，进行活动价
					if(  $act_type>0 ){

						//查找活动信息
						$act_info = $model->getAct($id,$act_type); 
						
						//活动类型 
						if( count($act_info)>0){
							switch($act_type){
								case 2:
									$a='限时促销';
									break; 
								case 1:
									$a='团购';
									break;
							}
							$price = $actual_price = $act_info['shop_price'];
						}else{
						$act_type = 0;
						//如果活动已过期，或没有相关活动，按产品原有的价格
						$info = $model->getDefalutAttribute($id);
						$price = $actual_price = $info['shop_price'];
 						} 
						 
					}else{ //查找商品价格信息
						$info = $model->getDefalutAttribute($id);
						$price = $actual_price = $info['shop_price'];
						//产品图片
						$img = $_POST['img'];
					}
			 
					$attr = array('params'=>$a,'pays'=>$pays,'price'=>$price,'actual_price'=>$actual_price,'act_type'=>$act_type);
					
				
 					$cart->addMerchandises($id,$num,$attr,$img);
				}else if( $id = $_GET['id'] ){
					//$products_option = unserialize( $GLOBALS['config']['options'] );
					//$price = $products_option['deposit'];
					
					//组合商品添加
					$id = explode(',',$id);
					foreach( $id as $k=>$v ){
						if( $v>0 ){
							$a = $model->getDefalutAttribute($v); 
							$attr = array('params'=>$a['param'],'pays'=>2,'price'=>$a['price'],'actual_price'=>$a['price'],'act_type'=>0);
							$cart->addMerchandises($v,1,$attr);
						}
					}
				}
				break;

			case 'empty':
				$cart->deleteCart();
				break;

			case 'delete':
				if( $id = $_GET['id'] ){
 					$cart->deleteMerchandise($id);
				}
				if( $_GET['no_html'] == '1' ){ return;}
 				break;


			case 'modifynumber':
				//print_r($_POST);
				 $v = intval( $_GET['v'] );
				 $cart->modificationMerchandiesNumber(trim($_GET['k']),$v);
				 return;
				break;

			case 'pay':
				import('pay.pay');
				
				$order_sn = trim($_GET['order_sn']);
				if( !empty($order_sn) )
				{
					$model = $this->getModel();
					$order_data = $model->getOrder($order_sn);

			 
					$pay = Pay::getInstance($order_data['pay']);	
					$htmlStatus  =  $pay->display($order_sn,'订单号：'.$order_sn,'格力在线定单支付款项',$order_data['total_deposit']);
					$tmpl = 'pay.php';
				}else if( !empty($_POST['order_sn']) ){
					$pay = Pay::getInstance($_POST['payment_id']);	
					$htmlStatus  =  $pay->display($_POST['order_sn'],$_POST['subject'],$_POST['body'],$_POST['price']);
					$tmpl = 'pay.php';
				}else{
					$tmpl = 'pay_error.php';
				}
				break;

			case 'checkout':
				 
				if( $app->uid < 1 ){
					$app->redirect('/?com=users&return=/?com=cart&act=checkout');
					return;
				}
				$ms = $cart->getMerchandises();
				if( count($ms)<1 ){
					 
					 
				}else{
					//结算单
					$tmpl = 'checkout.php'; 
					//会员的地址薄信息
					$address = $this->get('address');

					//支付接口的选择
					$payments = $this->get('payments');
				}
				
				break;

			case 'checkoutsubmit':
				$model = $this->getModel();
				$order_data = $model->checkoutsubmit();
				//print_r($model);
				$cart->deleteCart();//清空购物车
				$pay = $model->getPayItem($order_data['pay']);
				$tmpl = 'checkout_success.php';
				break;


			case 'loadpostage':	//AJAX加载货运方式

				$tmpl = 'loadpostage.php';
				break;
		}
		
		
		include(dirname(__FILE__).DS.'tmpl'.DS.$tmpl);
		 
	}
 
}
?>
