<?php
$baseurl = '/'.$GLOBALS['config']['preview_directory'].'/'.URI_DIRECTORY.'/'.$app->getTemplate();
include($app->getPreviewComponentPath().DS.'com_banners'.DS.'helper.php');
require_once ($app->getPreviewComponentPath().DS.'com_products'.DS.'helpers'.DS.'route.php');

$clink = URI::current();
$link = substr($clink,0,strpos($clink,'?'));
$uri = &URI::getInstance();

//产品图片信息
$images = explode(',',$this->item['images']); 

$thumb = '';
foreach( $images as $k=>$img ){
if( strpos($img,'|1') !== false ){
	$images[$k] = $thumb = substr($img,0,-2);
}
}  

$link = Router::_( ProductsHelperRoute::getProductRoute($this->item['products_id'],$this->item['catid']) );

$t = time();
$t = $t2=$this->item['start_time']-$t;

//echo $t;
$d = (int)($t/3600/24);
//echo $d.'天';

$t = $t-$d*3600*24;	//减天数

$h = (int)($t/3600);
//echo $h.'小时';

$t = $t-$h*3600;	//减小时数
$s = (int)($t/60);

//echo $s.'分钟';

$t = $t-$s*60;	//减分钟

	$d = $d<1?0:$d;
	$h = $h<1?0:$h;
	$s = $s<1?0:$s;
	$t = $t<1?0:$t;
?>

<link rel="stylesheet" href="<?php echo $baseurl;?>/css/seckill.css" type="text/css"/>

<div id="header"><a href="index.php" id="webtitle">格力小家电商城</a></div>
<div id="maindiv">
	<div class="fleft780">
		<div id="ptitle">
			<h2 class="protitle"><?php echo $this->item['act_name'];?></h2>
		</div>
		<div id="pro-pic">
 			<!-- 产品图片展示 -->
				<div id="spec-n1" class="jqzoom" style="position: static;">
				<IMG height="350"
				src="<?php echo $thumb;?>" jqimg="<?php echo $thumb;?>" width="350" height=350 ></div>

				<div id="ashow"><a href="<?php echo $link;?>?a=v " >查看全部大图</a></div>  
				<div id="spec-n5">
					<div id="spec-left" class="control">
						<img src="<?php echo $baseurl;?>/images/left.gif" />
					</div>
					<div id="spec-list">
						<ul class="list-h" style="width: 248px; overflow: hidden;">
							<?php 
							foreach( $images as $img ){
							?>
							<li><img src="<?php echo $img; ?>" > </li>
							<?php
							}
							?> 
						</ul>
					</div>
					<div id="spec-right" class="control">
						<img src="<?php echo $baseurl;?>/images/right.gif" />
					</div>
				</div>
			</div>



			<!-- 产品图片展示 -->	
			<div id="prointro">
				<ul id="proarg">
					<li class="lins"><a href="<?php echo $link;?>" target="_blank" >查看商品详情</a></li>
					<li>秒杀价：<span class="price"><?php echo Utility::price_format($this->item['shop_price']);?></span></li>
					<li>秒杀数量：<?php echo $this->item['product_amount'];?>台</li>
					<li>
					秒杀状态：
					<span class="c-orange">
						<?php 
						$start = 0;
						if( $t2<0 && $this->item['is_finished']>1  ){ 
							echo '已结束'; 
						}else if( $t2<1 ){
							if( $this->item['purchase_num']>=$this->item['product_amount'] ){
								echo '该商品已秒杀完'; 
							}else{
								echo '进行中'; 
								$start=1;
							}
						}else{ 
							echo '未开始'; 
						} 
						?> 
					</span>
					</li>
					<li>登录状态：<?php $session = &Factory::getSession(); if( ($session->get('uid'))>0 ){ echo '已登陆'; }else{ echo '未登录';}?></li>
				</ul>
				<div id="secbox">
					<div id="sectime">距离开始时间：<span id="th" ><?php echo $h;?></span><span >时</span> <span id="ti"><?php echo $s;?></span><span >分</span><span id="ts" ><?php echo $t;?></span><span>秒</span></div>
					<div id="secbutn">
							
						<?php if( $start==1 ){ ?>
							<a href="?a=start&aid=<?php echo $_GET['aid'];?>" id="secbtna"   >立即秒杀</a>
						<?php }else{ ?>
							<a href="#" id="secbtnb"  >立即秒杀</a>
						<?php } ?>

						<?php if( ($session->get('uid'))>0 ){ ?>
						欢迎参与秒杀 !
						<?php }else{ ?>
						参与秒杀，请先 <a href="" style="font-weight:bold; font-size:14px; color:#f60; text-decoration:underline;">登录</a>

						<?php } ?>
					</div>
				</div>
			</div>
			<h3 id="sectitle2">秒杀英雄榜</h3>
			<div class="secbig">
			<?php 
			//秒杀进行中，查询是否有人秒杀到
			if( $t2<0 ){
				$model = &$this->getModel();
				$kill_board = $model->getBoard($this->item['act_id']);
				echo '<ul>';
				foreach( $kill_board as $k=>$v ){
					?>
					<li><?php echo $k+1;?>, <?php echo $v['uname'];?> &nbsp;<?php echo $v['created'];?></li>
					<?php
				}
				echo '</ul>';
			}
			?>
			</div>
			<h3 id="sectitle3">秒杀流程及说明</h3>
			<div class="secbig2">
				<div style="margin:20px; text-align:center; background:#fff; border:1px solid #e3e3e3;"><img src="<?php echo $baseurl;?>/cache/lius.jpg" /></div>
				<div style="margin:0px 20px 20px 20px;">
					<h4>秒杀规则：</h4>
					<p>1.秒杀开始请快速点击秒杀，按要求填写相关信息并确保信息的真实性，以获取秒杀资格，发现信息填写不符合要求或联系方式错误的，格力在线有权取消其秒杀资格；</p>
					<p>2.秒杀资格获取成功的顾客，请在秒杀商品秒杀时间段结束后的两个小时内前往该商品页面进行购买，逾期支付价格视为放弃；</p>
					<p>3.秒杀成功以最终支付成功为准，加入购物车、异常订单、未支付等其他状态都不属于已成功秒杀；</p>
					<p>4.秒杀活动统一采用在线支付，不接受电话银行、分期付款、货到付款、现金支付等其他支付方式；</p>
					<p>5.因为秒杀商品数量有限，为保证会员可以第一时间以秒杀价购买到对应秒杀商品，建议您提前对账户充值。</p>
					<p>6. 为了让广大网友公平参与秒杀，让更多的网友享受到格力在线给予的优惠，促销期间内每人仅限秒杀一次，通过核实信息，发现重复秒杀的，格力在线有权取消其该商品的秒杀资格！</p>

				</div>
			</div>
	</div>
	<div class="fright190">
		<h2 class="ktitle">秒杀规则</h2>
		<div class="bdgray">
			 <p class="pad10">1、参与秒杀活动用户必须为格力在线会员，参与活动时请您仔细填写您的个人信息并确保真实有效，以便我司核实相关信息后及时为您配送。</p>
			<p  class="pad10">2、参与秒杀活动的会员必须先登录，并通过网站搜索此款商品点击查询当地是否有货或者是否销售，秒杀请选择正确的城市秒杀，否则不予配送！</p>
			<p  class="pad10">3、会员参与秒杀时可不用充格力在线格力宝，获得秒杀资格后统一使用进行支付，不支持其他支付方式，获得购买资格的会员，可通过搜索框搜索到秒杀的此款商品后下单购买，请您在秒杀两小时内下订单并完成支付，如顾客未及时下单而商品无货的，后果自负！逾期将视为自动放弃，敬请注意！</p>
			<p class="pad10">4、温馨提示:秒杀成功的会员按照秒杀价格可购买数量为1。请确保秒杀信息真实有效，发现信息填写不符合要求或联系方式错误的，格力在线有权取消其秒杀资格。</p>

		</div>
	</div>	 



	<?php
	$item	=& ModuleHelper::getModule('mod_copyright');
	echo ModuleHelper::renderModule($item);
	?> 




