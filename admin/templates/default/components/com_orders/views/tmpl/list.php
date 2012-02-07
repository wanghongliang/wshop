<form action="<?php echo $this->baseuri;?>" method="post" name="listform" >
 <?
import('html.html');
include($this->path.DS.'tmpl'.DS.'toolbar.php');
?>



<table class="listtable" style="margin-top:0px;" >
	<thead>
		<tr>
			<th width=10 ><input type="checkbox" class="selectall" /></th>
			<th>
			<?php 
				echo HTML::_('grid.sort',   '订单号', 'c.order_sn', $lists['order_dir'], $lists['order'] ); 
			?>
			<th>
			<?php 
				echo HTML::_('grid.sort',   '总金额', 'c.amount', $lists['order_dir'], $lists['order'] ); 
			?>
			
			</th>

			<th>
			<?php 
				echo HTML::_('grid.sort',   '提交时间', 'c.created_date', $lists['order_dir'], $lists['order'] ); 
			?>
			
			</th>
			<th>
			<?php 
				echo HTML::_('grid.sort',   '收货人', 'c.consignee', $lists['order_dir'], $lists['order'] ); 
			?>
			</th>

			<th>
			<?php 
				echo HTML::_('grid.sort',   '快递方式', 'c.postage', $lists['order_dir'], $lists['order'] ); 
			?>
			
			</th>
			
			<th>
			<?php 
				echo HTML::_('grid.sort',   '支付方式', 'c.pay', $lists['order_dir'], $lists['order'] ); 
			?>
	
			</th>



			<th>
			<?php 
				echo HTML::_('grid.sort',   '支付状态', 'c.pay_status', $lists['order_dir'], $lists['order'] ); 
			?>
			
			</th>
			<th>
			<?php 
				echo HTML::_('grid.sort',   '发货状态', 'c.ship_status', $lists['order_dir'], $lists['order'] ); 
			?>
			
			</th>
			<th>
			<?php 
				echo HTML::_('grid.sort',   '订单状态', 'c.order_status', $lists['order_dir'], $lists['order'] ); 
			?>
			
			</th>


			<th > 操作 </th>
			<th> <?php 
				echo HTML::_('grid.sort',   'ID', 'c.id', $lists['order_dir'], $lists['order'] ); 
			?> </th>
		</tr>
	</thead>

	<?php 

 	if( is_array($this->rows) ){
		$i = 0;
		//

  		foreach($this->rows as $k=>$row )
		{
		?>
			<tr class="trbg<?echo $i;?> <?php if( $row['pay_status'] == '0' ){ echo 'nopay'; } ?>" >
				<td>
					<input type="checkbox" name="id[]" value="<?php echo $row['id'];?>" class="ids" />
				</td>

				<td>
				<a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $row['id'];?>" >
					<?php echo $row['order_sn'];?>
				</a>	
				</td>

				<td>￥<?php echo $row['amount'];?></td>
				<td><?php echo $row['created_date'];?></td>

				<td><?php echo $row['consignee'];?></td>
			 	<td><?php echo $row['postage'];?></td>
				<td><?php echo $pays[$row['pay']]['name'];?></td>

				<td>
				<?php 
				switch( $row['pay_status'] ){

					case '2':
							echo '已退款';
							break;
					case '1':
							echo '已付款';
							break;
					case '0':
					default:
						echo '未支付';
					 
				}

  				?>
				
			 </td>
				<td>
				<?php 
				switch( $row['ship_status'] ){

					case '2':
							echo '已退货';
							break;
					case '1':
							echo '已发货';
							break;
					case '0':
	 
						echo '未发货';
					break;
					 
				} 
  				?>
			 </td>
 
	 
				<td>
				<?php 
				switch( $row['order_status'] ){

					case 'dead':
							echo '已作废';
							break;
					case 'finish':
							echo '已完成';
							break;
					case 'active':
					default:
						echo '进行中..';
					 
				}
 				?>
				</td>

 				<td>
				<a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $row['id'];?>" >
				编辑
				</a>

				&nbsp;
				<a href="javascript:del('<?php echo $this->baseuri;?>&task=del&id=<?php echo $row['id'];?>');" >
				删除
				</a>

				</td>

				<td>
					<?php echo $row['id'];?>
				</td>
			</tr>
		<?

			$i = 1-$i;

		}
	}
	?>

		<tr class="navigations" >
			<td colspan=12 >
				<?php
				echo $nav->showFilePage2(); 
				?>
			</td>
		</tr>
</table>

		<input type="hidden" name="filter_order" value="<?php echo $lists['order']; ?>" />
		<input type="hidden" name="filter_order_dir" value="<?php echo $lists['order_dir']; ?>" />
		<input type="hidden" name="com" value="<?php echo $_REQUEST['com'];?>" />
		<input type="hidden" name="tmpl" value="<?php echo $_REQUEST['tmpl'];?>" />
		<input type="hidden" name="mtid" value="<?php echo $_REQUEST['mtid'];?>" />
		<input type="hidden" name="s" value="<?php echo $_REQUEST['s'];?>" />
</form>

<script type="text/javascript" src="templates/default/js/calendar/calendar.js"></script>
<link href="templates/default/js/calendar/calendar.css" rel="stylesheet" type="text/css" />