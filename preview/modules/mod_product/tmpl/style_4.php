 
<?php
$link = Router::_('index.php?itemid=7');
?>
<h2 class="title2 mg-t10">热卖推荐</h2>
<div id="salehot">
			<?php
 
 			foreach( $list as $row )
			{
 				$img = $row['thumbnail'];
				$link = Router::_( ProductsHelperRoute::getProductRoute($row['id'],$row['catid']) );
				//$name = String::substr($row['title'],0,12);

				echo '<dl class="hotpbox">';
				echo '<dt class="good-img"><a href="'.$link.'"><img src="'.$img.'" width="120" height="120" alt="" /></a></dt>';

 				echo '<dd class="good-price"><span class="price" >'.Utility::price_format($row['shop_price']).'</span></dd>';
				echo '<dt><a href="'.$link.'">'.String::substr($row['name'],0,16).'</a></dt>';

				echo '</dl>';
			}
			?>
</div>

 
<?php unset($list,$link,$row);?>