</div>






<SCRIPT src="<?php echo $baseurl;?>/js/base.js" type="text/javascript"></SCRIPT>
<script type="text/javascript" src="<?php echo $baseurl;?>/js/timeCountDown.js"></script>

<script type="text/javascript" src="<?php echo $baseurl;?>/js/163css.js"></script>
			<!-- 产品图片展示 -->		
			<script language="javascript">
			$(function(){


				var t= <?php echo $this->item['start_time'];?>*1000+8*3600*1000;
				 
				fnTimeCountDown( t, {
					sec: $("#ts").get(0),
					mini: $("#ti").get(0),
					hour: $("#th").get(0)
				});
 
 
				//产品图片放大镜效果
				$(".jqzoom").hover(function(){
						$(this).css({position:'relative'});
				   },
				   function(){
						$(this).css({position:'static'});
				   });
				   $(".jqzoom").jqueryzoom({
						xzoom:400,
						yzoom:400,
						offset:10,
						position:"right",
						preload:1,
						lens:1
					});
					$("#spec-list").jdMarquee({
						deriction:"left",
						width:326,
						height:56,
						step:2,
						speed:4,
						delay:10,
						control:true,
						_front:"#spec-right",
						_back:"#spec-left"
					});
					$("#spec-list img").bind("mouseover",function(){
						var src=$(this).attr("src");
						$("#spec-n1 img").eq(0).attr({
							src:src.replace("\/n5\/","\/n1\/"),
							jqimg:src.replace("\/n5\/","\/n0\/")
						});
						$(this).css({
							"border":"2px solid #ff6600",
							"padding":"1px"
						});
					}).bind("mouseout",function(){
						$(this).css({
							"border":"1px solid #ccc",
							"padding":"2px"
						});
				});

					//设置背景
					$("body").css('background', 'url(<?php echo $baseurl;?>/images/killback.jpg) repeat-x left 107px');
				});
			</script>