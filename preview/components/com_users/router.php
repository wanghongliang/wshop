<?php


/***
 * �������ӵ�URL��Ϣ
 * ���ºͲ˵���ID... 
 */
function UsersBuildRoute(&$query)
{

	$segments = array();
	if( isset($query['task']) ){
		$segments['task']= $query['task'];
	}
	return $segments;
}

function UsersParseRoute($query)
{
	$segments = array();

 	if( isset($query[0]) && !$_GET['task'] ){
		$segments['task']=$query[0];
	}


 	return $segments;
}
