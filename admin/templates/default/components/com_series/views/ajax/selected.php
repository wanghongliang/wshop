[<?php
$n = count($rows)-1;
foreach($rows as $k=>$row ){
	$s = $row['is_double']==0?'[单向关联]':'[双向关联]';
	echo "['".$row['id']."','".$row['name'].$s."']";
	if( $k<$n ){ echo ','; }
}
?>]