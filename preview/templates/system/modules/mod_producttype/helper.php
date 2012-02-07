<?php
class modProducttypeHelper
{
	/**
	 * 获取新闻数据
	 */
	function & getList(&$params)
	{
		global $app;
		//菜单对象
		$menu = &$app->getMenu();
		$menus = $menu->getMenus(1);

		//从菜单中找出分类信息
		$list = array();
		foreach( $menus as $type )
		{
			if( $type['component'] == 'products' && $type['parent_id'] != 0 )
			{
				$type['link'] = Router::_( ProductsHelperRoute::getCategoryRoute($type['id']) );
				$list[] =  $type;
			}
		}

  
		return $list;

	}
 
}
