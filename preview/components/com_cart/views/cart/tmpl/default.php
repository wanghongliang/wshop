<?php
//基本URL信息
$baseurl = '/'.$GLOBALS['config']['preview_directory'].'/'.URI_DIRECTORY.'/'.$app->getTemplate();
require_once ($app->getPreviewComponentPath().DS.'com_products'.DS.'helpers'.DS.'route.php');

$ms = $cart->getMerchandises();
 
 
?>
<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>/style/order.css" />

<div id="header" style="background:none;">
	<?php
	$module	=& ModuleHelper::getModule('mod_logo');
	echo ModuleHelper::renderModule($module); 
	?> 
	<ul id="car-lab">
		<li style="color:#fff;">1、我的购物车</li>
		<li>2、填写并核对订单</li>
		<li>3、成功提交订单</li>
	</ul>
</div>

<div class="clr" ></div>
		<div class="atbei">
			<strong>商品清单:</strong>
			请按照配送地址，选择您的商品，我们将按照配送地址，来分配订单，一个地址生成一个订单。
		</div>
		<script type="text/javascript">
			//购买件数加减计算
			function addsd(obj, num){

			
				var vals = $(obj).parents().children('.num').val();
				vals = vals -1 + num + 1; 

				

				
					
				if(vals >= 1){
					$(obj).parents().children('.num').val(vals); 
		
					var k = $('.key',obj.parentNode).val();
					$.get('?com=cart&act=modifynumber&k='+k+'&v='+vals,function(data){

						
						var price = $('.price',obj.parentNode).val();
						var dop = $('.deposit',obj.parentNode).val();
	

						var total = '￥'+(price * vals);
						//total += '<div>预付 ￥'+(dop * vals )+'</div>';
						$('.car_tl',obj.parentNode.parentNode).html( total)


					   var num = 0, total = 0, n=0 , dop=0;
						$('.num').each(function(k,obj){
							n = parseInt( $(obj).val() );
							 
							num += n;
							total += ( parseInt( $('.price',obj.parentNode).val() ) * n );
							dop += ( parseInt( $('.deposit',obj.parentNode).val() ) * n );
						}); 
						
						$('.total_num').html(num);
						$('.total_price').html(total);
						$('.total_doposit').html(dop);
					});
				}else{
					alert('产品数量必须大于0');
					return false;
				}
			}
			</script>
		<table width="100%" cellspacing="0" cellpadding="0" border="0" id="car-tab">
			<tr>
				<th >商品名称</th> <th>单 价</th><th>商品数量</th><th>小 计</th><th>删除商品</th>
			</tr>
			<?php
			if( count($ms)>0 ){

				$total = 0;
				$total_price = 0;


 				$total_pays = 0;
				foreach( $ms as $k=>$v ){
					$price = Utility::price_format($v['info']['price']);	//价格
					$sub_total_price = $price * $v['number'];	//小结
					$total += $v['number'];	//总数量
					$total_price += $sub_total_price; //总价格


					$deposit = Utility::price_format($v['attr']['price']);	//价格
					$sub_total_p = $deposit * $v['number'];	//小结
 					$total_pays += $sub_total_p; //总价格
			?>
				<tr> 
					<td class="car-img" valign="middle">
					<div class="img" >
					<img width="60"  src="<?php echo $v['info']['thumbnail'];?>">
					</div>
					<a href="<?php echo Router::_( ProductsHelperRoute::getProductRoute($v['info']['id'],$v['info']['catid']) );?>" target="_blank" >
					 <?php echo $v['info']['name'];?>
					 </a>
					 <div class="attr_param" >
					 <?php
					 echo $v['attr']['params'];
					 ?>
					 </div>

					 </td>
 
					<td  align="center" class="d70034">
						￥<?php echo Utility::price_format($price);?> 
						<div >
							<?php
							 if( $v['attr']['pays'] == 1 ){
							?>
								预付 ￥<?php echo $deposit;?>
							<?php }else{ ?>
							 
							<?php } ?>
						</div>
					</td>


					<td  align="center"> 

					<?php 
						//是否为秒杀活动，如果是的话，将不能改变当前数量
						if( $v['attr']['act_type'] == 3 ){
					?>
						<?php echo $v['number'];?>
					<?php }else{ ?>
					<span  onclick="addsd(this, -1);">-</span> 
					<input type="text"  class="num" value="<?php echo $v['number'];?>" name="qty_<?php echo $k;?>" /> 
					<span onclick="addsd(this, 1);">+</span> 
					<?php } ?>

					<input type="hidden" name="key" class="key"  value="<?php echo $k;?>" />
					<input type="hidden" name="price" class="price"  value="<?php echo $price;?>" />
					<input type="hidden" name="deposit" class="deposit"  value="<?php echo $deposit;?>" />
					</td>

 					<td  align="center" class="car_tl">
						￥<?php echo Utility::price_format($sub_total_price);?>
						<div >
							<?php
							 if( $v['attr']['pays'] == 1 ){
							?>
								预付 ￥<?php echo $sub_total_p;?>
							<?php }else{ ?>
							 
							<?php } ?>
						</div>
					</td>
					


					<td  align="center">
						<a	 href="index.php?com=cart&act=delete&amp;id=<?php echo $k;?>">
							<span class="del" >删除</span>
						</a>
					</td>
				</tr>

			<?php
				}

			?>
			<tr>
				<td colspan="8" class="car-total">
				<div align="right" style="margin: 10px;">
				商品数量总计： <span class="total_num" ><?php echo $total; ?></span> &nbsp;&nbsp;&nbsp;&nbsp;
				商品金额总计： ￥<span class="total_price" ><?php echo Utility::price_format($total_price);?></span>&nbsp;&nbsp;&nbsp;&nbsp;

				预付金额： ￥<span class="total_doposit" ><?php echo Utility::price_format($total_pays);?></span>
				</div>
				</td>
			</tr>
			</table>
			<div id="cart-btn">
				<a href="/" title="继续购物"><img src="<?php echo $baseurl;?>/images/goshop.gif" /></a> &nbsp;&nbsp; 
				<a href="index.php?com=cart&act=checkout" title="去结算"><img src="<?php echo $baseurl;?>/images/orders.gif" /></a>
			</div>
			<?php
			}else{ 
				?>
				<tr>
					<td colspan="8" >
						<div style="height: 60px; text-align: center; line-height: 60px; font-size: 16px; font-weight: bold; font-family: microsoft yahei;">购物车没有商品,<a href="/" style=" font-size:12px; color:red;font-weight:normal;text-decoration:underline;" >去添加商品</a>.</div>
					</td>
				</tr>
				</table>
					<div id="cart-btn">
					</div>
				<?php

			}?> 

		<div class="elite_shop_poducts" >
			<div class="t" >
			<h3 class="active" >新品快递</h3>
			<h3 >浏览历史</h3>
			</div>
			<div class="bod" > 
			<ul id="pbod" ><li>
	
		<?php
 
		//相关推荐产品
		$list = $model->getEliteProducts(); 
 
		foreach( $list as $row )
		{
			$img = $row['thumbnail'];
			$link = Router::_( ProductsHelperRoute::getProductRoute($row['id'],$row['catid']) );
			//$name = String::substr($row['title'],0,12);

			echo '<dl class="hpbox">';
			echo '<dt class="good-img"><a href="'.$link.'"  target=_blank ><img src="'.$img.'" width="120" height="120" alt="" /></a></dt>';

			echo '<dt><a href="'.$link.'"  target=_blank >'.String::substr($row['name'],0,16).'</a></dt>';
			echo '<dd class="good-price"><span class="price" >'.Utility::price_format($row['shop_price']).'</span></dd>';
			echo '</dl>';
		}
		?>
		</li>

		<li style="display:none" >
		<?php

		//相关推荐产品
		$history = $model->getHistory(); 
 
		foreach( $history as $row )
		{
			$img = $row['thumbnail'];
			$link = Router::_( ProductsHelperRoute::getProductRoute($row['id'],$row['catid']) );
			//$name = String::substr($row['title'],0,12);

			echo '<dl class="hpbox">';
			echo '<dt class="good-img"><a href="'.$link.'"  target=_blank ><img src="'.$img.'" width="120" height="120" alt="" /></a></dt>';

			echo '<dt><a href="'.$link.'" target=_blank >'.String::substr($row['name'],0,16).'</a></dt>';
			echo '<dd class="good-price"><span class="price" >'.Utility::price_format($row['shop_price']).'</span></dd>';
			echo '</dl>';
		}
		?>
		</li>
		</ul>
		<div class="clr" ></div>
			</div>
		</div>


	<?php
	$item	=& ModuleHelper::getModule('mod_copyright');
	echo ModuleHelper::renderModule($item);
	?> 

 
 
 <script language="javascript" >
 function editNumber(){
	$('#cartform').submit();
 }

 function balance(){
 	if( $('.input_02').length>0 ){
		location.href="index.php?com=cart&act=checkout";
	}else{
		alert('购物车为空');
	}
 }

 $('.elite_shop_poducts h3').hover(function(){
		$('.elite_shop_poducts h3').removeClass('active');
		$(this).addClass('active');
		var index = $(this).index('.elite_shop_poducts h3');
		$('#pbod li').stop(true, true).hide();
 		$('#pbod li').eq(index).stop(true, true).show();
 },function(){
	 
 });
 </script>

 <?php

 return;
 /***
 ?>
 <table width="670" cellspacing="0" cellpadding="0" border="0" align="center">
				<tbody><tr>
					<td height="46" align="center">
						<a href="javascript:editNumber();"><span class="edit_number" >修改订购数量</span></a>　
						
						<a   href="index.php?com=cart&act=empty">
 							<span class="empty" >清空购物车</span>
						</a>
					</td>
					<td width="100" align="center"><a href="javascript:balance()"><img alt="结算" src="/preview/templates/default/images/btn_balance.jpg"></a></td>
				</tr>
			</tbody>
			</table>
<?php 
***/
?>