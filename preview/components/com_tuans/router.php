<?php


/***
 * 构建复杂的URL信息
 * 文章和菜单的ID... 
 */
function TuansBuildRoute(&$query)
{

	$segments = array();


 	

	$menu = &SiteApplication::getMenu();


	if (empty($query['itemid'])) {
		$menuItem = &$menu->getActive();
	} else {
		$menuItem = &$menu->getItem($query['itemid']);
	}

 	$mView	= (empty($menuItem['query']['view'])) ? null : $menuItem['query']['view'];
	$mCatid	= (empty($menuItem['query']['catid'])) ? $query['catid'] : $menuItem['query']['catid'];
	$mId	= (empty($menuItem['query']['id'])) ? null : $menuItem['query']['id'];

	//print_r($query);

	/***
	 * 视图的设置
	 * 当没有菜单ID时，设置视图
	 * 假设：如果有菜单ID，直接从菜单ID中找到对应的视图,不用设置对应的视图了
	 */
	 /**
	if(isset($query['view']))
	{
		$view = $query['view'];
		if(empty($query['itemid'])) {
			$segments[] = $query['view'];
		}
		unset($query['view']);
	};
	**/
	
	// are we dealing with an article that is attached to a menu item?
	//我们在处理一个附加到一个菜单项的文章？

	/**
	 * 当处理是一个和菜单关联的文章信息，将去掉URL参数中的文章信息,因为菜单中包含了文章信息
	 */
	if (($mView == 'buy') and (isset($query['id'])) and ($mId == intval($query['id']))) {
		unset($query['view']);
 		unset($query['id']);
 	}

 

	/**
	 * URL的文章类型相关参数构建
	 *
	 * 如果设置分类ID的话，将设文章ID
	 */
	if ( isset($view) and $view == 'category') {
		if ($mId != intval($query['id']) || $mView != $view) {
			$segments[] = $query['id'];
		}
		unset($query['id']);
	}

	/***
	 * 当URL中的 catid 和 菜单中的参数不一致时，并且是文章类型，将设 catid 参数
	 */
 

	/**
	 * 是后检测ID项
	 */
	if(isset($query['id'])) {
		if (empty($query['itemid'])) {
			$segments[] = $query['id'];
		} else {
			if (isset($menuItem['query']['id'])) {
				if($query['id'] != $mId) {
					$segments[] = $query['id'];
				}
			} else {
				$segments[] = $query['id'];
			}
		}
		unset($query['id']);
	};

 
 
	return $segments;
}

function TuansParseRoute($segments)
{
	$vars = array();

	//Get the active menu item
	$menu =& SiteApplication::getMenu();
	$item =& $menu->getActive();

	 
	// Count route segments
	$count = count($segments);

	//Standard routing for articles
	if(!isset($item))
	{
		$vars['view']  = $segments[0];
		$vars['id']    = $segments[$count - 1];
		return $vars;
	}
	
	//print_r($item);
	//print_r($segments);
 	//Handle View and Identifier
	switch($item['query']['view'])
	{
 

		case 'category'   :
		{

			if( (int)$segments[$count-1] > 0 ){
				$vars['id'] = $segments[$count-1];

				//定义显示的列表
				$vars['view'] = 'tuan';

				//print_r($vars);exit;
			}else{
				$category=$menu->getCategoryByAlias($segments);

				//print_r($category);
				$vars['catid']   = $category['id'];//$segments[$count-1];
				$vars['view'] = 'category';

				//定义显示的列表
				$vars['layout'] = 'category_list';
			}
			

		} break;

		case 'frontpage'   :
		{
			$vars['id']   = $segments[$count-1];
			$vars['view'] = 'tuan';

		} break;

		case 'article' :
		{
			$vars['id']	  = $segments[$count-1];
			$vars['view'] = 'tuan';
		} break;
	}

	return $vars;
}
