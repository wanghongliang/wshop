<?php 
$menu = &$app->getMenu();
$c_uri = URI::current(); 
$uri = &URI::getInstance();

//产品图片信息
$images = explode(',',$this->item['images']); 

$thumb = '';
foreach( $images as $k=>$img ){
	if( strpos($img,'|1') !== false ){
		$images[$k] = $thumb = substr($img,0,-2);
	}
} 

//基本URL信息
$baseurl = '/'.$GLOBALS['config']['preview_directory'].'/'.URI_DIRECTORY.'/'.$app->getTemplate();
 
$model = &$this->getModel();

$prev = $model->getPrev($this->item['id']);//上一个产品
$next = $model->getNext($this->item['id']);//下一个产品

//banner 条
//include($app->getPreviewComponentPath().DS.'com_banners'.DS.'helper.php');
//$banner = getBanner(18);
//print_r($banner);
//$params = unserialize( $banner['params'] );

$cat = $menu->getCategoryItem($this->item['catid']);
if( $cat['parent_id'] > 0 ){
$cat = $menu->getCategoryItem($cat['parent_id']);
}
 // print_r($GLOBALS['config']); 
 $deposit = $GLOBALS['config']['options']['deposit'];

if( $deposit < 1 ){
	$deposit = $products_option['deposit'];	//订金
}


/**
//取属性 
$sql = "select at.attr_name,av.attr_id,av.attr_value,av.attr_price,av.tb from #__products_attribute as at , #__products_attr as av where at.attr_id=av.attr_id and av.products_id=".(int)$this->item['id']." and attr_type = 2 ";

//echo $sql;
$db = &Factory::getDB();
$db->query($sql);
$attrs = $db->getResult('attr_id',true);
 
**/

//print_r($attrs);
?>

<LINK href="<?php echo $baseurl;?>/css/products.css" type="text/css" rel="stylesheet">

