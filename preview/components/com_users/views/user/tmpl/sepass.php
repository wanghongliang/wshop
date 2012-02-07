<div class="path" >
	<a href="/" >首页</a>
	>
	<a href="index.php?com=users&task=repass" >找回密码</a>
	>
	<a href="#" >设置新密码</a>
</div>
<div class="repass">


	<form action="index.php?com=users&task=confirmpass" method=post >
	<h3>设置新密码</h3>
	您的账号:<?php echo $this->username;?>
	<br/>
	新密码：<input type="password" name="pass" value="" class="ftext" />
	<br/>
	重新输入：<input type="password" name="repass" value="" class="ftext" />
	<br/>
	<input type="hidden" name="code" value="<?php echo $this->code;?>" />
	<input type="hidden" name="username" value="<?php echo $this->username;?>"  />
	<input type="submit" value="确认"  class="fbtn"  />
	</form>


 
	<div class="p_remark">
	</div>
</div>

 