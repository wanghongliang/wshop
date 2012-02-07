<?php
//include($this->path.DS.'tmpl'.DS.'toolbar_form.php');
import('html.editor');
$editor = Editor::getInstance($GLOBALS['config']['editor']);
?>

<div style="padding:10px;" >
	<table class="formtable "     > 
		<tr  >
			<td class="form_text"  ><span class="tips" >*</span>商品名称</td>
			<td>
				<input type="text" name="name" size=60 id="name" value="<?php echo $item['name'];?>" />
			</td>
 
		</tr>
 		<tr  >
			<td class="form_text" >商品编号</td>
			<td>
				<input type="text" name="model" size=30 id="model"  value="<?php echo $item['model'];?>" />
			</td>
		</tr>
		
 

 		<tr  >
			<td class="form_text" >本店售价</td>
			<td>
				<input type="text"  name="shop_price" size=30 id="shop_price"   value="<?php echo $item['shop_price'];?>" />
			</td>
		</tr>


		<tr  >
			<td class="form_text" >市场售价</td>
			<td>
				<input type="text"   name="market_price" size=30 id="market_price"  value="<?php echo $item['market_price'];?>" />
			</td>
		</tr>
 

		<tr >
			<td class="form_text" >重量</td>
			<td>
				<input type="text"   name="wei" size=30  id="wei"  value="<?php echo $item['weight'];?>"   /> 
		 

			</td>
		</tr>
		<tr >
			<td class="form_text" >库存</td>
			<td>
				<input type="text"   name="sto" size=30   value="<?php echo $item['store'];?>" id="store"  /> 
		 

			</td>
		</tr>
	 

	</table>

 		<table class="formtable"     > 

 		<tr  >
			<td class="form_text" valign=top   >商品页面标题：</td>
			<td class="db-pt5 db-pb5">
				<textarea cols=50 rows=1 name="title"  id="title" ><?php echo $item['title'];?></textarea>
			</td>
		</tr>

		<tr  >
			<td class="form_text" valign=top   >页面关键词</td>
			<td class="db-pt5 db-pb5">
				<textarea cols=50 rows=2 name="metakey"  id="metakey" ><?php echo $item['metakey'];?></textarea>
			</td>
		</tr>

 		<tr>
			<td  class="form_text db-pt5"  valign=top  >页面描述</td>
			<td  class="db-pt5 db-pb5">
				<textarea cols=50 rows=2 name="metadesc"  id="metadesc" ><?php echo $item['metadesc'];?></textarea>  
			</td>
		</tr>
		</table>


			<div class="formbtn" >
		<input type="button" class="submit_btn" onclick="saveForm();"  value="保存"/>
		<input type="button" class="apply_btn"  onclick="applyForm()" value="应用" />
		<input type="reset" class="cancel_btn" onclick="parent.cancel()" value="取消" />
		
	</div>
	<input type="hidden" value="save" name="task" id="task" />
	<input type="hidden" value="<?php echo $item['id'];?>" id="productid" name="id" />
	<input type="hidden" value="<?php echo $this->menuid;?>" name="menuid" />
	<input type="hidden" value="" name="return" id="return"  />
	<input type="hidden" value="<?php echo $_REQUEST['tmpl'];?>" name="tmpl" />
	<input type="hidden" value="0" name="recreate" id="recreate" />
</div>
<script type="text/javascript">
function applyForm(){
	$('.apply_btn').attr('disabled',true);
	var data = {
		id:$('#productid').val(),
		name:$('#name').val(),
		model:$('#model').val(), 
		shop_price:$('#shop_price').val(),
		market_price:$('#market_price').val(),
		wei:$('#wei').val(),
		store:$('#store').val(),
		title:$('#title').val(),
		metakey:$('#metakey').val(),
		metadesc:$('#metadesc').val()};
	var url = 'index.php?com=products&task=ajax&act=quikedit&no_html=1';
	var panel = ajaxMessage();
	$.post(url,data,function(d){ 
 		$(panel).html('<div class="ms" >保存成功!</div>'); 
		setTimeout(function(){$(panel).fadeOut("fast");},300); 
		$('.apply_btn').attr('disabled',false);
	});
} 

function saveForm(){
	$('.apply_btn').attr('disabled',true);
	var data = {
		id:$('#productid').val(),
		name:$('#name').val(),
		model:$('#model').val(), 
		shop_price:$('#shop_price').val(),
		market_price:$('#market_price').val(),
		wei:$('#wei').val(),
		store:$('#store').val(),
		title:$('#title').val(),
		metakey:$('#metakey').val(),
		metadesc:$('#metadesc').val()};
	var url = 'index.php?com=products&task=ajax&act=quikedit&no_html=1';
	parent.saveForm(url,data);
 
}
</script>