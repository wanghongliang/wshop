<?php

include($this->path.DS.'tmpl'.DS.'toolbar_form.php');

import('html.editor');
$editor = Editor::getInstance($GLOBALS['config']['editor']);
?>
<form action="index.php?com=companies"  method="post"  id="menage_form"  >
	<table class="formtable" >

 
		<tr   >
			<td class="form_text" >公司名称</td>
			<td>
				<input type="text" id="name"  name="name" size=50 value="<?php echo $item['name'];?>" />
			</td>
		</tr>


		<tr  >
			<td class="form_text" >联系人</td>
			<td>
				<input type="text" id="contact"  name="contact" size=50 value="<?php echo $item['contact'];?>" />
			</td>
		</tr>

 
 		<tr   >
			<td class="form_text" >联系人职位</td>
			<td>
				<input type="text" id="contact_jobs"  name="contact_jobs" size=50 value="<?php echo $item['contact_jobs'];?>" />
			</td>
		</tr>


		<tr  >
			<td class="form_text" >联系电话</td>
			<td>
				<input type="text" id="phone"  name="phone" size=50 value="<?php echo $item['phone'];?>" />
			</td>
		</tr>

 		<tr  >
			<td class="form_text" >手机</td>
			<td>
				<input type="text" id="mobile"  name="mobile" size=50 value="<?php echo $item['mobile'];?>" />
			</td>
		</tr>
		
		<tr  >
			<td class="form_text" >传真</td>
			<td>
				<input type="text" id="fax"  name="fax" size=50 value="<?php echo $item['fax'];?>" />
			</td>
		</tr>
 		<tr  >
			<td class="form_text" >公司地址</td>
			<td>
				<input type="text" id="address"  name="address" size=50 value="<?php echo $item['address'];?>" />
			</td>
		</tr>
 		<tr  >
			<td class="form_text" >公司网址</td>
			<td>
				<input type="text" id="http"  name="http" size=50 value="<?php echo $item['http'];?>" />
			</td>
		</tr>

		<tr>
			<td colspan=2   >
 				<input type="hidden" value="save" name="task" id="task" />
				<input type="hidden" value="<?php echo $item['id'];?>" name="id" />
				<input type="hidden" value="<?php echo $this->menuid;?>" name="menuid" />
				<input type="hidden" value="" name="return" id="return"  />
				<input type="hidden" value="<?php echo $_REQUEST['tmpl'];?>" name="tmpl" />
			</td>
		</tr>

	</table>
</form>

<script language="javascript" >
 
 	$(function(){
  
		$('.submit_btn').click(function(){	
			$('#menage_form').get(0).submit();
 		});

 	});
</script>