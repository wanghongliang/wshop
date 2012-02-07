<?php
//print_r($this->item);
$basepath = dirname(__FILE__);
//include($basepath.DS.'header.php');
$baseurl = '/preview/templates/'.$app->getTemplate();

?>

<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>/css/tuan.css" />


	<div class="hfleft">
		<h1 class="histitle">玩转格力</h1>
		<div class="histcontent">
			<img src="/preview/templates/default/cache/tuanorder.jpg" alt="" />
		</div>
		<div class="hisbtm"></div>
	</div>
	<div class="hfright">
		<div class="tuanbox">
			<h3 class="boxtitle">团购声明</h3>
			<div class="boxcon">
				奖活动大奖获得者黄先生因个人原因自愿放弃领奖，拉手网将于本周五重新安排公证开奖，再次抽取一位幸运用户！参与过本次抽奖活动的朋友们注意啦<br/>
				<a href="">查看详情>></a>
			</div>
		</div>
		<div class="tuanbox">
			<h3 class="boxtitle">邀请有奖</h3>
			<div class="boxcon">
				邀请好友首团成功，您将最多获得<span class="color2">10</span>元返利奖
			</div>
		</div>
		<div class="tuanbox">
			<h3 class="boxtitle">团购小知识</h3>
			<div class="boxcon">
				<ul class="newlist">
					<li><a href="">目前格力团购仅支持在线支付；</a></li>
					<li><a href="">已售数量达到成团数量后，即会发送短信优惠码。</a></li>
					<li><a href="">团购人多更优惠!</a></li>
					<li><a href="">我团购成功后怎么确认收货</a></li>
					<li><a href="">团购人数不够？</a></li>
				</ul>
			</div>
		</div>
	</div>


<?php include($basepath.DS.'footer.php');?>