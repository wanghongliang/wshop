<?php					
$session = &Factory::getSession();
$username = $session->get('username');
?>
<DIV style="padding:30px;text-align:center;" >
您已经收藏成功！ 					
 <a href="<?php echo $app->buildMemberLink($username);?>" target=_blank >
<u><font color=red>查看/编辑</font></u>	
</a>
</DIV>
