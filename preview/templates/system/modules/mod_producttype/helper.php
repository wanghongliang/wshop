<?php
class modProducttypeHelper
{
	/**
	 * ��ȡ��������
	 */
	function & getList(&$params)
	{
		global $app;
		//�˵�����
		$menu = &$app->getMenu();
		$menus = $menu->getMenus(1);

		//�Ӳ˵����ҳ�������Ϣ
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
