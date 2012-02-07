<table>
	<tr>
		<td>金额：</td>
		<td><input type="text" name="param[money]" value="<?php echo $params['money'];?>" size=5 /></td>
	</tr>
 
		<tr>
			<td  >赠品：</td>
			<td> 
				<input type="text" value="<?php echo $params['products_name'];?>" size="50" id="products_name" name="param[products_name]">
				<input type="button" dialogscroll="auto" dialogwidth="860" dialogheight="530" title="请选择团购的商品" alt="index.php?com=products&amp;task=selectproduct&amp;tmpl=component" value="选择商品" class="opener btn">
				<input type="hidden" value="<?php echo $params['products_id'];?>" id="products_id" name="param[products_id]">
				<input type="hidden" value="<?php echo $params['thumb'];?>" id="thumb" name="param[thumb]">
				<div class="p_thumb">
				<?php if( !empty( $params['thumb'] )){ ?>
					<img src="<?php echo $params['thumb'];?>" width=160 />

				<?php } ?>
				</div>
				 
			</td>
		</tr>

</table>