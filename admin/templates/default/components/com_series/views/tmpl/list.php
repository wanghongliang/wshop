<form action="<?php echo $this->baseuri;?>" method="post" name="listform" >
 <?
import('html.html'); 
include($this->path.DS.'tmpl'.DS.'toolbar.php');

 
?>


<table class="listtable"  >
	<thead>
		<tr>
			<th width=10 ><input type="checkbox" class="selectall" /></th>

			<th width=64 >
			<?php 
				echo HTML::_('grid.sort',   '系列图片', 'c.thumbnail', $lists['order_dir'], $lists['order'] ); 
			?>
			
			</th>
			<th width=30% >
			<?php 
				echo HTML::_('grid.sort',   '系列名称', 'c.name', $lists['order_dir'], $lists['order'] ); 
			?>
			</th>
 			<th width=10% >
			图片数量 
			</th>
 
			
			<th>
			<?php 
				echo HTML::_('grid.sort',   '排序', 'c.ordering', $lists['order_dir'], $lists['order'] ); 
			?>
	
			</th>

 
			<th > 操作 </th>
			<th width=40 >
			<?php 
				echo HTML::_('grid.sort',   '序号', 'c.id', $lists['order_dir'], $lists['order'] ); 
			?>
			</th>
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
					<input type="checkbox" name="id[]" value="<?php echo $row['id'];?>" class="ids" />
				</td>
				<td align=center >
				<?php if( $row['thumbnail'] ){ ?>
					<img src="<?php echo $row['thumbnail'];?>" width="60" />
				<?php }else{ ?>
					无图
				<?php } ?>
				</td>
				<td >
				<a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $row['id'];?>" >
					<?php echo $row['name'];?>
				</a>	
				</td>
				<td>
				<?php 
				echo $row['quantily'];
				?> 

				</td>
 

				<td>
				<input type="text" name="ordering" value="<?php echo $row['ordering'];?>" size=5 class="ordering" />
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
			<td colspan=9 >
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