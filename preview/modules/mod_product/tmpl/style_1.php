<?php
$link = Router::_('index.php?itemid=418');
?>

<h2 class="mg-tmenu newptitle">新品上架</h2>

<?php
$i=0;
foreach( $list as $row )
{

	$img = $row['thumbnail'];
	$link = Router::_( ProductsHelperRoute::getProductRoute($row['id'],$row['catid']) );
	//$name = String::substr($row['title'],0,12);
	echo '<dl class="newpbox">';
	echo '<dd class="img"><a href="'.$link.'" title="点击查看"><img src="'.$img.'" alt="" width=80 height=80 /></a></dd>';
	echo '<dd class="gprice"><span class="price" >'.Utility::price_format($row['shop_price']).'</span></dd>';	
	echo '<dd class="name"><a href="'.$link.'" title="'.$row['name'].'">'.String::substr($row['name'],0,26).'</a></dd>';

	echo '</dl>';

}

 
?> 
