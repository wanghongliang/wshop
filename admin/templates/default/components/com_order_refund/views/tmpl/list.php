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
				echo HTML::_('grid.sort',   '支付金额', 'c.amount', $lists['order_dir'], $lists['order'] ); 
			?>
			
			</th>

			<th>
			<?php 
				echo HTML::_('grid.sort',   '货币', 'c.currency', $lists['order_dir'], $lists['order'] ); 
			?>
			
			</th>

			<th>
			<?php 
				echo HTML::_('grid.sort',   '订单号', 'c.order_sn', $lists['order_dir'], $lists['order'] ); 
			?>
			
			</th>
			
			<th>
			<?php 
				echo HTML::_('grid.sort',   '支付方式', 'c.paymethod', $lists['order_dir'], $lists['order'] ); 
			?>
	
			</th>



			<th>
			<?php 
				echo HTML::_('grid.sort',   '退款账号', 'c.account', $lists['order_dir'], $lists['order'] ); 
			?>
			
			</th>
			<th>
			<?php 
				echo HTML::_('grid.sort',   '退款银行', 'c.bank', $lists['order_dir'], $lists['order'] ); 
			?>
			
			</th>
			<th>
			 状态 
			
			</th>
			<th>
			<?php 
				echo HTML::_('grid.sort',   '退款时间', 'c.t_ready', $lists['order_dir'], $lists['order'] ); 
			?>
			
			</th>

			<th > 操作 </th>
			<th>
			<?php 
				echo HTML::_('grid.sort',   'ID', 'c.id', $lists['order_dir'], $lists['order'] ); 
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
					<input type="checkbox" name="id[]" value="<?php echo $row['refund_id'];?>" class="ids" />
				</td>

	

				<td>￥<?php echo $row['money'];?></td>
				<td><?php echo $row['currency'];?></td>
				<td>
 					<?php echo $row['order_sn'];?>
 				</td>



			 	<td><?php echo $row['paymethod'];?></td>
				<td><?php echo $row['account']?$row['account']:'-';?></td>
				<td><?php echo $row['bank']?$row['bank']:'-';?></td>


				<td>支付成功</td>
				<td><?php echo date('Y-m-d H:i:s',$row['t_ready']);?></td>


 				<td>
				<a href="javascript:;;" class="v" url="<?php echo $this->baseuri;?>&tmpl=component&task=edit&id=<?php echo $row['refund_id'];?>" >
				查看
				</a>

				&nbsp;
				<a href="javascript:del('<?php echo $this->baseuri;?>&task=del&id=<?php echo $row['refund_id'];?>');" >
				删除
				</a>

				</td>

				<td>
					<?php echo $row['refund_id'];?>
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
	 $('.v').wDialog({title:'查看退款单信息',width:800,height:500,top:30,iframe:true});
 });


</script>