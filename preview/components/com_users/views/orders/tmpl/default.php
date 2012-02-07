 <?php

 require(dirname(PATH_COMPONENT).DS.'com_products'.DS.'helpers'.DS.'route.php');
 $rows = $lists['rows'];
 $num = count($rows);
 
$byTime = trim($_REQUEST['s']);
if( empty($byTime) ){ $byTime='oneWeek'; }

 ?>	 
 <div class="right_top" >
<h2  >我的订单</h2><span class="goon_btn"><a title="首页" href="./" style="color: rgb(255, 255, 255);">继续购物</a></span>
</div> 

		<?php /**
		<div class="u_ak"> 
			&nbsp;
			<?php if( $num>0 ){ ?>
			您有  <b><?php echo $num;?></b> 个支付订单未付款。您可以在订单中心查看订单状态和取消订单等。
			<?php }else{ ?>
			您没有相关订单信息.  
			<?php } ?>
		</div>
		**/ ?>
 
		<div class="u_bgbox"   >
			<div class="qfilter" >
				<select onchange="searchOrdersByTime();" id="selectTime" name="">
					<option value="oneWeek" <?php if( $byTime=='oneWeek' ){ ?>selected<?php } ?> >近一周的订单</option>
					<option value="oneMonth" <?php if( $byTime=='oneMonth' ){ ?>selected<?php } ?>>近一月的订单</option>
					<option value="all" <?php if( $byTime=='all' ){ ?>selected<?php } ?>>以往所有订单</option>
				</select>
			</div>
			<form action="#" method="post">
				<label>订单查询：</label>
				<select name="way" >
					<option value="1">产品名称</option>
					<option value="2">订单号</option>
				</select>
				<input type="text" name="key" id="key" size="15" value="<?php echo $_REQUEST['key'];?>" /> 
				<input type="submit" class="btns" value="搜索" />
			</form>

		</div>


		<div class="ubox">
			<h3 class="utitle2">所有订单</h3>
 
	
		<table width="100%" cellspacing="0" cellpadding="0" border="0"  class="u_tab" >
				<tbody><tr>
					<th  width="40" bgcolor="#FFFFFF" >序号</th>
					<th  width="380" bgcolor="#FFFFFF" >订单信息/产品信息</th> 

					<th  width="80" bgcolor="#FFFFFF" >总金额</th>
  
					<th  width="70" bgcolor="#FFFFFF" >订单状态</th> 
					<th  width="50" bgcolor="#FFFFFF" >操作</th>
				</tr>
				
				<?php
				

				//是否有定单信息
				if( $num > 0 ){
					$i=1;
					foreach( $rows as $k=>$r  ){
						$row = $r[0];
						?>
						<tr <?php if( $i++ < $num ){ echo ' class="btmbd" '; }else{ } ?> >
							<td   ><?php echo $i-1;?></td>


							<td class="oi"  >
							<div>
								订单号：<?php echo $row['order_sn'];?> 
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
								 时间：	<?php echo $row['created_date'];?>
							</div>
							<table class="order-goods"   cellspacing="0" cellpadding="0" >
							<?php
							foreach( $r as $v ){
								$link = Router::_( ProductsHelperRoute::getProductRoute($v['product_id'],$v['catid']) );


								$params = unserialize($v['params']);
								//print_r($params);
								$price = intval($v['product_price']);	//价格
								$sub_total_price = $price * $v['product_quanlity'];	//小结
								$total += $v['product_quanlity'];	//总数量
								$total_price += $sub_total_price; //总价格
								

								?>
								<tr style="border-top:1px solid #f0f0f0;" >
									<td width="50"  >
										<img width="50"  src="<?php echo $v['product_thumb'];?>">
									</td>
									<td class="pn" width="180" >
										<a href="<?php echo $link;?>" target="_blank"  >
										<?php echo $v['product_name'];?>
										<br/>
										<?php echo $params['params'];?>
										</a>
									</td>
								 
									<td  class="pr">
									￥<?php echo $sub_total_price;?> × <?php echo $v['product_quanlity'];?>  
									</td>
									<td > 
									<?php
									 if( $params['pays'] == 1 ){
									?>
									先付定金
									<br />
									￥<?php echo $params['price']*$v['product_quanlity'];?>
									<?php }else{ ?> 
									￥<?php echo $sub_total_price;?>
									<?php } ?>
									</td>
				 
								</tr>
								<?php
							}
							?>
							</table>
							</td>
							
							
							<td   >
							￥<?php echo $row['amount'];?>
							</td>

							<td   >
								<?php
									$s = $row['order_status'];
									if( $s == 'dead' ){
										echo '订单已取消'; 
									}elseif( $s == 'finish'){
										echo '已完成';
									}else{
										if( $row['pay_status'] == 0 ){
											echo '未付款';
											echo ' <div class="opt_pay" > <a href="/?com=cart&act=pay&order_sn='.$row['order_sn'].'" target="_blank"  >在线支付</a></div>'; 
										}else{
											
											if( $row['pay_status'] == '1' ){//付款后，就显示订单的状态
												echo '已付款';
											}elseif( $row['pay_status'] == '2' ){
												echo '已退款';
											}
											//echo '<div>'.$order_status[$row['order_status']].'</div>';

											switch( $row['ship_status'] )
											{
												case '0':
													echo '<div>配货中..</div>';
													break;
												case '1':
													echo '<div>已发货</div>';
													break;
												case '2':
													echo '<div>已退货</div>';
													break;
											} 
									 
										}

	
									}
								?>
							</td>
 
							<td   >
								<a href="index.php?com=users&view=orders&act=view&id=<?php echo $row['id'];?>">查看
								</a> 
								<br/>
								<?php
								if( $row['pay_status'] == 0 && $row['order_status'] != 'dead'   ){
								?>
 									<a href="javascript:cancel(<?php echo $row['id'];?>)">取消
								<?php
								}
								?>
								</a>
								
							</td>
						</tr>
						<?php
					}
				}else{
				?>
					<tr><td colspan="10"   >没有订单信息.</td></tr>
				<?php
				}
				?>
 
				
			</tbody></table>
			<?php
			echo $lists['nav']->showFilePage2();
			?>
		</div>

<script language="javascript" >
function cancel(id){
	var href="index.php?com=users&view=orders&act=cancel&id="+id;
	if( confirm('确认取消订单吗！') ){
		location.href=href;
	}

}

function searchOrdersByTime(){
	var q = $('#selectTime').val();
	location.href='<?php echo $this->baseuri;?>&s='+q;
}
</script>
  
 <style type="text/css" >
 .order-goods{ width:100%; border:1px solid #f0f0f0; border-top:0px; margin-top:8px; }
 .u_tab tr td{ vertical-align:top; background:white; border:0px;}
 tr.btmbd td{ border-bottom:1px solid #e2e2e2; padding-bottom:20px;}

 .order-goods tr td{
	 border:0px;
 	border-top:1px solid #f0f0f0;
	text-align:left;
	background:#f9f9f9;  padding:5px; 
 }
.oi{ text-align:left;}
.order-goods tr td.pn{ text-align:left; color:#1A267E;}
.order-goods  .pr{ color:red; width:80px;}
 </style>