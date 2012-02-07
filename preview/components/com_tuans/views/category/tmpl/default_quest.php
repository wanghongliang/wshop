<?php
//print_r($this->item);
$basepath = dirname(__FILE__);
///include($basepath.DS.'header.php');
$baseurl = '/preview/templates/'.$app->getTemplate();

?>

<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>/css/tuan.css" />


	<div class="hfleft">
		<h1 class="histitle">常见问题</h1>
		<div class="histcontent">
		<?php      
			/**
		    for($i=0; $i < 10; $i++)
		    {
		        echo '<dl class="newdl">';
				echo '<dt>什么是格力团？</dt>';
				echo '<dd>格力团购每天提供1 至3单精品消费，为您精选格力世界品牌空调、电磁炉、电饭煲等家用电器，只要达到团购最低限定人数即可成团，使您以超低价格就可以购买到趁心如意的商品！
另：格力团购马上就要推出特色形式的商品团购，敬请期待！！</dd>';
				echo '</dl>';
		    }

			**/

		?>


<dl class="newdl">
<dt>1，什么是格力团？</dt>
<dd>格力团购装将不定期，为您精选格力世界品牌空调、电磁炉、电饭煲等家用电器，只要达到团购最低限定人数即可成团，使您以超低价格就可以购买到趁心如意的商品！
<br/>
另：格力团购马上就要推出特色形式的商品团购，敬请期待！！
</dd>
</dl>

<dl class="newdl">
<dt>2，如何购买？</dt>
<dd>只需在团购结束之前点击“购买”按钮，根据提示下订单付费购买即可。如果参加团购人数达到最低人数下限，则团购成交，您将得到我们的邮件或短信通知。
</dd>
</dl>


<dl class="newdl">
<dt>3，都有哪些支付方式？</dt>
<dd>目前支持支付宝和各大银行在线支付方式
</dd>
</dl>
		    

<dl class="newdl">
<dt>4，团购成交后，我还能购买么？</dt>
<dd>团购成交后，仍可以继续购买。但是请注意部分团购有数量上限，先买先得，卖完为止。
</dd>
</dl>


<dl class="newdl">
<dt>5，团购人数不够买不成了怎么办？</dt>
<dd>如果参加团购人数不足，则该次团购取消。已支付的款项，格力团将立即原数返还，请放心。您不会有任何损失，但失去了以超低折扣价享受精品消费的机会。如果您很希望这次团购成交，邀请您的朋友一起来购买吧~
</dd>
</dl>



		</div>
		<div class="hisbtm"></div>
	</div>
	<div class="hfright">
		<div class="tuanbox">
			<h3 class="boxtitle">团购声明</h3>
			<div class="boxcon">
				奖活动大奖获得者黄先生因个人原因自愿放弃领奖，将于本周五重新安排公证开奖，再次抽取一位幸运用户！参与过本次抽奖活动的朋友们注意啦<br/>
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