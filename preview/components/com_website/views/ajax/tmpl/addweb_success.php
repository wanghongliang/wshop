<?php					
$session = &Factory::getSession();
$username = $session->get('username');
?>
<DIV class="status" style="padding:30px;text-align:center;" >
您已经发布成功！谢谢。
<br/>
<?php
if( $username ){
	?>
	感谢<?php echo $username; ?>,<a href="javascript:addFav('<?php echo $list['id'];?>')" >添加到我的收藏页</a>.
	 
	
	<br/>
	<b>加2个积分.</b>
	<br/>	
	<a href="<?php echo $app->buildMemberLink($username);?>/fav" target=_blank  >查看我的酷站 </a>
	<br/>
	<a href="/member/" target=_blank  >
	进入我的空间，
	</a>
	<div >
	<input  type="button" onclick="publishW();" class="submit_btn btn_save"  
	value="继续添加"
	/>
	<input  onclick="closeDialog();"  type="button" class="cancel_btn btn_cancel"  
	value="关闭" />
	</div>
	<?php
}else{
?>
	<div class="reg_guide" >
	<a href="/?com=users&view=user&layout=registor" target=_blank  >
	免费注册会员</a>
	&nbsp;
	<a href="/?com=users&view=login" target=_blank  >
	会员登陆
	</a>
	<br/>
	收藏、点评网站，我们一起设计分享... 
	<br/>
	获得更多积分...
	</div>
	<div >
		<input  type="button" onclick="publishW();" class="submit_btn btn_save"  
		value="重新添加"
		/>
		<input  onclick="closeDialog();"  type="button" class="cancel_btn btn_cancel"  
		value="关闭" />
	</div>


<?php } ?>
</DIV>
