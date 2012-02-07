<?php
$title = '查询关于您在「友客网」发布的"'.$this->item['title'].'"信息';
?>

<div  class="mod db-mt5"  >
	<dl>
		<dt>
			<span class="db-fr" ><a href="javascript:history.back();" >[返回]</a><a href="javascript:window.close();" >[关闭]</a></span>
		　联系信内容
		</dt>
		<dd>
			<div class="sendmsg" >
			<div class="explain" >
 					提示：已经是友客网会员？
					<br/>
					请先登录 ，将发送的商业信息保存至您的信息中心内。	
			 </div>
			
			<?php
				global $app;
				if( $msg = $app->getMsg() )
				{
					echo $msg;
				}
			?>
             <form action="index.php?com=feedbacks&task=save" method="post" onsubmit="return checkFed();">
             <table class="sendmsg_form" border="0" cellpadding="0" cellspacing="0" width="700">
                <tbody>
				<tr>
					<th>*主题:</th>
					<td>
					<input name="title" value='<?php echo $title;?>'   size="60"  class="text" type="text">
					</td>
				</tr>

				<tr>
					<th>*内容:</th>
					<td>
					<textarea name="content" id="text" cols="70" rows="8"><?php echo $_REQUEST['content'];?></textarea>
					</td>
				</tr>
				<tr>
					<th>*您的公司名称:</th>
					<td><input name="company_name" value="<?php echo $_REQUEST['company_name'];?>"   class="text"   id="company_name" size="50" type="text"></td>
				</tr>



				<tr>
					<th>*您的姓名:</th>
					<td>
					<input name="name" value="<?php echo $_REQUEST['name'];?>" id="lyname" size="50"  class="text" type="text">
					</td>
				</tr>



				<tr>
					<th>* E-Mail: </th>
					<td>
					<input name="email" value="<?php echo $_REQUEST['email'];?>"  id="email" size="50"  class="text"   type="text">
					</td>
				</tr>



				<tr>
                    <th>*联系电话:</th><td><input name="phone" id="phone" value="<?php echo $_REQUEST['phone'];?>"  class="text"  size="50" type="text"></td>
 
                </tr>


				<tr>
                    <th>*您的传真:</th><td><input name="phone" id="phone" value="<?php echo $_REQUEST['phone'];?>"  class="text"   size="50" type="text"></td>
         
                </tr>





                <tr>
                   <th>您的网址: </th>
				   <td><input name="phone" id="phone" value="<?php echo $_REQUEST['phone'];?>"  class="text"  size="50" type="text"></td>
  
                </tr>
 
                <tr>
					<th>选项: </th>
                    <td valign="top" >
					友客网是专业的电子商务平台，为中国产品走向世界提供最便捷的贸易通道。
					是的，我希望收到友客网的介绍信。
				
					</td>
                </tr>
                 <tr>
                    <th valign="top" >* 验证码: </th>
					<td colspan="3">
						<img src="index.php?com=feedbacks&task=securimage&sid=<?php echo md5(uniqid(time())); ?>&no_html=1"><br />
						<input type="text" name="code" class="text" size=20  />	&nbsp;请输入上方验证码

					</td>
                </tr>
 
                <tr>
                    <th>&nbsp;</th>
                    <td colspan="3">
                        <input id="fedSubmit" value="发送消息" type="submit">
                        <input name="type" value="1" type="hidden">
                        <input name="action" value="fedSave" type="hidden">
						<input name="return" type="hidden" value="<?php echo URI::current();?>" >
                    </td>
                </tr>
            </tbody></table>
            </form>
            
 
		</div>
 		</dd>
	</dl>
</div>