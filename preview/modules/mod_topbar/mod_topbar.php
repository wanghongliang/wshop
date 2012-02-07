<?php 
$session = &Factory::getSession();
$username = $session->get('username'); 
$help_link = Router::_('index.php?itemid=384');
?>
<div id="ptop">
 
		<p class="fleft">欢迎光临格力官方购物平台！
		<?php if( empty($username) ){ ?> 
		<a href="/?com=users" id="plogin">请登录</a> <a href="/?com=users&layout=registor" id="pregister">免费注册</a>
		<?php } ?>
		</p>
		<p class="fright">
			<?php if( !empty($username) ){ echo  ' 欢迎 '.$username.' ！'; }  ?>
			<a href="/index.php?com=users">会员中心</a>  |
			<a href="/index.php?com=users&view=orders">我的订单</a> |
			<?php if( !empty($username) ){ ?>
			<a href="/index.php?com=users&task=logout">退出</a> | 
			<?php } ?>
			<a href="<?php echo Router::_('index.php?itemid=420');?>">关于格力</a> |
			<a href="<?php echo $help_link;?>">帮助中心</a>
			&nbsp;服务电话：<span class="phone">400-800-9869</span>
		</p>
 
</div>

 