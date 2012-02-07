
<div class="navmenu" >
	<div class="t">网站导航</div>

	<div class="b" >
	<ul>
	<?php
	$menus = modNavMenuHelper();
	$menuid = intval($_GET['menuid']); 

	$depth =0;
	$pid = 0;

	$depthA = array();
	foreach( $menus as $menu ){
		$depthA[$menu['id']] = $depthA[$menu['parent_id']]+1;
		$depth = $depthA[$menu['id']];
		?>
		<li <?php if( $menuid== $menu['id'] ){ echo ' class="active" '; } ?> >

		<?php for($i=1;$i<$depth;$i++){ echo '&nbsp;'; }?>
		<a href="index.php?com=<?php echo $menu['component'];?>&tmpl=com&menuid=<?php echo $menu['id'];?>"  >
		<?php echo $menu['name'];?>
		</a>
		</li>
		<?php
	}
 
	?>
	</ul>
	</div>
</div>
 









<?php
function modNavMenuHelper()
{
	global $app;
	$db = &Factory::getDB();
	$sql = " select tid from #__menu where id=".intval($_GET['menuid']);
	$db->query($sql);
	$row = $db->getRow();

	if( $row['tid'] == 0 ){ $tid=1; }else{$tid=$row['tid'];}
	$sql = " select * from #__menu where tid=".$tid." order by lft ";
	$db->query($sql);
	return $db->getResult();
}
?>

 