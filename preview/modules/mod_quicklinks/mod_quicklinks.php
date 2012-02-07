<?php
require_once($app->getPreviewComponentPath().DS.'com_products'.DS.'helpers'.DS.'route.php');

$db = &Factory::getDB();
$sql = "select id,name,img,url,linkid from #__advers where type_id=17 limit 8";
$db->query($sql);
?>
<div class="hsort">
	<ul>
		<?php

		
		while($db->next_record()){

			$link = "#" ;

			if( $db->Record['linkid']>0 ){
				$link = Router::_( ProductsHelperRoute::getCategoryRoute($db->Record['linkid']) );
			}else if( $db->Record['url'] != '' ){
				$link = $db->Record['url'];
			}
			?>
			<li>
				<a href="<?php echo $link;?>">
					<img src="<?php echo $db->Record['img'];?>" />
				</a>
				<h5>
					<a href="<?php echo $link;?>"><?php echo $db->Record['name'];?></a>
				</h5>
			</li>
			<?php
		}	
		?>

 
	</ul>
</div>
