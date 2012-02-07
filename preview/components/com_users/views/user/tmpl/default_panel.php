<?php
$info = &$this->info;
 
?>
  
<div class="user_edit" >

<?php

//消息提示
$msg = $app->getMsg();

if( $msg )
{
?>
	<div align="center" ><?php echo $msg; ?></div>
<?php
} 
?>
 
 
<?php/**
<div class="u_ak">
	<a href="" class="u_al">格力积分换购开始了，十款服务任你选...</a>
</div>
**/?>

<div class="right_top" >
<h2  >欢迎 <font color=red > <?php echo $this->info['username'];?> </font> 来到会员中心!</h2><span class="goon_btn"><a title="首页" href="./" style="color: rgb(255, 255, 255);">继续购物</a></span>
</div>

<div class="u_bgbox" style=" padding:0px 15px 10px 15px;" >
 
	<p>
		 
		<ul class="class_info_ul">
            <li>您的可用优惠券：<span><a href="index.php?com=users&view=coupon">0.00 元</a></span></li>
            <li>您的积分：<span>0积分</span></li>
    		  <li>您的等级：<span>注册会员</span></li>
        </ul> 
		 
		<a href="index.php?com=users&act=info">人个资料</a> &nbsp;
		<a href="index.php?com=users&view=address">收货地址管理</a>  &nbsp;
		<a href="index.php?com=users&act=setpwd">修改密码</a>
	 
	</p>

	<?php

	/**
	//购物车信息
	import('utilities.cart');
	$cart =  Cart::getInstance();


	?>
	<div id="u_coat"><a href="">我的购物车：<span><?php echo $cart->getNum();?></span></a> <a href="">待处理订单：<span>1</span></a> <a href="">我的积分：<span>50</span></a> <a href="">待评价:<span>2</span></a> </div>

	<?php 

	**/
	?>

</div>





<?php
//最订单信息
$db = &Factory::getDB();
$sql = "select * from #__order where mid='".$this->info['id']."' ";
$db->query($sql);

$result = $db->getResult();

?>
<div class="ubox">
	<h3 class="utitle2">最近一周订单</h3>
	<table width="100%" cellpadding="5" cellspacing="0" border="0" class="u_tab">
		<tr>
			<th>订单号</th><th>订单金额</th><th>下单时间</th><th>订单状态</th><th>查看状态</th>
		</tr>

		<?php
		if( count($result)>0 ){	
		?>	

		<?php
		foreach( $result as $k=>$v ){
		?>
		<tr>
			<td><a href="index.php?com=users&view=orders&act=view&id=<?php echo $v['id'];?>"><?php echo $v['order_sn'];?></a></td>
			<td>￥<?php echo $v['amount'];?></td>
			<td> <?php echo $v['created_date'];?> </td>
			<td   >
				<?php
					$s = $v['order_status'];
					if( $s == 'dead' ){
						echo '订单已取消'; 
					}elseif( $s == 'finish'){
						echo '已完成';
					}else{
						if( $v['pay_status'] == 0 ){
							echo '未付款';
							echo ' <div class="opt_pay" > <a href="/?com=cart&act=pay&order_sn='.$v['order_sn'].'" target="_blank"  >在线支付</a></div>'; 
						}else{
							
							if( $v['pay_status'] == '1' ){//付款后，就显示订单的状态
								echo '已付款';
							}elseif( $v['pay_status'] == '2' ){
								echo '已退款';
							}
							//echo '<div>'.$order_status[$v['order_status']].'</div>';

							switch( $v['ship_status'] )
							{
								case '0':
									echo '<div>配货中..</div>';
									break;
								case '1':
									echo '<div>已发货</div>';
									break;
								case '2':
									echo '<div>已退货</div>';
									break;
							} 
					 
						}


					}
				?>
			</td>
			<td><a href="index.php?com=users&view=orders&act=view&id=<?php echo $v['id'];?>">查看</a></td>
		</tr>
		<?php 
		}
		}else{
		?> 
			<tr><td colspan=6 >没有订单信息,&nbsp;<a href="/" target="_blank" >立刻去购买</a></td></tr>
		<?php
		}
		?>
	</table>
</div>


<?php
 require(dirname(PATH_COMPONENT).DS.'com_products'.DS.'helpers'.DS.'route.php');
global $app;
//最订单信息
$db = &Factory::getDB();
$sql = "select p.id,p.catid,p.thumbnail,p.name,p.shop_price as price from   #__products as p   where  p.published=1 limit 4 ";
 $db->query($sql); 
$result = $db->getResult(); 


//print_r($result);
?>


<div class="ubox">
	<h3 class="utitle2">您可能感兴趣的商品</h3>
	<?php
		foreach( $result  as  $k=>$v ){
			$link = Router::_( ProductsHelperRoute::getProductRoute($v['id'],$v['catid']) );
			echo '<dl class="probox">';
			echo '<dt class="good-pic"><a href="'.$link.'" target="_blank" title="点击查看"><img src="'.$v['thumbnail'].'" alt="" width="120"/></a></dt>';
			echo '<dt class="good-name"><a href="detail.php" title="'.$v['name'].'">'.$v['name'].'</a></dt>';
			echo '<dd class="good-price"><span>'.$v['price'].'</span></dd>';
			echo '</dl>';
		} 
	?>
	<div class="cln0">&nbsp;</div>
</div>
</div>

 