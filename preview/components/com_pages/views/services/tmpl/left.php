<?php
$url_link = URI::base(true);

?>
<div class="sleft">
	<h2 class="stitle">空调维护</h2>
	<ul class="smenu">
		<li><a href="" class="asearch">服务查询</a>
		<ul>
			<li><a href="<?php echo $url_link.'?a=qappo';?>" class="colors2">预约信息</a></li>
			<li><a href="<?php echo $url_link.'?a=qcons';?>">咨询信息</a></li>
			<li><a href="<?php echo $url_link.'?a=qcomp';?>">投诉信息</a></li>
		</ul>
		</li>
		<li><a href="" class="ago">服务申请</a>
		<ul>
			<li><a href="<?php echo $url_link.'?a=appo';?>">预约</a></li>
			<li><a href="<?php echo $url_link.'?a=cons';?>">咨询</a></li>
			<li><a href="<?php echo $url_link.'?a=comp';?>">投诉</a></li>
		</ul>
		</li>
	</ul>
	<h2 class="stitle mag-t10">常见问题</h2>
	<ul class="snews">
 
	<?php
	$link = Router::_('index.php?com=contents&view=article&id=195&itemid=384');
	?>
	<li><a href="<?php echo $link;?>" >为何制冷效果差？</a></li>
	<li><a href="<?php echo $link;?>">为何空调不工作？</a></li>
	<li><a href="<?php echo $link;?>">为何空调不开机？</a></li>
	<li><a href="<?php echo $link;?>">为什么会有凝露？</a></li>
	<li><a href="<?php echo $link;?>">运行时外机无排水？</a></li>
	<li><a href="<?php echo $link;?>">为何空调内机噪音大？</a></li>
	<li><a href="<?php echo $link;?>">为何空调外机噪音大？</a></li>
	<li><a href="<?php echo $link;?>">为何空调启动有异响？</a></li>
	<li><a href="<?php echo $link;?>">遥控器乱码如何处理？ </a></li>
	</ul>
</div>