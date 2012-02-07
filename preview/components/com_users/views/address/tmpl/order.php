<?php 
 ?>

	<div class="regheader" >
	<div class="topnav" >
		<?php
		$modules	=& ModuleHelper::getModules('breadcrumbs');
		foreach($modules as $item)
		{
			echo ModuleHelper::renderModule($item);
		}
		?>
	</div>
 	</div>

	<div class="clr" ></div>

<br/>
<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" >
<tbody>
 
<tr>
	<td   height="30" align="left">
	 <b>订单号：</b><?php echo $order_data['order_sn'];?>
	</td>
</tr>

</tbody>
</table>

<div class="order_detail_frame" style="width:100%;margin-top:0px;" >	
 	


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

			<tr>
				<td>备注：</td><td><?php echo $order_data['remark'];?></td>
			</tr>

		  </table>
	 
		  </li>
		 </ul>
	
	 <h2>送货方式</h2>
		 <ul class="ditail_frame_p">
		 <li><?php echo $order_data['postage'];?></li>
		 </ul>
		 
		 
 	 <h2>付款方式</h2>
		 <ul class="ditail_frame_p">
		 <li><?php echo $order_data['pay'];?> </li>
		 </ul>
	
	
	<div id="4113201355" class="ditail_frame ditail_frame_nopadding">
        <div class="business_bag">
            <h2>商品清单</h2>
        </div>              
    </div>
    
     
 	 <div class="merch_bord">

		<table width="100%"  class="cart_table" cellspacing="1" cellpadding="0" border="0" bgcolor="#e3e3e3">
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
		 

 </div>
 