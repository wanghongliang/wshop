<?php
class ProductsHelperRoute
{
	/**
	 * @param	int	The route of the content item
	 */
	function getProductRoute($id, $catid = 0)
	{
		$needles = array(
			'product'  => (int) $id,
			'category' => (int) $catid,//指当前菜单分类下的ID,如果不是将找不到对应的菜单项
		);

		//Create the link
		$link = 'index.php?com=products&view=product&id='. $id; 
		$link .= '&catid='.$catid;	//直接引用 
 		return $link;
	}
	function getCategoryRoute($catid)
	{
		$needles = array(
			'category' => (int) $catid,
		);

		//Create the link
		$link = 'index.php?com=products&catid='.$catid;	//直接引用 
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
		$items	= $menus->getItems('component', 'products');
		
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