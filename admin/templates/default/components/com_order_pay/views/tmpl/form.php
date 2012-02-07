<?php
//激活按钮
$active_button = array();
$disabled_button = array();


//首先判断订单的状态
if( $order_data['order_status'] == 'active' ){

	//是否激活付款和退款按钮
	switch($order_data['pay_status']){

		case '0':
		$disabled_button[] = 'btn_refund';
		break;

		case '1':
		$disabled_button[] = 'btn_pay';
		break;

		case '2':	//退款
		$disabled_button[] = 'btn_refund';
		$disabled_button[] = 'btn_pay';
		break;

	}

	switch($order_data['ship_status']){

		case '0':
		$disabled_button[] = 'btn_back';
		break;

		case '1':
		$disabled_button[] = 'btn_ship';
		break;

		case '2':	//退货后
		$disabled_button[] = 'btn_ship';
		$disabled_button[] = 'btn_back';
		break;

	}

	
}else{
	$disabled_button=array('btn_pay','btn_ship','btn_refund','btn_back','btn_dead','btn_finish');
	switch( $order_data['order_status'] ){
		case 'dead':
			$order_s= '[已作废]';
			break;
		case 'finish':
			$order_s = '[已完成]';
			break;
	}
}
?>
<div class="toolbar" >
 <ul class="com_ com_contents">
	<li <?php if( $_GET['task'] == 'accessories' ){ echo ' class="normal_li" '; }else{ echo ' class="active_li" '; } ?> onclick=""  > 

		<?php 
		if( $_GET['id'] > 0 ){
		?>
		 订单信息
		<?php }else{ ?>
		 订单信息
		<?php } ?>
		
	</li>
 

</ul>

<div class="clr" ></div>
<div class="tackle" >

<div class="filter"  >
  <b>订单号：</b><font  size=3 ><?php echo $order_data['order_sn'];?></font>
</div>

<div class="action-bar action-bar-order" >
<div order_id="20101206133810" class="order-ctls">
	<span class="action-bar-info">订单状态操作:</span> 
	<!--<input type="button" onclick="OrderMgr.act.confirm(this)" value="确认"class="btndisabled" disabled="disabled" class="inactive" />--> 
	<span class="action-bar-btns">
	<span> 
		<ul> 
		<li class="first">
			<input type="button" id="btn_pay" url="index.php?com=orders&task=opt&act=pay&tmpl=component&id=<?php echo $_GET['id'];?>" onclick="openInner(this,'订单[<?php echo $order_data['order_sn'];?>]支付')" class="inactive"  value="支付..."  <?php if( in_array('btn_pay',$disabled_button) ){ ?>  disabled="disabled"  <?php } ?> > 
		</li> 
		<li> 
			<input type="button" id="btn_ship" url="index.php?com=orders&task=opt&act=ship&tmpl=component&id=<?php echo $_GET['id'];?>" onclick="openInner(this,'订单[<?php echo $order_data['order_sn'];?>]发货')" class="inactive"  value="发货..."  <?php if( in_array('btn_ship',$disabled_button) ){ ?>  disabled="disabled"  <?php } ?> > 
		</li> 
		<li> 
			<input type="button" class="inactive" id="btn_finish"  value="完成"  <?php if( in_array('btn_finish',$disabled_button) ){ ?>  disabled="disabled"  <?php } ?>  > 
		</li> 
		</ul> 
	</span>
	</span> 


	<span class="action-bar-btns">
	<span> 
	<ul> 
	<li class="first"> 
	<input type="button"  class="inactive"  value="退款..." id="btn_refund" url="index.php?com=orders&task=opt&act=refund&tmpl=component&id=<?php echo $_GET['id'];?>" onclick="openInner(this,'订单[<?php echo $order_data['order_sn'];?>]退款.. 操作')"  <?php if( in_array('btn_refund',$disabled_button) ){ ?>  disabled="disabled"  <?php } ?> > 
	</li> 
	<li> 
	<input type="button"  class="inactive"  value="退货..." id="btn_back"  url="index.php?com=orders&task=opt&act=back&tmpl=component&id=<?php echo $_GET['id'];?>" onclick="openInner(this,'订单[<?php echo $order_data['order_sn'];?>]退货...操作')" <?php if( in_array('btn_back',$disabled_button) ){ ?>  disabled="disabled"  <?php } ?> > 
	</li> 
	</ul> 
	</span>
	</span> 


	<span class="action-bar-btns">
	<span> 
	<ul> 
	<li class="first"> 
	<input type="button" class="inactive" id="btn_dead" value="作废"  <?php if( in_array('btn_dead',$disabled_button) ){ ?>  disabled="disabled"  <?php } ?>  > 
	</li> 
	</ul> 
	</span>
	</span> 

	<label><?php echo $order_s;?></label> 
