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
		$menus = $menu->getMenus();

		//从菜单中找出分类信息
		$list = array();

		$parent_id = intval($params['producttype']);
		foreach( $menus as $type )
		{
			if( $type['component'] == 'products'  )
			{

				
				//是否选择了指定的父分类ID
				if( $parent_id>0 && $type['parent_id']!=$parent_id ){
					continue;
				}

				$type['link'] = Router::_( ProductsHelperRoute::getCategoryRoute($type['id']) );
				$list[] =  $type;
			}
		}

  
		return $list;

	}
 
}
