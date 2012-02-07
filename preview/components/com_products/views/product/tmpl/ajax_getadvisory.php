<?php
//print_r($rows);

?>

{rows:[<?php
$i=0;$n=count($rows['rows'])-1;
foreach( $rows['rows'] as $k=>$v ){
	echo '{comment_id:"'.$v['comment_id'].'",author:"'.$v['author'].'",content:"'.$v['content'].'",created:"'.date('Y-m-d H:i',$v['created']).'",recontent:"'.$v['recontent'].'"}';
	if( $i++<$n ){
		echo ',';
	}
}
?>],page:'<?php echo $this->getPage();?>'}
