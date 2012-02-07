<?php
$session = &Factory::getSession();	//session
$username = $session->get('username');	//会员名称

?>
<div class="user" >
	<div class="user_name" >
		<?php echo $username; ?>
	</div>
	<div class="clr"></div>
	<div class="user_company" >
		深圳市天亿网络技术有限..
	</div>
</div>