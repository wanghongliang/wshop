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
				echo HTML::_('grid.sort',   '标题', 'c.title', $lists['order_dir'], $lists['order'] );
			?>



			<th>
			<?php
				echo HTML::_('grid.sort',   '发布', 'c.published', $lists['order_dir'], $lists['order'] );
			?>

			</th>
			<th>
			<?php
				echo HTML::_('grid.sort',   '属性', 'c.attr', $lists['order_dir'], $lists['order'] );
			?>
			</th>
			<th>
			<?php
				echo HTML::_('grid.sort',   '排序', 'c.ordering', $lists['order_dir'], $lists['order'] );
			?>

			</th>

			<th>
			<?php
				echo HTML::_('grid.sort',   '所属菜单', 'c.menuid', $lists['order_dir'], $lists['order'] );
			?>

			</th>

			<th > 操作 </th>
			<th> <?php
				echo HTML::_('grid.sort',   'ID', 'c.id', $lists['order_dir'], $lists['order'] );
			?> </th>
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

				<td>
				<a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $row['id'];?>" >
					<?php echo $row['title'];?>
				</a>
				</td>



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
 
				<?php/**	<a href="<?php echo $this->baseuri;?>&task=toggle&attr=isfront&value=1&id=<?php echo $row['id'];?>" >  **/ ?>
						<?php echo $attr[$row['attr']];?>
				<?php /**	</a>  **/ ?>
				 
				</td>
				<td>
				<input type="text" name="ordering" value="<?php echo $row['ordering'];?>" size=5 class="ordering" />
				</td>


				<td><?php echo $row['typename'];?></td>


 				<td>
				<a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $row['id'];?>" class="list_edit">
				编辑
				</a>

				&nbsp;
				<a href="javascript:del('<?php echo $this->baseuri;?>&task=del&id=<?php echo $row['id'];?>');" class="list_del">
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
		<tr>
			<td colspan=8>
			<div  class="db-pl5"  >
				<select  >

				<?php
				$options = array(
					array(
						'text'=>'批量操作',
						'value'=>'-1'
					),
					array(
						'text'=>'置项',
						'value'=>'istop'
					),

					array(
						'text'=>'推荐',
						'value'=>'iselite'
					),
					array(
						'text'=>'关注',
						'value'=>'issee'
					),
					array(
						'text'=>'取消置项',
						'value'=>'retop'
					),

					array(
						'text'=>'取消推荐',
						'value'=>'relite'
					),
					array(
						'text'=>'取消关注',
						'value'=>'resee'
					),

				);
				foreach( $options as $option ){
					?>
					<option value="<?php echo $option['value'];?>" ><?php echo $option['text'];?></option>
					<?
				}
				?>
				</select>
				<input type="button" value="应用" />
				</div>
			</td>
		</tr>
		<tr class="navigations" >
 
			<td colspan=8 >
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