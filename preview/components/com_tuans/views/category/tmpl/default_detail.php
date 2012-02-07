<?php
//print_r($this->item);
$basepath = dirname(__FILE__);
//include($basepath.DS.'header.php');
$baseurl = '/preview/templates/'.$app->getTemplate();

?>

<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>/css/tuan.css" />



		<div class="tfleft">
			<?php
			if( $this->item['act_id'] > 0 ){
				$this->item['market_price'] = $this->item['market_price']<1?1:$this->item['market_price'];

				$link = URI::current();
				$t = time();
				$param = unserialize( $this->item['ext_info']);
				 
	
				//是否过期
				if( $t < $this->item['end_time'] ){
 				$t =  $this->item['end_time']-$t;

				$d = (int)($t/3600/24); 

				$t = $t-$d*3600*24;	
				$h = (int)($t/3600); 

				$t = $t-$h*3600;	
				$s = (int)($t/60);

				$t = $t-$s*60;	//减分钟


				?>
					<div class="share">
						<span class="tnum"><? echo  $this->item['act_id']; ?></span>
						<span class="sharelab">分享到：</span>
						<a class="a_share share_sina" title="分享到新浪微博" href="http://v.t.sina.com.cn/share/share.php?url=<?php echo $link;?>" target="_blank">新浪</a>
						<a class="a_share share_qzone" title="分享到Qzone" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php echo $link;?>" target="_blank">Qzone</a>
						<a class="a_share share_qq" title="分享到腾讯微博" href="http://v.t.qq.com/share/share.php?url=<?php echo $link;?>" target="_blank">腾讯</a>
						<a class="a_share share_baidu" title="分享到百度搜藏" href="http://cang.baidu.com/do/add?iu=<?php echo $link;?>" target="_blank">百度</a>
						<a class="a_share share_taojh" title="分享到淘江湖" href="http://share.jianghu.taobao.com/share/addShare.htm?url=<?php echo $link;?>" target="_blank">淘江湖</a>
						<a class="a_share share_kaixin" title="分享到开心网" href="http://www.kaixin001.com/repaste/bshare.php?rurl=http://www.mbaobao.com/pshow-1106037220.html&amp;rtitle=格力好空调" target="_blank"><!-- 注意此处开心网的rurl 后地址不带http:// -->开心网</a>
						<a class="a_share share_renren" title="分享到人人网" href="http://share.renren.com/share/buttonshare.do?link=<?php echo $link;?>" target="_blank">人人网</a
						>
						<a class="a_share share_douban" title="分享到豆瓣" href="http://www.douban.com/recommend/?url=<?php echo $link;?>&amp;comment=开心网购，就在麦包包！在麦包包官方网站淘宝，可用支付宝付款，满100全国免邮，不满意7天无条件退货！麦包包，淘宝网商城知名品牌，开心网购，值得信赖！">豆瓣</a>
						<a class="a_share share_baishh" title="分享到搜狐白社会" href="http://bai.sohu.com/share/blank/addbutton.do?link=<?php echo $link;?>" target="_blank">白社会</a>
					</div>
					<div class="tcontent">
						<h2 class="titles">
						
						<a href="<?php echo $clink;?>?id=<?php echo $this->item['act_id'];?>">
						今日团购：<? echo  $this->item['act_name']; ?>
						</a>
			
						</h2>


						<div class="tuanarg">
							<dl class="tuandl">
								<dt>
								<span class="good-price"><?php echo $param['ladder_price'][0];?></span> 
								<a href="javascript:submit(<?php echo $this->item['act_id'];?>)" class="tuanbtn">立即团购</a>
								</dt>
								<dd>原价<span>￥<?php echo $this->item['market_price'];?></span></dd>
								<dd>折扣<span><?php echo number_format( $param['ladder_price'][0]/$this->item['market_price']*10,1,'.','');?>折</span></dd>
								<dd>节约<span>￥<?php echo $this->item['market_price']-$param['ladder_price'][0];?></span></dd>
							</dl>
							<div class="tuantime">
								到结束仅有：<br/>
								 <span class="hday"><?php echo $d;?></span> 天<span id="th" ><?php echo $h;?></span><span >时</span> <span id="ti"><?php echo $s;?></span><span >分</span><span id="ts" ><?php echo $t;?></span><span>秒</span>
							</div>
							<div class="tuanperson">
 								<?php if( $param['ladder_amount'][0]<=$this->item['purchase_people'] ){ ?>
								 
								<h5 class="tuanok">已有<?php echo $this->item['purchase_people'];?>人购买</h5> 
								<div class="dealok">团购已成功可继续购买</div>
								 <br/>	<span class="color2">数量有限，再不抢就来不及啦！</span>
								<?php }else{ ?>
								<h5 class="tuanok">已有<?php echo $this->item['purchase_people'];?>人购买</h5>
								距离团购人数还差<?php echo $param['ladder_amount'][0]- $this->item['purchase_people'];?> 人。
								<?php } ?>
							</div>
						</div>
						<form action="/?com=cart&act=add" method="post" id="tuan<?php echo $this->item['act_id'];?>" >
						<input type="hidden" name="id" value="<?php echo $this->item['products_id'];?>" />
						<input type="hidden" name="num" value="1" />
						<input type="hidden" name="act_type" value="1" />
						</form>
						<div class="tuandesc">
							<div align=center >
 								<img src="<?php echo $this->item['img'];?>" width="490"/>
 							</div>
							<div class="tuantext">
								<?php echo $this->item['act_remark'];?>
							</div>
						</div>
					</div>
				<?php
					}else{////////////////////////////////////////////////////////////
				?>

					<div class="share">
						<span class="tnum"><? echo  $this->item['act_id']; ?></span>
						<span class="sharelab">分享到：</span>
						<a class="a_share share_sina" title="分享到新浪微博" href="http://v.t.sina.com.cn/share/share.php?url=<?php echo $link;?>" target="_blank">新浪</a>
						<a class="a_share share_qzone" title="分享到Qzone" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php echo $link;?>" target="_blank">Qzone</a>
						<a class="a_share share_qq" title="分享到腾讯微博" href="http://v.t.qq.com/share/share.php?url=<?php echo $link;?>" target="_blank">腾讯</a>
						<a class="a_share share_baidu" title="分享到百度搜藏" href="http://cang.baidu.com/do/add?iu=<?php echo $link;?>" target="_blank">百度</a>
						<a class="a_share share_taojh" title="分享到淘江湖" href="http://share.jianghu.taobao.com/share/addShare.htm?url=<?php echo $link;?>" target="_blank">淘江湖</a>
						<a class="a_share share_kaixin" title="分享到开心网" href="http://www.kaixin001.com/repaste/bshare.php?rurl=http://www.mbaobao.com/pshow-1106037220.html&amp;rtitle=格力好空调" target="_blank"><!-- 注意此处开心网的rurl 后地址不带http:// -->开心网</a>
						<a class="a_share share_renren" title="分享到人人网" href="http://share.renren.com/share/buttonshare.do?link=<?php echo $link;?>" target="_blank">人人网</a
						>
						<a class="a_share share_douban" title="分享到豆瓣" href="http://www.douban.com/recommend/?url=<?php echo $link;?>&amp;comment=开心网购，就在麦包包！在麦包包官方网站淘宝，可用支付宝付款，满100全国免邮，不满意7天无条件退货！麦包包，淘宝网商城知名品牌，开心网购，值得信赖！">豆瓣</a>
						<a class="a_share share_baishh" title="分享到搜狐白社会" href="http://bai.sohu.com/share/blank/addbutton.do?link=<?php echo $link;?>" target="_blank">白社会</a>
					</div>
					<div class="tcontent">
						<h2 class="titles">
						
						<a href="<?php echo $clink;?>?id=<?php echo $this->item['act_id'];?>">
						今日团购：<? echo  $this->item['act_name']; ?>
						</a>
			
						</h2>


						<div class="tuanarg">
							<dl class="tuandl">
								<dt class="end" >
								<span class="good-price"><?php echo $param['ladder_price'][0];?></span> 
									<a href="#" class="tuanbtn">立即团购</a>
								</dt>
								<dd>原价<span>￥<?php echo $this->item['market_price'];?></span></dd>
								<dd>折扣<span><?php echo number_format( $param['ladder_price'][0]/$this->item['market_price']*10,1,'.','');?>折</span></dd>
								<dd>节约<span>￥333</span></dd>
							</dl>
							<div class="tuantime2">
								团购已于<?php echo date('Y-m-d H:i:s',$this->item['end_time']);?>结束。
							</div>
							<div class="tuanperson" style="background:#F7E9CF;">
								<?php if( $param['ladder_amount'][0]<=$this->item['purchase_people'] ){ ?>
								<div><img src="<?php echo $baseurl;?>/images/dealsucc.gif"></div>
								<h5 class="tuanok">已有<?php echo $this->item['purchase_people'];?>人购买</h5> 
 								<?php }else{ ?>
								<h5 class="tuanok">已有<?php echo $this->item['purchase_people'];?>人购买</h5>
						 
								<?php } ?>
							</div>
						</div>

						<div class="tuandesc">
							<div align=center >
							<a href="#">
								<img src="<?php echo $this->item['img'];?>" width="490"/>
							</a>
							</div>
							<div class="tuantext">
								薄，一見傾心。<br/>
								只一道輕盈的曲線，就勾勒出悸动心灵的轨迹。<br/>
								带着独有的艺术张力，凌驾传统工业设计之上...
							</div>
						</div>
					</div>


				<?php
					}
				?>
					<div class="showcontent">
						<div class="pad10">
							<h3 class="modtitle">本团详情</h3>
							<?php echo $this->item['act_desc'];?>
							<p>
								<img src="cache/tuan2.jpg" alt="" />
							</p>

							<?php /** ?>
							<h3 class="modtitle">大家这样说<h3>
							<p>
								天天购物网真的很不错，我的香水、彩妆、护肤品都在这里买的，很值得信赖！这次买的雅诗兰黛比我在美国买的还便宜些！而且也是原装进口的！太棒了，继续支持天天购物网！
							</p>
							<?php **/?>
						</div>
					</div>

				<?php
				}else{
					
				}
			?>
		</div>


<?php include($basepath.DS.'right.php');?>

<div class="clr" style="height:10px;" >&nbsp;</div>
<script type="text/javascript" src="<?php echo $baseurl;?>/js/timeCountDown.js"></script>

<script language="javascript" >
function submit(id){
	$('#tuan'+id).submit();
}

$(function(){
	var t= <?php echo $this->item['end_time'];?>*1000+8*3600*1000;
	 
	fnTimeCountDown( t, {
		sec: $("#ts").get(0),
		mini: $("#ti").get(0),
		hour: $("#th").get(0),
		day: $(".hday").get(0)
	});
 
});
</script>

 

<?php include($basepath.DS.'footer.php');?>