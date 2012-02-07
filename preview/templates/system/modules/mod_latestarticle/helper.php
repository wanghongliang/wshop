<?php
require_once ($app->getPreviewComponentPath().DS.'com_contents'.DS.'helpers'.DS.'route.php');
class modLatestArticleHelper
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

		if( $catid > 0 ){
			//获取菜单分类信息
			$menu = &$app->getMenu();
			$menu_item = $menu->getItem($catid);

			
			$where = " where p.isfront=1 and m.uid=".$app->uid." and  m.lft >".$menu_item['lft']." and m.rgt <= ".$menu_item['rgt']."  ";
			//查询数据库
			$query = 'Select p.* from #__contents as p inner join #__menu as m on m.id=p.menuid ' .
					$where;
			//echo $query;exit;
		
		}else{
			$where = " where p.isfront=1 and p.uid=".$app->uid;
			//查询数据库
			$query = 'Select p.* from #__contents as p  ' . $where;

		}
		$db->query($query);
 		$list['list_article']= & modLatestArticleHelper::_buildLink( $db->loadObjectList() );
	

		return $list;

	}

	function & _buildLink(&$rows)
	{
		$i		= 0;
		$lists	= array();
		foreach ( $rows as $row )
		{
			$lists[$i]->link = Router::_( ContentsHelperRoute::getArticleRoute($row->id,$row->menuid) );
			$lists[$i]->title = htmlspecialchars( $row->title );
 			$i++;
		}
		return $lists;
	}
}
