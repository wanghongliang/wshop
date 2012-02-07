


<ul class="switch_con" >
<li class="con active" > 

<div class="subbar" >
<ul>
	<li  class="<?php if( $s == 1 ){ ?> act  <?php }else{ ?> nor <?php } ?>"   >
	&nbsp;&nbsp;<a href="<?php echo $this->baseuri;?>&s=1"  >最新商品</a>
	</li>
 	<li  class="<?php if( $s == 2 ){ ?> act <?php }else{ ?> nor <?php } ?>"   >
	 &nbsp;&nbsp;<a href="<?php echo $this->baseuri;?>&s=2" >热卖商品</a>
	</li>
	<li   class="<?php if( $s == 3 ){ ?> act <?php }else{ ?> nor <?php } ?>"  >
	 &nbsp;&nbsp;<a href="<?php echo $this->baseuri;?>&s=3" >特价商品</a>
	</li>
</ul>
</div>

<table  class="listtable"  >
	<thead>
		<tr>
			<th width=10 ><input type="checkbox" class="selectall" /></th>

			<th width=74 > 商品图片 </th>
			<th width=30% > 商品名称  </th>
 			<th width=10% > 价格 </th>
 			<th width=10% > 库存 
			</th>

			<th> 排序 </th>
 			<th > 操作 </th>
			<th>
			<?php 
				echo HTML::_('grid.sort',   '序号', 'c.id', $lists['order_dir'], $lists['order'] ); 
			?>
			</th>

		</tr>
	</thead>

	<?php 
 	if( is_array($this->rows) ){
		foreach($this->rows as $k=>$row )
		{
		?>
			<tr>
				<td>
					<input type="checkbox" name="id[]" value="<?php echo $row['id'];?>" class="ids" />
				</td>
				<td align=center >
				<?php if( $row['thumbnail'] ){ ?>
					<a  class="img" href="index.php?com=products&task=edit&id=<?php echo $row['id'];?>"  target="_blank"  >
						<img src="<?php echo $row['thumbnail'];?>" width="60" />
					</a>
				<?php }else{ ?>
					无图
				<?php } ?>
				</td>
				<td class="fb"><a  href="index.php?com=products&task=edit&id=<?php echo $row['id'];?>" target=_blank ><?php echo $row['name'];?></a></td>
				<td><?php echo $row['shop_price'];?></td>
				<td><?php echo $row['store'];?></td>
				<td>
				<input type="text" name="ordering" value="<?php echo $row['ordering'];?>" size=5 class="ordering" />
				</td>
 				<td>
 				&nbsp;
				<span onclick="delElite(this,'<?php echo $row['id'];?>');" >
				删除
				</span>

				</td>
				<td><?php echo $row['id'];?></td>
			</tr>
		<?
		}
	}
	?>
</table>

</li>
</ul>

<input type="hidden" name="com" value="<?php echo $_REQUEST['com'];?>" />
<input type="hidden" name="menuid" value="<?php echo $s;?>" />

<script language="javascript" >
function loadClick(){
	
	var url = 'index.php?com=products&task=selectproduct&act=m&tmpl=component';
	// 继承属性
	var options = {title:'选择推荐的商品',width:900,height:520,url:url,isget:true,reload:true,iframe:true};$.w.createDialog(options,3);
			
 }
 function selectMultiProducts(ids){
	 if( ids ){
 		$.w.closeN(3);
		gotohref('<?php echo $this->baseuri;	
 			echo '&s='.$s; ?>&task=selectproducts&ids='+ids);
	 }
 }
 function delElite(obj,id){
	 	if( confirm( '请确认是否删除' ) ){
			$(obj.parentNode.parentNode).remove();
			$.get('<?php echo $this->baseuri;	
					echo '&s='.$s; ?>&no_html=1&task=del&id='+id,function(data){
					//alert('删除成功!');
					});

	 }
 }
</script>