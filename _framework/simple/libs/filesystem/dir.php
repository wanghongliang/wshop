<?php
	class WDir{
		var $path=null;
		function is_dir($arg){
			return is_dir($arg);
		}
		function mkdir($arg){
		
			//echo $arg;
			if(WDir::is_dir($arg)){
				return true;
			}else{
				$dir=str_replace(PATH_ROOT,'',$arg);
				
				$dir=preg_replace("|\\\|i","/",$dir);
				
				$dirs=explode('/',$dir);
				
				$dir=PATH_ROOT;
				foreach($dirs as $v){
					
					if(is_dir($dir.='/'.$v)){
						continue;
					}
					@mkdir($dir);
				}
			}
			return true;
		}

		function uploadFile($files,$dirs='',$file_str='',$rename=0){
	
			if( !$dirs )
			{
				$dirs = PATH_UPLOAD;
			}

 
			if(!isset($files['name']) || ''==$files['name'])
			{
				 echo '上传的文件名为空!';
				 exit;
			}
			
			
			//检查文件的类型
			if(''==$file_str) $file_str='jpg|gif|png|bmp|doc|pdf|swf|zip|rar|xls|txt|xml|conf|rtf';
 			if(!stristr($file_str,substr($files['name'],-3)))
			{
				echo '不允许上传此类型文件！';
				return false;
			}
			

 
			//目录是否存在
			WDir::mkdir($dirs);
			if(!(substr($dirs,-1)=='/' || substr($dirs,-1) == '\\'))
			{
				$dirs.='/';
			}
			//文件名和目录
			if($rename==0){
				$file_name=$files['name'];

				if( string::isChinese($file_name) )
				{
					import('chinesespell.chinesespell');
					$spell = new ChineseSpell();
					$file_name = $spell->getFullSpell( mb_convert_encoding($file_name,'gb2312','utf-8'),'' ); 
				}
 
 			}else{
				$file_name=Time().substr($files['name'],-4); 
				if( file_exists( $dirs.$file_name ) ){
					$file_name=Time().'-1'.substr($files['name'],-4);
				}
			}

			//上传后的文件路径
			$path=$dirs.$file_name;

			if(@move_uploaded_file($files['tmp_name'],$path))
			{
 				return array( 'file_path'=>$path,'uri_path'=>preg_replace('/[\\\]+/','/',str_replace(PATH_ROOT,'',$path)) );
			}

			//echo $dirs.$file_name;

			echo '文件上传失败！ 文件:',$dirs.$file_name,'大小:',$files['size'];
			return false;

		}
		function promptMSG($s){
			$message = "<script language='javascript'>";
			$message .= "alert('提示信息：".$s."');";
 			$message .= "</script>";
			echo $message;
			//exit;
		}

	 /*
	  *@浏览目录
	  */
	 function getFolders ($dir) {
	  $this->mFolders = Array();
	  //如果给定路径末尾包含"/",先将其删除
	  if(substr($dir,-1)=="/"){
		$dir=substr($dir,0,-1);
	  }
	  //如给出的目录不存在或者不是一个有效的目录，则返回
			if(!file_exists($dir)||!is_dir($dir)){
				return false;
	  }
	  //打开目录，
	  $dirs= opendir($dir);
	  //把目录下的目录信息写入数组
	  $i = 0;
	  while (false!==($entry=readdir($dirs))) {
	   //过滤掉表示当前目录的"."和表示父目录的".."
	   if ($entry!="."&&$entry!="..") {
		$path=$dir."/".$entry;
		//为子目录，则采集信息
		if(is_dir($path)){
		 $filetime = @filemtime($path);
		 $filetime = @date($this->mDateTime, $filetime+3600*$this->mTimeOffset);
		 // 目录名
		 $this->mFolders[$i]['name'] = $entry;
		 // 目录最后修改时间
		 $this->mFolders[$i]['filetime'] = $filetime;
		 // 目录大小,不计,设为0
		 $this->mFolders[$i]['filesize'] = 0;
		 $i++;
		}
	   }
	  }
	  return $this->mFolders;
	 }
	 /*
	  *@浏览文件
	  */
	 function getFiles ($dir,$ftype='') {
	  $this->mFiles = Array();
	  //如果给定路径末尾包含"/",先将其删除
	  if(substr($dir,-1)=="/"){
	   $dir=substr($dir,0,-1);
	  }
	  //如给出的目录不存在或者不是一个有效的目录，则返回
			if(!file_exists($dir)||!is_dir($dir)){
				return false;
	  }
	  //打开目录，
	  $dirs= opendir($dir);
	  //把目录下的文件信息写入数组
	  $i = 0;
	  if($ftype!=''){ $file_type=$ftype;}else{  $file_type='jpg|gif|bmp|png';}

	  while (false!==($entry=readdir($dirs))) {
	   //过滤掉表示当前目录的"."和表示父目录的".."
	   if ($entry!="."&&$entry!="..") {
		   if(strstr($file_type,substr($entry,-3))==false) continue;
		$path=$dir."/".$entry;
		//为子目录，则采集信息
		if(is_file($path)){
		 $filetime = @filemtime($path);
		 $filetime = @date($this->mDateTime, $filetime+3600*$this->mTimeOffset);
		 $filesize = $this->getFileSize($path);
		 // 文件名
		 $this->mFiles[$i]['name'] = $entry;
		 // 文件最后修改时间
		 $this->mFiles[$i]['filetime'] = $filetime;
		 // 文件的大小
		 $this->mFiles[$i]['filesize'] = $filesize;
		 $i++;
		}
	   }
	  }
	  return $this->mFiles;
	 }

	 /*
	  *@获取文件的大小:字节,KB,MB,GB
	  */
	 function getFileSize ($file) {
	  if ( !is_file($file) ) return 0;
	  $f1 = $f2 = "";
	  $filesize = @filesize("$file");
	  // 大于1GB以上的文件
	  if ( $filesize > 1073741824 ) {
	  // 大于1MB以上的文件
	  } elseif ( $filesize > 1048576 ) {
	   $filesize = $filesize / 1048576;
	   list($f1, $f2) = explode(".",$filesize);
	   $filesize = $f1.".".substr($f2, 0, 2)."MB";
	  // 大于1KB小于1MB的文件
	  } elseif ( $filesize > 1024 ) {
	   $filesize = $filesize / 1024;
	   list($f1, $f2) = explode(".",$filesize);
	   $filesize = $f1.".".substr($f2, 0, 2)."KB";
	  // 小于1KB的文件
	  } else {
	   $filesize = $filesize."字节";
	  }
	  return $filesize;
	 }

	 function deleleFile($path)
	{
		 return @unlink($path);
	}

	/**
	 * 移动目录
	 */
	function moveDir($oldDir, $aimDir, $overWrite = false) {
		   $aimDir = str_replace('', '/', $aimDir);
		   $aimDir = substr($aimDir, -1) == '/' ? $aimDir : $aimDir . '/';
		   $oldDir = str_replace('', '/', $oldDir);
		   $oldDir = substr($oldDir, -1) == '/' ? $oldDir : $oldDir . '/';
		   if (!is_dir($oldDir)) {
			 return false;
		   }

		   if(!file_exists($aimDir)) {
			 WDir::mkdir($aimDir);
		   }

		   @$dirHandle = opendir($oldDir);
		   if (!$dirHandle) {
			 return false;
		   }
		   while(false !== ($file = readdir($dirHandle))) {
			 if ($file == '.' || $file == '..') {
				continue;
			 }
			 if (!is_dir($oldDir.$file)) {
				WDir::moveFile($oldDir . $file, $aimDir . $file, $overWrite);
			 } else {
				WDir::moveDir($oldDir . $file, $aimDir . $file, $overWrite);
			 }
		   }
		   closedir($dirHandle);
		   return rmdir($oldDir);
	}


	function moveFile($fileUrl, $aimUrl, $overWrite = false) {
		   if (!file_exists($fileUrl)) {
			 return false;
		   }
		   if (file_exists($aimUrl) && $overWrite = false) {
			 return false;
		   } elseif (file_exists($aimUrl) && $overWrite = true) {
			 @unlink($aimUrl);
		   }
		   $aimDir = dirname($aimUrl);
		   WDir::mkdir($aimDir);
		   rename($fileUrl, $aimUrl);
		   return true;
	}

	function deleteDir($dir)
	{
		if( is_dir( $dir) ) {
			if( $dp = opendir( $dir) ) {
				while ( ( $file=readdir($dp) ) != false ) {
  					if ($file == '.' || $file == '..') {
						continue;
					}else if (is_dir( $dir.DS.$file)) {
						WDir::deleteDir($dir.DS.$file);
					} else {
						unlink($dir.DS.$file);
					}
				}
				closedir($dp);
				rmdir($dir);
			} else {
				Error::throwError('没有删除目录的权限. Not permission');
			}
		}
	}



	function getInstance(){
		static $instance;
		if( empty( $instance ) )
		{
			$instance = new WDir();
		}
		return $instance;
	}
}
?>