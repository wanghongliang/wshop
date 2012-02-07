	<div class="container">

		<div class="index_topbar">
			<div class="index_top_logo"><a href="/index.php"><img src="<?php echo $this->baseurl;?>/css/images/logo.jpg" border="0" alt="天亿自助建站"></a>
			</div>
			<h1 class="topbar_ad">免费为企业打造电子商务平台</h1>
		</div>

		<div class="content_top">

			<div class="index_banner"><img src="<?php echo $this->baseurl;?>/css/images/index_banner.jpg"></div>
			<div class="login_box">
				<div class="login_logo">
					<img src="<?php echo $this->baseurl;?>/css/images/login_logo.jpg" alt="亿企家会员登录">
				</div>

				<form method="post" action="index.php?com=users&task=login" >

				<table width="100%" border="0">

					<?php
					$msg = $app->getMsg();
					if( $msg )
					{
					?>
						<tr>
							<td colspan=2 >
								<?php echo $msg; ?>
							</td>
						</tr>
					<?php
					}
					?>

				  <tr>
					<td width="70" align="right" height="30">用户名：</td>
					<td>
					  <input type="text" name="username" class="input_text">
					</td>
				  </tr>
				  <tr>
					<td align="right" height="30">密　码：</td>
					<td><input type="password" name="pass" class="input_text"></td>
				  </tr>
				  <tr>
					<td></td>
					<td>
					  <input type="checkbox" name="checkbox" value="checkbox">
					  <span class="login_span">两周内自动登录</span>
					</td>
				  </tr>
				  <tr>
					<td></td>
					<td><input type="image" src="<?php echo $this->baseurl;?>/css/images/reg_button.jpg" border="0" alt="登录">&nbsp;&nbsp;<a class="get_password" href="#">找回密码？</a></td>
				  </tr>
				  <tr>
					<td></td>
					<td><span class="login_span">&nbsp;现无 qoid.com 账号？</span><a class="reg" href="index.php?com=users&view=user&layout=registor">立即注册</a></td>
				  </tr>
				</table>
				</form>

			</div>
			<div class="login_right"></div>

		</div>
		<div class="content">
			<div class="content_left">

				<ul class="advantages">
					<li>
						<img class="advantages_img" src="<?php echo $this->baseurl;?>/css/images/advantages1.jpg">
						<div class="advantages_title">彰显尊贵身份</div>
						独立服务器，独享超宽带，数据多重备份，免费赠送功能强大的商务通服务，尊贵体验就在亿企家商务平台。独立服务器，独享超宽带，数据多重备份，企业建站无忧。
					</li>
					<li>
						<img class="advantages_img" src="<?php echo $this->baseurl;?>/css/images/advantages2.jpg">
						<div class="advantages_title">彰显尊贵身份</div>
						独立服务器，独享超宽带，数据多重备份，免费赠送功能强大的商务通服务，尊贵体验就在亿企家商务平台。独立服务器，独享超宽带，数据多重备份，企业建站无忧。
					</li>
					<li>
						<img class="advantages_img" src="<?php echo $this->baseurl;?>/css/images/advantages3.jpg">
						<div class="advantages_title">彰显尊贵身份</div>
						独立服务器，独享超宽带，数据多重备份，免费赠送功能强大的商务通服务，尊贵体验就在亿企家商务平台。独立服务器，独享超宽带，数据多重备份，企业建站无忧。
					</li>
				</ul>

				<div class="reg_advantages">
					<div class="reg_advantages1"></div>
					<div class="reg_advantages2">注册亿企家</div>
					<div class="reg_advantages3"></div>
					<ul class="reg_advantages4">
						<li><div class="advantages_dot"></div>拥有企业商务网站</li>
						<li><div class="advantages_dot"></div>添加企业产品和资料</li>
						<li><div class="advantages_dot"></div>商务在线跟踪企业订单</li>
					</ul>
					<div class="reg_advantages5"></div>
				</div>
			</div>

			<div class="content_middle"></div>
			<div class="login_under">
				<div class="login_line"></div>
				<ul class="articles_list">
					<li><div class="article_dot"></div>用亿企家我能做什么？</li>
					<li><div class="article_dot"></div>我怎么升级我的网站？</li>
					<li><div class="article_dot"></div>亿企家怎么做互联网广告和产品竞价？</li>
					<li><div class="article_dot"></div>怎么用亿企家赚钱？</li>
				</ul>
			</div>
			<div class="content_right"></div>
		</div>

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
