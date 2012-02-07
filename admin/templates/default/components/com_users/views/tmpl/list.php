<form action="<?php echo $this->baseuri;?>" method="post" name="listform" >

<?
include($this->path.DS.'tmpl'.DS.'toolbar.php');
?>
<table class="listtable"  >
	<thead>
		<tr>
			<th><input type="checkbox" class="selectall" /></th>
			<th>
			<?php 
				echo HTML::_('grid.sort',   '账号', 'u.username', $lists['order_dir'], $lists['order'] ); 
			?>
			</th>
			<th>所属组</th>
			<th>
			<?php 
				echo HTML::_('grid.sort',   'Email', 'u.email', $lists['order_dir'], $lists['order'] ); 
			?></th><th>
			<?php 
				echo HTML::_('grid.sort',   '注册时间', 'u.registerDate', $lists['order_dir'], $lists['order'] ); 
			?></th><th>
			<?php 
				echo HTML::_('grid.sort',   '最后登陆时间', 'u.lastvisitDate', $lists['order_dir'], $lists['order'] ); 
			?></th><th>
			<?php 
				echo HTML::_('grid.sort',   '状态', 'u.block', $lists['order_dir'], $lists['order'] ); 
			?></th> 
			<th > 操作 </th><th >
			<?php 
				echo HTML::_('grid.sort',   '序号', 'u.id', $lists['order_dir'], $lists['order'] ); 
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
					<input type="checkbox" name="id[]" value="<?php echo $row['id'];?>" />
				</td>

				<td> 
					<?php 
 						echo $row['username'];
					?> 
				</td>
 				<td>

 
					<?php 
 						echo $row['gname'];
					?>
 
				</td>
 
				<td>
					<?php echo $row['email'];?>
				</td>

				<td>
					<?php
						echo $row['registerDate'];
					?>
				</td>

 				<td>
					<?php
						echo $row['lastvisitDate'];
					?>
				</td>

 

 				<td>
					<?php
					echo $row['block']==1?'锁住':'开启';
					?>
				</td>


 				<td>
		 
				<a href="javascript:v()" class="v" url="<?php echo $this->baseuri;?>&task=edit&tmpl=component&id=<?php echo $row['id'];?>" >
				编辑
				</a>
 
				<?php 
				if( $row['iscore'] ){
					echo '<font color=gray >卸载</font>';
				}else{
					?>
					<a href="javascript:del('<?php echo $this->baseuri;?>&task=del&id=<?php echo $row['id'];?>')" >
					删除
					</a>
					<?
					 
				}
				?>
				&nbsp;
				<?php /**
				<a href="javascript:del('index.php?com=boot&task=emptydata&id=<?php echo $row['id'];?>')" >
					清空数据
				</a>
				**/?>
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
		<td colspan=9 >
		<?php echo $nav->showFilePage2();?>
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

 <script language="javascript" >

 $(function(){
	 $('.v').wDialog({title:'会员信息',width:800,height:500,top:30,iframe:true});
 });


</script>