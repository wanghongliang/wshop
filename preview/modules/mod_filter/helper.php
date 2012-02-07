<?php
class modFilterHelper
{
	/**
	 * 获取新闻数据
	 */
	function & getProvince($area=1)
	{
		global $app;
 
		$menu = &$app->getMenu();
		//数据列表
		$list = array();
 			
		$list = &$menu->getCategory();
		return $list;


	}
 
}
