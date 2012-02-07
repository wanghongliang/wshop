[<?php
$n = count($rows)-1;
foreach($rows as $k=>$row ){
	echo "['".$row['id']."','".$row['name']."','".$row['shop_price']."']";
	if( $k<$n ){ echo ','; }
}
?>]