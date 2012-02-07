<?php
 //目录分离符
if(!defined( 'DS' )){    define( 'DS', DIRECTORY_SEPARATOR );		}							

//根目录常量
if(!defined( 'PATH_BASE' )){    
	$path= explode(DS,dirname(__FILE__));
	array_pop($path);
	define('PATH_BASE', implode(DS,$path) );
}

define('PATH_FRAMEWORK',PATH_ROOT.DS.'_framework'.DS.'simple' );





//配置文件信息
include(PATH_FRAMEWORK.DS.'config/default.php');



//加载器类信息
include(PATH_FRAMEWORK.DS.'libs/loader.php');
//工厂类信息
include(PATH_FRAMEWORK.DS.'libs/factory.php');


define('DEBUG',false);

if (DEBUG){
	import( 'error.profiler' );
	$_PROFILER =& WProfiler::getInstance( 'app' );
}




/////////////////////////////处理环境变量信息/////////////////////////////////
//请求信息
import('environment.request');
unset($LANG, $_REQUEST, $HTTP_ENV_VARS, $HTTP_POST_VARS, $HTTP_GET_VARS, $HTTP_POST_FILES, $HTTP_COOKIE_VARS);

//preg_replace -- 执行正则表达式的搜索和替换 ,先构造正则替换所需的模式 /i 不分大小写
$search_arr  = array("/ union /i","/ select /i","/ update /i","/ outfile /i","/ or /i");
$replace_arr = array('&nbsp;union&nbsp;','&nbsp;select&nbsp;','&nbsp;update&nbsp;','&nbsp;outfile&nbsp;','&nbsp;or&nbsp;');
$_POST       = strip_sql($_POST);
$_GET        = strip_sql($_GET);
$_COOKIE     = strip_sql($_COOKIE);
$_REQUEST	 = array_merge($_GET,$_POST);
unset($search_arr, $replace_arr);							//释放不用的数组

$magic_quotes_gpc = get_magic_quotes_gpc();					//读取服务器配置,来过滤是否插入值


if(!$magic_quotes_gpc)										//作出相应的字符转换
{
	$_POST = new_addslashes($_POST);
	$_GET  = new_addslashes($_GET);
}
//////////////////////////////////处理完毕/////////////////////////////////////


$config['upload_type']='.jpg.png.gif.dmp';


///////////////////////////////       常用的变量信息定义      ///////////////////////////////
//缓存
define('PATH_CACHE',PATH_ROOT.DS.'cache');
define('PATH_PLUGINS',PATH_ROOT.DS.'plugins');	 
//模板路径定义
define('PATH_TEMPLATE',PATH_BASE.DS.'templates');

//定义当前网站目录,如果在根目录就为 /
define('URI_DIRECTORY','templates');

//定义组件目录
//define('PATH_COMPONENT',$config['template_dir'].DS.'components');
//定义上传文件的目录
define('PATH_UPLOAD',PATH_ROOT.DS.'media');
define('PATH_TMP',PATH_ROOT.DS.'tmp');	//临时目录，用于上传压缩文件时的解压目录

define('PATH_PREVIEW',PATH_ROOT.DS.$config['preview_directory']);	//一定要定义	

//////////////////////////////////////////////////////////////////////////////////////////////



//////////// 路由器模式
//1为index.php/home.html 2为 home.html 3为直接生成静态页
define('ROUTER_MODE', $config['router_mode']);


///////////


define('URI_PATH','/');//$config['preview_directory']);		
 


/**
 * 导入常用类库信息
 */
import('error.error');
import('environment.router');
import('environment.uri');
import('html.text');
import('utilities.string');
import('utilities.utility');


if (extension_loaded('mbstring') || ((!strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' && dl('mbstring.so')))) {
	//输出格式为UTF-8
	@ini_set('mbstring.internal_encoding', 'UTF-8');
	@ini_set('mbstring.http_input', 'UTF-8');
	@ini_set('mbstring.http_output', 'UTF-8');
}

if (function_exists('iconv') || ((!strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' && dl('iconv.so')))) {
	iconv_set_encoding("internal_encoding", "UTF-8");
	iconv_set_encoding("input_encoding", "UTF-8");
	iconv_set_encoding("output_encoding", "UTF-8");
}

?>
