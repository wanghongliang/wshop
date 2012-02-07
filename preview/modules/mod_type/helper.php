<?php
require_once($app->getPreviewComponentPath().DS.'com_contents'.DS.'helpers'.DS.'route.php');

class modTypeHelper
{
	/**
	 * ��ȡ��������
	 */
	function & getList(&$params)
	{
		global $app;

		//�˵�����
		$menu = &$app->getMenu();

		//���в˵�
		$menus = $menu->getMenus();


		//���ҵ�ǰ�˵��µ��ӷ���
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


		
		//�Ӳ˵����ҳ�������Ϣ
		$list = array();

		$parent_id = intval($params['menuid']);
		foreach( $menus as $type )
		{
	 			
			//�Ƿ�ѡ����ָ���ĸ�����ID
			if( $parent_id>0 && $type['parent_id']!=$parent_id ){
				continue;
			}

			Menu::buildLink(&$type);
			$list[] =  $type;
	 
		}

  
		return $list;

	}
 
}
