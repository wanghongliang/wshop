<form action="<?php echo $this->baseuri;?>" method="post" name="listform" >

<?
import('html.html');
include($this->path.DS.'tmpl'.DS.'toolbar.php');
?> 
<table class="listtable" >
	<thead>
		<tr>
			<th width=10 ><input type="checkbox" class="selectall" /></th>
			<th>
			<?php
				echo HTML::_('grid.sort',   '等级名称', 'c.brand_name', $lists['order_dir'], $lists['order'] );
			?> 
			</th>
 

			<th>
			<?php
				echo HTML::_('grid.sort',   '优惠率', 'c.published', $lists['order_dir'], $lists['order'] );
			?>

			</th>

			<th>
			<?php
				echo HTML::_('grid.sort',   '是否默认', 'c.ordering', $lists['order_dir'], $lists['order'] );
			?> 
			</th> 

			<th>
			<?php
				echo HTML::_('grid.sort',   '所需积分', 'c.ordering', $lists['order_dir'], $lists['order'] );
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

	//print_r($this->rows);

 	if( is_array($this->rows) ){
		$i = 0;

 		foreach($this->rows as $k=>$row )
		{
		?>
			<tr class="trbg<?echo $i;?>" >
				<td>
					<input type="checkbox"  name="id[]" value="<?php echo $row['id'];?>" class="ids" />
				</td>

				<td>
				<a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $row['id'];?>" >
					<?php echo $row['name'];?>
				</a>
				</td> 
 
				<td><?php echo $row['discount'];?>%</td>
				<td>
				<?php
				if($row['defaulted'] == 1 ){
					?>
					是
					<?php
				}else{
					?>
					否
					<?php
				}?>
				</td>

 
				<td>
					 <?php echo $row['point'];?> 
				</td>




 				<td>
				<a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $row['id'];?>" class="list_edit">
				编辑
				</a>

				&nbsp;
				<a href="javascript:del('<?php echo $this->baseuri;?>&task=del&id=<?php echo $row['id'];?>');" class="list_del">
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
 
			<td colspan=8 >
				<?php
				echo $this->nav->showFilePage2(); 
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

 