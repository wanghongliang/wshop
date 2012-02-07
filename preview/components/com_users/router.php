<?php


/***
 * 构建复杂的URL信息
 * 文章和菜单的ID... 
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
