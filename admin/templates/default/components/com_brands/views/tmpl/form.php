<?php
include($this->path.DS.'tmpl'.DS.'toolbar_form.php');
?>
<div class="clr" ></div>
<form action="<?php echo $this->baseuri;?>"  method="post"  name="menage_form" id="menage_form" >
	<table class="formtable" >
		<tr>
			<td class="form_text" >品牌名称</td>
			<td>
				<input type="text" name="brand_name" size=30 value="<?php echo $item['brand_name'];?>" />
			</td>
		</tr> 

        <tr>
            <td class="form_text" >logo图片</td>
            <td>
                <input type="text" id="brand_logo" name="brand_logo" size="40" value="<? echo $item['brand_logo']?>">
                <input type="button" name="" value="上传图片" onclick="upload('brand_logo')" />
				<input name="" value=".." onclick="selectImage('brand_logo')" type="button">
            </td>
        </tr>
        <tr>
            <td class="form_text" >网址</td>
            <td>
                <input type="text" id="url" name="url" size="40" value="<? echo $item['url']?>">
            </td>
        </tr>
        <tr>
            <td class="form_text" >排序</td>
            <td>
                <input type="text" id="ordering" name="ordering" size="5" value="<? echo $item['ordering']?>">
            </td>
        </tr>
 		 <tr>
            <td class="form_text" >是否发布</td>
            <td><input type="radio" name="published" value="1" <? echo ( $item['published'] || !$_REQUEST['id'])?' checked':''; ?>/>发布 <input type="radio" name="published" value="0" <? echo (!$item['published'] && $_REQUEST['id'])?' checked':''; ?>/>不发布</td>
        </tr>
        <tr>
            <td class="form_text" >备注</td>
            <td>
                <textarea name="brand_desc" cols="40" rows="5"><? echo $item['brand_desc']; ?></textarea>
            </td>
        </tr>
		<tr class="bordernone" >
			<td  >
			</td>
			<td>
				<input type="button" class="submit_btn" value="保存"/>
				<input type="button" class="apply_btn" value="应用" />
				<input type="reset" class="cancel_btn" value="取消" />

				<input type="hidden" value="" name="return" id="return" />
				<input type="hidden" value="save" name="task" />
				<input type="hidden" value="<?php echo $item['brand_id'];?>" name="id" />
			</td>
		</tr>

	</table>
</form>

<script language="javascript" >

	var url_current ='<?php echo URI::current();?>';
	

	$(function(){

			$('.submit_btn').click(function(){	
				 
					$('#menage_form').get(0).submit();
				 
			});

			$('.apply_btn').click(function(){	
				$('#return').attr('value',url_current);
				$('#menage_form').get(0).submit();
 			});

			$('.cancel_btn').click(function(){
				location.href='index.php?com=brands<?php if( $_REQUEST['tmpl'] != '' ){ echo "&tmpl=".$_REQUEST['tmpl'];}?>&menuid=<?php echo $this->menuid;?>';
			});
	 


			
		});
	
</script>