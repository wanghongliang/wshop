<?php
//print_r($this->item);
$basepath = dirname(__FILE__);
//include($basepath.DS.'header.php');

$order_data = &$this->order_data;
$param = unserialize( $this->item['ext_info']);

$baseurl = '/preview/templates/'.$app->getTemplate();

?>

<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>/css/tuan.css" />



<div class="tfleft">
	<div class="tcontent">
		<h2 class="gbt_line">
			<img src="/preview/templates/default/images/step3.gif" />
		</h2>
	
	<div class="sect" >
 

  	<div class="pay_box">
	  <div class="ok_title">感谢您的订购！</div>
	  <div class="ok_line">您的订单号是&nbsp;
	  <a target="_blank" href="index.php?com=users&view=orders" class="item_opt">
		<?php echo $order_data['order_sn'];?>
	  </a>&nbsp;, 
	  <?php 
		  $price = $order_data['total_deposit'];
		  if( $order_data['amount']>$order_data['total_deposit'] ){ 

			  ?>
		预支付金额
	  <?php }else{ 
			$price = $order_data['amount'];		  
		?>
		支付金额
	  <?php } ?>
	  &nbsp;
	  <span><?php echo $price;?>元</span>
	  </div>
	  <div class="endway_line">
	  您选择的付款方式为：
	  <a href="#">
	  在线支付
	  </a>&nbsp;&nbsp;
	付款方式，确认付款后，我们将在承诺的时间内发货。<br>未付款订单将被保留24个小时，请在24个小时内完成支付。感谢您的惠顾！
	</div>
	<div class="tip_line"></div>
		
	</div>

	<div class="cart_btn">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
		  <tbody><tr>
			<td height="78" align="center" valign="middle">
				<div style="text-align: center;">
				<form target="_blank" id="cmb_form"  action="/?com=cart&act=pay" method="post" style="text-align: center;" name="kqPay">
					<input type="hidden" name="price" value="<?php echo $price;?>"  />
					<input type="hidden" name="order_sn" value="<?php echo $order_data['order_sn'];?>"  />
					<input type="hidden" name="subject" value="订单号:<?php echo $order_data['order_sn'];?>"  />
					<input type="hidden" name="body" value="格力在线定单支付"  /> 
					<input type="image"  src="/preview/templates/default/images/pay.jpg" /> 
				</form>
				</div>    
			</td>
		  </tr>
		</tbody>
		</table>
	  </div>

 
	</div>
	
	</div>
</div>


<div class="cln">&nbsp;</div>


 

<?php include($basepath.DS.'footer.php');?>