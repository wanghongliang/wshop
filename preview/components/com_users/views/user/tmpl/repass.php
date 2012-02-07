<div class="path" >
	<a href="/" >首页</a>
	>
	<a href="#" >找回密码</a>

</div>
<div class="repass">
	<form action="index.php?com=users&task=sendpassactive" method=post >
	<h3>会员找回密码</h3>

	<?php 
	global $app;
	$msg = $app->getMessageQueue();
    
	 if( is_array($msg) ){
		?>
		<div class="message" > <div class="msg_">
		<?php
		echo $msg[0]['message'];
		?></div>
		</div>
	<?php  } ?>
	请输入您的账号:

	<input type="text" name="uname" value="" class="ftext" />
	<br/>


	<input type="submit" value="提交" class="fbtn"  />
	</form>

	<div class="p_remark">
	</div>
</div>