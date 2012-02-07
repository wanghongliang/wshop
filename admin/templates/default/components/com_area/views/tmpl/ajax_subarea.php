[<?php
$n = count($rows)-1;
foreach($rows as $k=>$row ){
 	echo "['".$row['id']."','".$row['name']."','".$row['n']."','".$row['published']."','".$row['alias']."']";
	if( $k<$n ){ echo ','; }
}
?>]