<div class="sright">
	<h2 class="stitle2">在线咨询<span style="font-weight:normal; color:#ED0E0E;"></span></h2>
	<div class="sgform">
			<div class="" >
			<?php
			$msg = $app->getMsg(); 
			if( $msg )
			{  echo $msg; 
			}  
			?>
			</div>
		<form action="<?php echo $uri->getByURL(array('a'=>'cons'));?>" method="post">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="reform">

				<tr><th>咨询标题：</th><td><input type="text" name="title" id="title" size="35" value="<?php echo $_GET['title'];?>" /></td></tr>
				<tr><th>咨询内容：</th><td><textarea name="content" id="content" cols="50" rows="8"><?php echo $_GET['content'];?></textarea></td></tr>


				<tr><th>用户名：</th><td><input type="text" name="username" id="username" size="35" value="<?php echo $_GET['username'];?>" /></td></tr>
				<tr><th>销售单号：</th><td><input type="text" name="order_sn" id="order_sn" size="35" value="<?php echo $_GET['order_sn'];?>"  /></td></tr>
				<tr><th>固定电话：</th><td><input type="text" name="phone" id="phone" size="35" value="<?php echo $_GET['phone'];?>" /></td></tr>
				<tr><th>手机号码：</th><td><input type="text" name="mobile" id="mobile" size="35" value="<?php echo $_GET['mobile'];?>" /></td></tr>
				<tr><th>E-mail：</th><td><input type="text" name="email" id="email" size="35" value="<?php echo $_GET['email'];?>" /></td></tr>
				<tr><th>真实姓名：</th><td><input type="text" name="author" id="author" size="35" value="<?php echo $_GET['author'];?>" /></td></tr>
				<tr><th>所在住址：</th>
					<td> 
						<input type="text" name="address" id="address" size="35" value="<?php echo $_GET['address'];?>" />
					</td>
				</tr>

				<tr><th>验证码：</th><td><input type="text" name="code" id="code" size="10"/> <img id="validate" src="/index.php?com=feedbacks&task=securimage&sid=<?php echo md5(uniqid(time())); ?>&no_html=1" valign=center height=22  ></td></tr>
				<tr><th>&nbsp;</th><td><input type="submit" class="sgbtn" value="提交"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" class="sgbtn" value="重填"/>
				
				<input type="hidden" name="act" value="save" />
				<input type="hidden" name="return" value="<?php echo $uri->getByURL(array('a'=>'cons'));?>" />
				</td></tr>



			</table>


	</div>       
</div>