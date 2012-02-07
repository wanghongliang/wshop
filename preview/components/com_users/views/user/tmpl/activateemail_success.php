
<div class="regheader" >
	<div class="topnav" >
		<div class="" >
			<a href="/" >首页</a>
			<a href="/index.php?com=users&view=login" >登陆</a>
			<a href="#" >帮助中心</a>
		</div>

		<div class="" >
		如遇注册问题请拨打，<span class="sm">0755-27803441</span>
		</div>
	</div>

	<?php
	$module =& ModuleHelper::getModule('mod_logo');
    echo ModuleHelper::renderModule($module);
 	?>
	 <div class="login_title" >
		 免费注册  	
	 </div>
</div>
<div class="clr" ></div>

<?php /*** ?>
<div class="regheader" >
	<?php
	$module =& ModuleHelper::getModule('mod_logo');
    echo ModuleHelper::renderModule($module);
 	?>
 	<div class="regpath" >
	<?php
	$pathway = &$app->getPathWay();
 	$pathway->addItem('注册新会员','/index.php?com=users&view=user&layout=registor');
	$pathway->addItem('激活成功！','#');
 	$modules  =& ModuleHelper::getModules('breadcrumbs');
 	foreach( $modules as $item ){
	  echo ModuleHelper::renderModule($item );
	}
 	?>
	</div>
</div>
<?php ***/ ?>
<div class="stepTop">
	<a href="/" >首页</a>
	>
	<a href="/index.php?com=users&view=user&layout=registor" >用户注册</a>
	>
	<a href="" >邮箱激活</a>
	>
	<a href="" >注册成功</a>

</div>
<br/>
<div class="stepborderTop3"></div>
<div class="stepborderTop2"></div>
	<div class="stepborder">
		<div class="content">
			<div class="title_info"><div class="right_dot"></div><?php echo $this->username;?>
			验证成功，感谢您的注册！</div>
			<div class="register_info">
			<span class="id_info">
			您的用户名:<?php echo $this->username;?>&nbsp; &nbsp; &nbsp; &nbsp; 
			<a href="/" ><u>返回首页</u></a> &nbsp; &nbsp; 
			<a href="/index.php?com=users&task=login" ><u>立即登陆</u></a>
			</span>
			<br><br>
			<b>登陆后，您可以：</b><br>
			 • <a href="#">发布分类信息</a><br>
			 你可以在亿企家发布您的供求信息！<br>
			 • <a href="#">预览您的网站</a><br>
			 你可以现在就预览自己的网站！<br>
			 • <a href="#">进入管理后台</a><br>
			 你可以进入后台管理自己的网站！<br>
			 • <a href="#">回到分类首页</a><br>
			 你可以回到分类首页查看信息！<br>
			 • <a href="#">去亿企家家园</a><br>
			 你可以去亿企家家园结交商友，拓展人脉！<br>
			</div>
			
		</div>
		</div>
  <div class="stepborderBottom2"></div>
  <div class="stepborderBottom3"></div>



		