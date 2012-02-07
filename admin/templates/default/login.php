<html>
	<head>
		<title>系统登陆</title>
		<link href="<?php echo $this->baseurl;?>/css/reset.css" type="text/css" rel="stylesheet" />
		<link href="<?php echo $this->baseurl;?>/css/daybillion.css" type="text/css" rel="stylesheet" />
		<link href="<?php echo $this->baseurl;?>/css/admin.css" type="text/css" rel="stylesheet" />
		<link href="<?php echo $this->baseurl;?>/css/login.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="<?php echo $this->baseurl;?>/js/jquery-1.2.6.min.js"></script>
	</head>
	<body>
 
				<div class="login-panel" >
 				<div class="login-body" >
					<form method="post" action="index.php?task=login" >

					
					<table border="0">
					  <tr>
					    <td rowspan=5 >
						<div class="login-logo" >
						 
						</div>
						</td>

						<td class="label_text">	
						
						<?php
						global $app;
						$msg = $app->getMsg();
						if( $msg )
						{
						?>
 						<?php echo $msg; ?>
 						<?php
						}
						?>

						账　号：</td>
					  </tr>
					  <tr>
						<td>
						  <input type="text" name="username" class="input_text">
						</td>
					  </tr>
					  <tr>
						<td  class="label_text" >密　码：</td>
					  </tr>
					  <tr>
						<td><input type="password" name="pass" class="input_text"></td>

					  </tr>

						<tr>
 							<td class="" ><input type="submit" class="input-button" value="登录" alt="登录"> </td>
					  </tr>
					 </table>
				 </form>
				 </div>
				<div class="login-link" >
				 <a href="../" >回到前台首页</a>&nbsp;&nbsp;  |  &nbsp;&nbsp;<a href="#" >技术支持</a>
				 </div>
				 </div>
				
 	</body>
</html>