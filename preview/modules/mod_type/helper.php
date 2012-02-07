<?php
require_once($app->getPreviewComponentPath().DS.'com_contents'.DS.'helpers'.DS.'route.php');

class modTypeHelper
{
	/**
	 * 获取新闻数据
	 */
	function & getList(&$params)
	{
		global $app;

		//菜单对象
		$menu = &$app->getMenu();

		//所有菜单
		$menus = $menu->getMenus();


		//查找当前菜单下的子分类
		$active_menu = $menu->getActive();
		if( $active_menu )
		{
			if( $active_menu['parent_id'] == 0  )
			{
				$id = $active_menu['id'];
			}else{
				$id = $active_menu['parent_id'];
			}
			$sitems = array();
			foreach( $menus as $m )
			{
				 if( $m['parent_id'] == $id )
				{
					Menu::buildLink(&$m);
					$sitems[] = $m;
				}
			}
			if( count($sitems) ){ return $sitems; }
		}


		
		//从菜单中找出分类信息
		$list = array();

		$parent_id = intval($params['menuid']);
		foreach( $menus as $type )
		{
	 			
			//是否选择了指定的父分类ID
			if( $parent_id>0 && $type['parent_id']!=$parent_id ){
				continue;
			}

			Menu::buildLink(&$type);
			$list[] =  $type;
	 
		}

  
		return $list;

	}
 
}
