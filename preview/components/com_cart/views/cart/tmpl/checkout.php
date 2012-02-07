<?php

//当前送货的地区
$defaultArea = array();

$baseurl = '/'.$GLOBALS['config']['preview_directory'].'/'.URI_DIRECTORY.'/'.$app->getTemplate();

$province = $this->get('province');
require_once ($app->getPreviewComponentPath().DS.'com_products'.DS.'helpers'.DS.'route.php');
?>
<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>/style/order.css" />


<div id="header" style="background:none;">
	<?php
	$module	=& ModuleHelper::getModule('mod_logo');
	echo ModuleHelper::renderModule($module); 
	?> 
	<ul id="car-lab1">
		<li>1、我的购物车</li>
		<li style="color:#fff;">2、填写并核对订单</li>
		<li>3、成功提交订单</li>
	</ul>
</div>
 
 

<div id="pcontent" >
	<div class="pad10">
		<strong>收货人信息:</strong>请填写收货人信息，然后提交订单。
	</div>
	<div class="or-content">
		<h3 class="ortitle">收货人信息&nbsp;&nbsp; <a style="font-size:12px;font-weight:normal;"  href="/index.php?com=users&view=address" name="selectaddr" >管理收货地址</a></h3> 
 		<form action="/index.php?com=cart&act=checkoutsubmit" method="post" id="checkform" >
		<?php
		foreach( $address as $k=>$v ){

		?><p>
		<input type="radio" name="adr" class="adr" value="<?php echo $v['address_id'];?>" addr="<?php echo "1,",$v['province'],",".$v['city'];?>" <?php 
			if( $v['defaulted'] == '1' ){ echo ' checked="true" '; $defaultArea=array(1,$v['province'],$v['city']); } 
		?> /> 
		<label for="adr1">
		<?php
			echo $v['consignee'];
			echo ' , ';
			echo $v['pname'];
			echo ' ';
			echo $v['cname'];
			echo ' ';
			echo $v['goods_address'];
			echo ' , ';
			echo $v['zipcode'];
			echo ' , ';
			echo $v['goods_mobile'];

			echo $v['tel'];
		?>
		 
		</label> &nbsp;&nbsp;&nbsp;&nbsp;
	 
		</p>
		<?php
		}
		?>

		
		<p>
			<input type="radio" name="adr" id="adr2" value="new"  <?php if( count($address) == 0 ){ ?> checked <?php } ?> /> <label for="adr2">使用新地址</label>
		</p>
		<div class="ardiv" <?php if( count($address)<1 ){ ?> style="display:block;" <?php } ?> >
			<table width="100%" cellpadding="0" cellspacing="10" border="0" class="ortab">
				<tr>
					<th width="100">收货人：</th>
					<td>
					<input type="text" id="txt_ship_man" name="txt_ship_man">
					<span id="vaild_ship_man" class="nohint">请填写收货人姓名</span>
					</td>
				</tr>
				<tr>
					<th>地 区：</th>
					<td>
					<select id="province"  class="inputh input_require" name="province" onchange="setCity(this.value,'chinacomcity');" >
						<option value="">--请选择省份--</option>
						<?php

						$cCity = array();
						foreach( $province as $p ){	
							
							if( $item['province']>0 && $item['province'] == $p['parent_id'] ){
								$cCity[] = $p;
							}
							if( $p['parent_id']>1 ){ continue;}
							?>
							<option value="<?php echo $p['id'];?>"
							
							<?php
							if( $p['id'] == $item['province'] ) echo ' selected ';	

						
							?>
							><?php echo $p['name'];?></option>
							<?php
						}
						?>
						</select>
						

						<?php
						//print_r($cCity);
						?>
						<select  name="city" class="inputh" id="chinacomcity">
							
							<option value="">请选择城市</option>
							<?php 
							if( count($cCity) > 0 ){
								foreach( $cCity as $c ){
								?>
								<option value="<?php echo $c['id'];?>"
								
								<?php
								if( $c['id'] == $item['city'] ) echo ' selected ';	

							
								?>
								><?php echo $c['name'];?></option>
								<?php
								}
							}
							?>
						</select>
						<span  id="vaild_province" class="nohint">请选择地区</span>
					</td>
				</tr>
				<tr>
					<th>街道地址：</th>
					<td>
					<input type="text" size="50" id="txt_addr_detail" name="txt_addr_detail">
					<span  id="valid_addressdetail" class="nohint">请填写街道地址</span>
					</td>
				</tr>
				<tr>
					<th>邮 编：</th>
					<td>
					<input type="text" id="txt_ship_zip" name="txt_ship_zip">
					<span class="teltip">正确的邮编有助于加快送货速度</span>
					<span id="vaild_shipzip" class="nohint">&nbsp;&nbsp;&nbsp;请填写您的邮编 </span>

					</td>
				</tr>
				<tr>
					<th>手 机：</th>
					<td>
					<input type="text" id="txt_ship_mb" name="txt_ship_mb">
					<label>或者 固定电话</label><input type="text" id="txt_ship_tel" name="txt_ship_tel">
					<span id="vaild_tel" class="nohint">请填写手机号码或固定电话 请选填至少一项</span>
					</td>
				</tr>

				<tr>
					<th> </th>
					<td id="saddr" >
					<input type="button" onclick="submitAddress();" value=" 确认新地址 " />
					</td>
				</tr>
			</table>
		</div>
	


		<script type="text/javascript">
			$(function(){
				$('input[name="adr"]').click(function(){
					var vals = $(this).val();
					if(vals == 2){
					    $('.ardiv').stop(true, true).show();
					}else{
					    $('.ardiv').stop(true, true).hide();
					}
				});
			});
		</script>




