<form action="<?php echo $this->baseuri;?>" method="post" name="listform" >
 <?
import('html.html');
include($this->path.DS.'tmpl'.DS.'toolbar.php');
?>


<table class="listtable"  >
	<thead>
		<tr>
			<th width=10 ><input type="checkbox" class="selectall" /></th>
 			<th>
			<?php 
				echo HTML::_('grid.sort',   '退货单号', 'c.delivery_id', $lists['order_dir'], $lists['order'] ); 
			?>
			
			</th>
 
			<th>
			<?php 
				echo HTML::_('grid.sort',   '订单号', 'c.order_sn', $lists['order_dir'], $lists['order'] ); 
			?>
			
			</th>
			
			<th>
			<?php 
				echo HTML::_('grid.sort',   '创建时间', 'c.add_time', $lists['order_dir'], $lists['order'] ); 
			?>
			
			</th>
			<th>
			<?php 
				echo HTML::_('grid.sort',   '会员', 'c.mid', $lists['order_dir'], $lists['order'] ); 
			?>
			
			</th>

			<th>
			<?php 
				echo HTML::_('grid.sort',   '物流费用', 'c.shipping_fee', $lists['order_dir'], $lists['order'] ); 
			?>
	
			</th>



			<th>
			<?php 
				echo HTML::_('grid.sort',   '是否保价', 'c.insure', $lists['order_dir'], $lists['order'] ); 
			?>
			
			</th>
			<th>
			<?php 
				echo HTML::_('grid.sort',   '退货人', 'c.consignee', $lists['order_dir'], $lists['order'] ); 
			?>
			
			</th>
			<th>
			<?php 
				echo HTML::_('grid.sort',   '配送方式', 'c.shipping_id', $lists['order_dir'], $lists['order'] ); 
			?>
			
			</th>
			<th>
			<?php 
				echo HTML::_('grid.sort',   '物流公司', 'c.shipping_name', $lists['order_dir'], $lists['order'] ); 
			?>
			
			</th>

			<th>
			<?php 
				echo HTML::_('grid.sort',   '物流单号', 'c.shipping_sn', $lists['order_dir'], $lists['order'] ); 
			?>
			
			</th>


			<th > 操作 </th>
			<th>
			<?php 
				echo HTML::_('grid.sort',   'ID', 'c.delivery_id', $lists['order_dir'], $lists['order'] ); 
			?> 
			</th>
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
					<input type="checkbox" name="id[]" value="<?php echo $row['delivery_id'];?>" class="ids" />
				</td>

				<td>
					<?php echo $row['delivery_id'];?>
				</td>

				<td><?php echo $row['order_sn'];?></td>
				<td><?php echo date('Y-m-d H:i:s',$row['add_time']);?></td>
				<td>
 					<?php echo $row['mid'];?>
 				</td>



			 	<td><?php echo $row['shipping_fee'];?></td>


				<td><?php echo $row['insure']?$row['insure']:'-';?></td>
				<td><?php echo $row['consignee']?$row['consignee']:'-';?></td>
				<td><?php echo $row['shipping_id']?$row['shipping_id']:'-';?></td>
				<td><?php echo $row['shipping_name']?$row['shipping_name']:'-';?></td>
				<td><?php echo $row['shipping_sn']?$row['shipping_sn']:'-';?></td>
 

 				<td>
				<a href="javascript:;;" class="v" url="<?php echo $this->baseuri;?>&tmpl=component&task=edit&id=<?php echo $row['delivery_id'];?>" >
				查看
				</a>

				&nbsp;
				<a href="javascript:del('<?php echo $this->baseuri;?>&task=del&id=<?php echo $row['delivery_id'];?>');" >
				删除
				</a>

				</td>

				<td>
					<?php echo $row['delivery_id'];?>
				</td>
			</tr>
		<?

			$i = 1-$i;

		}
	}
	?>

		<tr class="navigations" >
			<td colspan=10 >
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
		<input type="hidden" name="menuid" value="<?php echo $this->menuid;?>" />
</form>


 <script language="javascript" >

 $(function(){
	 $('.v').wDialog({title:'查看发货单信息',width:800,height:500,top:30,iframe:true});
 });


</script>