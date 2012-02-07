<?php					
$session = &Factory::getSession();
$username = $session->get('username');
?>
<DIV style="padding:30px;text-align:center;" >
 请填写网站名称和网址，谢谢。
<input  type="button" onclick="publishW();" class="submit_btn btn_save"  
value="重新添加"
/>
<input  onclick="closeDialog();"  type="button" class="cancel_btn btn_cancel"  
value="取消" />
</DIV>
