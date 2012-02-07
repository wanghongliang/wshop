<?
include($this->path.DS.'tmpl'.DS.'toolbar.php');
include($this->path.DS.'tmpl'.DS.'submenu.php');
?>
<table class="listtable"  >
	<thead>
		<tr>
			<th width=5 ><input type="checkbox" class="selectall" /></th>
 			<th > 模板名称 </th>
			<th > 当前选择的模板 </th>
			<th > 作者 </th>
			<th > 创建时间 </th>
			<th > 前台/后台 </th>
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
					<input type="checkbox" name="id[]" class="ids"  value="<?php echo $row['name'];?>" />
				</td>
				<td>
					<?php 

						echo $row['title'];
					
					?>
				</td>

				<td>
					<?php
						if( $row['default'] == 1 ){ echo '*'; }	//默认的模板	
					?>
				</td>

  				<td>
 					<?php
					echo $row['author'];
					?>
				</td>
   				<td>
 					<?php
					echo $row['creationDate'];
					?>
				</td>

 				<td>
					<?php
					echo $row['client_id']==0?'前台':'后台';
					?>
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
		<?php //echo $nav->showFilePage2();?>
		</td>
	</tr>
	</tfoot>

</table>
<input type="hidden" name="com" value="<?php echo $_REQUEST['com'];?>" />
<input type="hidden" name="input_ordering" value="<?php echo substr($input_orderings,1);?>" />
 <script language="javascript" >

 $(function(){
	 $('.v').wDialog({title:'编辑模块内容',iframe:true,width:800,height:500,top:30});
 });


</script>