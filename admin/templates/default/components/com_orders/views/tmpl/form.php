<?php
//激活按钮
$active_button = array();
$disabled_button = array();


//首先判断订单的状态
if( $order_data['order_status'] == 'active' || ( $order_data['order_status'] != 'dead' && $order_data['order_status'] != 'finish' ) ){

	//是否激活付款和退款按钮
	switch($order_data['pay_status']){

		case '0': //未支付
		$disabled_button[] = 'btn_refund';
		break;

		case '1': //已支付
		$disabled_button[] = 'btn_pay';
		break;

		case '2':	//退款
		$disabled_button[] = 'btn_refund';
		$disabled_button[] = 'btn_pay';
		break;

	}

	switch($order_data['ship_status']){

		case '0': //未发货
		$disabled_button[] = 'btn_back';
		break;

		case '1': //已发货
		$disabled_button[] = 'btn_ship';
		break;

		case '2':	//退货后
		$disabled_button[] = 'btn_ship';
		$disabled_button[] = 'btn_back';
		break;

	}

	if($order_data['pay_status'] == '0' && $order_data['ship_status']=='0' ){ 
		$disabled_button[] = 'btn_finish';
		$disabled_button[] = 'btn_dead';
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
	<li <?php if( $_GET['task'] == 'accessories' ){ echo ' class="normal_li" '; }else{ echo ' class="active_li" '; } ?>    > 

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
	  <b style="font-size:14px;">订单号：</b><font  size=3 ><?php echo $order_data['order_sn'];?></font>
	</div>

	<div class="action-bar action-bar-order" >
	<div order_id="20101206133810" class="order-ctls">
		<span class="action-bar-info">订单状态操作 &nbsp;</span> 
		<span class="action-bar-btns">
			<span> 
				<ul> 
				<li class="first">
					<input type="button" id="btn_pay" url="index.php?com=orders&task=opt&act=pay&tmpl=component&id=<?php echo $_GET['id'];?>" onclick="openInner(this,'订单[<?php echo $order_data['order_sn'];?>]支付.. 操作')" class="inactive"  value="支付..."  <?php if( in_array('btn_pay',$disabled_button) ){ ?>  disabled="disabled"  <?php } ?> > 
				</li> 
				<li> 
					<input type="button" id="btn_ship" url="index.php?com=orders&task=opt&act=ship&tmpl=component&id=<?php echo $_GET['id'];?>" onclick="openInner(this,'订单[<?php echo $order_data['order_sn'];?>]发货.. 操作')" class="inactive"  value="发货..."  <?php if( in_array('btn_ship',$disabled_button) ){ ?>  disabled="disabled"  <?php } ?> > 
				</li> 
				<li> 
					<input type="button" class="inactive" id="btn_finish" onclick="setFinish()"  value="完成"  <?php if( in_array('btn_finish',$disabled_button) ){ ?>  disabled="disabled"  <?php } ?>  > 
				</li> 
				</ul> 
			</span>
		</span> 


		<span class="action-bar-btns">
			<span> 
			<ul> 
				<li class="first"> 
				<input type="button"  class="inactive"  value="退款..." id="btn_refund"  url="index.php?com=orders&task=opt&act=refund&tmpl=component&id=<?php echo $_GET['id'];?>" onclick="openInner(this,'订单[<?php echo $order_data['order_sn'];?>]退款.. 操作')"  <?php if( in_array('btn_refund',$disabled_button) ){ ?>  disabled="disabled"  <?php } ?> > 
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
		<input type="button" class="inactive" onclick="setDead()" id="btn_dead" value="作废"  <?php if( in_array('btn_dead',$disabled_button) ){ ?>  disabled="disabled"  <?php } ?>  > 
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



<div class="order_detail_frame"  >
<div class="ditail_frame_p" >
<table width=100%  >
	<tr>
		<td width=50% >
			<h3>订单基本信息</h3>
			<table cellspacing="0" cellpadding="0" border="0"  class="intab" > 
			<tbody>
			<tr> 
				<th >商品总额：</th> 
				<td>￥<?php echo $order_data['amount']-$order_data['postage_free'];?></td> 
			</tr>  
			<tr> 
				<th >配送费用：</th> 
				<td><font color=red ><?php echo $order_data['postage_free']>1?'￥'.$order_data['postage_free']:'包邮';?></font></td> 
			</tr>  
			<tr> 
			<th >订单总额：</th> 
			<td style="font-size: 16px; color: rgb(255, 153, 0); font-weight: 700;">￥<?php echo $order_data['amount'];?></td> 
			</tr> 
					<tr> 
					<th >可得积分：</th> 
					<td><?php echo $order_data['integral'];?></td> 
					</tr> 
			<tr> 
			<th >支付方式：</th> 
			<td>		
			<?php  
			if( !empty($pay['params']['logo']) ){
				echo '<img src="'.$pay['params']['logo'].'" width=133 />';
			 
			}else{
				echo $pay['name'];
			}
 			?>
			</td> 
			</tr>

 

			<tr> 
			<th >订单状态：</th> 
			<td style="color:red;" > 
			<?php  
				$s = $order_data['order_status'];
				if( $s == 'dead' ){
					echo '订单已取消'; 
				}elseif( $s == 'finish'){
					echo '已完成';
				}else{
					if( $order_data['pay_status'] == 0 ){
						echo '未付款';
					}else{
						
						if( $order_data['pay_status'] == '1' ){//付款后，就显示订单的状态
							echo '已付款';
						}elseif( $order_data['pay_status'] == '2' ){
							echo '已退款';
						}
						//echo '<div>'.$order_status[$row['order_status']].'</div>';

					}


					switch( $order_data['ship_status'] )
					{
						case '0':
							echo '  - 未发货';
							break;
						case '1':
							echo '  - 已发货';
							break;
						case '2':
							echo '  - 已退货';
							break;
					} 
			 
				} 
				 ?> 
			</td> 
			</tr> 
			</tbody>
			</table> 
		 
		
		</td>
		<td valign=top >
		
		
			<h3>配送信息</h3>
 			<table cellspacing="0" cellpadding="0" border="0" class="intab" > 
					<tbody>
					<tr> 
						<th >配送方式：</th> 
						<td>		 
						<?php //print_r($ship); 
						echo $ship['name']; 
						?>
						<font color=red >￥<?php echo $order_data['postage_free']; ?> 元</font>
						<?php //echo $ship['desc'];  ?>
						</td> 
					</tr> 

					<tr> 
						<th >配送保价：</th> 
						<td>否</td> 
					</tr>  
					<tr> 
					<th >商品重量：</th> 
					<td >- </td> 
					</tr> 
					
 
					<tr> 
					<th >是否开票：</th> 
					<td>否 </td> 
					</tr> 

		

					</tbody>
			</table> 
		</td>
	</tr>


	<tr>
		<td  valign=top >
			<h3>购买人信息</h3>
			<table cellspacing="0" cellpadding="0" border="0"   class="intab" > 
			<tbody>
			<tr> 
				<th >用户名：</th> 
				<td><?php echo $order_data['username'];?></td> 
			</tr> 

			<tr> 
				<th >姓名：</th> 
				<td><?php echo $order_data['nickname'];?></td> 
			</tr>  
			<tr> 
			<th >电话：</th> 
			<td  ><?php echo $order_data['tel'];?></td> 
			</tr> 
			
			<tr> 
			<th >地区：</th> 
			<td><?php echo $order_data['nickname'];?></td> 
			</tr> 
			<tr> 
			<th >Email：</th> 
			<td><?php echo $order_data['email'];?></td> 
			</tr> 

			</tbody>
			</table> 


		</td>
		<td >

			<h3>收货人信息</h3>
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

		</td>
	</tr>
</table>



<?php ////////////////订购的商品信息///////////////////?> 
<div style="clear:both;display:block;"  >

<h3>商品信息</h3>
 
 <div class="order_p_info">
	<table  class="ptab tbd" cellspacing="1" width=100% cellpadding="0" border="0"  >
	<tbody>
		<tr>
			<th height="25" width="100"  bgcolor="#f2f2f2" align="center">商品图片</th>
			<th  bgcolor="#f2f2f2" align="center">商品名称</th>
			<th width="70"  bgcolor="#f2f2f2" align="center">数量</th>
			<th width="80"  bgcolor="#f2f2f2" align="center">单价</th>
			<th width="80"   bgcolor="#f2f2f2" align="center">小计</th>
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
				<td bgcolor="#ffffff" align="center">
				<img   height="60" src="<?php echo $v['product_thumb'];?>">
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

</div>



<?php //////////////// 订单的操作记录////////////////// ?>
			
<div   style="clear:both;display:block;"  >
	<h3>订单操作日志</dt>
	 <table cellspacing="0" cellpadding="0" border="0"  width=100%    class="intab tbd"> 
	<thead> 
	<tr> 
	<th>序号</th> 
	<th>时间</th> 
	<th>操作人</th> 
	<th>行为</th> 
	<th>结果</th> 
	<th>备注</th> 
	</tr> 
	</thead> 
	<tbody>  
	<?php
	$i=count($log);
	foreach( $log as $k=>$v ){
	?>
	<tr> 
	<td><?php echo $i--;?></td> 
	<td><?php echo date('Y-m-d H:i:s',$v['log_time']);?></td> 
	<td><?php echo $v['action_user'];?></td> 
	<td><?php echo $v['behavior'];?></td> 
	<td>成功</td> 
	<td><?php echo $v['action_note'];?></td> 
	</tr>    
	<?php
	}
	?>
	</tbody> 
	</table> 

</div>



</div>
</div>



 
<form action="index.php?com=orders"  method="post"  id="menage_form"  >


	<input type="hidden" value="savestatus" name="task" id="task" />
	<input type="hidden" value="<?php echo $order_data['id'];?>" name="id" /> 
	<input type="hidden" value="" name="return" id="return"  />
	<input type="hidden" value="<?php echo $_REQUEST['tmpl'];?>" name="tmpl" />
	<input type="hidden" value="" name="status"  id="status" />
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
	//$('#btn_pay').attr('disabled','disabled');
	location.reload();
}


//订单设为完成状态
function setFinish(){

	if( confirm('完成操作 会将该订单归档并且不允许再做任何操作，确认要执行吗？') ){
		$('#status').attr('value','finish');
		$('#return').attr('value','<?php echo URI::current();?>');
		$('#menage_form').get(0).submit();
	}

}

//订单设为作废状态
function setDead(){
	if( confirm('作废后该订单何将不允许再做任何操作，确认要执行吗？') ){
		$('#status').attr('value','dead');
		$('#return').attr('value','<?php echo URI::current();?>');
		$('#menage_form').get(0).submit();
	}

}
</script>

<style type="text/css" >

</style>