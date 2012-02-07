<?php
class WebsiteHelperRoute
{
	/**
	 * @param	int	The route of the content item
	 */
	function getRoute($id, $catid = 0)
	{
		global $app;
   		$link = 'index.php?com=website&view=site&id='. $id;
   		$link .= '&catid='.$catid;	//直接引用

 		return $link;
	}
	function getGoRoute($id, $catid = 0)
	{
		global $app;
 
 		$link = 'index.php?com=website&view=gourl&id='. $id;
   		$link .= '&catid='.$catid;	//直接引用

 		return $link;
	}
	function getFavRoute($id, $catid = 0)
	{
		global $app;
  		$link = 'index.php?com=website&view=fav&id='. $id;
   		$link .= '&catid='.$catid;	//直接引用

 		return $link;
	}

	function getErrorRoute($id, $catid = 0)
	{
		global $app;
 		$link = 'index.php?com=website&view=senderror&id='. $id;
   		$link .= '&catid='.$catid;	//直接引用
 		return $link;
	}
	function getWsRoute($id, $catid = 0)
	{
		global $app;
 		$link = 'index.php?com=website&view=ws&id='. $id;
   		$link .= '&catid='.$catid;	//直接引用
 		return $link;
	}
	function getCategoryRoute($catid)
	{
		$needles = array(
			'category' => (int) $catid,
		);

		//Create the link
		$link = 'index.php?com=website&view=category&id='.$catid;

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
		 * 菜单对象: core/application/menu->/includes/menu
		 */
		$menus	= &SiteApplication::getMenu();

		/**
		 * 取得与当前组件相区配的菜单
		 */
		$items	= $menus->getItems('component', 'website');
		
 		$match = null;
 

		//print_r($needles);

		/**
		 * 查找对应的菜单
		 */
		foreach($needles as $needle => $id)
		{
			foreach($items as $item)
			{
				/**
				 * 选择的前组显示视图 和 对应的ID 相对应 即为该文章的路径
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