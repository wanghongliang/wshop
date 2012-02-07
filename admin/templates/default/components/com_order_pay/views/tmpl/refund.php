 
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
			<th >订单总额：</th> 
			<td style="font-size: 16px; color: rgb(255, 153, 0); font-weight: 700;">￥<?php echo $order_data['amount'];?></td> 
			</tr> 
		
			<tr> 
			<th >已付金额：</th> 
			<td>￥0.00</td> 
			</tr>
			
			<?php ////////////收款信息////////////////// ?>
			<tr> 
			<th   colspan = 2  style="text-align:left"  ><b>退款信息</b></th> 
 			</tr> 
			<tr> 
			<th >退款类型：</th> 
			<td> 
			<select name="pay_type" id="pay_type" class="x-input-select  inputstyle">
				<option value="online" selected="selected">--在线支付--</option>
 				</select>
			</td> 
			</tr> 

			<tr> 
			<th >退款方式：</th> 
			<td>  
				<select name="payment"  >
				<option value="31">运筹宝</option>
				<option value="1" selected="selected">预存款支付</option>
				<option value="28">汇款-工商银行（示范）</option>
				<option value="30">支付宝（示范）</option>
				<option value="27">腾讯财付通（示范）</option>
				</select>
			</td> 
			</tr> 

			<tr> 
			<th >退款银行：</th> 
			<td> <input type="text" width="100"   value="" name="bank" id="payBank" class="x-input " > </td> 
			</tr>

			<tr> 
			<th >退款帐号：</th> 
			<td>  <input type="text" width="200"   value="" name="account" id="payAccount" class="x-input "  > </td> 
			</tr>

			<tr> 
			<th >退款金额：</th> 
			<td> <input type="text" width="100"  value="" name="money" class="x-input " > </td> 
			</tr>
			
 
			<tr>
				<th>收款人： 	</th>
				<td> <input type="text" width="100"  name="pay_account" class="x-input " > </td>
			</tr>

			<tr>
				<th>扣除用户积分： 	</th>
				<td> <input type="text" width="100"   value="0.000" name="return_score" class="x-input "  > </td>
			</tr>
 

			</tbody>
			</table> 

			<div class="formbtn" >
			<input type="button"  post="#menage_form" url="index.php?com=users&no_html=1" value="提交"  class="submit_btn" />  
			<input type="button"   class="btn"  id="cancel_btn"  value="取消" />
 			<input type="hidden" value="save" name="task" id="task" />
			<input type="hidden" value="refund" name="act" id="act" />
			<input type="hidden" value="<?php echo $order_data['id'];?>" name="id" /> 
			<input type="hidden" value="" name="return" id="return"  />
			<input type="hidden" name="tmpl" value="<?php echo $_REQUEST['tmpl'];?>" />
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

 