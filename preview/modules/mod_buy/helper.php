<?php
class modCaseHelper
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
 			
		//是否指定分类
		$catid = intval($params['catid']);

		$num = intval($params['num']);

 		//获取菜单分类信息
		$menu = &$app->getMenu();
		$menu_item = $menu->getItem($catid);

		if( $catid>0 && is_array($menu_item) ){ //确认是否找到分类菜单项
			$where = " where p.isfront=1 and p.uid=".$app->uid." and  m.lft >=".$menu_item['lft']." and m.rgt <= ".$menu_item['rgt']."  ";
			//查询数据库
			$query = 'Select p.* from #__contents as p inner join #__menu as m on m.id=p.menuid ' .
					$where;		
		}else{
			$where = " where p.isfront=1 and p.uid=".$app->uid;
			//查询数据库
			$query = 'Select p.* from #__contents as p ' .
					$where;		
		}
		if( $num > 0 ){
			$query .= " limit 0,".$num;
		}

		$db->query($query);
		$list = $db->getResult();

		return $list;

	}
 
}
