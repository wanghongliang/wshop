
<?php if( $_REQUEST['no_html'] == 1 ){

	$uri=&URI::getInstance();
	$valify = rand(108, 949);
	$session = &Factory::getSession();
	$session->set('valify',$valify);
	?>

	<div class="" style="padding-top:10px; " >

		<table  class="logintable" cellspacing="0" cellpadding="0" border="0" align="center" >
			<tbody>
 			<tr>
				<td  class="login04"  colspan="3"><h2>会员登录</h2></td>
			</tr>
		<?php
		$msg = $app->getMsg();
		?>
			<?php
			if( $msg )
			{
			?>
				<tr>
					<td colspan=3     >
						<?php echo $msg; ?>
					</td>
				</tr>
			<?php
			}else{
			?>


			<?php
			}
			?>

			<tr>
				<td width="40"   class="login05">帐号</td>
				<td  >
				<input type="text" id="username" size=10 maxlength="100" name="username" class="logininp"></td>
				<td  > </td>
			</tr>
			<tr>
				<td   class="login05">密码</td>
				<td ><input type="password" id="pass"  size=10  maxlength="100" name="pass" class="logininp"><a class="login06" target="_blank" href="/index.php?com=users&task=repass">&nbsp;找回密码</a></td>
				<td  ></td>
			</tr>
			<tr>
				<td ></td>
				<td  ><a href="/?com=users&layout=registor" class="forget"  >我还没有账号？ 现在免费注册</a></td>
				<td  ></td>
			</tr>
			<tr>
				<td  ></td>
				<td >
				<input   type="image" class="denglu" src="/preview/templates/default/images/lgbt.jpg" onclick="submitF()"  name="image">
 				<input   type="hidden"  name="return" value="<?php echo urlencode($_REQUEST['return']);?>" id="return"  />
 				<input   type="hidden"  name="valify" value="<?php echo $valify;?>" id="valify"  />
				</td>
				<td >
				</td>
			</tr>

		</tbody>
		</table>
		<script language="javascript">

			function KillSpace(x){
				while((x.length>0) && (x.charAt(0)==' '))
					x = x.substring(1,x.length);
				while((x.length>0)&& (x.charAt(x.length-1)==' '))
					x = x.substring(0,x.length-1);

				return x.replace(/&amp;nbsp;/g,"");
			}

		    function submitF()
			{
				var username = document.getElementById("username").value;
				var pass = document.getElementById("pass").value;
				var valify = document.getElementById("valify").value;
				if ( KillSpace(username) == "" )
				{
					alert("请输入用户名!");
					document.all("username").focus();
					return false;
				}
				if ( KillSpace(pass) == "" )
				{
					alert("请输入密码!");
					document.all("pass").focus();
					return false;
				}

				var url = '/index.php?com=users&task=dologin&no_html=1&return='+document.getElementById("return").value;
				$.get(url,{'username':username,'pass':pass,'valify':valify},function(data){
					$('.con',div).html(data);
				});

			}
		</script>

	</div>
<?php }else{ ?>
	<div id="header"><h1 id="gree_logo"><a href="/" >格力网上购物平台</a></h1></div>
	<div class="flv pad-b20">
	<div id="logindiv">
		<div class="loginbot" >
		<div id="logohead"><h3>会员登录</h3><h3><a href="/?com=users&layout=registor">免费注册</a></h3></div>
		<div id="loginform">


	<form onsubmit="return CheckForm();" style="margin: 0px;" id="Form1" action="index.php?com=users&task=dologin"  method="post" name="Form1">
		<?php
		$msg = $app->getMsg();
		if( $msg )
		{
		 echo $msg;

		}
		?>
		<p>
			<label class="inlab" for="username">帐户名：</label>
			<input type="text" id="username" maxlength="100" name="username" class="logininp">
		</p>
		<p>
			<label class="inlab" for="pwd">密 码：</label>
			<input type="password" id="pass" maxlength="100" name="pass" class="logininp">
		</p>
		<p class="mag-l80">
			<input type="checkbox" name="record" id="record" value="1" /> <label for="record">两周内免登录</label>
		</p>
		<p class="mag-l80">
			<input type="submit" value="登 录" id="logbtn" class="denglu"  />&nbsp;&nbsp;&nbsp;&nbsp; <a href="index.php?com=users&task=repass" class="col2">忘记密码？</a>
			<input   type="hidden"  name="return" value="<?php echo $_REQUEST['return'];?>"  />


		</p>



	</form>


		</div>
		<div id="log-help">服务电话：0755-27836989  <a href="/xinshouzhinan/187.html" class="col2">如何注册？</a></div>

		<div class="lh" ></div>
		</div>
	</div>
	<div id="log-thumb"><img src="/preview/templates/default/images/login.jpg" alt=""/></div>
	</div>
	<?php
	$item	=& ModuleHelper::getModule('mod_copyright');
	echo ModuleHelper::renderModule($item);
	?>




	<script language="javascript">
		function KillSpace(x){
			while((x.length>0) && (x.charAt(0)==' '))
				x = x.substring(1,x.length);
			while((x.length>0)&& (x.charAt(x.length-1)==' '))
				x = x.substring(0,x.length-1);

			return x.replace(/&amp;nbsp;/g,"");
		}

		CheckForm = function()
		{
			if ( KillSpace(document.all("username").value) == "" )
			{
				alert("请输入用户名!");
				document.all("username").focus();
				return false;
			}
			if ( KillSpace(document.all("pass").value) == "" )
			{
				alert("请输入密码!");
				document.all("pass").focus();
				return false;
			}

		}
	</script>





<?php } ?>