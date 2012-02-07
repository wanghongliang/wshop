<?php
//省市分类
$province = $this->get('province');
?>
 
<div class="right_top" >
<h2  >收货地址管理</h2><span class="goon_btn"><a title="首页" href="./" style="color: rgb(255, 255, 255);">继续购物</a></span>
</div>
	<?php
	$msg = $app->getMsg(); 
	if( $msg )
	{  echo $msg; 
	}  
	?>

<div class="ubox">
	<h3 class="utitle2">现有收货地址</h3> 

	<?php
	$rows = &$lists['rows'];

	if( ( $n= count($rows) ) > 0 ){
		?>
		<ul class="ul_addr" >
		<?php
		foreach( $rows as $k=>$row ){
			?>
			<li class="<?php if( $n-1>$k){ echo 'bt';} if( $row['defaulted'] == '1' ){ echo ' lidef'; } ?>" >
				<div class="number" ><?php echo $k+1;?>,</div>
				<div class="p" >
				<?php
				/**
				<p>收&nbsp;货&nbsp;人：<?php echo $row['consignee'];?></p>
				<p>地　　区：<?php echo $row['proname'];?>><?php echo $row['citname'];?></p>
				<p>地　　址：<?php echo $row['goods_address'];?></p>
				<p>邮　　编：<?php echo $row['zipcode'];?></p>
				<p>联系电话：<?php echo $row['tel'];?></p>
				<p>手机短信：<?php echo $row['goods_mobile'];?></p>
				<p>电子邮件：<?php echo $row['email'];?></p>

				**/
					echo $row['consignee'];
					echo ' , ';
					echo $row['proname'];
					echo ' ';
					echo $row['citname'];
					echo ' ';
					echo $row['goods_address'];
					echo ' , ';
					echo $row['zipcode'];
					echo ' , ';
					echo $row['goods_mobile'];

					echo $row['tel'];
				?>

				</div>

				<div class="btn" >
					
					<input name="btn_alterDefault" id="btn_alterDefault" class="button_delete" value="[修改]" addid="<?php echo $row['address_id'];?>" operate="bindselected" onclick="javascript:event.cancelBubble=true;setAddressValue(this)" type="button">
					<input name="btn_deleteDefault" id="btn_deleteDefault" class="button_delete" value="[删除]" addid="<?php echo $row['address_id'];?>"  operate="delete" onclick="javascript:event.cancelBubble=true;PopuMess(this)" type="button">
					<?php if( $row['defaulted'] == 1 ){ ?>
					<span>默认地址</span>
					<?php }else{ ?>
					<span> 
					<a onclick="javascript:event.cancelBubble=true;SetDefaultAddress(this)"  addid="<?php echo $row['address_id'];?>" class="setdefault"  >设为默认地址</a>
					</span>
					<?php } ?>
				</div>
				<div class="clr" ></div>
			</li>
			<?php
		 
		}
		?>
		</ul>
		<a name="form" ></a>
		<div class="clr" ></div>
		<?php
	}else{
	?>
	<div style="padding:10px;" >
	您没有添加地址信息，<a href="index.php?com=users&view=address&act=new" >请添加新地址</a>
	</div>
	<?php
	}
	?>



</div>


<div id="EditorPosition" class="ubox">
<h5>
	新增/修改收货地址<span>手机、固定电话选填一项，其余均为必填</span>
</h5>

<form action="<?php echo URI::current();?>" method="post" name="addr_form" >
<div class="my_address_add_info">
	<p>
		<label>
			收货人：</label><input type="text" id="txt_ship_man" name="txt_ship_man"><span id="vaild_ship_man" class="nohint">请填写收货人姓名</span>
	</p> 
	<p>  
	<label>
	地区：</label>
		<?php
		//print_r($province);
		?>
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
	</p>
	<p>
		<label>
			街道地址：
		</label>
			<input type="text" size="50" id="txt_addr_detail" name="txt_addr_detail">
			<span  id="valid_addressdetail" class="nohint">请填写街道地址</span>
	</p>

	<p>
		<label>
			邮政编码：
		</label>
			<input type="text" id="txt_ship_zip" name="txt_ship_zip">
			<span class="teltip">正确的邮编有助于加快送货速度</span>
			<span id="vaild_shipzip" class="nohint">&nbsp;&nbsp;&nbsp;请填写您的邮编 </span>
	</p>

	<p>
		<label>
			手机：
		</label>
		<input type="text" id="txt_ship_mb" name="txt_ship_mb">
		<label>或者 固定电话</label><input type="text" id="txt_ship_tel" name="txt_ship_tel">
		<span id="vaild_tel" class="nohint">请填写手机号码或固定电话 请选填至少一项</span>
	</p>

	<p class="address_add_checkbox">
		<input type="checkbox" id="check_default" name="check_default" value="1" >
		<span>设为默认地址</span>
	</p>

	<p class="address_add_btn">
		<button class="u_btn2" onclick="return saveaddress()">
			保存
		</button>
		<input type="hidden" name="act" value="save" />
		<input type="hidden" name="address_id" id="address_id"  value="0" />
		<span id="span_savemsg" class="nohint"></span>
	</p>

	<p class="address_ajax_info">

	</p>
</div>

</form>


</div>

<script language="javascript" >
	var url_current ='<?php echo URI::current();?>';
 	$(function(){ 
 
	});

	function setAddressValue(obj){
		var id = $(obj).attr('addid');
		$.get('index.php?com=users&view=address&act=get&no_html=1&id='+id,function(data){
			//$(".address_ajax_info").html(data);
			var json_obj = eval("("+data+")");
			//alert(json_obj);
			$('#txt_ship_man').val(json_obj.consignee);
			$('#province').val(json_obj.province);
			//$('#city').val(json_obj.city);
			var province = parseInt(json_obj.province);
			setCity(province,'chinacomcity');
			$('#chinacomcity').val(json_obj.city);
			$('#txt_addr_detail').val(json_obj.goods_address);
			$('#txt_ship_zip').val(json_obj.zipcode);
			$('#txt_ship_mb').val(json_obj.goods_mobile);
			$('#txt_ship_tel').val(json_obj.tel);
			$('#address_id').val(json_obj.address_id);

			if( json_obj.defaulted == '1' ){ $('#check_default').get(0).checked=true; }else{
				$('#check_default').get(0).checked=false;
			}
			location.href='#form';

		});
	}

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