<?php
class ContentsHelperRoute
{
	/**
	 * @param	int	The route of the content item
	 */
	function getArticleRoute($id, $catid = 0)
	{
		$needles = array(
			'article'  => (int) $id,
			'category' => (int) $catid,
		);

		//Create the link
		$link = 'index.php?com=contents&view=article&id='. $id;

		//if($catid) {
		///	$link .= '&catid='.$catid;
		//}

		//if($item = ContentsHelperRoute::_findItem($needles)) {
 			$link .= '&itemid='.$catid;
		//};
		return $link;
	}
	function getCategoryRoute($catid)
	{
		$needles = array(
			'category' => (int) $catid,
		);

		//Create the link
		$link = 'index.php?com=contents&view=category&id='.$catid;

		if($item = ContentsHelperRoute::_findItem($needles)) {

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
		$items	= $menus->getItems('component', 'contents');
  		$match = null;

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


		return $match;
	}

}
?>