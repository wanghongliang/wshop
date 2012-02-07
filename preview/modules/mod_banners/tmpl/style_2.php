<?php
/**
 * 此样式是单个图片排列
 */

if( is_array( $list ) ){
	//banner模块相关信息类
	$w = $params['width']?$params['width']:780;
	$h = $params['height']?$params['height']:256;$n = (int)$params['num'];
 	$params = (array)unserialize( $list['params'] ); 

	$i=1;
	foreach($params as $item ){
		if( $i++>$n) break;
		$link = $item['http'];//Router::_( $item['http'] );//'#';// Router::_( 'index.php?com=banners&task=click&bid='. $item['id'] );
 		echo '<div class="hthum"><a href="'.$link.'"  target="_blank"  ><img src="'.$item['thumb'].'" alt="'.$item['title'].'" width="'.$w.'"  height="'.$h.'" /></a></div>';

		 
	}
 }
?>


 