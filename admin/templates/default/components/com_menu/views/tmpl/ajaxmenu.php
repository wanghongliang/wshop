<div class="navmenu" >
	<div class="t">网站导航</div>

	<div class="b" >
	<ul>
	<?php
	$types = $menus[intval($_GET['t'])];
	foreach( $types as $menu ){
		$depthA[$menu['id']] = $depthA[$menu['parent_id']]+1;
		$depth = $depthA[$menu['id']];
		?>
		<li>		<?php for($i=1;$i<$depth;$i++){ echo '&nbsp;'; }?>

		<a href="index.php?com=<?php echo $menu['component'];?>&tmpl=com&menuid=<?php echo $menu['id'];?>" >
		<?php echo $menu['name'];?>
		</a>
		</li>
		<?php
	}
	?>
	</ul>
	</div>
</div>