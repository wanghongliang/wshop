<?
include($this->path.DS.'tmpl'.DS.'toolbar.php');
?>
<table class="listtable"  >
	<thead>
		<tr>
			<th>标题</th>
			<th > 组件名 </th>
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
				<td>
					<?php 
					if( $row['iscore'] ){
						echo '<font color=gray >'.$row['name'].'</font>';
					}else{
						echo $row['name'];
					}
					?>
				</td>

				<td>
					<?php echo $row['option'];?>
				</td>

 				<td>
				<?php 

				/**
				<a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $row['id'];?>" >
				编辑
				</a>

				**/
				?>

				<?php 
				if( $row['iscore'] ){

					echo '<font color=gray >卸载</font>';
				}else{
					?>
					<a href="<?php echo $this->baseuri;?>&task=del&id=<?php echo $row['id'];?>" >
					卸载
					</a>
					<?
					 
				}
				?>

			
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
</table>
 