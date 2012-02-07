<?php
$link = Router::_('index.php?itemid=354');
?>
<div class="saletitle">
	<h2 id="special">特价产品</h2> 
	<a href="javascript:searchsubmit('电磁炉');">电磁炉</a>
	<a href="javascript:searchsubmit('电饭煲');">电饭煲</a>
	<a href="javascript:searchsubmit('电风扇');">电风扇</a>
	<a href="javascript:searchsubmit('空调扇');">空调扇</a>
</div>
<div class="salehotbox">
	<?php
	foreach( $list as $row )
	{
		$img = $row['thumbnail'];
		$link = Router::_( ProductsHelperRoute::getProductRoute($row['id'],$row['catid']) );
		//$name = String::substr($row['title'],0,12);

		echo '<dl class="hpbox">';
		echo '<dt class="hp-img"><a href="'.$link.'"><img src="'.$img.'" width="130" height="130" alt="" /></a></dt>';

		echo '<dt class="hp-name"><a href="'.$link.'">'.$row['name'].'</a></dt>';
		echo '<dd class="hp-price"><span class="price" >'.Utility::price_format($row['shop_price']).'</span></dd>';
		echo '</dl>';
	}
	?>
</div>

 
<?php unset($list,$link,$row);?>
