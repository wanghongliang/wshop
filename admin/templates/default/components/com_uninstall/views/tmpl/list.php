<?
include($this->path.DS.'tmpl'.DS.'submenu.php');
?>
<table class="listtable"  >
	<thead>
		<tr>
			<th>标题</th>
			<th>模块</th>
			<th>作者</th>
			<th>描述</th>
			<th>类型</th>
			<th > 操作 </th>
			<th> ID </th>
		</tr>
	</thead>

	<?php 

 	if( is_array($this->rows) ){
		foreach($this->rows as $k=>$row )
		{
		?>
			<tr>
				<td><?php echo $row['title'];?></td>
				<td><?php echo $row['module'];?></td>
				<td><?php echo $row['author'];?></td>
				<td><?php echo $row['description'];?></td>

				<td><?php echo $row['client_id']==0?'前台':'后台';?></td>


 				<td>
				<?php if( $row['id']>0 ){?>
 				<a href="<?php echo $this->baseuri;?>&task=del&id=<?php echo $row['id'];?>" >
					卸载
				</a>

				<?php }else{?>
					<font color=gray >
						手动卸载
					</font>
				<?php }?>
				&nbsp;

				</td>

				<td>
					<?php echo $row['id'];?>
				</td>
			</tr>
		<?
		}
	}
	?>

	<tr>
		<td colspan=7 >
		<?php echo $nav->showFilePage2();?>
		</td>
	</tr>
</table>
 