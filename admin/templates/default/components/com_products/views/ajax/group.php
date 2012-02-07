[<?php
$n = count($rows)-1;
foreach($rows as $k=>$row ){
	$s = '-'.$row['products_price'];
	echo "['".$row['id']."','".$row['name'].$s."']";
	if( $k<$n ){ echo ','; }
}
?>]