<?php //////////////货运方式和货运费用,不同的货运地区有些不同///////////////////// ?>

<h3 class="ortitle">送货方式：</h3>
	
<div id="postage_way" >
		<table cellspacing="0" cellpadding="0" border="0" width="100%" class="paytab" >
        <tbody> 
 		<?php
		
		//货运方式
		$shipping = $this->get('shipping');
		$shipping_free = 0; //当前的货运费用
		$i=0;
		foreach( $shipping as $k=>$row ){
			$free = 0;
			$v  = $row[0];

			//相关配置项
			$cg = unserialize($v['cg']);
	
			//指定配送地区和费用
			if( $cg['setting'] == 'setting_sda' ){
				//查找配置的地区价格
				foreach( $row as $x=>$y ){
					$aids = explode(',',$y['areaid_group']); 
					//找到后计算价格
					if( in_array( $defaultArea[2],$aids ) || in_array( $defaultArea[1],$aids ) || in_array( $defaultArea[0],$aids ) ){
						$config = unserialize($y['config']);
						$free = $config['firstFee'];
					}
				}

				//是否设定当前城市的货运价格
				if( $free == 0 ){  
					if( $cg['defAreaFee'] != 1 ){ continue; }
					$free = $cg['firstprice']; 
 				 }
			}else{
				$free = $cg['firstprice'];
			} 
		?>

		<tr>
		  <td align="left" width="24%" valign="middle">
			<input type="radio"   onclick="selectShipping(this)" <?php if( $i++==0 ){ $shipping_free=$free; echo ' checked '; } if( $v['has_cod']==1 ){ echo ' has_cod=1 '; }?>  value="<?php echo $v['id'];?>" name="shipping"  > <b>
			<label for="wangyin"><?php echo $v['name'];?></label> 
			</b>
			</td>
		  <td align="left" width="38%" valign="middle"><?php echo $v['desc'];?>	</td>
		  <td align="left"  valign="middle">费用： <font style="color:red;font-size:14px;" > <span class="price" ><?php echo Utility::price_format($free);  ?></span> 元</font></td>
		</tr> 
		<?php } ?> 
      </tbody>
</table>
</div>


 <?php /////////////////////////////////// ?>

		<h3 class="ortitle">支付方式：</h3>
		<p>



<table cellspacing="0" cellpadding="0" border="0" width="100%" class="paytab" >
        <tbody>  
 		<?php  
 		foreach( $payments as $k=>$v ){
			if( $v['id'] == 1 ){ 
		?>

		<tr class="out" style="display:none;" >
		  <td align="left" width="24%" valign="middle"><b>
			<input type="radio" class="sradio" onclick="selectPayment(this)" <?php if( $k==0 ){ echo ' checked '; } ?>  value="<?php echo $v['id'];?>" id="<?php echo $v['element'];?>" name="payment" > 
			<?php if( !empty($v['params']['logo']) ){ ?>
			<img src="<?php echo $v['params']['logo'];?>" width=133 />
			<?php }else{ ?>
			<label for="wangyin"><?php echo $v['name'];?></label>
			<?php } ?>
			</b>
			</td>
		  <td align="left" width="88%" valign="middle"><?php echo $v['params']['desc'];?></td>
		</tr> 


		<?php 
			}else{
		?>

		<tr  class="on"  >
		  <td align="left" width="24%" valign="middle"><b>
			<input type="radio" class="sradio" onclick="selectPayment(this)" <?php if( $k==0 ){ echo ' checked '; } ?>  value="<?php echo $v['id'];?>" id="<?php echo $v['element'];?>" name="payment" > 
			<?php if( !empty($v['params']['logo']) ){ ?>
			<img src="<?php echo $v['params']['logo'];?>" width=133 />
			<?php }else{ ?>
			<label for="wangyin"><?php echo $v['name'];?></label>
			<?php } ?>
			</b>
			</td>
		  <td align="left" width="88%" valign="middle"><?php echo $v['params']['desc'];?></td>
		</tr> 


		<?php
			}
		} ?> 
      </tbody>
