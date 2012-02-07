<?php
//print_r($this->item);
$basepath = dirname(__FILE__);
//include($basepath.DS.'header.php');

$province = $this->get('province');
$amount = (int)$_POST['amount'];


$param = unserialize( $this->item['ext_info']);

$baseurl = '/preview/templates/'.$app->getTemplate();

?>

<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>/css/tuan.css" />





<div class="tfleft" >
	<div class="tcontent" style="width:855px;">
		<h2 class="gbt_line">
			<img src="/preview/templates/default/images/step2.gif" />
		</h2>
	
	<div class="sect" >
 


	<div class="or-content"  >
		<h3 class="ortitle">
		收货人信息&nbsp;&nbsp; 
		<a style="font-size:12px;font-weight:normal;"  href="/index.php?com=users&view=address" name="selectaddr" >
		管理收货地址
		</a>
		</h3> 

 		<form action="<?php echo $clink;?>?a=checkoutsubmit&id=<?php echo $this->item['act_id'];?>" method="post" id="checkform" >
		<?php
		$address = &$this->address;
		foreach( $address as $k=>$v ){
		?><p>
		<input type="radio" name="adr" class="adr" value="<?php echo $v['address_id'];?>" <?php if( $v['defaulted'] == '1' ){ echo ' checked="true" '; } ?> /> 
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
							
							if( $this->item['province']>0 && $this->item['province'] == $p['parent_id'] ){
								$cCity[] = $p;
							}
							if( $p['parent_id']>1 ){ continue;}
							?>
							<option value="<?php echo $p['id'];?>"
							
							<?php
							if( $p['id'] ==  $this->item['province'] ) echo ' selected ';	

						
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
	 
	</div>


	<div class="or-content">
		<h3 class="ortitle">支付方式：</h3>
		<p>

<table cellspacing="0" cellpadding="0" border="0" width="100%" class="paytab" >
        <tbody> 
		
	<tr>
      <td align="left" width="14%" valign="middle"><b>
        <input type="radio" value="radio" id="wangyin" name="payment" checked > 
        <label for="wangyin">网上银行</label>
        </b></td>
      <td align="left" width="88%" valign="middle">通过国内各大银行，官方网站在线支付平台支付。 </td>
    </tr>
 
 
  
        <tr>
      <td align="left" valign="middle"><b>
        <input type="radio" class="sradio" onclick="selectPayment(this)" iscod="0" value="5" id="radio_5" name="payment">
        <label for="radio_5">支付宝</label>
        </b></td>
      <td align="left" valign="middle">支付宝作为诚信中立的第三方机构，充分保障货款安全及买卖双方利益,支持各大银行网上支付。 </td>
    </tr>
 
        <tr>
      <td align="left" valign="middle"><b>
        <input type="radio" class="sradio" onclick="selectPayment(this)" iscod="0" value="29" id="radio_29" name="payment">
        <label for="radio_29">财付通</label>
        </b></td>
      <td align="left" valign="middle">腾讯旗下在线支付平台，支持各大银行网上支付 </td>
    </tr>
        
      </tbody></table>
		</p>
	</div>


	<div class="or-content">
		<h3 class="ortitle">送货方式：</h3>
		<p>
			同城格力服务点免费直接送货上门安装。
		</p>
	</div>



	<div class="or-content">
		<h3 class="ortitle">购物清单：</h3>
 		<table width="100%" cellspacing="0" cellpadding="0" border="0" class="checkout-tab">
			<tr>
			<th class="db_name">名称</th>
			<th class="db_quantity">数量</th>
			<th class="db_multi">&nbsp;</th>
			<th class="db_price">单价</th>
			<th class="db_equal">&nbsp;</th>
			<th class="db_total">总价</th>
		  </tr>
		  <tr>

			<td class="db_name">
				<div><?php echo $this->item['act_name'];?></div>
				<img src="<?php echo $this->item['img'];?>" width=200 />
			</td>
			<td class="db_quantity">
				<?php echo $amount;?>
			</td>
			<td class="db_multi">X</td>
			<td align="center" class="db_price">￥<?php echo $param['ladder_price'][0];?> </td>
			<td align="center" class="db_equal">=</td>
			<td class="db_total">￥
			<span id="purchase_total"><?php echo $param['ladder_price'][0]*$amount;?></span>
			</td>
		  </tr>
					 <tr>
		   <td class="db_name red line">应付总额：</td>
		   <td class="db_quantity line">&nbsp;</td>
		   <td class="db_multi line">&nbsp;</td>
		   <td class="db_price line">&nbsp;</td>
		   <td align="center" style="color: rgb(204, 0, 0);" class="db_equal line">=</td>
		   <td class="db_total red line">￥<span id="purchase_all_total"><?php echo $param['ladder_price'][0]*$amount;?></span></td>
		  </tr>
		</tbody>
	</table>
	</div>


		<input type="hidden" name="amount" value="<?php echo $amount;?>" />

		<div class="zfbox"><input type="button" onclick="submitOrder()" value="提交订单" id="" class="gdbtn grep_ok"></div>
		
	</div>
	
	</div>
</div>


<div class="cln">&nbsp;</div>

 <script language="javascript" >
$(function(){
	var c = false;
	 $('input[name=adr]').each(function(k,obj){
		 if( obj.checked ){ c= true; }
	 });

	 if( !c ){
		if( $('input[name=adr]').get(0).value == 'new' ){
			$('.ardiv').show();
		}
		$('input[name=adr]').get(0).checked = true;

	 }
	$('input[name="adr"]').click(function(){
		var vals = $(this).val(); 
		if(vals == 'new'){
			$('.ardiv').stop(true, true).show();
		}else{
			$('.ardiv').stop(true, true).hide();
		}
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
	}
 }

//设置在线支付方式
function selectPayment(){
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


<?php include($basepath.DS.'footer.php');?>
