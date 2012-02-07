{<?php
$n = count($row)-1;
$i=0;
foreach( $row as $k=>$v ){
	
	echo $k.':"'.$v.'"';
	if( $i++<$n) echo ',';
}
?>}