 
<form action="index.php?com=orders"  method="post"  id="menage_form"  >


<div class="order_detail_frame" style=" margin:10px 5px;border:1px solid #ddd;padding:10px;" >
 			<table cellspacing="0" cellpadding="0" border="0" class="intab" style="width:100%;"  > 
			<tbody>
			<tr> 
			<th colspan = 2  style="text-align:left"   ><b>发货单信息</b></th> 
 			</tr> 
			<tr> 
				<th >订单号：</th> 
				<td><?php echo $item['order_sn']; ?></td> 
			</tr> 

			<tr> 
				<th >配送方式：</th> 
				<td><?php echo $item['shipping_id']; ?></td> 
			</tr> 
			<tr> 
			<th >操作员：</th> 
			<td ><?php echo $item['uid'];?></td> 
			</tr> 
 
			<tr> 
			<th >会员：</th> 
			<td> <?php echo $item['mid'];?> </td> 
			</tr>

			<tr> 
			<th >收货人：</th> 
			<td>  <?php echo $item['consignee'];?> </td> 
			</tr>
 
			<tr> 
			<th >收货地址：</th> 
			<td>
				<?php echo $item['address'];?>
			</td> 
			</tr> 


 
			<tr> 
			<th >邮编：</th> 
			<td>
				<?php echo $item['zipcode'];?>
			</td> 
			</tr>
 			<tr> 
				<th >电话：</th> 
				<td><?php echo $item['tel'];?></td> 
			</tr>  

			<tr>
				<th>手机：</th>
				<td>
					<?php echo $item['mobile'];?>
				</td>
			</tr>

			<tr> 
			<th >物流公司：</th> 
			<td>
				<?php echo $item['shipping_name'];?>
			</td> 
			</tr>

			<tr> 
			<th >物流费用：</th> 
			<td>
				<?php echo $item['shipping_fee'];?>
			</td> 
			</tr>

			<tr> 
			<th >物流单号：</th> 
			<td>
				<?php echo $item['shipping_sn'];?>
			</td> 
			</tr>
			<tr> 
			<th >生成时间：</th> 
			<td>
				<?php echo date('Y-m-d H:i:s',$item['add_time']);?>
			</td> 
			</tr>


			</tbody>
			</table> 
			

			

			<dl style="text-align:left;">
				<dt  ><b>发货明细:</b></dt>
				<dd>
				
				 
				 <div class="merch_bord">

					<table width="100%"  class="ptab" cellspacing="1" cellpadding="0" border="0" bgcolor="#e3e3e3">
						<tbody>
						<tr>
							<th height="35" bgcolor="#f2f2f2" align="center">商品序号</th>
							<th height="35" bgcolor="#f2f2f2" align="center">商品名称</th>
							<th width="70" height="35" bgcolor="#f2f2f2" align="center">发货量</th> 
						</tr>

						<?php 
						foreach( $product_lists as $k=>$v ){
						?>	
						<tr>
							<td><?php echo $v['product_id'];?></td>

							<td><?php echo $v['product_name'];?></td>
							<td><?php echo $v['send_number'];?></td>
						</tr>
						<?php	
						}
						?>
					   </tbody>
					</table>
				</div>
				</dd>
			</dl>


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

 