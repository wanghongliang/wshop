<?php
class modProductsHelper
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
		$limit = " limit ".intval($params['num_products']);

		/**
		//是否指定分类
		$catid = intval($params['catid']);


 		//获取菜单分类信息
		$menu = &$app->getMenu();
		$menu_item = $menu->getItem($catid);

		if( $catid>0 && is_array($menu_item) ){ //确认是否找到分类菜单项
			$where = " where p.isfront=1  and m.lft >=".$menu_item['lft']." and m.rgt <= ".$menu_item['rgt']."  ";
			//查询数据库
			$query = 'Select p.* from #__products as p left join #__category as m on m.id=p.catid ' .
					$where;		
			$db->query($query);
			$list = $db->getResult();
		}else{
			$where = " where p.isfront=1 ";
			//查询数据库
			$query = 'Select p.* from #__products as p ' .
					$where;		
			$db->query($query);
			$list = $db->getResult();
		}
		**/
		$showway = intval($params['showway']);

		if( $showway < 0 || $showway>3 ){ $showway = 2; }
 

		$where = " where e.elite_id=".$showway." and p.published=1 ";
		//查询数据库
		$query = 'Select p.id,p.name,p.catid,p.thumbnail,p.shop_price from #__elite_re as e left join #__products as p on e.products_id=p.id   ' .
				$where;		
		$query .=" order by e.ordering ";
		$query .= $limit;


 		$db->query($query);
		
		$list = $db->getResult();
		return $list;

	}
 
}
