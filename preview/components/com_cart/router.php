<?php


/***
 * �������ӵ�URL��Ϣ
 * ���ºͲ˵���ID... 
 */
function CartBuildRoute(&$query)
{

	$segments = array();
	if( isset($query['task']) ){
		$segments['task']= $query['task'];
	}
	return $segments;
}

function CartParseRoute($query)
{
	$segments = array();

	
 

	if( isset($query[0]) ){
		$segments['task']=$query[0];
	}
 
 	return $segments;
}
