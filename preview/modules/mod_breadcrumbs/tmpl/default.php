<?php 
$items = & modBreadCrumbsHelper::getList($params);

if( count($items) ){ ?>
<ul id="root" >
	<li class="home" style="position: static;"><a title="回首页" href="/">首页</a></li>
	<li style="position: static;"> <a title="回首页" href="/">首页</a> </li>
		<?php
  		foreach( $items as  $item )
		{
			echo "<li> ";

			echo '<a href="'.$item->link.'" class="path" >';
			echo $item->name;
			echo '</a></li>';
			
		}
 	?>
 
</ul>
<?php
}
?>