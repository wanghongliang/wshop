<?php
//print_r($this->item);
$basepath = dirname(__FILE__);
//include($basepath.DS.'header.php');

$province = $this->get('province');
$param = unserialize( $this->item['ext_info']);
$baseurl = '/preview/templates/'.$app->getTemplate();

?>

<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>/css/tuan.css" />




<div class="tfleft">
	<div class="tcontent">
		<h2 class="gbt_line">
			<img src="/preview/templates/default/images/step1.gif" />
		</h2>
	
	<div class="sect" >
	<form action="<?php echo $clink;?>?a=sa&id=<?php echo $this->item['act_id'];?>" method="post" id="checkform" >
	<table cellspacing="0" cellpadding="0" border="0" width="100%" class="deal_buy">
		  <tbody><tr>
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
				<input autocomplete="off" class="db_input" name="amount" value="1" size="5" id="order_amount">
			</td>
			<td class="db_multi">X</td>
			<td align="center" class="db_price">￥<?php echo $param['ladder_price'][0];?> </td>
			<td align="center" class="db_equal">=</td>
			<td class="db_total">￥
			<span id="purchase_total"><?php echo $param['ladder_price'][0];?></span>
			</td>
		  </tr>
					 <tr>
		   <td class="db_name red line">应付总额：</td>
		   <td class="db_quantity line">&nbsp;</td>
		   <td class="db_multi line">&nbsp;</td>
		   <td class="db_price line">&nbsp;</td>
		   <td align="center" style="color: rgb(204, 0, 0);" class="db_equal line">=</td>
		   <td class="db_total red line">￥<span id="purchase_all_total"><?php echo $param['ladder_price'][0];?></span></td>
		  </tr>
		</tbody>
	</table>


	<?php /** 
	<dl class="flow_addr">
	<dt><b>配送信息</b>&nbsp;&nbsp;&nbsp;&nbsp;		
		<a style="font-size:12px;font-weight:normal;"  href="/index.php?com=users&view=address" name="selectaddr" target="_blank"  >
		修改
		</a>
	</dt>
	<dd>
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
		<div class="ardiv">
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
	</dd>       
  </dl>
	
   **/?>

	<div class="zfbox">
	<input type="hidden" value="<?php echo $this->item['act_id'];?>" name="id" />
	<input type="submit"  value="确认无误，购买" id="" class="gdbtn grep_ok">
	</div>
	</form>


	</div>
	
	</div>
</div>


<div class="cln">&nbsp;</div>
 

<?php include($basepath.DS.'footer.php');?>