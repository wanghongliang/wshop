<?php
include($this->path.DS.'tmpl'.DS.'toolbar_form.php');

?>
<form action="index.php?com=menutype"  method="post"  >
	<table class="formtable" >
		<tr>
			<td>菜单名称</td>
			<td>
				<input type="text" name="title" size=30 value="<?php echo $item['title'];?>" />
			</td>
		</tr>
		<tr>
			<td>排序值</td>
			<td>
				<input type="text" name="ordering" size=30 value="<?php echo $item['ordering'];?>" />
			</td>
		</tr>

		<tr>
			<td>描述</td>
			<td>
				<?php echo $description;?>
			</td>
		</tr>	
		
 

 
	</table>
 

				<input type="hidden" value="save" name="task" />

				<input type="hidden" value="<?php echo $item['id'];?>" name="id" />
 <div class="formbtn" >
				<input type="submit"  class="btn" value="提交" />
				<input type="button"  class="btn" value="取消" onclick="location.href='<?php echo $this->baseuri;?>'" />
 </div>
</form>