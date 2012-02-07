<form action="<?php echo $this->baseuri;?>" method="post" name="listform" >

<?
include($this->path.DS.'tmpl'.DS.'toolbar.php');
//include($this->path.DS.'tmpl'.DS.'submenu.php');
?>
<table class="moveordertable listtable"  >
	<thead>
		<tr>
			<th><input type="checkbox" class="selectall" /></th>
			<th>标题</th>
			<th > 模块名称 </th>
			<th > 模块位置 </th>
			<th > 排序 </th>
			<th > 是否启用 </th>
			<th > 快捷操作 </th>
			<th > 前/后台 </th>
			<th > 操作 </th>
			<th> ID </th>
		</tr>
	</thead>

	<?php 

 	if( is_array($this->rows) ){
		$i = 0;

		$input_orderings = '';	//当前列表的排序值
		foreach($this->rows as $k=>$row )
		{
			$input_orderings.=','.$row['ordering'];
		?>
			<tr class="trbg<?echo $i;?>" >		
				<td>
					<input type="checkbox" name="id[]" class="ids"  value="<?php echo $row['id'];?>" />
				</td>
				<td>
				<a href="javascript:v()" class="v" url="<?php echo $this->baseuri;?>&task=edit&no_html=1&id=<?php echo $row['id'];?>" >
					<?php 
					if( $row['iscore'] ){
						echo '<font color=gray >'.$row['title'].'</font>';
					}else{
						echo $row['title'];
					}
					?>
				</a>
				</td>

				<td>
					<?php echo $row['module'];?>
				</td>
				<td>
					<span class="pos" ><?php echo $row['position'];?></span>
				</td>

				<td>
					<input type="text" name="order[]" pos="<?php echo $row['position'];?>" readonly value="<?php
						echo $row['ordering'];
					?>"  size=3 class="orderinput" />
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
				<?php
				if($row['short'] == 1 ){
					?>
					<a href="<?php echo $this->baseuri;?>&task=toggle&attr=short&value=0&id=<?php echo $row['id'];?>" >
					<img src="templates/default/images/tick.png" >
					</a>
					<?php
				}else{
					?>
					<a href="<?php echo $this->baseuri;?>&task=toggle&attr=short&value=1&id=<?php echo $row['id'];?>" >
					<img src="templates/default/images/publish_x.png" >
					</a>
					<?php
				}?>

				</td>

 				<td>
					<?php
					echo $row['client_id']==0?'前台':'后台';
					?>
				</td>


 				<td>
		 
				<a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $row['id'];?>" >
				编辑
				</a>
 
				&nbsp;


				<?php 
				if( $row['iscore'] ){

					echo '<font color=gray >卸载</font>';
				}else{
					?>
 
					<a href="javascript:del('<?php echo $this->baseuri;?>&task=del&id=<?php echo $row['id'];?>');" >
					删除
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

			$i = 1-$i;
		}
	}
	?>
	<tfoot>
	<tr>
		<td colspan=9 >
		<?php echo $nav->showFilePage2();?>
		</td>
	</tr>
	</tfoot>

</table>
<input type="hidden" name="com" value="<?php echo $_REQUEST['com'];?>" />
<input type="hidden" name="input_ordering" value="<?php echo substr($input_orderings,1);?>" />



</form>
 <script language="javascript" >

 $(function(){
	 $('.v').wDialog({title:'编辑模块内容',iframe:true,onsuccess:function(){ 
	$.w.closeDialog(); },width:980,height:540,top:5});
 });


</script>