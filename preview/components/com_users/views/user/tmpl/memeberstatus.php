<?php
	$session = &Factory::getSession();
	$uid = $session->get('uid');
	if( $uid > 0 ){
	?>
	欢迎回来！
	<strong>
	<a href="/member/"  > 
		<?php	echo $session->get('username'); ?>
	</a>
	</strong>
 
	|
	<a href="/member/"  > 
		<u>我的空间</u>
	</a>
	|
	<a href="index.php?com=users&task=logout" >退出</a>

	 &nbsp;
	<?php }else{ ?>
 	<span id="join_now_span" sizcache="2" sizset="1" style="display: inline">
	<a href="/index.php?com=users&amp;view=user&amp;layout=registor">免费注册</a> 
	|
	</span>
	
	<span id="logon_span" sizcache="2" sizset="3" style="display: inline">
	<a href="/index.php?com=users&amp;view=login">会员登录</a>  &nbsp;
	</span>

	<?php } ?>









