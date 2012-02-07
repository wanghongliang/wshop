<?php
if( !class_exists("modEliteCompanyHelper") ){
	require_once ($app->getPreviewComponentPath().DS.'com_contents'.DS.'helpers'.DS.'route.php');
	class modEliteCompanyHelper
	{
		/**
		 * 获取新闻数据
		 */
		function & getList(&$params)
		{
			global $app;
			$db = &Factory::getDB();
			//print_r($params);
			//说明： 此模块分三部分数据，可打开一部分数据的读取

			//数据列表
			$list = array();
				
 
			$where ='';// " where u.block=0 ";
			//查询数据库
			$query = 'Select c.company_name,c.id,u.username,c.uname from #__companies  as c  ';
			$query .= " left join #__users as u on c.uid=u.id ";
			$query.= $where;
	 
			$query.=" order by  c.id desc ";

			if( $num > 0 ){
				$query .= " limit 0,".$num;
			}


			$db->query($query);
			$list['rows']=  $db->loadObjectList();

			return $list;

		}


	}
}