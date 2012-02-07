<?php
class BuysHelperRoute
{
	/**
	 * @param	int	The route of the content item
	 */
	function getBuyRoute($id, $catid = 0)
	{
		global $app;
		$needles = array(
			'buy'  => (int) $id,
			'category' => (int) $catid,//ָ��ǰ�˵������µ�ID,������ǽ��Ҳ�����Ӧ�Ĳ˵���
		);

		//Create the link
		$link = 'index.php?com=buys&view=buy&id='. $id;

		$menus= &$app->getMenu();
		$m = $menus->getBuysMenu();
		$link .= '&itemid='.$m['id'];

 		//$link .= '&catid='.$catid;	//ֱ������

 		return $link;
	}
	function getCategoryRoute($catid)
	{
		$needles = array(
			'category' => (int) $catid,
		);

		//Create the link
		$link = 'index.php?com=buys&view=category&id='.$catid;

		if($item = ProductsHelperRoute::_findItem($needles)) {

 			if(isset($item->query['layout'])) {
				$link .= '&layout='.$item->query['layout'];
			}
			$link .= '&itemid='.$item['id'];
		};

		return $link;
	}


	function _findItem($needles)
	{
 		/**
		 * �˵�����: core/application/menu->/includes/menu
		 */
		$menus	= &SiteApplication::getMenu();

		/**
		 * ȡ���뵱ǰ���������Ĳ˵�
		 */
		$items	= $menus->getItems('component', 'products');
		
 		$match = null;
 

		//print_r($needles);

		/**
		 * ���Ҷ�Ӧ�Ĳ˵�
		 */
		foreach($needles as $needle => $id)
		{
			foreach($items as $item)
			{
				/**
				 * ѡ���ǰ����ʾ��ͼ �� ��Ӧ��ID ���Ӧ ��Ϊ�����µ�·��
				 */
				if (($item['query']['view'] == $needle) && ($item['query']['id'] == $id)) {
					$match = $item;
					break;
				}
			}

			if(isset($match)) {
				break;
			}
		}
		//print_r($match);
		return $match;
	}

}
?>