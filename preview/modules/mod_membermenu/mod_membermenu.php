<?php
$v = $_GET['view'];
?>
<ul id="u_menu">
	<li><a   class="uico1">交易管理</a>
		<ul>
			<li><a <?php if( $v == 'orders' ){ echo ' class="now" '; } ?> href="index.php?com=users&view=orders">我的订单</a></li>
			<li><a <?php if( $v == 'tuan' ){ echo ' class="now" '; } ?> href="index.php?com=users&view=tuan">我的团购</a></li> 
		</ul>
	</li>

	<li><a  class="uico3">应用管理</a>
		<ul>
			<li><a <?php if( $v == 'fav' ){ echo ' class="now" '; } ?> href="index.php?com=users&view=fav">我的收藏</a></li>
			<li><a <?php if( $v == 'evaluation' ){ echo ' class="now" '; } ?> href="index.php?com=users&view=evaluation">商品评价</a></li>
		</ul>
	</li>

	<li><a  class="uico2">账户管理</a>
		<ul>
			<li><a <?php if( $v == 'points' ){ echo ' class="now" '; } ?> href="index.php?com=users&view=points">我的积分</a></li>
			<li><a <?php if( $v == 'coupon' ){ echo ' class="now" '; } ?> href="index.php?com=users&view=coupon">我的优惠券</a></li>
		</ul>
	</li>
	<li><a  class="uico4">个人信息</a>
		<ul>
			<li><a <?php if( $v == 'address'){ echo ' class="now" '; } ?> href="index.php?com=users&view=address" >收货地址</a></li>
			<li><a <?php if( $v == ''  && $a == 'info'  ){ echo ' class="now" '; } ?> href="index.php?com=users&act=info">个人资料</a></li>
			<li><a <?php if( $v == ''  && $a == 'setpwd'  ){ echo ' class="now" '; } ?> href="index.php?com=users&act=setpwd">修改密码</a></li> 
			<li><a  href="index.php?com=users&task=logout">退出登陆</a></li>
		</ul>
	</li>
</ul>