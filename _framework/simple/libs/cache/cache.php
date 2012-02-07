<?php

/**
 * 缓存对象，用于缓存常用的数据
 */
class Cache
{
	/**
	 * 生成缓存配置文件
	 */
	function cacheConfig()
	{
		global $app;
		
		$db = &Factory::getDB(); 
		//取出对应的配置信息
		$sql = " select * from #__configs ";

 		$db->query($sql);
		$row = $db->getRow();
		unset($row['id']);
 
		//构造配置文件路径
		$config_file = PATH_CACHE.DS.'configs';
		import('filesystem.dir');
		WDir::mkdir($config_file);
		file_put_contents($config_file.DS.'default.php',"<?php return ".var_export($row,true)."; ?>");
	}

	function getConfigCache()
	{
		//构造配置文件路径
		$config_file = PATH_CACHE.DS.'configs'.DS.'default.php'; 
  		if( file_exists( $config_file ) )
		{
			return include($config_file);
		}
		return array();
	}


	/** 是否已经缓存 **/
	function isCache($uid = 0 )
	{
		if( $uid == 0 )
		{
			$uid = $GLOBALS['USERID'];
		}

		$config_file = PATH_CACHE.DS.$uid.DS.'configs'.DS.'default.php';
 		return  file_exists( $config_file );
 
	}

	/** 去掉缓存 **/
	function delCache($uid=0){
		if( $uid == 0 )
		{
			$uid = $GLOBALS['USERID'];
		}

		$config_file = PATH_CACHE.DS.$uid.DS.'configs'.DS.'default.php';
		
		return  @unlink($config_file);
	}
}
?>