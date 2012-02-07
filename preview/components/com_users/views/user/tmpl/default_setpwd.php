<div class="right_top" >
<h2  >修改密码</h2><span class="goon_btn"><a title="首页" href="./" style="color: rgb(255, 255, 255);">继续购物</a></span>
</div> 
  
<div class="ubox">
<?php
$msg = $app->getMsg(); 
if( $msg )
{  echo $msg; 
}  
?>
<form onsubmit="return checkregform(this);" name="form_reg" method="post">

<table width="670" cellspacing="5" cellpadding="0" border="0"  class="login_table" style="margin: 30px auto 15px;"> 
 	<tr>
		<td height="22" class="ft" >旧密码：</td>
		<td>
			<input type="password" class="input_02" maxlength="30" size="30" name="oldpass">
		</td>
	</tr>
	<tr>
		<td height="22" class="ft" >新密码：</td>
		<td>
			<input type="password" class="input_02" maxlength="30" size="30" name="pass">
		</td>
	</tr>
	<tr>
		<td height="22" class="ft" >请再次输入新密码：</td>
		<td>
			<input type="password" class="input_02" maxlength="30" size="30" name="pass2">
		</td>
	</tr>
	<tr>
			<td height="22">&nbsp;</td>
			<td height="60">
				<input type="hidden" name="task" value="edit" />
				<input type="hidden" name="act2" value="save" />
				<input type="submit" class="u_btn" value="保存修改">
			</td>
		</tr>
</tbody></table>
</form>

</div>
 
 <script language="javascript" >
function checkregform(obj){
	 if( $('input[name=pass]').val() != $('input[name=pass2]').val() ){
		 alert(' 两次输入的密码不一致,请重新输入! ');
		 return false;
	 }
}
</script>