</table>


		</p>

<?php /////////////////////////////////// ?>



		<h3 class="ortitle">购物清单：</h3>
 		<table width="100%" cellspacing="0" cellpadding="0" border="0" class="checkout-tab">
			<tr>
				<th colspan="2">商品名称</th><th>支付方式</th><th>单 价</th><th>商品数量</th><th>小 计</th> 
			</tr>
			<?php
			if( count($ms)>0 ){
				$total = 0;
				$total_price = 0;


 				$total_pays = 0;
				foreach( $ms as $k=>$v ){
					$price = Utility::price_format($v['info']['price']);	//价格
					$sub_total_price = Utility::price_format($price * $v['number']);	//小结
					$total += $v['number'];	//总数量
					$total_price +=  $sub_total_price; //总价格


					$deposit = Utility::price_format($v['attr']['price']);	//价格
					$sub_total_p = $deposit * $v['number'];	//小结
 					$total_pays += $total_price; //总价格
			?>
				<tr> 
					<td class="car-img" width="80">
						<div class="img" >
							<img width="60"  src="<?php echo $v['info']['thumbnail'];?>">
						</div>
					</td>
					<td>
						<a href="<?php echo Router::_( ProductsHelperRoute::getProductRoute($v['info']['id'],$v['info']['catid']) );?>" target="_blank" >
						 <?php echo $v['info']['name'];?>
						 </a>
						 <div class="attr_param" >
						 <?php
						 echo $v['attr']['params'];
						 ?>
						 </div>
					 </td>
					
					<td>
						<?php
						 if( $v['attr']['pays'] == 1 ){
						?>
						先付定金
						<?php }else{ ?>
						全额付款
						<?php } ?>
					 </td>

					<td>
						￥<?php echo $price;?>

						<div >
							<?php
							 if( $v['attr']['pays'] == 1 ){
							?>
								预付 ￥<?php echo $deposit;?>
							<?php }else{ ?>
							 
							<?php } ?>
						</div>
					</td>


					<td> 
					<?php echo $v['number'];?> 
					</td>

 					<td>
						￥<?php echo $sub_total_price;?>
						<div >
							<?php
							 if( $v['attr']['pays'] == 1 ){
							?>
								预付 ￥<?php echo $sub_total_p;?>
							<?php }else{ ?>
							 
							<?php } ?>
						</div>
					</td> 
				</tr>

			<?php
				}
			}else{ 

			}?> 
			<tr>
				<td colspan="8" class="car-total">
				<div align="right" style="margin: 10px;">
				商品数量总计： <?php echo $total; ?> &nbsp;&nbsp;&nbsp;&nbsp;
				商品金额总计： ￥<?php echo Utility::price_format($total_price);?> 
				</div>
				</td>
			</tr>

			<tr>
				<td colspan="8" class="total" >
				<div align="right" style=" font-size:14px; "  >
				商品金额：<font color="red" >￥<span id="pprice" ><?php echo Utility::price_format($total_pays);?></span>元</font> + 运费：<font color="red"  >￥<span id="freeprice" ><?php echo Utility::price_format($shipping_free);?></span>元</font> = 
				<?php /**if( ($total_price-$total_pays)!=0 ){ ?>
					货到付余款: <font style="font-size:18px;color:red;" >￥<?php echo Utility::price_format($total_price-$total_pays);?>元</font>
				<?php } **/?>
					应付总额：￥<span style="font-size:20px; color:red; " id="totalprice" ><?php echo Utility::price_format($total_pays+$shipping_free);?></span> 元 
				</td>

			</tr>
			
		</table>
 	</div>

	<div class="btndiv">
		<input type="button" onclick="submitOrder()" value="确认订单" class="orbtn"/> 
		<div class="subremark" >
		请仔细核对以上信息后，点击“确认订单”
		</div>
	</div>

	</form>
	<?php
	$item	=& ModuleHelper::getModule('mod_copyright');
	echo ModuleHelper::renderModule($item);
	?> 
