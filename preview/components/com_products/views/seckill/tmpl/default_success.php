<?php
$baseurl = '/'.$GLOBALS['config']['preview_directory'].'/'.URI_DIRECTORY.'/'.$app->getTemplate();
?>
<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>/css/questions.css" />

<div class="q_box">
<h2 class="q_h2" >
	恭喜你，秒杀商品已添加到您的购物车！
</h2>
<div class="q_remark" >
请在两个小时内，完成该商品订单信息，并成功在线支付，即可完成秒杀！
</div>

<a href="/?com=cart" >
<div class="q_btn"  >去购物车</div>
</a>

</div>