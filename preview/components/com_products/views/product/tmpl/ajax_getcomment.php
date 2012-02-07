<?php
//print_r($rows);

?>

{info:{<?php
$i=0;$n=count($rows['info'])-1;
foreach( $rows['info'] as $k=>$v ){
	echo 'a'.$k;
	echo ':"';
	echo $v;
	echo '"';
	if( $i++<$n ){
		echo ',';
	}
}
?>},rows:[<?php
$i=0;$n=count($rows['rows'])-1;
foreach( $rows['rows'] as $k=>$v ){
	echo '{id:"'.$v['id'].'",uname:"'.$v['uname'].'",contents:"'.$v['contents'].'",star:"'.$v['star'].'",created:"'.$v['created'].'",useful:"'.$v['useful'].'",useless:"'.$v['useless'].'"}';
	if( $i++<$n ){
		echo ',';
	}
}
?>],page:'<?php echo $this->getPage();?>'}
