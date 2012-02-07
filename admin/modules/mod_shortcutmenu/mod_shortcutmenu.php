<?php 

$m = &$app->getMenu();
$menudata = $m->getMenus();

$com = trim($_GET['com']);
if( $com == '' ){ 
	$com2=$com='cpanel';
}else{

	if( $com == 'cpanel' ){
		$com2 = $com;
	}else{


 	$com2 = $root_menu['com'];
	}
}
$active_menu = $m->getItem($com);
$root_menu = $menudata[$active_menu['pid']];
//echo $com;
//print_r($active_menu);
//echo $active_menu['pic'];
$menus = (array)$root_menu['submenu'];

?>

<div class="navmenu" >
	<div class="t"  ><?php echo $root_menu['text'];?>菜单</div>
	<div class="b" >
	<ul>
	<?php
	foreach( $menus as $menu ){
		?>
		<li <?php  if( $com == $menu['com'] || ( is_array($menu['subcom']) && in_array($com,$menu['subcom']) )  ){ echo ' class="active" '; }  ?> >
 		<a href="<?php echo $menu['link'];?>"  >
			<?php echo $menu['text'];?>
		</a>
		</li>
		<?php
	}
	?>
 
	</ul>

	</div>
</div>



<?php 

/**
$menus = modNavMenuHelper();
$menuid = intval($_GET['menuid']); 


$active_menu_type = 0;
foreach( $menus as $ms ){
	foreach( $ms as $menu ){
		 if( $menuid== $menu['id'] ){
			$active_menu_type = $menu['tid'];
		 }
	}
}

$active_menu_type = $active_menu_type==0?1:$active_menu_type;

//echo $active_menu_type;
foreach( $menus as $ms ){
?>
<div class="navmenu " >
	<div class="t <?php if( $ms[0]['tid']!=$active_menu_type ){ echo 'jia'; }?> "><?php echo $ms[0]['title'];?></div>

	<div class="b <?php if( $ms[0]['tid']!=$active_menu_type ){ echo 'hide'; }?>" >
	<ul>
	<?php
 
	$depth =0;
	$pid = 0;

	$depthA = array();
	foreach( $ms as $menu ){
		$depthA[$menu['id']] = $depthA[$menu['parent_id']]+1;
		$depth = $depthA[$menu['id']];

		if( $menu['iscontent'] == 1 ){
			$com= 'pages';
		}else{
		$com = $menu['component'];
		}
		
		?>
		<li <?php if( $menuid== $menu['id'] ){ echo ' class="active" '; } ?> >

		<?php for($i=1;$i<$depth;$i++){ echo '&nbsp;'; }?>
		<a href="index.php?com=<?php echo $com;?>&tmpl=cpanel&menuid=<?php echo $menu['id'];?>"  >
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

}

**/


?>









<?php
function modNavMenuHelper()
{
	global $app;
	$db = &Factory::getDB();
	//$sql = " select tid from #__menu where id=".intval($_GET['menuid']);
	//$db->query($sql);
	//$row = $db->getRow();

	///if( $row['tid'] == 0 ){ $tid=1; }else{$tid=$row['tid'];}
	$sql = " select m.id,m.name,m.component,m.iscontent,m.parent_id,m.tid as tid,t.title from #__menu as m left join #__menu_types as t on m.tid=t.id order by  t.ordering,lft  ";
	$db->query($sql);
	return $db->getResult('tid',true);
}
?>

 