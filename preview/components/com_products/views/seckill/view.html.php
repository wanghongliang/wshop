<?php
import( 'application.component.view');
require(dirname(PATH_COMPONENT).DS.'com_products'.DS.'helpers'.DS.'route.php');

class SeckillView extends View
{
	var $info = null;	//提示信息
	var $questions = null; //选择问题

	function display($tpl = null)
	{
		global $app;
		$params 	   =& $app->getParams('com_products');
		$_REQUEST['tmpl'] = 'component';
		
		$this->item = $this->get('item');	//秒杀产品信息 
		//是否进行秒杀
		if( $_REQUEST['a'] == 'start' ){
 
				$s = $this->item['is_finished']; 
				if( $s > 1 ){
					//大于1，该活动已结束
					$this->info = '该活动已结束,您可以看一下其它的产品,谢谢关注!';
					$tpl = 'info';
				}else if($this->item['purchase_num']>=$this->item['product_amount'] ){
					//商品已被秒杀完
					$this->info = '该商品已被秒杀完，谢谢!';
					$tpl = 'info';
				}else if( time() > $this->item['end_time'] ){
					//是否已过期，结束时间已经到了
					$this->info = '该活动已过期,您可以看一下其它的产品,谢谢关注!';
					$tpl = 'info';
				}else if( time() > $this->item['start_time'] ){
					//正在进行中
					$tpl = 'start';
					$this->questions = $this->get('questions');
				}else {
					//该活动还没有开始
					$this->info = '该活动没有开始,稍后再参加,谢谢关注!';
					$tpl = 'info';
				} 
				
 		}else if( $_REQUEST['a'] == 'answer' ){
 			

			$model = &$this->getModel();
			if( $model->check() ){
				$tpl = 'success';
				import('utilities.cart');
				$cart =  Cart::getInstance();
				$attr = array('params'=>'秒杀','pays'=>2,'price'=>$this->item['shop_price'],'actual_price'=>$this->item['shop_price'],'act_type'=>3);
				//防止多次刷新
				if( $cart->issetM( $this->item['products_id'],1,$attr ) ){
					$app->redirect('/?com=cart');
				}else{
	
					$cart->addMerchandises($this->item['products_id'],1,$attr);

					//更新秒杀的人数，及数量
					$model->updateSkill($this->item['act_id']);

					//记录秒杀排行榜
					$model->recordBoard($this->item['act_id']);

				}
			}else{
				$this->info = '问题回答错误，请重新回答!';
				$tpl = 'restart';
			}

		}
 		parent::display($tpl);
	}
 
}
?>