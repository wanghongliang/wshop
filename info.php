<?php

phpinfo();exit;
define('_CHARSET','UTF-8');
define('DS',DIRECTORY_SEPARATOR);
header("Content-type: text/html; charset=utf-8");
print "
<html>
<head>
<title>AppServ Open Project "._APPVERSION."</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=\""._CHARSET."\">
<style>
<!-- Hide style for old browsers 
BODY          {font-family: MS Sans Serif;font-size=\"10\"}
.headd { font-family: Helvetica,Verdana ; font-size: 13pt; text-decoration:  none; }
.app { font-family: MS Sans Serif ; font-size: 10pt; text-decoration:  none; }
A:link    {text-decoration: none; color: #0000FF}
A:visited {text-decoration: none; color: #0000FF}
A:hover   {text-decoration: none; color: #FF0000}
A:active  {text-decoration: none; color: #FF0000}
-->
</style>
</head>
<body bgcolor=\"#FFFFFF\">

";


class ParserFile{
	//文件名
	var $fileName;

	//目录名
	var $directoryName;

	//字符串
	var $string;

	//正则表达式
	var $preg_string;
	function ParserFile($fileName='',$dir='',$preg=''){

		//文件名
		if($fileName!=''){
			$this->fileName=$fileName;
		}else{
			$this->fileName='httpd.conf';
		}

		//目录
		if($dir!=''){
			$this->directoryName=$dir;
		}else{
			$file_dir=dirname(__FILE__);
			if(!defined('DS')){
				define('DS',DIRECTORY_SEPARATOR);
			}
			$ext_dir=explode(DS,$file_dir);


			array_pop($ext_dir);
			$file_dir=implode(DS,$ext_dir);
			$file_dir.=DS.'/Apache2.2/conf';
			$this->directoryName=$file_dir;
		}
		

		//正则
		if($preg!=''){
			$this->preg_string = $preg;
		}else{
			$this->preg_string = "|<VirtualHost\s?([a-zA-Z0-9:*]+)\s?>([\s\S]*?)</VirtualHost>|i";
		}

	}

	function render(){
		
		if($this->string=='' ){
			$filePath=$this->directoryName.DS.$this->fileName;
			if(file_exists($filePath)){
				$this->string=file_get_contents($filePath);
			}
		}

		//echo $filePath;

		//preg_match_all($this->preg_string,preg_replace('|\s+|','tt',$this->string),$out);

		preg_match_all($this->preg_string,$this->string ,$out);
		//print_r($out);
		//开始解析字符串
		echo '<table border=1 style="border-collapse:collapse;border:1px solid gray;width:100%;" >';
	
		$num=count($out[0]);

		//print_r($out);
		for($i=0;$i<$num;$i++){
			$s =explode('<br />', nl2br($out[2][$i]));
			//print_r($s);

			$documentroot = $serveralias = '';
 			foreach( $s as $v )
			{
				$v = trim($v);

				//echo $v;
				if( !$v ){ continue; }
				if( strpos($v,'DocumentRoot') !== false ){
					$documentroot = $v;
				}else if( strpos($v,'ServerAlias') !== false ){
					$serveralias = $v;
				}
			}

			//echo $serveralias;
			//echo $documentroot;

			$serveralias = trim(str_replace('ServerAlias','',$serveralias));
			echo '<tr>';
			echo '<td class="websit_http" ><a href="http://'.$serveralias.'" target=_blank >'.$serveralias.'</a></td>';

			$tmp=str_replace('DocumentRoot','',$documentroot);
 			echo '<td>目录:<a href="'.$tmp.'" target=_blank >'.$tmp.'</a></td>';
			echo '</tr>';
		}

		echo '</table>';
		echo '<style type="text/css" >';
		echo 'td{border:1px solid gray;padding:5px;}';
		echo 'td.websit_http{ width:38%;}';
		echo '</style>';

	}

}
echo '<div ><a href="/phpmyadmin/" target=_blank >数据库管理 PHPMyAdmin</a>----------<a href="/phpinfo.php" target=_blank >PHPINFO</a>';
$parser=new ParserFile('','E:\AppServ\Apache2.2\conf');
$parser->render();

//echo __FILE__;
?>
</body>
</html>


 