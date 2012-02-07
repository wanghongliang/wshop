<?
include($this->path.DS.'tmpl'.DS.'recycle_toolbar.php');
?>
<table class="innertable"  >
	<thead>
		<tr>
			<th width=10 ><input type="checkbox" class="selectall" /></th>
			<th>标题</th>
 			<th> ID </th>
		</tr>
	</thead>

	<?php 

 	if( is_array($this->rows) ){
		$i = 0;

		foreach($this->rows as $k=>$row )
		{
		?>
 			<tr class="trbg<?echo $i;?>" >
				<td>
					<input type="checkbox"  name="id[]" value="<?php echo $row['id'];?>" class="ids" />
				</td>
 				<td><?php echo $row['title'];?></td>
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
				echo $nav->showFilePage2();
				
				?>
			</td>
		</tr>

</table>
 