</div>
 
 <script language="javascript" >
$(function(){
	$('#adr2').click(function(){
		$('.ardiv').show();
	});


	$('.adr').click(function(){
		loadPostage($(this).attr('addr'));
		
	});
 });


 
 //提交订单信息
 function submitOrder(){

	 //检测是否用新的地址
	if( $('#adr2').get(0).checked ){
		if( !check() ){
			location.href="#selectaddr";
			alert(' 请填写您的新地址信息，谢谢. ');
			return false;
		}
	}

	alert(' 提交成功 .. ');
	$('#checkform').submit();
 }

 //提交新地址
 function submitAddress(){
	if( check() ){
		$('#saddr').html('<div class"addrok" >√</div>');
		$('#province').attr('readonly',true);
 
		$('#chinacomcity').attr('readonly',true);
		var addr = '1,'+$('#province').val()+','+ $('#chinacomcity').val();
		loadPostage(addr);
	}
 }

//动态加载货运方式及价格
function loadPostage(s){
	$.get('/?com=cart&act=loadpostage&no_html=1&addr='+s,function(data){
		$('#postage_way').html(data);
		selectShipping($('input[name=shipping]').get(0));
	});
}

//设置在线支付方式
function selectPayment(){
}


function selectShipping(obj){ 

	//是否为货到货款
	if( $(obj).attr('has_cod') == '1' ){
		$('.out .sradio').get(0).checked =true;
		$('.out').show();
		$('.on').hide();
	}else{
		$('.on .sradio').get(0).checked =true;
		$('.on').show();
		$('.out').hide();
	}
	var p = obj.parentNode.parentNode;
	var free = $('.price',p).html() ;
	$('#freeprice').html(  free );
	$('#totalprice').html( formatFloat( parseInt($('#pprice').html())+ formatFloat(free,2),2 ) );
}
function formatFloat(src, pos)
{
    return Math.round(src*Math.pow(10, pos))/Math.pow(10, pos);
}



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

 function save(obj){
 } 


	var url_current ='<?php echo URI::current();?>';
 	$(function(){ 
 
	});  

	function PopuMess(obj){
		var id = $(obj).attr('addid');
 		location.href='index.php?com=users&view=address&act=delete&id='+id;
	}
	function SetDefaultAddress(obj){
		var id = $(obj).attr('addid');
 		location.href='index.php?com=users&view=address&act=setdefault&id='+id;
	}
	function saveaddress(obj){
		
		if( check() ){
			addr_form.submit();
		}
		return false;
	}
	
	function check(){
		$('#vaild_ship_man,#vaild_province,#valid_addressdetail,#vaild_shipzip,#vaild_tel').hide();


		if( $('#txt_ship_man').val() == '' ){
			$('#vaild_ship_man').show();
			return false;
		} 
	 
		if( $('#province').val() < 1 ){
			$('#vaild_province').show();
			return false;
		} 

		if( $('#txt_addr_detail').val() == '' ){
			$('#valid_addressdetail').show();
			return false;
		} 

		if( $('#txt_ship_zip').val() == '' ){
			$('#vaild_shipzip').show();
			return false;
		}

		if( $('#txt_ship_mb').val() == '' && $('#txt_ship_tel').val() == ''){
			$('#vaild_tel').show();
			return false;
		}


		return true;

	}
	//市的数组
	var area=[
	<?php
		$n = count($province)-1;
		foreach( $province as $k=>$v ){
			if( $v['parent_id']>1){
				echo '['.$v['id'].',"'.$v['name'].'",'.$v['parent_id'].']';
				if( $k<$n ){ 
					echo ',';
				}
			}
		}
	?>
	];

	function setCity(id,idname)
	{
		var n=area.length;
		var select = $('#'+idname).get(0);
		select.length=0;
		var x=0;

		 
		for(i=0;i<n;i++){
			if( area[i] ){
				if( area[i][2] == id ){
					select.options[x++]=new Option(area[i][1],area[i][0]);
				}
			}
		}

		//alert(x);
		if( x==0 ){
			$(select).hide();
		}else{
			$(select).show();
		}
	}

</script>