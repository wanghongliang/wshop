<?php
require_once ($app->getPreviewComponentPath().DS.'com_contents'.DS.'helpers'.DS.'route.php');
class modLatestArticleHelper
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

		if( $catid > 0 ){
			//��ȡ�˵�������Ϣ
			$menu = &$app->getMenu();
			$menu_item = $menu->getItem($catid);

			
			$where = " where p.isfront=1 and m.uid=".$app->uid." and  m.lft >".$menu_item['lft']." and m.rgt <= ".$menu_item['rgt']."  ";
			//��ѯ���ݿ�
			$query = 'Select p.* from #__contents as p inner join #__menu as m on m.id=p.menuid ' .
					$where;
			//echo $query;exit;
		
		}else{
			$where = " where p.isfront=1 and p.uid=".$app->uid;
			//��ѯ���ݿ�
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
