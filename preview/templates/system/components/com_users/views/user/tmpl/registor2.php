<?php
global $app;

?>
	<div class="container">
		<div class="sub_topbar">
			<div class="sub_top_logo"><a href="/index.php"><img src="<?php echo $this->baseurl;?>/css/images/logo.jpg" border="0" alt="天亿自助建站"></a>
			</div>
			<h1 class="topbar_ad">免费为企业打造电子商务平台</h1>
		</div>

		<div class="sub_content_top"></div>

		<div class="sub_content_bg">
			<div class="sub_content">

				<div class="content">
					<img src="<?php echo $this->baseurl;?>/css/images/register_steps.jpg" border="0" usemap="#steps" alt="注册步骤" />

					<map name="steps" id="steps">
					  <area shape="rect" coords="215,35,325,65" href ="#" alt="选择会员类型" />
					  <area shape="rect" coords="340,35,460,65" href ="#" alt="填写注册信息" />
					  <area shape="rect" coords="470,35,563,65" href ="#" alt="选择会员类型" />
					  <area shape="rect" coords="573,35,666,65" href ="#" alt="选择会员类型" />
					</map>
					<div class="content_title">
						<div class="title_dot"></div>
						<div class="title_name">个人会员注册</div>
						<div class="path">当前位置：<a href="/index.php">首页 > <a href="#">会员注册</a></div>
					</div>


					<form method="post" action="index.php?com=users&task=registor" >
					<table class="register_table" border="0" cellpadding="0" cellspacing="4">

					<?php
					$msg = $app->getMsg();
					if( $msg )
					{
					?>
						<tr>
							<td colspan=3 >
								<?php echo $msg; ?>
							</td>
						</tr>
					<?php
					}
					?>
					<tr>
						<td class="title">用户名</td>
						<td width="220"><input type="text" name="username" class="reg_input_text"> </td>
						<td><div class="tips_left"></div><div class="tips">用户名由6位到12位数字或字符组成。</div></td>
					</tr>
					<tr>
						<td class="title">密码</td>
						<td><input type="password" name="pass"  class="reg_input_text"></td>
						<td></td>
					</tr>
					<tr>
						<td class="title">重新输入密码</td>
						<td><input type="password"  name="repass" class="reg_input_text"></td>
						<td></td>
					</tr>
					<tr>
						<td class="title">电子邮件</td>
						<td><input type="text" name="email" class="reg_input_text"></td>
						<td></td>
					</tr>
					<tr>
						<td class="title">验证码</td>
						<td><input type="text" class="reg_input_text2"><img src="<?php echo $this->baseurl;?>/css/images/code.gif" border="0" class="code"></td>
						<td></td>
					</tr>
					<tr>
						<td colspan="3" class="last">
							<div class="agreement">
								<input type="checkbox">同意<a class="agree" href="#">亿企家服务条款
							</a></div>
							<div class="submit">
								<input type="image"src="<?php echo $this->baseurl;?>/css/images/reg_submit.jpg">
							</div>
						</td>
					</tr>
					</table>

					</form>

					<div class="register_advantages">
						<div class="register_advantages_top"></div>
						<div class="register_advantages_center">
							<div class="register_title">
								<span class="title">注册亿企家会员</span><br>
								您将免费享受一下服务
							</div>
							<ul class="reg_advantages">
								<li>
									<div class="reg_advantages_dot"><img src="<?php echo $this->baseurl;?>/css/images/reg_advantages_dot1.gif" border="0"></div>
									<div class="advantages_word">免费获得自己的网站！</div>
								</li>
								<li>
									<div class="reg_advantages_dot"><img src="<?php echo $this->baseurl;?>/css/images/reg_advantages_dot2.gif" border="0"></div>
									<div class="advantages_word">免费发布自己的产品供求信息！</div>
								</li>
								<li>
									<div class="reg_advantages_dot"><img src="<?php echo $this->baseurl;?>/css/images/reg_advantages_dot3.gif" border="0"></div>
									<div class="advantages_word">推广自己的产品！</div>
								</li>
								<li>
									<div class="reg_advantages_dot"><img src="<?php echo $this->baseurl;?>/css/images/reg_advantages_dot4.gif" border="0"></div>
									<div class="advantages_word">结交商友，网络人脉！</div>
								</li>
							</ul>
						</div>
						<div class="register_advantages_bottom"></div>
					</div>
					<div class="clr"></div>

				</div>
				
			</div>
		</div>
		<div class="sub_content_bottom"></div>

		<div class="foot">
			<div class="foot_logo">
				<img src="<?php echo $this->baseurl;?>/css/images/foot_logo.jpg" alt="亿企家商务平台">
			</div>
			<div class="foot_line"></div>
			<ul class="foot_menu">
				<li class="name"><a href="#">关于我们</a></li>
				<li class="line">|</li>
				<li class="name"><a href="#">法律声明</a></li>
				<li class="line">|</li>
				<li class="name"><a href="#">广告服务</a></li>
				<li class="line">|</li>
				<li class="name"><a href="#">合作伙伴</a></li>
				<li class="line">|</li>
				<li class="name"><a href="#">诚聘英才</a></li>
				<li class="line">|</li>
				<li class="name"><a href="#">意见反馈</a></li>
				<li class="line">|</li>
				<li class="name"><a href="#">联系我们</a></li>
			</ul>
			<div class="copyright">
				深圳市天亿网络技术有限公司-版权所有 Copyright©2008—2009 www.daybillion.com All Rights Reserved. 
			</div>
		</div>

	</div>