</div>
</div>


<ul class="tools tool_border" >	

	<li   >
		<a href="javascript:location.href='index.php?com=orders'"   class="btn_back"  >
		返回列表
		</a>
		&nbsp;
	</li>

 </ul>
<div class="clr" ></div> 
</div>

 </div>
<form action="index.php?com=orders"  method="post"  id="menage_form"  >


<div class="order_detail_frame" style=" margin-top:0px;" >

	<ul class="order_content" >
 	<li>


		
		<dl>
			<dt>订单基本信息</dt>
			<dd>
			
			  <div class="division"> 
					<table cellspacing="0" cellpadding="0" border="0" class="intab" > 
					<tbody>
					<tr> 
						<th >商品总额：</th> 
						<td>￥312.00</td> 
					</tr> 

					<tr> 
						<th >配送费用：</th> 
						<td>￥90.00</td> 
					</tr>  
					<tr> 
					<th >订单总额：</th> 
					<td style="font-size: 16px; color: rgb(255, 153, 0); font-weight: 700;">￥<?php echo $order_data['amount'];?></td> 
					</tr> 
				
					<tr> 
					<th >支付方式：</th> 
					<td>在线付款</td> 
					</tr>

					<tr> 
					<th >已支付金额：</th> 
					<td>￥0.00</td> 
					</tr> 

					</tbody>
					</table> 
				</div>
			</dd>
		</dl>



		<dl>
			<dt>配送信息</dt>
			<dd>
			
			  <div class="division"> 
					<table cellspacing="0" cellpadding="0" border="0" class="intab" > 
					<tbody>
					<tr> 
						<th >配送方式</th> 
						<td>速尔快递</td> 
					</tr> 

					<tr> 
						<th >配送保价</th> 
						<td>否</td> 
					</tr>  
					<tr> 
					<th >商品重量</th> 
					<td >0 g </td> 
					</tr> 
					
					<tr> 
					<th >支付方式：</th> 
					<td>货到付款   </td> 
					</tr> 

					<tr> 
					<th >是否开票：</th> 
					<td>否 </td> 
					</tr> 

					<tr> 
					<th >可得积分</th> 
					<td>20</td> 
					</tr> 

					</tbody>
					</table> 
				</div>
			</dd>
		</dl>
		<div class="clr" ></div>

		<dl>
			<dt>购买人信息</dt>
			<dd>
			
			  <div class="division"> 
					<table cellspacing="0" cellpadding="0" border="0" class="intab" > 
					<tbody>
					<tr> 
						<th >用户名：</th> 
						<td>luxin_0855</td> 
					</tr> 

					<tr> 
						<th >姓名：</th> 
						<td>xx</td> 
					</tr>  
					<tr> 
					<th >电话：</th> 
					<td  >xx</td> 
					</tr> 
					
					<tr> 
					<th >地区：</th> 
					<td>xx</td> 
					</tr> 
					<tr> 
					<th >Email：</th> 
					<td>xx</td> 
					</tr> 

					</tbody>
					</table> 
				</div>
			</dd>
		</dl>



		<dl>
			<dt>收货人信息</dt>
			<dd>
			
			  <div class="division"> 
					<table cellspacing="0" cellpadding="0" border="0" class="intab" > 
					<tbody>
					<tr> 
						<th >发货日期：</th> 
						<td>任意日期 任意时间段</td> 
					</tr> 
 
						<tr>
							<th>收货人姓名：</th><td><?php echo $order_data['consignee'];?> </td>
						</tr>
						<tr>
							<th>省份/直辖市：</th><td><?php echo $order_data['province'];?> </td>
						</tr>
						<tr>
							<th>详细地址：</th><td><?php echo $order_data['goods_address'];?></td>
						</tr>
						<tr>
							<th>邮政编码：</th><td><?php echo $order_data['zipcode'];?></td>
						</tr>
						<tr>
							<th>手机/电话：</th><td><?php echo $order_data['goods_mobile'];?><?php if( $order_data['goods_mobile'] && $order_data['tel'] ){ echo '/'; }?><?php echo $order_data['tel'];?></td>
						</tr>
						<tr>
							<th>备注：</th><td><?php echo $order_data['remark'];?></td>
						</tr>
					  </table>
				</div>
			</dd>
		</dl>
 
			
		<dl style="width:100%;" >
			<dt>商品信息</dt>
			<dd>
			
			 
			 <div class="merch_bord">

				<table width="100%"  class="ptab" cellspacing="1" cellpadding="0" border="0" bgcolor="#e3e3e3">
					<tbody>
					<tr>
						<th height="35" bgcolor="#f2f2f2" align="center">商品图片</th>
						<th height="35" bgcolor="#f2f2f2" align="center">商品名称</th>
						<th width="70" height="35" bgcolor="#f2f2f2" align="center">数量</th>
						<th width="80" height="35" bgcolor="#f2f2f2" align="center">单价</th>
						<th width="80" height="35" bgcolor="#f2f2f2" align="center">小计</th>
					</tr>
					
					<?php
					if( count($ms)>0 ){
						$total = 0;
						$total_price = 0;
						foreach( $ms as $k=>$v ){
							$price = intval($v['product_price']);	//价格
							$sub_total_price = $price * $v['product_quanlity'];	//小结
							$total += $v['product_quanlity'];	//总数量
							$total_price += $sub_total_price; //总价格
					?>
						<tr>
							<td height="120" bgcolor="#ffffff" align="center">
									<img width="87" height="100" src="<?php echo $v['product_thumb'];?>">
							</td>
							<td bgcolor="#ffffff" align="center"><?php echo $v['product_name'];?></td>
							<td bgcolor="#ffffff" align="center">
								<?php echo $v['product_quanlity'];?></td>
							<td bgcolor="#ffffff" align="center" class="d70034">￥<?php echo $price;?></td>
							<td bgcolor="#ffffff" align="center" class="d70034">￥<?php echo $sub_total_price;?></td>
		 
						</tr>

					<?php
						}
					}else{ 

					}?>
								
				</tbody>
				</table>

				<div align="right" style="margin: 10px;">
					商品数量总计：<span class="d70034"><?php echo $total; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
					商品金额总计：<span class="d70034">￥<?php echo $total_price;?></span>
				</div>

			 </div>
		</dd>
	</dl>

	<div class="clr" ></div>
	</li>

 
	</ul>
