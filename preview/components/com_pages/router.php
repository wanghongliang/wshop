<?php


/***
 * �������ӵ�URL��Ϣ
 * ���ºͲ˵���ID... 
 */
function PagesBuildRoute(&$query)
{

	$segments = array();
	/*
	 * �Ǻ���ID��
	 */
	if(isset($query['tid'])) {
 
		$segments[] = $query['tid'];
 
		unset($query['tid']);
	};

 
 
	return $segments;
}

function PagesParseRoute($segments)
{
	$vars = array();

	if( count($segments) == 1 ){
 		$vars['tid'] = $segments[0];
	}
 

	return $vars;
}
