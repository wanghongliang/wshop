<?php 

$m = &$app->getMenu();
$menudata = $m->getMenus();

$com = $_GET['com'];
if( $com == '' ){ 
	$com2=$com='cpanel';
}else{

	if( $com == 'cpanel' ){
		$com2 = $com;
	}else{
		$active_menu = $m->getItem($com);
		$root_menu = $menudata[$active_menu['pid']];

 		$com2 = $root_menu['com'];

 	}
}


?>

<div class="mainmenu" >

<?php
 		$dispatcher=Dispatcher::getInstance();
		PluginHelper::importPlugin('cache');
		$results = $dispatcher->trigger('promptCache');
?>

<ul class="menu" >
	<?php
	foreach( $menudata as $menu ){
	?>
		<li <?php if( $menu['type'] == 'elite' ){  echo ' class="elite" ';  }else if(  $menu['pid'] == $root_menu['pid'] ){ echo ' class="active" '; }else if( $menu['type'] ){ echo ' class="'.$menu['type'].'" ';  } ?> ><a href="<?php echo $menu['link'];?>" id="<?php echo $menu['id'];?>"><?php echo $menu['text'];?></a>
		
		<?php 
			if( is_array($menu['submenu']) ){
				?>
				<span class="droparr" >
				</span>
				<?php
				echo '<ul class="ss" >';
				foreach( $menu['submenu'] as $smenu ){
					?>
					<li   ><a href="<?php echo $smenu['link'];?>" id="<?php echo $smenu['id'];?>"><?php echo $smenu['text'];?></a>
					<?php
				}
				echo '</ul>';
			}
		?>
		</li>
		<?php
	} 
	?>

</ul>
</div>
 









<?php
function modMenuHelper()
{
	global $app;
	$db = &Factory::getDB();
	$sql = " select * from #__menu_types where uid=".$db->Quote($app->uid);
	$db->query($sql);
	return $db->getResult();
}
?>

<script language="javascript" >

</script>