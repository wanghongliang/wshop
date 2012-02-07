<?php 
$session = &Factory::getSession();
$username = $session->get('username'); 

$m = &$app->getMenu();
$active = $m->getActive();
$m->buildLink( $active );
$link = $active['link'];
 


$contact_link = Router::_('index.php?itemid=428');
?>
<div id="header"> 
	<?php
	$item	=& ModuleHelper::getModule('mod_logo');
	echo ModuleHelper::renderModule($item);
	?>


	<div class="flvr">
		<div id="headlab">
			<a href="/">回商城首页</a> |
			<a href="<?php echo $contact_link;?>">联系我们</a> |
			<a href="">收藏本站</a>
		</div>
		<div id="headsearch">
			<form action="<?php echo $link;?>?a=subscribe" id="subscribe" method="post" target="_blank" >
				<input type="text" name="email" id="email" value="输入EMAIL信息，订阅每日团购信息！"/>
				<input type="button" id="ebtn" value="订阅" />
			</form>
		</div>
	</div>

</div>


<div id="tmenu">

	<ul>
		<li><a href="<?php echo $link;?>" class="now">今日团购</a></li>
		<li><a href="<?php echo $link;?>?a=historyteam">往期团购</a></li>
		<li><a href="<?php echo $link;?>?a=tour">玩转格力</a></li>
		<li><a href="<?php echo $link;?>?a=quest">常见问题</a></li>
		<li><a href="<?php echo '/'.RouterSite::getMemberName();?>" title="返回首页" > 回商场首页</a></li>
	</ul> 

	<p class="flvr">
		<?php if( !empty($username) ){ ?> 
			<a href="/?com=users" ><?php  echo  ' 欢迎 '.$username.' ！'; ?></a>
		<?php }else{ ?>
		<a href="/?com=users">登录</a> &nbsp;<a href="/?com=users&layout=registor">注册</a>
		<?php } ?>
	</p>

</div>