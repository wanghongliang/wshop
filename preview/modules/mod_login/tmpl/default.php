<?php
$session = &Factory::getSession();
 $uid = $session->get('uid')
?>

<div  class="mod mod_login"  id="<?php echo $module->module,'-',$module->id;?>"  >
	<dl>
		<dt>
 			<span>	
			<a href="/member/">
 				<?php
				if( $uid ){
					echo '会员管理中心';
				}else{
					echo '会员登陆';
				}
				?>
			</a>
			</span>
		</dt>
		<dd>
		
 			<div class="login_box">
 
				<form method="post" action="<?php echo Router::_('index.php?com=users&task=dologin');?>" >

					<?php
					if( $uid )
					{
						?>				
						<table  border="0"  class="logined" >

						<tr>
							<td>
								欢迎回来！<strong><a href="/member/" target=_blank > <?php	echo $session->get('username'); ?>
									</a></strong>
									&nbsp;
									<a href="index.php?com=users&task=logout" >退出</a>
							</td>
							
						</tr>
						<tr>
							<td colspan=2 >
								<p>您有<span class="red"><strong>0</strong></span>封<a href="/message.do?action=inbox">新邮件</a></p>
								
								<a href="/member/?com=products&task=add" >添加新产品</a> |
								
								<a href="/member/?com=products&task=add" >添加新商情</a>
								 | <a href="/china/index.php/<?echo $session->get('username');?>" target=_blank >我的展示厅</a>
			 				</td>
						</tr>
						</table>
						<div class="join_line" ></div>
						<div class="join" href="<?php echo Router::_('index.php?com=users&task=reg');?>" title="免费注册" >
							<ul>
								<Li><a href="#" >新产品专区</a></li>
								<li><a href="#" >友客旺铺</a></Li>
								<li><a href="#" >高级搜索</a></Li>
								<li><a href="#" >热点关键词</a></Li>
								<li><a href="#" >推广服务</a></Li>
								<li><a href="#" >积分攻略</a></Li>
								<li><a href="#" >发布供应信息</a></Li>
								<li><a href="#" >发布产品信息</a></Li>
							</ul>
						</div>
						<?php
					}else{

					?>
					<table width="100%" border="0"   >
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
						<td><input type="submit" value="登录" border="0"  >&nbsp;&nbsp;<a class="get_password" href="#">忘记密码？</a></td>
					  </tr>
					  </table>
					<div class="join_line" ></div>
					  <div class="join" href="/index.php?com=users&view=user&layout=registor" title="免费注册" target=_blank  >
							<ul>
								<Li><a href="#" >新产品专区</a></li>
								<li><a href="#" >友客旺铺</a></Li>
								<li><a href="#" >高级搜索</a></Li>
								<li><a href="#" >热点关键词</a></Li>
								<li><a href="#" >推广服务</a></Li>
								<li><a href="#" >积分攻略</a></Li>
								<li><a href="#" >发布供应信息</a></Li>
								<li><a href="#" >发布产品信息</a></Li>
							</ul>
						</div>

					<?php
					}
					?>
 			
				</form>
			</div>
 </dd>
</dl>
</div>