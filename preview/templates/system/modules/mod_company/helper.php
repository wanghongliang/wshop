<?php
class modCompanyHelper
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
 			
		$query = "select * from #__companies where uid=".$app->uid;
		$db->query($query);
		$list = $db->getRow();
		return $list;

	}
 
}
