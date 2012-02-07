<?
include($this->path.DS.'tmpl'.DS.'toolbar.php');
?>

<form action="index.php?com=feedbacks"  method="post"  id="menage_form" name="listform">


<table class="listtable"  >
	<thead>
		<tr>
			<th><input type="checkbox" class="selectall" /></th>
			<th > 配送方式 </th>
			<th > 描述 </th>
			<th > 物流保价  </th>
			<th > 货到付款 </th> 
			<th > 开启 </th> 
			<th > 排序 </th>
 			<th > 操作 </th>
			<th> ID </th>
		</tr>
	</thead>

	<?php 

 	if( is_array($this->rows) ){
		$i = 0;

		//print_r( $this->rows );
		foreach($this->rows as $k=>$row )
		{
		?>
			<tr class="trbg<?echo $i;?>" >

			
				<td>
					<input type="checkbox" name="id[]" value="<?php echo $row['id'];?>" class="ids" />
				</td>

				<td>

				<a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $row['id'];?>" > 
					<?php 
 						echo $row['name'];
					?>
				</a>
				</td>

				<td>
					<?php echo $row['desc'];?>
				</td>
				<td>
					<?php echo $row['protect']==1?'是':'否';?>
				</td>

				<td>
					<?php
						echo $row['has_cod']==1?'是':'否';
					?>
				</td>

				<td>
				<?php
				if($row['published'] == 1 ){
					?>
					<a href="<?php echo $this->baseuri;?>&task=lock&value=0&id=<?php echo $row['id'];?>" >
					<img src="templates/default/images/tick.png" >
					</a>
					<?php
				}else{
					?>
					<a href="<?php echo $this->baseuri;?>&task=lock&value=1&id=<?php echo $row['id'];?>" >
					<img src="templates/default/images/publish_x.png" >
					</a>
					<?php
				}?>

				</td>

				<td>
					<?php echo $row['ordering'];?>
				</td>

  

 				<td>
		 
					<a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $row['id'];?>" class="list_edit">
					编辑 
					</a>
					<a href="<?php echo $this->baseuri;?>&task=delete&id=<?php echo $row['id'];?>" class="list_del">
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
		<td colspan=9 >
		<?php echo $nav->showFilePage2();?>
		</td>
	</tr>
</table>
</form>
 <script language="javascript" >

 $(function(){
	 $('.v').wDialog({title:'编辑模块内容',width:800,height:500,top:30});
 });


</script>