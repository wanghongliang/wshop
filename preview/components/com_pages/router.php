<?php


/***
 * 构建复杂的URL信息
 * 文章和菜单的ID... 
 */
function PagesBuildRoute(&$query)
{

	$segments = array();
	/*
	 * 是后检测ID项
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
