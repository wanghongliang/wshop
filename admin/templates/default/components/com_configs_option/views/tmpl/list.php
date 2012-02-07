<table  class="listtable"  >
	<thead>
		<tr>
		<th>分组名称</th> 
		<th> 配置值 </th>
		<th> 状态 </th>
		<th> 操作 </th>
		<th> 序号 </th>
		</tr>
	</thead>

	<?php 
	$spec_type = array(0=>'文字 ',1=>'图片');
	$spec_show_type = array(0=>'平铺显示 ',1=>'下拉显示');
	if( is_array($this->rows) ){
		foreach($this->rows as $k=>$row )
		{
		?>
			<tr>
				<td class="fb"><?php echo $row['name'];?></td> 
				<td><?php echo $row['num'];?></td>
				<td>
				<?php
				if($row['published'] == 1 ){
					?>
					<a href="<?php echo $this->baseuri;?>&task=toggle&attr=published&value=0&id=<?php echo $row['id'];?>" >
					<img src="templates/default/images/tick.png" >
					</a>
					<?php
				}else{
					?>
					<a href="<?php echo $this->baseuri;?>&task=toggle&attr=published&value=1&id=<?php echo $row['id'];?>" >
					<img src="templates/default/images/publish_x.png" >
					</a>
					<?php
				}?>

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
				<td><?php echo $row['id'];?></td>
			</tr>
		<?
		}
	}
	?>
</table>