</div>
	 
	<input type="hidden" value="save" name="task" id="task" />
	<input type="hidden" value="<?php echo $order_data['id'];?>" name="id" />
	<input type="hidden" value="<?php echo $this->menuid;?>" name="menuid" />
	<input type="hidden" value="" name="return" id="return"  />
	<input type="hidden" value="<?php echo $_REQUEST['tmpl'];?>" name="tmpl" />
</form>

<script language="javascript" >
 
 	$(function(){
  
		$('.submit_btn').click(function(){	
			$('#menage_form').get(0).submit();
 		});

		$('.apply_btn').click(function(){	
			$('#return').attr('value','<?php echo URI::current();?>');
			$('#menage_form').get(0).submit();
 		});

		$('.cancel_btn').click(function(){	
 			location.href='index.php?com=orders<?php if( $_REQUEST['tmpl'] != '' ){ echo "&tmpl=".$_REQUEST['tmpl'];}?>&menuid=<?php echo $this->menuid;?>';
 		});

	 

	});

function openInner(obj,name){
 	// $('.v').wDialog({title:'订单['+name+']支付',width:800,height:520,top:30,iframe:true});
	var url = $(obj).attr('url');
 	$.w.createDialog({
		title:name,
		width:800,
		height:520,
		top:10,
		iframe:true,
		url:url,
		isget:true,
		reload:true
	},3);
}
function setPay(){
	$('#btn_pay').attr('disabled','disabled');
}

</script>

<style type="text/css" >

</style>