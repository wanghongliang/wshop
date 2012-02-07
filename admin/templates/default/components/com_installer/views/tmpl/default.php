<?
include($this->path.DS.'tmpl'.DS.'toolbar.php');
?>

<table class="formtable"  >
	<tr class="style1" >
		<td colspan=2 >
			请上传需要安装的文件	
		</td>
	</tr>
	<tr>
		<td colspan=2 > 
			上传压缩包文件, 文件类型限定为 zip 格式
			<br/>
			<form enctype="multipart/form-data" action="index.php?com=installer" method="post" name="adminForm" >
				<input type="file" name="upload" size="50" /><input type="submit" value="上传" />
				<input type="hidden" name="task" value="uploadinstaller" />
			</form>
		</td>
	</tr>
</table>
 