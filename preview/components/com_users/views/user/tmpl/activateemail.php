

<div class="regheader" >
	<div class="topnav" >
		<div class="" >
			<a href="/" >首页</a>
			<a href="/index.php?com=users&view=login" >登陆</a>
			<a href="#" >帮助中心</a>
		</div>

		<div class="" >
		如遇注册问题请发邮件，<span class="sm">onetree@yeah.net</span>
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


<?php/** ?>
<div class="regheader" >
	<?php
	$module =& ModuleHelper::getModule('mod_logo');
    echo ModuleHelper::renderModule($module);
 	?>
 	<div class="regpath" >
	<?php
	$pathway = &$app->getPathWay();
 	$pathway->addItem('注册新会员','/index.php?com=users&view=user&layout=registor');
	$pathway->addItem('公司信息','#');
 	$modules  =& ModuleHelper::getModules('breadcrumbs');
 	foreach( $modules as $item ){
	  echo ModuleHelper::renderModule($item );
	}
 	?>
	</div>
</div>
<?php **/ ?>


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
			<div class="title_info">
				<div class="right_dot"></div>
				<h1><?php echo $this->username;?> 注册成功，请登陆你的邮箱激活你的账号！</h1>
			</div>

			<div class="register_info">
				<span class="id_info">您的用户名:<?php echo $this->username;?> &nbsp;&nbsp;&nbsp;&nbsp; 您的电子邮箱:<?php echo $this->email;?></span><br><br>
				<b>请验证您的电子邮箱，以便享受更多服务。</b><br>
				 • 我们已经给您的注册邮箱发送了<a href="#">验证邮件</a>，请查收。<br>
				 • 您只需点击邮件里的链接，即可完成验证。<br><br>
				<b>没收到邮件？</b><br>
				 • 可以到您邮箱的垃圾邮件或广告邮件文件夹中找找。<br>
				 • 也可能是由于邮件系统繁忙，请过几个小时再查收您的邮件。<br>
				 • 或点击<a href="#">再次发送验证邮件</a>重新给你的邮箱发送验证邮件。<br>

				 <div  style="border-top:1px solid #eee;padding:10px 0px;margin-top:10px;" >
					<a href="index.php" ><u>返回到首页</u></a>
				</div>

			</div>

		</div>
	</div>
  <div class="stepborderBottom2"></div>
  <div class="stepborderBottom3"></div>



