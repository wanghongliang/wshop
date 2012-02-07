<form action="<?php echo $this->baseuri;?>&task=selectproduct" method="post" name="listform"  id="listform" >
<div class="tackle" >
	<div class="filter" > 
		查找 
		<?php 
		$data = array(0=>'所有分类...');
		$data = Form::_buildTreeOptions($type,0,0,0,$data);
		echo Form::dropdown('catid',$data,$_REQUEST['catid'],'   ');
		//print_r($data);
		?> 

 
		&nbsp;商品名称：
		<input type="text" name="key" value="<?php echo  $_REQUEST['key'];?>" size=10 class="key" />
		<input type="button" value="搜索" onclick="submitForm()" class="sbutton"/>
		<input type="button" value="清空" onclick="$('select[name=catid]').attr('value',0);$('input[name=key]').attr('value','');submitForm()" class="sbutton"/>
 
		<input type="hidden" name="filter_order" value="<?php echo $lists['order']; ?>" />
		<input type="hidden" name="filter_order_dir" value="<?php echo $lists['order_dir']; ?>" />

	</div> 
 
</div>
 

<table class="listtable"  >
<thead>
	<tr> 
 			<th  class="fs2 headerSort" width=300 >
			<?php 
				echo HTML::_('grid.sort',   '商品名称', 'c.title', $lists['order_dir'], $lists['order'] ); 
			?>
			</th>
			<th  class="fs2 headerSort" >
			销售价(元)
			</th>
 
			
 

			<th  class="fs2 headerSort" >
			<?php 
				echo HTML::_('grid.sort',   '分类', 'c.catid', $lists['order_dir'], $lists['order'] ); 
			?> 
			</th> 

			<th  class="fs2 headerSort" >
			<?php 
				echo HTML::_('grid.sort',   '销售状态', 's.published', $lists['order_dir'], $lists['order'] ); 
			?> 
			</th> 
 
			<th  class="fs2 headerSort" > 执行操作 </th>




	</tr>	
</thead>
<tbody>

	<?php 

 	if( is_array($this->rows) ){
		$i = 0;
  		foreach($this->rows as $k=>$row )
		{ 
			$outimg = $row['thumbnail'];
			$image_str = $row['images'];
			if( $pos = strpos($image_str,'|1') ){
				$tmp=substr($image_str,0,$pos);
				$tmp_a = explode(',',$tmp);
				$outimg = $tmp_a[count($tmp_a)-1]; 
 			}
		
	
		?>
			<tr class="trbg<?echo $i;?>" > 
 				<td  >
				<div class="thumb" > 
				<?php
					if( $row['thumbnail'] ){
				?>
					<img src="<?php echo $row['thumbnail'];?>" width=60 height=60 />
				<?php }else{ ?>
					<img src="/member/templates/default/images/blank.gif" />
				<?php } ?>
				</div>
				<div class="pname" >
				
 
					<a href="javascript:parent.selectProduct(<?php echo $row['id'];?>,'<?php echo $row['name'];?>','<?php echo $row['thumbnail'];?>','<?php echo $row['catid'];?>');" >
						<?php echo $row['name'];?>
					</a>

					<br/>
					<?php if( $row['new'] == 1 ){ ?>
						<font color=red>新品</font>&nbsp;
					<?php } ?>

					<?php if( $row['hot'] == 1 ){ ?>
						<font color=red>热卖</font>&nbsp;
					<?php } ?>

					<?php if( $row['spe'] == 1 ){ ?>
						<font color=red>特价</font>&nbsp;
					<?php } ?>
				</div>
			
				</td>
				<td class="ppr" >
				￥<?php echo $row['price'];?>
				</td>
 

		 
				<td><?php echo $row['typename'];?></td>
 
				<td class="published" align=center >
				<?php if( $row['published']== 1 ){ ?>
					已上架 
				<?php }else{ ?>
					没有上架
				<?php } ?>

				</td>
 				<td>
					<a class="skin-blue" href="javascript:parent.selectProduct(<?php echo $row['id'];?>,'<?php echo $row['name'];?>','<?php echo $outimg;?>','<?php echo $row['catid'];?>');"  >选择</a> 
					<input type="hidden" value="<?php echo $row['id'];?>" class="ids" />
				</td>


			</tr>
		<?

			$i = 1-$i;

		}
	}
	?>



</tbody>

</table>
<?php
echo $nav->showFilePage2();

?>

<div class="clear" ></div>
 

</form>

<script language="javascript" >
function submitForm(){
	var action = $('#listform').get(0).action;
 
	action += '&catid='+$('select[name=catid]').val()+'&key='+$('input[name=key]').val();
	$('#listform').attr('action',action);
	$('#listform').submit();
}
function tableOrdering( order, dir, task ) {
	var form = document.listform;
	form.filter_order.value 	= order;
	form.filter_order_dir.value	= dir;
	form.submit();
}


</script>