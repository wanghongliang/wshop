<?php
require_once ($app->getPreviewComponentPath().DS.'com_contents'.DS.'helpers'.DS.'route.php');
$menu = &$app->getMenu();


//底部快捷文章导航
$data = $menu->getMenus( 10); 
$keys = array(); //array_keys( $data );
foreach( $data as $v ){  $keys[] = $v['id']; }


//print_r($keys);
$db = &Factory::getDB();
$sql = "select id,title,menuid from #__contents where menuid in (".implode(',',$keys)." ) ";
$db->query($sql);
$results = $db->getResult('menuid',true);

 
?>
 

		<div class="clr" ></div>
		<div id="pintro">
			<div id="pbphone">
			<p>订购热线：<br>
			<span>400-800-6953 </span></p>
			<p>
			客服服务：<br>
			<span>400-800-6953 </span></p>
			</div>

			<?php
			foreach( $data as $k=>$v ){
				?>
				<dl class="pbdt">
				<dt  id="ico<?php echo $k+1;?>" ><?php echo $v['name'];?> </dt>
				<?php
				if( is_array( $rows = $results[$v['id']] ) ){
					foreach( $rows as $item ){
					$link =  Router::_( ContentsHelperRoute::getArticleRoute($item['id'],$item['menuid']) );
					?>
					<dd><a href="<?php echo $link;?>"><?php echo $item['title'];?> </a></dd>
					<?php
					}
				}
				echo '</dl>';
			}
			?>
 
 
		</div>

		<div id="botlink">
			<?php
			$rows = $menu->getMenus( 11 ); 
			$n = count($rows)-1;
			$i=0;
			foreach( $rows as $row ){
				$menu->buildLink($row);
			?>
				<a href="<?php echo $row['link'];?>"><?php echo $row['name'];?></a>
				<?php if( $i++<$n ){ ?>
				|  
				<?php } ?>
			<?php

			}
			?>
	 
		</div>