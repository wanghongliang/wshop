<?php
if( !class_exists("modFocusHelper") ){
	require_once ($app->getPreviewComponentPath().DS.'com_contents'.DS.'helpers'.DS.'route.php');
	class modFocusHelper
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
			if( $catid > 0 ){
				//获取菜单分类信息
				$menu = &$app->getMenu();
				$menu_item = $menu->getItem($catid);
				
				$where = " where p.isfront=1 and m.uid=".$app->uid." and  m.lft >=".$menu_item['lft']." and m.rgt <= ".$menu_item['rgt']."  ";
				//查询数据库
				$query = 'Select  p.title,p.id,p.author,m.name,p.menuid  from #__contents as p inner join #__menu as m on m.id=p.menuid ' .
						$where;
				//echo $query;exit;
			
			}else{
				$where = " where p.isfront=1 and p.uid=".$app->uid;
				//查询数据库
 				$query = 'Select p.title,p.id,p.author,m.name,p.menuid  from #__contents as p inner join #__menu as m on m.id=p.menuid ' .
						$where;
			}

			$query.=" order by p.ordering , p.id desc ";

			if( $num > 0 ){
				$query .= " limit 0,".$num;
			}


			$db->query($query);


			if( $params['catlink'] == '1' ){
				$list['list_article']= & modFocusHelper::_buildCatLink( $db->loadObjectList() );

			}else{
				$list['list_article']= & modFocusHelper::_buildLink( $db->loadObjectList() );
			}
		

			return $list;

		}

		function & _buildCatLink(&$rows){
			$i		= 0;
			$lists	= array();
			foreach ( $rows as $row )
			{
				$lists[$i]->link = Router::_( ContentsHelperRoute::getCategoryRoute($row->menuid) ).'#'.$row->id;
				$lists[$i]->title = htmlspecialchars( $row->title );
								$lists[$i]->author = $row->author;

				$i++;
			}
			return $lists;
		}

		function & _buildLink(&$rows)
		{
			$i		= 0;
			$lists	= array();
			foreach ( $rows as $row )
			{
				$lists[$i]->link = Router::_( ContentsHelperRoute::getArticleRoute($row->id,$row->menuid) );
				$lists[$i]->name = htmlspecialchars( $row->name );
				$lists[$i]->title = htmlspecialchars( $row->title );
				$lists[$i]->author = $row->author;

				$i++;
			}
			return $lists;
		}
	}
}