<?php
	//$ms = $cart->getMerchandises();
	//sprint_r($address);
  
$baseurl = '/'.$GLOBALS['config']['preview_directory'].'/'.URI_DIRECTORY.'/'.$app->getTemplate();

 
?>
<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>/style/order.css" />

<div id="header" style="background:none;">
	<?php
	$module	=& ModuleHelper::getModule('mod_logo');
	echo ModuleHelper::renderModule($module); 
	?> 
	<ul id="car-lab2">
		<li >1、我的购物车</li>
		<li>2、填写并核对订单</li>
		<li style="color:#fff;">3、成功提交订单</li>
	</ul>
</div>
<div class="clr" ></div>
<div id="pcontent">

	<div class="pay_box">
	  <div class="ok_title">感谢您的订购！</div>
	  <div class="ok_line">您的订单号是&nbsp;
	  <a target="_blank" href="index.php?com=users&view=orders" class="item_opt">
		<?php echo $order_data['order_sn'];?>
	  </a>&nbsp;,
	  
	  <?php 
		  $price = $order_data['amount'];
		 ?>
		支付金额 
	  &nbsp;
	  <span><?php echo $price;?>元</span>
	  </div>
	  <div class="endway_line">
	  您选择的付款方式为：
	  <a href="#">
			<?php  
			if( !empty($pay['params']['logo']) ){
				echo '<img src="'.$pay['params']['logo'].'" width=133 />';
			 
			}else{
				echo $pay['name'];
			}
 			?>
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
				<form target="_blank" id="cmb_form"  action="?com=cart&act=pay" method="post" style="text-align: center;" name="kqPay">
					<input type="hidden" name="price" value="<?php echo $price;?>"  />
					<input type="hidden" name="order_sn" value="<?php echo $order_data['order_sn'];?>"  />
					<input type="hidden" name="payment_id" value="<?php echo $order_data['pay'];?>"  />
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



	<?php
	/****
    <div class="pad10">
			您的订单号：<strong class="color1">31805236</strong> &nbsp;&nbsp;&nbsp;&nbsp;     应付金额：<strong  class="color1">2199.00</strong>元 &nbsp;&nbsp;&nbsp;&nbsp;      支付方式：在线支付     配送方式：快递运输
    </div>
	<div class="atbei">
			提示： 部分大家电产品需要厂家进行安装，请您在厂家安装前不要拆开商品包装；
	</div>	
    <div class="pad10">
			<strong style="color:#000; font-size:14px;">还差一步，请选择下面支付方式(请您在24小时内付清款项，否则订单会被自动取消)</strong>
	</div>
		<ul id="pay_ul">
			<li class="txt">请点击以下银行支付：</li>
			<li><a href=""><img src="/test/gree/cache/pay1.gif" width="140" height="40" /></a></li>
			<li><a href=""><img src="/test/gree/cache/pay2.gif" width="140" height="40" /></a></li>
			<li><a href=""><img src="/test/gree/cache/pay3.gif" width="140" height="40" /></a></li>
			<li><a href=""><img src="/test/gree/cache/pay4.gif" width="140" height="40" /></a></li>
			<li><a href=""><img src="/test/gree/cache/pay5.gif" width="140" height="40" /></a></li>
			<li><a href=""><img src="/test/gree/cache/pay6.gif" width="140" height="40" /></a></li>
			<li><a href=""><img src="/test/gree/cache/pay1.gif" width="140" height="40" /></a></li>
			<li><a href=""><img src="/test/gree/cache/pay2.gif" width="140" height="40" /></a></li>
			<li><a href=""><img src="/test/gree/cache/pay3.gif" width="140" height="40" /></a></li>
			<li><a href=""><img src="/test/gree/cache/pay4.gif" width="140" height="40" /></a></li>
			<li><a href=""><img src="/test/gree/cache/pay5.gif" width="140" height="40" /></a></li>
			<li><a href=""><img src="/test/gree/cache/pay6.gif" width="140" height="40" /></a></li>
			<li class="txt">请选择以下支付平台</li>
			<li><a href=""><img src="/test/gree/cache/ca1.gif" width="140" height="40" /></a></li>
			<li><a href=""><img src="/test/gree/cache/ca2.gif" width="140" height="40" /></a></li>
			<li><a href=""><img src="/test/gree/cache/ca3.gif" width="140" height="40" /></a></li>
			<li><a href=""><img src="/test/gree/cache/ca4.gif" width="140" height="40" /></a></li>
			<li><a href=""><img src="/test/gree/cache/ca5.gif" width="140" height="40" /></a></li>
		</ul>
		<div class="cln">&nbsp;</div>
		<div class="pay_info">
			提示：<br/>
			  尊敬的用户，因手机支付进行系统维护，将于23:50~00:50可能无法使用。请稍后重试，给您带来的不便敬请谅解！<br/>
			如何进行大额支付：<br/>
			1、如您订单金额较大，可以使用快钱支付中的招行、工行、建行、农行、广发进行一次性大额支付（一万元以下）；<br/>
			2、如果您有财付通、支付宝或快钱账户，可将款项先充入相应账户内，然后使用账户余额进行一次性大额支付；
		</div>

		<div class="pad10">
		完成支付后，您可以：<a href="user.html">查看订单状态</a>&nbsp;&nbsp;&nbsp;&nbsp;   <a href="products.html">继续购物</a>  &nbsp;&nbsp;&nbsp;&nbsp;  <a href="feedback.html">反馈建议</a> 
		</div>
		***/?>

	<?php
	$item	=& ModuleHelper::getModule('mod_copyright');
	echo ModuleHelper::renderModule($item);
	?> 
</div>



 