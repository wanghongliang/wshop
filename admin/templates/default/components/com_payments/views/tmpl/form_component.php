
<?
include($this->path.DS.'tmpl'.DS.'toolbar_form_component.php');
?>
 <form action="<?php echo $this->baseuri;?>"  method="post"  id="menage_form" name="listform"  >

	<table class="formtable"  >

		<tr class="style1" >
			<th   colspan=2 >
			留言信息
			</th>
		</tr>
 
		<tr  >
			<td class="form_text" >标题:</td>
			<td>
				<input type="text" id="title"  name="title" size=30 value="<?php echo $item['title'];?>" />
			</td>
		</tr>
		<tr >
			<td class="form_text" >内容:</td>
			<td>
				<textarea cols=60 rows=6 name="content" ><?php echo $item['content'];?></textarea>
			</td>
		</tr>
		<tr  >
			<td class="form_text" >回复:</td>
			<td>
				<textarea cols=60 rows=6 name="reply_content" ><?php echo $item['reply_content'];?></textarea>
			</td>
		</tr>
		<tr  >
			<td class="form_text" >发表日期:</td>
			<td>
				<input type="text" id="release_date"  name="release_date" size=30 value="<?php echo $item['release_date'];?>" />
			</td>
		</tr>

		<tr   >
			<td class="form_text" >是否锁定:</td>
			<td>
				<input type="radio" id="published"  name="published"  value="0" <?php echo $item['published']==0?'checked':''; ?> /> 锁定

				<input type="radio" id="published"  name="published"  value="1" <?php echo $item['published']==1?'checked':''; ?> /> 打开
			</td>
		</tr>
		<tr class="style1" >
			<th   colspan=2 >
				留言人信息
			</th>
		</tr>
		<tr  >
			<td class="form_text" >留言人姓名:</td>
			<td>
				<input type="text" id="author"  name="author" size=30 value="<?php echo $item['author'];?>" />
			</td>
		</tr>
		<tr  >
			<td class="form_text" >公司名称:</td>
			<td>
				<input type="text" id="company"  name="company" size=30 value="<?php echo $item['company'];?>" />
			</td>
		</tr>
		<tr  >
			<td class="form_text" >联系电话:</td>
			<td>
				<input type="text" id="phone"  name="phone" size=30 value="<?php echo $item['phone'];?>" />
			</td>
		</tr>
		<tr  >
			<td class="form_text" >E-mail:</td>
			<td>
				<input type="text" id="email"  name="email" size=30 value="<?php echo $item['email'];?>" />
			</td>
		</tr>
		<tr  >
			<td class="form_text" >联系地址:</td>
			<td>
				<input type="text" id="address"  name="address" size=30 value="<?php echo $item['address'];?>" />
			</td>
		</tr> 
		
		<tr>
			<td colspan=2 >
				<input type="button" class="submit_btn" value="提交" />
 
				<input type="button" class="cancel_btn"  value="取消" />

				<input type="hidden" value="save" name="task" id="task" />
				<input type="hidden" value="reply_date" name="reply_date" id="reply_date" />
				<input type="hidden" value="<?php echo $item['id'];?>" name="id" />
			</td>
		</tr>

	</table>
</form>

<script language="javascript" >
 	$(function(){
		$('.submit_btn').click(function(){
 			$('#menage_form').get(0).submit();
			return true;
 		});

		$('.apply_btn').click(function(){	
			$('#return').attr('value','<?php echo URI::current();?>');
			$('#menage_form').get(0).submit();
 		});

		$('.cancel_btn').click(function(){	
			location.href='index.php?com=feedbacks<?php if( $_REQUEST['tmpl']== 'component' ){ echo "&tmpl=component";}?>';
 		});
	});
</script>