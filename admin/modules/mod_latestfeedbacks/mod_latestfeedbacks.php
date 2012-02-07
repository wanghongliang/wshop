<?php
$session = &Factory::getSession();	//session
$username = $session->get('username');	//会员名称

$db = &Factory::getDB();
$sql = "select id,release_date , content from #__feedbacks where uid=".$app->uid." order by id desc " ;
$db->query($sql);
$rows = $db->getResult();
//print_r($rows);

?>
<div class="con_title" >
<span class="more" ><a href="?com=feedbacks" >更多..</a></span>
	最新留言
</div>
<div class="con" >
	<ul >
		<?php
		foreach( $rows as $row )
		{
			?>	
			<li class='bg'><a href="?com=feedbacks&task=edit&id=<?php echo $row['id'];?>" target="_blank"><?php echo $row['content'];?></a>&nbsp;<span class="f12 gray">(<?php echo $row['release_date'];?>)</span></li>
			<?php
		}
		?>
 

	</ul>
</div>