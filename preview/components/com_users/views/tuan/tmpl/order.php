<?php
						 
$total_pays = $order_data['total_deposit'];
?>
 
  <div class="right_top" >
<h2  >订单详细信息</h2><span class="goon_btn"><a  href="index.php?com=users&view=tuan"  style="color: rgb(255, 255, 255);">返回我的团购</a></span>
</div> 

<div class="order_sn" >
	 <b>订单号：</b><?php echo $order_data['order_sn'];?>
	 &nbsp;
	 ( <?php  
	$s = $order_data['order_status'];
	if( $s == 'dead' ){
		echo '订单已取消'; 
	}elseif( $s == 'finish'){
		echo '已完成';
	}else{
		if( $order_data['pay_status'] == 0 ){
			echo ' 未付款';
			echo '  <a style="color:red;" href="/?com=cart&act=pay&order_sn='.$order_data['order_sn'].'" target="_blank"  >在线支付</a> '; 
		}else{
			
			if( $order_data['pay_status'] == '1' ){//付款后，就显示订单的状态
				echo '已付款';
			}elseif( $order_data['pay_status'] == '2' ){
				echo '已退款';
			}

			echo '&nbsp; > &nbsp;';
			//echo '<div>'.$order_status[$row['order_status']].'</div>';

			switch( $order_data['ship_status'] )
			{
				case '0':
					echo '<span>配货中..</span>';
					break;
				case '1':
					echo '<span>已发货</span>';
					break;
				case '2':
					echo '<span>已退货</span>';
					break;
			} 
	 
		}


	}
					 

	 
	 ?> )
</div>
<?php 	$i=count($log); 
if( $i>0 ){
?>
<div class="order_detail_frame" style=" margin-top:0px;border-bottom:0px; " >
 		<dl   >
			<dt>订单操作日志</dt>
			<dd>
			 <table cellspacing="0" cellpadding="0" border="0"   class="intab tbd"> 
 
			<tbody>  
			<?php
		
			foreach( $log as $k=>$v ){
			?>
			<tr> 
			<td><?php echo $i--;?>,&nbsp;</td> 
			<td><?php echo date('Y-m-d H:i:s',$v['log_time']);?></td> 
			<td><?php echo $v['action_user'];?></td>  
			<td><?php echo $v['action_note'];?></td> 
			</tr>    
			<?php
			}
			?>
			</tbody> 
			</table> 
 		</dd>
	</dl>
</div>
<?php
}
?>

<div class="order_detail_frame" style=" margin-top:0px;" >
    <!--收货人信息修改开始-->
     <h2 style="visibility: visible;">
		收货人信息  
	</h2>        
		<ul style="display: block;" id="receiver_label_content" class="ditail_frame_p">
		  <li>
		  <table>
			<tr>
				<td>收货人姓名：</td><td><?php echo $order_data['consignee'];?> </td>
			</tr> 
			<tr>
				<td>省份/直辖市：</td><td><?php echo $order_data['province'];?> </td>
			</tr> 
			<tr>
				<td>详细地址：</td><td><?php echo $order_data['goods_address'];?></td>
			</tr> 
			<tr>
				<td>邮政编码：</td><td><?php echo $order_data['zipcode'];?></td>
			</tr> 
			<tr>
				<td>手机/固定电话：</td><td><?php echo $order_data['goods_mobile'];?><?php if( $order_data['goods_mobile'] && $order_data['tel'] ){ echo '/'; }?><?php echo $order_data['tel'];?></td>
			</tr> 
			<?php if( !empty($order_data['remark']) ){ ?>
			<tr>
				<td>备注：</td><td><?php echo $order_data['remark'];?></td>
			</tr>
			<?php } ?>

		  </table>
	 
		  </li>
		 </ul>
	
	 <h2>送货方式</h2>
		 <ul class="ditail_frame_p">
		 <li>
		 <?php //print_r($ship); 
			echo $ship['name']; 
			

			
		?>
		<font color=red >￥<?php echo $order_data['postage_free']; ?> 元</font>
		<?php echo $ship['desc'];  ?>
		 </li>
		 </ul>
		 
		 
 	 <h2>付款方式</h2>
		 <ul class="ditail_frame_p">
		 <li>
		 <?php  
			if( !empty($pay['params']['logo']) ){
				echo '<img src="'.$pay['params']['logo'].'" width=133 />';
			 
			}else{
				echo $pay['name'];
			}
			echo '<br/>';
			echo $pay['params']['desc'];
		?>
 
		 </li>
		</ul>
	
	

     
	<div id="4113201355" class="ditail_frame ditail_frame_nopadding">
        <div class="business_bag">
            <h2>商品清单</h2>
        </div>              
    </div>
    
 	 <div class="merch_bord">

		<table width="100%"  class="odtab" cellspacing="0" cellpadding="0" border="0" bgcolor="#e3e3e3">
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
					<td   bgcolor="#ffffff" align="center">
							<img width="87"  src="<?php echo $v['product_thumb'];?>">
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

		<div align="right" style="border-top:1px solid #e2e2e2;line-height:42px;"  >

				商品金额：<font color="#CB120D" >￥<span id="pprice" ><?php echo $total_price;?></span>元</font> + 运费：<font color="#CB120D"  >￥<span id="freeprice" ><?php echo $order_data['postage_free'];?></span>元</font>
				<br/>
			支付金额:
			<font style="font-weight:bold;font-size:24px;color:#CB120D;"  >
			￥<?php echo $total_pays;?>元
			</font>
			 
		</div>

		<br/>
	 </div>
		 

 </div>
 
 