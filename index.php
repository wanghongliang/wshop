<?php

/**
* @ 版本		$Id: index.php 2009-10-4
* @ 作用		系统入口文件
* @ 团队        daybillion团队
* @ copyright   Copyright (c) 2006-2009 Daybillion Inc. All rights reserved {@link http://www.daybillion.com}
* @ 作者        王洪亮
* @ E-mail      daybillion@yahoo.com.cn
* @ 认证		需商业许可认证,详细请查看根目录下 LICENSE.txt
* @ 备注：		本系统基于团队协作开发
*/
//if( strstr($_SERVER["HTTP_HOST"],'daybillion') !== false ){
//	header("Location: http://www.ui58.com/"); /* Redirect browser */
//	return;
//}

//定义目录分割符
define( 'DS', DIRECTORY_SEPARATOR );
define('PATH_BASE', dirname(__FILE__).DS.'preview');

//定义根目录信息
define('PATH_ROOT',dirname(PATH_BASE));

//载入框架信息
include(PATH_BASE.DS.'includes'.DS.'framework.php');

$app = Factory::getApplication('site');


//组件
$com = $_REQUEST['com']?$_REQUEST['com']:'contents';
echo $app->dispatch($com);
if( is_object($_PROFILER) ){
	echo '系统处理完成内存使用量:'.($_PROFILER->getMemory()/1024/1024).'MB';
	$db = &Factory::getDB();
	print_r($db->_log);
}
?>