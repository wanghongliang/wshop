<form action="<?php echo $this->baseuri;?>" method="post" name="listform" >

<table  class="listtable"  >
	<thead>
		<tr>
		<th width=10 ><input type="checkbox" class="selectall" /></th>
		<th> 属性名称</th>
		<th> 属性类型</th>
		<th> 所属分类 </th>
		<th> 属性值的录入方式 </th>
		<th width=40% > 可选值列表 </th>
		<th>
		<?php 
			echo HTML::_('grid.sort',   '排序', 'c.ordering', $lists['order_dir'], $lists['order'] ); 
		?> 
		</th> 
		<th> 操作 </th>
		<th> 		
		<?php 
			echo HTML::_('grid.sort',   '序号', 'c.attr_id', $lists['order_dir'], $lists['order'] ); 
		?>
		</th>
		</tr>
	</thead>

	<?php 
	if( is_array($rows = $lists['rows']) ){
		$i = 0;

		foreach($rows as $k=>$row )
		{
		?>
			<tr class="trbg<?echo $i;?>" >
				<td>
					<input type="checkbox" name="id[]" value="<?php echo $row['attr_id'];?>" class="ids" />
				</td>
				<td class="fb"><?php echo $row['attr_name'];
				
				?></td>

				<td><?php echo $type[$row['type_id']]['name'];?></td>
				<td>
				<?php 
				//echo $attr_type[$row['attr_type']];
				if( $row['attr_type']>0 ){ 
					echo '<font color="red" >搜索';
					echo '√</font>'; 
				}else{
					echo '<font color="#cccccc" >普通</font>';
				}
				?>
				</td>
				<td><?php echo $attr_input_values[$row['attr_input_type']];?></td>
				<td> 
					<?php echo str_replace("\n", ", ",$row['attr_values']);?>
				</td>

				<td>
				<input type="text" name="ordering" value="<?php echo $row['ordering'];?>" size=5 class="ordering" />
				</td>

				<td>
 
				<a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $row['attr_id'];?>" >
				编辑
				</a>

				&nbsp;
				<a href="javascript:del('<?php echo $this->baseuri;?>&task=del&id=<?php echo $row['attr_id'];?>');" >
				删除
				</a>

				</td>
				<td><?php echo $row['attr_id'];?></td>
			</tr>
		<?
			$i = 1-$i;
		}
	}
	?>

		<tr class="navigations" >
			<td colspan=9 >
				<?php
				echo $this->nav->showFilePage2();
				
				?>
			</td>
		</tr>
</table>
		<input type="hidden" name="filter_order" value="<?php echo $lists['order']; ?>" />
		<input type="hidden" name="filter_order_dir" value="<?php echo $lists['order_dir']; ?>" />
		<input type="hidden" name="com" value="<?php echo $_REQUEST['com'];?>" />
		<input type="hidden" name="menuid" value="<?php echo $_REQUEST['type_id'];?>" />
		<input type="hidden" name="tmpl" value="<?php echo $_REQUEST['tmpl'];?>" />
 
</form>