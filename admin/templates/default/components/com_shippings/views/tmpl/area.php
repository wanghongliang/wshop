[['0','请选择...','']<?php
$n = count($rows)-1; if( $n>0 ){ echo ','; }
foreach($rows as $k=>$row ){
	echo "['".$row['id']."','".$row['name']."','".$row['lft']."','".$row['rgt']."','".$row['parent_id']."']";
	if( $k<$n ){ echo ','; }
}
?>]