<div id="dtroot">
<?php
$item	=& ModuleHelper::getModule('mod_breadcrumbs');
echo ModuleHelper::renderModule($item);
?>
</div> 
	<div class="flbig"> 
		<div id="ptitle">
			<h2 class="protitle"><?php echo $this->item['name'];?></h2>
			<a id="prev" title="前一个商品"  href="<?php if( isset($prev['id']) ){
				echo Router::_( ProductsHelperRoute::getProductRoute($prev['id'],$prev['catid']) ); 
				}else{ echo 'javascript:alert(\'前面没有商品了\'); '; }?>">PREV</a> | <a id="next" title="后一个商品" href="<?php if( isset($next['id']) ){ echo Router::_( ProductsHelperRoute::getProductRoute($next['id'],$next['catid']) ); }else{  echo 'javascript:alert(\'后面没有商品了\'); '; } ?>">NEXT</a>
		</div>

		<div id="pro-pic">
			<!-- 产品图片展示 -->
				<div id="spec-n1" class="jqzoom" style="position: static;"><IMG height="350"
				src="<?php echo $thumb;?>" jqimg="<?php echo $thumb;?>" width="350" height=350 ></div>
				<div id="ashow"><a href="<?php echo $uri->getByURL(array('a'=>'v'));?> " >查看全部大图</a></div>  
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
 			<!-- 产品图片展示 -->		
		</div>


		<div id="prointro">
			<ul id="proarg">
				<li>商品编号： <?php echo $this->item['model'];?></li>
				<li>市 场 价： ￥<s><?php echo Utility::price_format($this->item['market_price']);?></s></li> 		
					<?php 
					if( is_array($act) && count($act)>0 ){

					$t = time();
					$t = $act['end_time']-$t;

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

					//更改活动价
					$this->item['shop_price'] = $act['shop_price'];
					$act_type = $act['act_type'];

					?>
					<li>活动价：<span class="price" id="ptdp"><?php echo Utility::price_format($act['shop_price']);?></span>&nbsp;&nbsp; 剩余数量<?php echo $act['product_amount'];?>件</li>
					<li class="good-time" t="<?php echo $act['end_time'];?>" >仅剩 <span class="hday"><?php echo $d;?></span>天 <span class="hhour"><?php echo $h;?></span>时 <span class="hmini"><?php echo $s;?></span>分 <span class="hsec"><?php echo $t;?></span>秒</li>
					<script type="text/javascript" src="/preview/templates/default/js/timeCountDown.js"></script>

					<script type="text/javascript">
					$(function(){
						var o = $('.good-time').get(0);
						var t= parseInt($(o).attr('t'))*1000+8*3600*1000;
							fnTimeCountDown( t, {
								sec: $(".hsec",o).get(0),
								mini: $(".hmini",o).get(0),
								hour: $(".hhour",o).get(0),
								day: $(".hday",o).get(0)
							});
					 });

					</script>

					<?php
					}else{
					?>
					<li>网 购 价：<span class="price" id="ptdp"><?php echo Utility::price_format($this->item['shop_price']);?></span></li>

					<?php } ?>
 
			</ul>
			<div id="probuy">
  

			<script type="text/javascript">
			//按颜色设计价格
			function setPrice(price, obj, kthis){
				$(kthis).siblings('span').removeClass('now');
				$(kthis).siblings('span').addClass('sclr');
				$(kthis).removeClass('sclr');
				$(kthis).addClass('now');
				

				$('input[name=attr]').val( $('.t',kthis).html() );

				//alert($('input[name=attr]').val());
				if( price>0 ){
					$(obj).html(price);
					$('input[name=price]').val( price );
				}
				var img = $('img',kthis);
				if( img ){
					var src=$(img).attr("src");
					$('input[name=img]').val( src );
					$("#spec-n1 img").eq(0).attr({
						src:src.replace("\/n5\/","\/n1\/"),
						jqimg:src.replace("\/n5\/","\/n0\/")
					}); 
				}
			}
			//购买件数加减计算
			function adds(obj, num){
				var vals = $(obj).val();
				vals = vals -1 + num + 1;
				if(vals >= 0){
					$(obj).val(vals);
				}else{
					return false;
				}
			}
			</script>

			<form action="<?php echo $menu->link('index.php?com=cart&act=add');?>" method="post" name="add_cart" >
			<div id="pt-shop">

	
					<ul id="pt-stxt"> 
					<?php

					//产品参数
					$attr = (array)$this->lists['attr'];
					$attr_price = $this->lists['attr_price'];

					//把需要设定价格的参数先过滤出来
					$ap = array();
					foreach( $attr as $k=>$a ){
						if( $a['attr_type'] == 2  && $attr_price[$a['products_attr_id']]['enabled'] == 1 ){
							$ap[$a['attr_id']][] = $a;
							unset($attr[$k]);
						}
					} 
					//print_r($ap); 
					$colors = array(
						'白色'=>'ffffff',
						'红色'=>'ff0000',
					);
					foreach( $ap as $k=>$v ){
						if( $v[0]['attr_name'] == '颜色' ){

							//print_r($v);
							?>
							<li>
							<div style="float:left;">颜 色：</div>



							<?php foreach( $v as $k2=>$v2 ){ 
									
									$pr = $attr_price[$v2['products_attr_id']];

									//if( $pr['enabled'] == 1 ){
									?>
									<span class="sclr" onclick="setPrice(<?php echo Utility::price_format($pr['price']);?>, '#ptdp', this);">
										<?php 
										if( $v2['tb'] != '' ){
											echo '<img src="'.$v2['tb'].'" width=60 height=60 >';
										}else{
										?>
										<div  class="c" style="background:#<?php echo $colors[$v2['attr_value']];?>;" ></div>
										<?php
										}
										?>
										<div class="t" ><?php echo $v2['attr_value'];?></div>

									</span>
									<?php 
									//}else{

									//}
								?>


							<?php } ?>  
							<div class="cln"></div>
							</li>
							<?php
						}
					}

					?>	

								
					<li>
					我要买 
					<span class="num_btn" onclick="adds('#num', -1);">-</span> 
					<input type="input" name="num" id="num" value="1" /> 
					<input type="hidden" name="act_type" id="act_type" value="<?php echo $act_type;?>" />
					<span  class="num_btn" onclick="adds('#num', 1);">+</span>
					 <input type="hidden" name="pays" id="pays2" value="2" checked /> 
					&nbsp;&nbsp;&nbsp;&nbsp;<span class="a_org">热销中，请尽快抢购！</span>
					</li> 
					</ul>
			
			</div>
			<input type="hidden" name="id" value="<?php echo $this->item['id'];?>" />
			<input type="hidden" name="attr" value="" />
			<input type="hidden" name="img" value="" />
			<input type="hidden" name="price" value="<?php echo Utility::price_format($this->item['shop_price']);?>" />
 

			<div onclick="add_cart.submit();" class="a_tobuy" id="addcart"  title="马上购买">
			立即购买
			</div>
			<div class="a_tofaver" title="加入收藏" onclick="addFav(<?php echo $this->item['id'];?>)" id="collect" />加入收藏</div>
	 
 
			</form>


			</div>
			<div id="proping">
			<?php if( $this->item['postnum']>0 ){ ?>
			已有 <?php echo $this->item['postnum'];?> 人评价&nbsp;
			<?php }else{ ?>
			<img align="left" src="<?php echo $baseurl;?>/images/ping.gif"> 
			<?php } ?>
			<a class="c-orange" href="#evaluation">查看评论</a> 
			<a class="c-orange" href="#consulting">购买咨询</a>
			</div>

			<div class="span_share">
				<b>分享到：</b>
				<a class="a_share share_sina" title="分享到新浪微博" href="http://v.t.sina.com.cn/share/share.php?url=<?php echo $c_uri;?>" target="_blank">新浪微博</a>
				<a class="a_share share_qzone" title="分享到Qzone" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php echo $c_uri;?>" target="_blank">Qzone</a>
				<a class="a_share share_qq" title="分享到腾讯微博" href="http://v.t.qq.com/share/share.php?url=<?php echo $c_uri;?>" target="_blank">腾讯微博</a>
				<a class="a_share share_baidu" title="分享到百度搜藏" href="http://cang.baidu.com/do/add?iu=<?php echo $c_uri;?>" target="_blank">百度搜藏</a>
				<a class="a_share share_taojh" title="分享到淘江湖" href="http://share.jianghu.taobao.com/share/addShare.htm?url=<?php echo $c_uri;?>" target="_blank">淘江湖</a>
				<a class="a_share share_kaixin" title="分享到开心网" href="http://www.kaixin001.com/repaste/bshare.php?rurl=http://www.mbaobao.com/pshow-1106037220.html&amp;rtitle=格力好空调" target="_blank"><!-- 注意此处开心网的rurl 后地址不带http:// -->开心网</a>
				<a class="a_share share_renren" title="分享到人人网" href="http://share.renren.com/share/buttonshare.do?link=<?php echo $c_uri;?>" target="_blank">人人网</a
				>
				<a class="a_share share_douban" title="分享到豆瓣" href="http://www.douban.com/recommend/?url=<?php echo $c_uri;?>&amp;comment=格力在线！">豆瓣</a>
				<a class="a_share share_baishh" title="分享到搜狐白社会" href="http://bai.sohu.com/share/blank/addbutton.do?link=<?php echo $c_uri;?>" target="_blank">搜狐白社会</a>
			</div>
		</div>


	<?php $links = $model->getLink($this->item['id']); ?>
 	<h3 class="pdtitle1">最佳拍档</h3>
	<div id="pdmore">
		<dl>
			<dt><img src="<?php echo $this->item['thumbnail'];?>" width="80" height="80" /></dt>
			<?php foreach( $links as $k=>$v ){ 
					$link = Router::_( ProductsHelperRoute::getProductRoute($v['id'],$v['catid']) );	
			?>
			<dd <?php echo ($k==0?'class="addpaid"':''); ?>>
				<a href="<?php echo $link; ?>" target="_blank" ><img src="<?php echo $v['thumbnail'];?>" width="80" height="80" /></a>
				<h5><input type="checkbox" name="paid" class="paid"  <?php echo ($k==0?'checked=true':''); ?> mp="<?php echo $v['market_price'];?>" sp="<?php echo Utility::price_format($v['shop_price']);?>" id="<?php echo $v['id'];?>" /> <?php echo $v['name'];?></h5>
				<p><span class="price"><?php echo Utility::price_format($v['shop_price']);?></span></p>
			</dd>
			<?php } ?>
		</dl>
		<div id="pdtext">
			<p class="dashed"><span id="combin" >2</span>件商品组合购买</p>
			<p>
				总定价：<s>￥<span id="cmp" ><?php echo Utility::price_format($links[0]['market_price']+$this->item['market_price']);?></span></s><br />
				格力价：<span class="price" id="csp"  ><?php echo Utility::price_format($links[0]['shop_price']+$this->item['shop_price']);?></span><br/>
				<a href="javascript:addCart();" class="buygroup">购买本组拍档</a>
			</p>
		</div>
	</div>

	<div class="clr" ></div>
	<a name="pdins"></a>


		<div id="pt-content">
			<a name="pdins"></a>
			<ul id="dplab" >
				<li class="now"><a href="#pdins">详情介绍</a></li>
				<li ><a href="#pdargs">商品参数</a></li>
				<li><a href="#packing" >包装清单</a></li>
				<li><a href="#evaluation" >产品评价</a></li>
				<li><a href="#consulting" >购买咨询</a></li> 
			</ul>
			

			<div class="dpcons">
 				<?php
				//产品详细信息
				echo $this->item['fulltext'];
				?>
 			</div>
			<div class="dpcons"><a name="pdargs" ></a>
				<h2 class="ptboxh2">产品参数</h2>

				<?php

	 
				if( count($attr)>0 ){
					?>
	 
					<table class="param"  >
					<?php
					foreach( $attr as $a ){
						?>
						<tr>
							<td class="t" ><?php echo $a['attr_name'];?>:</td>
							<td><?php echo str_replace("\n","<br/>",$a['attr_value']);?></td>
						</tr>
						<?php
					}
					?>
					</table>
		 
				<?php
				}
				?>



			</div>
			<div class="dpcons"><a name="packing" ></a>
				<h2 class="ptboxh2">包装清单</h2>
				<div  >
				<?php 
				if( $this->item['packaging'] ){
					echo $this->item['packaging'];
			}else{
				?>
				<div class="noping" align="center" >无相关清单.</div>
				
				<?php } ?>
				</div>
			</div>
			<div class="dpcons"><a name="evaluation" ></a>
                <h2 class="ptboxh2">产品评价</h2>
				
 
                <table width="100%" cellspacing="0" cellpadding="0" border="0" id="reviwtab">
                    <tr>
                        <td width="100"><span class="bold20">95%</span><br/>好评度</td>
                        <td width="200">
                            <p>好评 <span id="progress1"></span></p>
                            <p>中评 <span id="progress2"></span></p>
                            <p>差评 <span id="progress3"></span></p>
                        </td>
                        <td style="text-align:right;">如果您买过此商品,可以参加评论<br/><a href="/?com=users&view=evaluation&a=r&product_id=<?php echo $this->item['id'];?>" target="_blank"><img src="<?php echo $baseurl;?>/images/btn7.gif" /></a></td>
                    </tr>
                </table>

				<div id="reviewlist" >
                
				</div>
				<div id="reviewpage" >
				</div>
			</div>
			<div class="dpcons"><a name="consulting" ></a>
                <h2 class="ptboxh2">购买咨询</h2>
				<div class="scrip_box" >

				<div id="show_comments">
				<div style="text-align: center;"> 暂无咨询 </div>
				</div>

				<form id="commentForm" name="commentForm" method="post" onsubmit="submitComment(this)" action="javascript:;">
					<ul class="wenti_box">
					  <li>你有什么购买问题及产品意见？</li>
					  <li>
						<textarea rows="" cols="" id="goods_question_contens_box" name="content" class="wenti_input"></textarea>
					  </li>
					  <li>
						<input type="submit" value="" name="" class="wenti_btn"> 
						<?php
						if( $app->uid < 1 ){
							?>
							&nbsp; > <a href="/?com=users" target="_blank" >会员登陆</a>
							<?php
						}
						?>
 					</li>
					</ul>
				  </form> 
				</div>
			</div>


 
		</div>



</div>
<div class="fright190">
 
<?php
$modules	=& ModuleHelper::getModules('right');
foreach($modules as $item)
{
	echo ModuleHelper::renderModule($item);
}
?>
</div>

<script language="javascript" >
var market_price = <?php echo $this->item['market_price'];?>;
var shop_price = <?php echo $this->item['shop_price'];?>;
var id = <?php echo $this->item['id'];?>;
</script>
<SCRIPT src="<?php echo $baseurl;?>/js/base.js" type="text/javascript"></SCRIPT>
<SCRIPT src="<?php echo $baseurl;?>/js/163css.js" type="text/javascript"></SCRIPT>
<script src="<?php echo $baseurl;?>/js/jquery.progressbar.js" type="text/javascript"></script>
<SCRIPT src="<?php echo $baseurl;?>/js/product.js" type=text/javascript></SCRIPT>