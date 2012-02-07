<?php
$session = &Factory::getSession();
?>
<div  style="padding:10px;"  >

<?php
if( $session->get('uid') > 0 ){
	if( $status == 1 ){
		?>
			<div style="padding-top:30px;text-align:center;" >
			该网址，您已经报过错，我们会第一时间处理，谢谢！
			</div>

		<?php
	}else{
?>
 
			感谢 <font color=red ><strong><?php echo $session->get('username');?></strong></font> 的报错提醒，我们会第一时间处理.
			<br/>
			您将会获得<strong>加1分</strong>的奖励! 
 
<?php
	}
}else{
?>
  
			感谢您的报错提醒，我们会第一时间处理.
			<br/>
			如果你是会员，我们将会给予<strong>加1分</strong>的奖励! 
			<br/>
			<a href="/index.php?com=users&view=login" target=_blank >
			<u><font color=red>会员登陆</font></u>
 			</a>
			&nbsp;&nbsp;
			<a href="/index.php?com=users&view=user&layout=registor" target=_blank >
			<u><font color=red>马上免费注册会员!</font></u>
				
			</a>

<?php
}
?>
</div>
