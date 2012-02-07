<?
include($this->path.DS.'tmpl'.DS.'toolbar_type.php');
?>
<table class="moveordertable2 listtable"  >
	<thead>
		<tr>
			<th width=5 ><input type="checkbox" class="selectall" /></th>
			<th width=5% > 图标</th>
 			<th > 语言分类名称 </th>
			<th > 标识名称 </th>
			<th > 默认 </th>
			<th > 状态 </th>
			<th > 排序 </th>
			<th > 操作 </th>
			<th > ID </th>
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
					<img src="<?php 

						echo $row['img'];
					?>" width=25 height=18 />
				</td>


				<td>
					<?php 

						echo $row['name'];
					?>
				</td>
				<td>
					<?php 

						echo $row['mark'];
					?>
				</td>
				<td>
					<?php 

						if( $row['isdefault'] == 1 ){
							echo ' * ';
						}
					?>
				</td>
			<td>
				<?php
				if( $row['id'] == 1 ){
					echo ' - ';
				}else if($row['published'] == 1 ){
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
						echo $row['ordering'];	
					?>
				</td>
 
				 <td>
                       <a href="<?php echo $this->baseuri;?>&task=edittype&id=<?php echo $row['id'];?>" class="list_edit">
                            编辑
						</a>
						&nbsp;
					   
						<a href="javascript:del('<?php echo $this->baseuri;?>&task=deltype&id=<?php echo $row['id'];?>');" class="list_del">
							删除
						</a>
			   
                        </td>
				<td>
					<?php
						echo $row['id'];	
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
 
	$(".moveordertable2").tableDnD({onDragClass: "myDragClass",
		onFilterDown:function(obj,row){
			if( $(obj).find('.ids').attr('value') == '1' || $(row).find('.ids').attr('value') == '1'  ){
				return false;
			}
 			return true;
		},
		onFilterUp:function(obj,row){
			if($(obj).find('.ids').attr('value') == '1' || $(row).find('.ids').attr('value') == '1'  ){
				return false;
			}
			return true;
		},
		onDrop: function(table, row) {
            var rows = table.tBodies[0].rows;
           // var debugStr = "Row dropped was "+row.id+". New order: ";
			var debugStr = "";
			var ids = "";

			var order ="";		
			for (var i=0; i<rows.length; i++) {
 					 ids += ","+$(rows[i]).find('.ids').attr('value');
             }
			ids = ids.substring(1,ids.length);
			var uri = "index.php?com="+$('input[name=com]').attr('value')+"&task=moveorder&no_html=1";
 			$.get(uri,{ids:ids},function(data){
				//alert(data);
				// $('input[name=input_ordering]').attr('value',debugStr);
			});
 		}
	});
});
</script>