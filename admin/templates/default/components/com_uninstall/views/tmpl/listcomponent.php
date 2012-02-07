<?
include($this->path.DS.'tmpl'.DS.'submenu.php');
?>
<table class="listtable"  >
	<thead>
		<tr>
 			<th>组件</th>
 			<th > 版本 </th>
 			<th>日期</th>
 			<th > 作者 </th>
  			<th > 操作 </th>
			<th> ID </th>
		</tr>
	</thead>

	<?php 

 	if( is_array($this->rows) ){
		$uri = $this->baseuri.'&type='.$_REQUEST['type'];
		foreach($this->rows as $k=>$row )
		{
		?>
			<tr>
				<td><?php echo $row['name'];?></td>
				<td > <?php echo $row['version'];?> </td>
				<td><?php echo $row['creationDate'];?></td>
				<td > <?php echo $row['author'];?> </td>
 				<td>
				<?php if( $row['id']>0 ){?>
 				<a href="<?php echo $uri;?>&task=del&id=<?php echo $row['id'];?>" >
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
 