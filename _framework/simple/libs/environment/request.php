<?php

/**
 * 处理当前的环境变量中的 request 信息
 */



class Request
{

}

/**
 * 过滤SQL非法字符的信息
 */
function new_addslashes($string)
{
	if(!is_array($string)) return addslashes($string);
	foreach($string as $key => $val) $string[$key] = new_addslashes($val);
	return $string;
}

function new_stripslashes($string)
{
	if(!is_array($string)) return stripslashes($string);
	foreach($string as $key => $val) $string[$key] = new_stripslashes($val);
	return $string;
}

function strip_sql($string)
{
	global $search_arr,$replace_arr;
	//array_map --  将回调函数作用到给定数组的单元上 

	// 如果参数是数组，那么对其每一个值递归调用本函数 : preg_replace -- 执行正则表达式的搜索和替换
	return is_array($string) ? array_map('strip_sql', $string) : preg_replace($search_arr, $replace_arr, $string);
}

?>