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
				echo HTML::_('grid.sort',   '品牌名称', 'c.brand_name', $lists['order_dir'], $lists['order'] );
			?> 
			<th>
			LOGO 图片
			</th>
			<th>
				描述
			</th>

			<th>
			<?php
				echo HTML::_('grid.sort',   '发布', 'c.published', $lists['order_dir'], $lists['order'] );
			?>

			</th>

			<th>
			<?php
				echo HTML::_('grid.sort',   '排序', 'c.ordering', $lists['order_dir'], $lists['order'] );
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
					<input type="checkbox"  name="id[]" value="<?php echo $row['brand_id'];?>" class="ids" />
				</td>

				<td>
				<a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $row['brand_id'];?>" >
					<?php echo $row['brand_name'];?>
				</a>
				</td> 
				<td  >
				<?php if( $row['brand_logo'] ){ ?>
					<a  class="img" href="<?php echo $row['brand_logo'];?>"   >
					<img src="<?php echo $row['brand_logo'];?>" width="60" />
					</a>
				<?php }else{ ?>
					无图
				<?php } ?>
				</td>

				<td><?php echo $row['brand_desc'];?></td>
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
				<input type="text" name="ordering" value="<?php echo $row['ordering'];?>" size=5 class="ordering" />
				</td>




 				<td>
				<a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $row['brand_id'];?>" class="list_edit">
				编辑
				</a>

				&nbsp;
				<a href="javascript:del('<?php echo $this->baseuri;?>&task=del&id=<?php echo $row['brand_id'];?>');" class="list_del">
				删除
				</a>

				</td>

				<td>
					<?php echo $row['brand_id'];?>
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

 