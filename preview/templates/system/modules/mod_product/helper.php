<?php
class modProductsHelper
{
	/**
	 * ��ȡ��������
	 */
	function & getList(&$params)
	{
		global $app;
		$db = &Factory::getDB();
		//print_r($params);
		//˵���� ��ģ������������ݣ��ɴ�һ�������ݵĶ�ȡ


		//�����б�
		$list = array();
 			
		//�Ƿ�ָ������
		$catid = intval($params['catid']);


 		//��ȡ�˵�������Ϣ
		$menu = &$app->getMenu();
		$menu_item = $menu->getItem($catid);

		
 		$where = " where p.isfront=1 and p.uid=".$app->uid." and  m.lft >=".$menu_item['lft']." and m.rgt <= ".$menu_item['rgt']."  ";
		//��ѯ���ݿ�
		$query = 'Select p.* from #__products as p inner join #__menu as m on m.id=p.menuid ' .
				$where;		
		$db->query($query);
		$list = $db->getResult();
		
  
		return $list;

	}
 
}
