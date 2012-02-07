<?php
//print_r($this->item);
$basepath = dirname(__FILE__);
//include($basepath.DS.'header.php');

$clink = URI::current();
$baseurl = '/preview/templates/'.$app->getTemplate();

?>

<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>/css/tuan.css" />

		<div class="tfleft">






			<?php

 
			if( count($this->item) > 0 ){
				 
				foreach( $this->item as $k=> $row ){
				
				$row['market_price'] = $row['market_price']<1?1:$row['market_price'];
				$param = unserialize( $row['ext_info']);
				
				$t = time();
				//是否过期 --- 没过期
				if( $t < $row['end_time'] ){
					$t =  $row['end_time']-$t; 
					$d = (int)($t/3600/24); 

					$t = $t-$d*3600*24;	
					$h = (int)($t/3600); 

					$t = $t-$h*3600;	
					$s = (int)($t/60);

					$t = $t-$s*60;	//减分钟


				?>
				<div class="share">
					<span class="tnum"><? echo  $row['act_id']; ?></span>
					<span class="sharelab">分享到：</span>
					<a class="a_share share_sina" title="分享到新浪微博" href="http://v.t.sina.com.cn/share/share.php?url=<?php echo $clink;?>" target="_blank">新浪</a>
					<a class="a_share share_qzone" title="分享到Qzone" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php echo $clink;?>" target="_blank">Qzone</a>
					<a class="a_share share_qq" title="分享到腾讯微博" href="http://v.t.qq.com/share/share.php?url=<?php echo $clink;?>" target="_blank">腾讯</a>
					<a class="a_share share_baidu" title="分享到百度搜藏" href="http://cang.baidu.com/do/add?iu=<?php echo $clink;?>" target="_blank">百度</a>
					<a class="a_share share_taojh" title="分享到淘江湖" href="http://share.jianghu.taobao.com/share/addShare.htm?url=<?php echo $clink;?>" target="_blank">淘江湖</a>
					<a class="a_share share_kaixin" title="分享到开心网" href="http://www.kaixin001.com/repaste/bshare.php?rurl=http://www.mbaobao.com/pshow-1106037220.html&amp;rtitle=格力好空调" target="_blank"><!-- 注意此处开心网的rurl 后地址不带http:// -->开心网</a>
					<a class="a_share share_renren" title="分享到人人网" href="http://share.renren.com/share/buttonshare.do?link=<?php echo $clink;?>" target="_blank">人人网</a
					>
					<a class="a_share share_douban" title="分享到豆瓣" href="http://www.douban.com/recommend/?url=<?php echo $clink;?>&amp;comment=开心网购，就在麦包包！在麦包包官方网站淘宝，可用支付宝付款，满100全国免邮，不满意7天无条件退货！麦包包，淘宝网商城知名品牌，开心网购，值得信赖！">豆瓣</a>
					<a class="a_share share_baishh" title="分享到搜狐白社会" href="http://bai.sohu.com/share/blank/addbutton.do?link=<?php echo $clink;?>" target="_blank">白社会</a>
				</div>
				<div class="tcontent">
					<h2 class="titles"> 
						<a href="<?php echo $clink;?>?id=<?php echo $row['act_id'];?>">
						今日团购：<? echo  $row['act_name']; ?>
						</a> 
					</h2> 
					<div class="tuanarg">
						<dl class="tuandl">
							<dt>
							<span class="good-price"><?php echo $param['ladder_price'][0];?></span> 
								<a href="javascript:submit(<?php echo $row['act_id'];?>)" class="tuanbtn">立即团购</a>
							</dt>
							<dd>原价<span>￥<?php echo $row['market_price'];?></span></dd>
							<dd>折扣<span><?php echo number_format( $param['ladder_price'][0]/$row['market_price']*10,1,'.','');?>折</span></dd>
							<dd>节约<span>￥<?php echo $row['market_price']-$param['ladder_price'][0];?></span></dd>
						</dl>
							<div class="tuantime" t="<?php echo $row['end_time'];?>" >
								到结束仅有：<br/>
								<span class="hday"><?php echo $d;?></span> 天 <span class="hhour"><?php echo $h;?></span> 时 <span class="hmini"><?php echo $s;?></span> 分 <span class="hsec"><?php echo $t;?></span> 秒
							</div>
							<div class="tuanperson">
 								<?php if( $param['ladder_amount'][0]<=$row['purchase_people'] ){ ?>
								 
								<h5 class="tuanok">已有<?php echo $row['purchase_people'];?>人购买</h5> 
								<div class="dealok">团购已成功可继续购买</div>
								 <br/>	<span class="color2">数量有限，再不抢就来不及啦！</span>
								<?php }else{ ?>
								<h5 class="tuanok">已有<?php echo $row['purchase_people'];?>人购买</h5>
								距离团购人数还差<?php echo $param['ladder_amount'][0]-$row['purchase_people'];?> 人。
								<?php } ?>
							</div>

						<form action="/?com=cart&act=add" method="post" id="tuan<?php echo $row['act_id'];?>" >
						<input type="hidden" name="id" value="<?php echo $row['products_id'];?>" />
						<input type="hidden" name="num" value="1" />
						<input type="hidden" name="act_type" value="1" />
						</form>
					</div>

					<div class="tuandesc">
						<div align=center >
						<a href="<?php echo $clink;?>?id=<?php echo $row['act_id'];?>">
							<img src="<?php echo $row['img'];?>" width="490"/>
						</a>
						</div>
						<div class="tuantext">
							<?php echo $row['act_remark'];?>
						</div>
					</div> 
				</div>
				<?php

				}else{
				?>

				<div class="share">
					<span class="tnum"><? echo  $row['act_id']; ?></span>
					<span class="sharelab">分享到：</span>
					<a class="a_share share_sina" title="分享到新浪微博" href="http://v.t.sina.com.cn/share/share.php?url=<?php echo $clink;?>" target="_blank">新浪</a>
					<a class="a_share share_qzone" title="分享到Qzone" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php echo $clink;?>" target="_blank">Qzone</a>
					<a class="a_share share_qq" title="分享到腾讯微博" href="http://v.t.qq.com/share/share.php?url=<?php echo $clink;?>" target="_blank">腾讯</a>
					<a class="a_share share_baidu" title="分享到百度搜藏" href="http://cang.baidu.com/do/add?iu=<?php echo $clink;?>" target="_blank">百度</a>
					<a class="a_share share_taojh" title="分享到淘江湖" href="http://share.jianghu.taobao.com/share/addShare.htm?url=<?php echo $clink;?>" target="_blank">淘江湖</a>
					<a class="a_share share_kaixin" title="分享到开心网" href="http://www.kaixin001.com/repaste/bshare.php?rurl=http://www.mbaobao.com/pshow-1106037220.html&amp;rtitle=格力好空调" target="_blank"><!-- 注意此处开心网的rurl 后地址不带http:// -->开心网</a>
					<a class="a_share share_renren" title="分享到人人网" href="http://share.renren.com/share/buttonshare.do?link=<?php echo $clink;?>" target="_blank">人人网</a
					>
					<a class="a_share share_douban" title="分享到豆瓣" href="http://www.douban.com/recommend/?url=<?php echo $clink;?>&amp;comment=开心网购，就在麦包包！在麦包包官方网站淘宝，可用支付宝付款，满100全国免邮，不满意7天无条件退货！麦包包，淘宝网商城知名品牌，开心网购，值得信赖！">豆瓣</a>
					<a class="a_share share_baishh" title="分享到搜狐白社会" href="http://bai.sohu.com/share/blank/addbutton.do?link=<?php echo $clink;?>" target="_blank">白社会</a>
				</div>
				<div class="tcontent">
						<h2 class="titles"> 
							<a href="<?php echo $clink;?>?id=<?php echo $row['act_id'];?>">
								今日团购：<? echo  $row['act_name']; ?>
							</a> 
						</h2> 
						<div class="tuanarg">
							<dl class="tuandl">
								<dt class="end" >
								<span class="good-price"><?php echo $param['ladder_price'][0];?></span> 
									<a href="#" class="tuanbtn">立即团购</a>
								</dt>
								<dd>原价<span>￥<?php echo $row['market_price'];?></span></dd>
								<dd>折扣<span><?php $row['market_price']=$row['market_price']<1?1:$row['market_price']; echo number_format( $param['ladder_price'][0]/$row['market_price']*10,1,'.','');?>折</span></dd>
								<dd>节约<span>￥333</span></dd>
							</dl>
							<div class="tuantime2">
								团购已于<?php echo date('Y-m-d H:i:s',$row['end_time']);?>结束。
							</div>
							<div class="tuanperson" style="background:#F7E9CF;">
								<?php if( $param['ladder_amount'][0]<=$row['purchase_people'] ){ ?>
								<div><img src="<?php echo $baseurl;?>/images/dealsucc.gif"></div>
								<h5 class="tuanok">已有<?php echo $row['purchase_people'];?>人购买</h5> 
 								<?php }else{ ?>
								<h5 class="tuanok">已有<?php echo $row['purchase_people'];?>人购买</h5>
						 
								<?php } ?>
							</div>
						</div>

						<div class="tuandesc">
							<div align=center >
							<a href="<?php echo $clink;?>?id=<?php echo $row['act_id'];?>">
								<img src="<?php echo $row['img'];?>" width="420"/>
							</a>
							</div>
							<div class="tuantext">
								<?php echo $row['act_remark'];?>
							</div>
						</div>
			
				</div>

				<?php 
				}
				}

			}else{

				echo '暂无团购信息';
			}

			?> 
		</div>


<?php include($basepath.DS.'right.php');?>

<div class="cln">&nbsp;</div>

<script type="text/javascript" src="<?php echo $baseurl;?>/js/timeCountDown.js"></script>
<script type="text/javascript">
$('.tuantime').each(function(k,o){
 	var t= parseInt($(o).attr('t'))*1000+8*3600*1000;
 		fnTimeCountDown( t, {
			sec: $(".hsec",o).get(0),
			mini: $(".hmini",o).get(0),
			hour: $(".hhour",o).get(0),
			day: $(".hday",o).get(0)
		});
 });

function submit(id){
	$('#tuan'+id).submit();
}
</script>

<?php include($basepath.DS.'footer.php');?>