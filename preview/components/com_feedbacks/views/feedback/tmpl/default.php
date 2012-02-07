<?php
$menu = &$app->getMenu();
$active = & $menu->getActive();
?>
<div class="mod pages"  >
	<dl>

	
		<dt>
			<span>
			<h1>
				<?php echo $active['name']; ?>
			</h1>
			</span>
		</dt>
		<dd>
 
		<div class="db-p10" >
			<div class="feedback_remarkdb-p10" >
				如果您对<?php echo $GLOBALS['config']['title'];?>的产品和服务有什么意见、建议或投诉，请填好以下表格。我们会尽快与您取得联系，谢谢！
					
			</div>
			
			<?php
				global $app;
				if( $msg = $app->getMsg() )
				{
					echo $msg;
				}
			?>
             <form action="index.php?com=feedbacks&task=save" method="post" onsubmit="return checkFed();">
             <table class="feedback_form" border="0" cellpadding="0" cellspacing="0" width="95%">
                <tbody>
				<tr>
                    <th>* 姓名:</th>
					<td class="td1" >
					<input name="name" value="<?php echo $_REQUEST['name'];?>" id="lyname" size="20" type="text">
					</td>
                    <th>* E-Mail: </th><td><input name="email" value="<?php echo $_REQUEST['email'];?>"  id="email" size="20" type="text"></td>
                </tr>
                <tr>
                   <th>电话/手机号: </th>
				   <td class="td1" ><input name="phone" id="phone" value="<?php echo $_REQUEST['phone'];?>"  size="20" type="text"></td>
                   <th>公司名称:</th>
					<td><input name="company_name" value="<?php echo $_REQUEST['company_name'];?>"  id="company_name" size="20" type="text"></td>
                </tr>
 
                <tr>
                    <th valign="top" >* 内容: </th>
					<td colspan="3">
					<textarea name="content" id="text" cols="80" rows="8"><?php echo $_REQUEST['content'];?></textarea>
					</td>
                </tr>
                 <tr>
                    <th valign="top" >* 验证码: </th>
					<td colspan="3">
						<img src="index.php?com=feedbacks&task=securimage&sid=<?php echo md5(uniqid(time())); ?>&no_html=1"><br />
						<input type="text" name="code" />	&nbsp;请输入上方验证码

					</td>
                </tr>
 
                <tr>
                    <th>&nbsp;</th>
                    <td colspan="3">
                        <input id="fedSubmit" value="提交留言" type="submit">
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

<script>
function checkFed()
{

}
</script>
