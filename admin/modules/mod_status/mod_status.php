<?php

$session = &Factory::getSession();	//session
$username = $session->get('username');	//会员名称

$db = &Factory::getDB();

//商品点评价格
$sql = "select count(*) as n from #__evaluation ";
$db->query($sql);
$evaluation_count = $db->getRow();
 

$sql = "select count(*) as n  from #__products_comment where parent_id=0 ";
$db->query($sql);
$product_comment_count = $db->getRow();


$sql = "select count(*)  as n from #__order  ";
$db->query($sql);
$order_count = $db->getRow();
?>
<div class="logo" >
</div>
<div class="company_name" >	
	<?php 
	//$company_info = $app->getCompanyInfo();
	//echo $company_info['name']; 
	?>
</div>
<div class="mod_statu" >
<ul  >
	<li>
		<a href="../" id="show" target=_blank >预览</a>
	</li>
	<li class="statu_msg" >
		<ul>
			<li><a href="?com=products_comment" >商品咨询: <?php echo $product_comment_count['n'];?></a></li>
			<li><a href="?com=evaluation" >商品评价: <?php echo $evaluation_count['n'];?></a></li>
			<li><a href="?com=orders" >订单信息: <?php echo $order_count['n'];?></a></li>
		</ul>
		 
	</li>
	<li >
		<a href="index.php" id="s_user"> <?php echo $username; ?> </a>
	</li>
	<li><a href="index.php?com=users&task=logout" id="s_out">退出登陆</a></li>


</ul>
</div>






<script type="text/javascript"> 
		$(document).ready(function(){
			$(".statu_msg").textSlider({line:1,speed:1000,timer:2000});
		});
		</script>