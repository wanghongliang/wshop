 
<form action="index.php?com=orders"  method="post"  id="menage_form"  >


<div class="order_detail_frame" style=" margin:10px 5px;border:1px solid #ddd;padding:10px;" >

 

			<table cellspacing="0" cellpadding="0" border="0" class="intab" style="width:100%;"  > 
			<tbody>
			<tr> 
			<th colspan = 2  style="text-align:left"   ><b>收款单信息</b></th> 
 			</tr> 
			<tr> 
				<th >订单号：</th> 
				<td><?php echo $item['order_sn']; ?></td> 
			</tr> 

			<tr> 
				<th >收款单日期：</th> 
				<td><?php echo date('Y-m-d H:i:s',$item['t_begin']);?></td> 
			</tr>  
			<tr> 
			<th >收款金额：</th> 
			<td style="font-size: 16px; color: rgb(255, 153, 0); font-weight: 700;">￥<?php echo $item['money'];?></td> 
			</tr> 
 
			<tr> 
			<th >收款银行：</th> 
			<td> <?php echo $item['bank'];?> </td> 
			</tr>

			<tr> 
			<th >收款帐号：</th> 
			<td>  <?php echo $item['account'];?> </td> 
			</tr>
 
			<tr> 
			<th >收款类型：</th> 
			<td>
				<?php echo $item['pay_type'];?>
			</td> 
			</tr> 


			<?php /////////////支付信息/////////////  ?>

			<tr> 
			<th colspan = 2  style="text-align:left"   ><b>支付信息</b></th> 
 			</tr> 
			<tr> 
			<th >支付方式：</th> 
			<td>
				<?php echo $item['paymethod'];?>
			</td> 
			</tr>
 
			<tr> 
			<th >是否开票：</th> 
			<td>否</td> 
			</tr>
			
			<tr> 
			<th >税金：</th> 
			<td>￥0.00</td> 
			</tr> 
			
			<tr>
				<th>发票抬头： 	</th>
				<td> 无 </td>
			</tr>

			<tr>
				<th>付款人： 	</th>
				<td> 
					<?php echo $item['pay_account'];?>
				</td>
			</tr>
			<tr>
				<th>收款单备注：</th>
				<td>
					<?php echo $item['memo'];?>
				</td>
			</tr>

			</tbody>
			</table> 

			<div class="formbtn" >
 			<input type="button"   class="btn"  id="cancel_btn"  value="取消" />
 			<input type="hidden" value="save" name="task" id="task" />
			<input type="hidden" value="pay" name="act" id="act" />
			<input type="hidden" value="<?php echo $item['id'];?>" name="id" /> 
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
			parent.$.w.closeDialog();
 		}); 

	});

 

</script>

 