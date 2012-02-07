<table  class="listtable"  >
	<thead>
		<tr>
		<th>名称</th>
 
		<th> 说明 </th>
		<th> 排序 </th>
		<th> 操作 </th>
		</tr>
	</thead>

	<?php 
	if( is_array($this->rows) ){
		foreach($this->rows as $k=>$row )
		{
		?>
			<tr>
				<td class="fb" >&nbsp;<?php echo $row['title'];?></td>
				<td><?php echo $row['description'];?></td>
				<td><?php echo $row['ordering'];?></td>
				<td>
				<a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $row['id'];?>" >
				编辑
				</a>

				&nbsp;
				<a href="<?php echo $this->baseuri;?>&task=del&id=<?php echo $row['id'];?>" >
				删除
				</a>

				</td>
			</tr>
		<?
		}
	}
	?>
</table>

