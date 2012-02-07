<?php

/**
 * ����������ڻ��泣�õ�����
 */
class Cache
{
	/**
	 * ���ɻ��������ļ�
	 */
	function cacheConfig()
	{
		global $app;
		
		$db = &Factory::getDB(); 
		//ȡ����Ӧ��������Ϣ
		$sql = " select * from #__configs ";

 		$db->query($sql);
		$row = $db->getRow();
		unset($row['id']);
 
		//���������ļ�·��
		$config_file = PATH_CACHE.DS.'configs';
		import('filesystem.dir');
		WDir::mkdir($config_file);
		file_put_contents($config_file.DS.'default.php',"<?php return ".var_export($row,true)."; ?>");
	}

	function getConfigCache()
	{
		//���������ļ�·��
		$config_file = PATH_CACHE.DS.'configs'.DS.'default.php'; 
  		if( file_exists( $config_file ) )
		{
			return include($config_file);
		}
		return array();
	}


	/** �Ƿ��Ѿ����� **/
	function isCache($uid = 0 )
	{
		if( $uid == 0 )
		{
			$uid = $GLOBALS['USERID'];
		}

		$config_file = PATH_CACHE.DS.$uid.DS.'configs'.DS.'default.php';
 		return  file_exists( $config_file );
 
	}

	/** ȥ������ **/
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