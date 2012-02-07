<form action="<?php echo $this->baseuri;?>" method="post" name="listform" >

<table  class="listtable"  >
	<thead>
		<tr>
		<th width=10 ><input type="checkbox" class="selectall" /></th>
		<th width=60% > 问答标题</th> 
		<th>
		<?php 
			echo HTML::_('grid.sort',   '排序', 'c.ordering', $lists['order_dir'], $lists['order'] ); 
		?> 
		</th> 
		<th> 操作 </th>
		<th> 		
		<?php 
			echo HTML::_('grid.sort',   '序号', 'c.id', $lists['order_dir'], $lists['order'] ); 
		?>
		</th>
		</tr>
	</thead>

	<?php 
	if( is_array($rows = $lists['rows']) ){
		$i = 0;

		foreach($rows as $k=>$row )
		{

			$values = unserialize( $row['contents'] );
		?>
			<tr class="trbg<?echo $i;?>" >
				<td>
					<input type="checkbox" name="id[]" value="<?php echo $row['id'];?>" class="ids" />
				</td>
				<td class="fb">
				<div class="t" ><?php echo $row['title']; ?></div>
				<div >
					<ul>
					<?php 
					foreach( $values as $k=>$v ){
 						if( $row['defaulted'] == $k ){
							echo '<li class="def" >'.($k+1).','.$v.'&nbsp;&nbsp;√</li>';
						}else{
							echo '<li>'.($k+1).','.$v.'</li>';
						} 
					}
					?>
					</ul>
				</div>
				
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
				<td><?php echo $row['id'];?></td>
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
<style type="text/css" >
.listtable ul,.listtable ul li{ font-weight:normal;  list-style-type:lower-roman; float:none; display:block; padding-left:5px; }
.listtable ul li.def{ color:red;  }
</style>