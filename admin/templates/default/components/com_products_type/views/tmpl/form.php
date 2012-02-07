<?php
include($this->path.DS.'tmpl'.DS.'toolbar_form.php');
?>
<div class="clr" ></div>
<form action="<?php echo $this->baseuri;?>"  method="post"  >
	<table class="formtable" >
		<tr>
			<td class="form_text" >类型名称</td>
			<td>
				<input type="text" name="name" size=30 value="<?php echo $item['name'];?>" />
			</td>
		</tr> 
		
		<tr class="bordernone" >
			<td  >
			</td>
			<td>
				<input type="submit" value="提交" />
				<input type="button" value="取消" onclick="location.href='<?php echo $this->baseuri;?>'" />

				<input type="hidden" value="save" name="task" />

				<input type="hidden" value="<?php echo $item['id'];?>" name="id" />
			</td>
		</tr>

	</table>
</form>