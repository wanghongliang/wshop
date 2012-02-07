 
<form action="index.php?com=orders"  method="post"  id="menage_form"  >


<div class="order_detail_frame" style=" margin:10px 5px;border:1px solid #ddd;padding:10px;" >

 

			<table cellspacing="0" cellpadding="0" border="0" class="intab" style="width:100%;"  > 
			<tbody>
			<tr> 
			<th colspan = 2  style="text-align:left"   ><b>订单信息</b></th> 
 			</tr> 
			<tr> 
				<th >订单号：</th> 
				<td><?php echo $order_data['order_sn']; ?></td> 
			</tr> 

			<tr> 
				<th >下单日期：</th> 
				<td><?php echo $order_data['created_date'];?></td> 
			</tr>  
			<tr> 
			<th >购货人：</th> 
			<td > 
				<?php echo $order_data['username'];?>
				<input type="hidden" value="<?php echo $order_data['username'];?>" name="action_user" />
			</td> 
			</tr> 
		
			<tr> 
			<th >配送方式：</th> 
			<td> 经销商送货 </td> 
			</tr>
			<tr> 
			<th >配送费用：</th> 
			<td > 免邮 </td> 
			</tr> 
			
			<tr> 
			<th >是否保价：</th> 
			<td> 否 </td> 
			</tr>
			<tr> 
			<th >保价费用：</th> 
			<td> ￥0.00 </td> 
			</tr>
			<tr> 
			<th >退货原因：</th> 
			<td><textarea cols=30 rows=3 name="reason" ></textarea></td> 
			</tr>


 			<tr> 
			<th colspan = 2  style="text-align:left"   ><b>物流信息</b></th> 
 			</tr> 
			<tr> 
			<tr> 
			<th >物流公司：</th> 
			<td>
			<select name="shipping_name" class="x-input-select  inputstyle">
			<option value="中国邮政">中国邮政</option>
			<option value="申通快递">申通快递</option>
			<option value="圆通速递">圆通速递</option>
			<option value="顺丰速运" selected="selected">顺丰速运</option>
			<option value="天天快递">天天快递</option>
			<option value="韵达快递">韵达快递</option>
			<option value="中通速递">中通速递</option>
			<option value="龙邦物流">龙邦物流</option><option value="宅急送">宅急送</option><option value="全一快递">全一快递</option><option value="汇通速递">汇通速递</option><option value="民航快递">民航快递</option><option value="亚风速递">亚风速递</option><option value="快捷速递">快捷速递</option><option value="DDS快递">DDS快递</option><option value="华宇物流">华宇物流</option><option value="中铁快运">中铁快运</option><option value="FedEx">FedEx</option><option value="UPS">UPS</option><option value="DHL">DHL</option></select> 
			
			</td> 
			</tr>

			<tr> 
			<th >物流单号：</th> 
			<td> <input type="text" width="100"  name="shipping_sn" class="x-input " > </td> 
			</tr>

			<tr> 
			<th >物流费用：</th> 
			<td> <input type="text" width="50"  value="20.000" name="shipping_fee" class="x-input " > </td> 
			</tr>
			
			<tr> 
			<th >物流保价：</th> 
			<td>
			  <input type="radio" checked="checked" value="0" name="insure">
			  <label >否</label>
			  <br>
			  <input type="radio" value="1"  name="insure">
			  <label >是</label>
			  <br> 
			</tr> 
			<tr> 
			<th >保价费用：</th> 
			<td>  <input type="text" width="200"   value="0" name="insure_fee" id="payAccount" class="x-input "  > </td> 
			</tr>

  

			<tr> 
			<th colspan = 2  style="text-align:left"   ><b>退货人信息</b></th> 
 			</tr> 
			<tr> 
			<th >退货人：</th> 
			<td>
				<input type="text" width="100" value="<?php echo $order_data['consignee'];?>" name="consignee" class="x-input " >
			</td> 
			</tr>

 			<tr> 
			<th >电子邮件：</th> 
			<td>
				<input type="text" size="30" value="<?php echo $order_data['email'];?>" name="email" class="x-input " >
			</td> 
			</tr>

			<tr> 
			<th >地址：</th> 
			<td>
				<input type="text" size="50" value="<?php echo $order_data['goods_address'];?>" name="address" class="x-input " >
			</td> 
			</tr>

			<tr> 
			<th >邮编：</th> 
			<td>
				<input type="text" width="100" value="<?php echo $order_data['zipcode'];?>" name="zipcode" class="x-input " >
			</td> 
			</tr>

			<tr> 
			<th >电话：</th> 
			<td>
				<input type="text" width="100" value="<?php echo $order_data['tel'];?>" name="tel" class="x-input " >
			</td> 
			</tr>
			<tr> 
			<th >手机：</th> 
			<td>
				<input type="text" width="100" value="<?php echo $order_data['goods_mobile'];?>" name="mobile" class="x-input " >
			</td> 
			</tr>

			<tr>
				<th>退货单备注：</th>
				<td>
				<textarea cols=60 rows=3 name="postscript" ></textarea>
				</td>
			</tr>

			</tbody>
			</table> 


			<table width="100%"  class="ptab" cellspacing="1" cellpadding="0" border="0" style="margin-top:10px; border:1px solid #ddd; " >
				<tbody>
				<tr>
					<th height="35" bgcolor="#f2f2f2" align="center">商品号</th>
					<th height="35" bgcolor="#f2f2f2" align="center">商品名称</th>
					<th width="70" height="35" bgcolor="#f2f2f2" align="center">库存</th>
					<th width="80" height="35" bgcolor="#f2f2f2" align="center">购买数量</th>
					<th width="80" height="35" bgcolor="#f2f2f2" align="center">已发货</th>
					<th width="80" height="35" bgcolor="#f2f2f2" align="center">此单发货</th>
				</tr>
				
				<?php
				if( count($ms)>0 ){ 
					foreach( $ms as $k=>$v ){
						$price = intval($v['product_price']);	//价格 
				?>
					<tr>
						<td  height="30"  bgcolor="#ffffff" align="center">
							<?php echo $v['product_id'];?>
						</td>
						<td bgcolor="#ffffff" align="center"><?php echo $v['product_name'];?></td>
						<td></td>
						<td bgcolor="#ffffff" align="center">
							<?php echo $v['product_quanlity'];?>
						</td>
						<td bgcolor="#ffffff" align="center" >0</td>
						<td bgcolor="#ffffff" align="center" class="d70034">
							<input type="text" name="qty[<?php echo $k;?>]" size="5" value="<?php echo $v['product_quanlity'];?>" />
						</td>
	 
					</tr>

				<?php
					}
				}else{ 

				}?>
							
			</tbody>
			</table>


			<div class="formbtn" >
			<input type="button"  post="#menage_form" url="index.php?com=users&no_html=1" value="提交"  class="submit_btn" />  
			<input type="button"   class="btn"  id="cancel_btn"  value="取消" />
 			<input type="hidden" value="save" name="task" id="task" />
			<input type="hidden" value="back" name="act" id="act" />
			<input type="hidden" value="<?php echo $order_data['id'];?>" name="id" /> 
			<input type="hidden" value="" name="return" id="return"  />
			<input type="hidden" name="tmpl" value="<?php echo $_REQUEST['tmpl'];?>" />
			<input type="hidden" value="<?php echo $order_data['order_sn'];?>" name="order_sn" /> 
			<input type="hidden" value="<?php echo $order_data['province'];?>" name="province" /> 
			<input type="hidden" value="<?php echo $order_data['city'];?>" name="city" /> 
 
			</div>
 
</div>
	  
</form>

<script language="javascript" >
 	var url_current ='<?php echo URI::current();?>';

 	$(function(){ 
		$('.submit_btn').click(function(){	
			$('#menage_form').get(0).submit();
		});

		$('.apply_btn').click(function(){	
			$('#return').attr('value',url_current);
			$('#menage_form').get(0).submit();
		});
		$('#cancel_btn').click(function(){	
			parent.$.w.closeN(3);
 		}); 

	});

 

</script>

 