{<?php
	$n =count($item)-1; $i=0;
	foreach( $item as $k=>$v ){
		echo $k.':"'.$v.'"';
		if( $i++<$n ) echo ',';
	}
?>}