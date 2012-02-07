<?php					
$session = &Factory::getSession();
$username = $session->get('username');
?>
<DIV style="padding:30px;text-align:center;" >
	您上传的文件过大，文件大小不能超过1M,谢谢.
	<input  type="button" onclick="publishW();" class="submit_btn btn_save"  
value="重新添加"
/>
<input  onclick="closeDialog();"  type="button" class="cancel_btn btn_cancel"  
value="关闭" />
</DIV>
