<?php


/***
 * �������ӵ�URL��Ϣ
 * ���ºͲ˵���ID... 
 */
function ProductsBuildRoute(&$query)
{

	$segments = array();

	

	$menu = &SiteApplication::getMenu();


	if (empty($query['itemid'])) {
		$menuItem = &$menu->getActive();
	} else {
		$menuItem = &$menu->getItem($query['itemid']);
	}

 	$mView	= (empty($menuItem['query']['view'])) ? null : $menuItem['query']['view'];
	$mCatid	= (empty($menuItem['query']['catid'])) ? null : $menuItem['query']['catid'];
	$mId	= (empty($menuItem['query']['id'])) ? null : $menuItem['query']['id'];

	//print_r($query);

	/***
	 * ��ͼ������
	 * ��û�в˵�IDʱ��������ͼ
	 * ���裺����в˵�ID��ֱ�ӴӲ˵�ID���ҵ���Ӧ����ͼ,�������ö�Ӧ����ͼ��
	 */
	if(isset($query['view']))
	{
		$view = $query['view'];
		if(empty($query['itemid'])) {
			$segments[] = $query['view'];
		}
		unset($query['view']);
	};

	
	// are we dealing with an article that is attached to a menu item?
	//�����ڴ���һ�����ӵ�һ���˵�������£�

	/**
	 * ��������һ���Ͳ˵�������������Ϣ����ȥ��URL�����е�������Ϣ,��Ϊ�˵��а�����������Ϣ
	 */
	if (($mView == 'product') and (isset($query['id'])) and ($mId == intval($query['id']))) {
		unset($query['view']);
		unset($query['catid']);
		unset($query['id']);
 	}

 

	/**
	 * URL������������ز�������
	 *
	 * ������÷���ID�Ļ�����������ID
	 */
	if ( isset($view) and $view == 'category') {
		if ($mId != intval($query['id']) || $mView != $view) {
			$segments[] = $query['id'];
		}
		unset($query['id']);
	}

	/***
	 * ��URL�е� catid �� �˵��еĲ�����һ��ʱ���������������ͣ����� catid ����
	 */
	if (isset($query['catid'])) {

		// if we are routing an article or category where the category id matches the menu catid, don't include the category segment
		if ((($view == 'article') and ($mView != 'category') and ($mView != 'article') and ($mCatid != intval($query['catid'])))) {
			$segments[] = $query['catid'];
		}
		unset($query['catid']);
	};


	/**
	 * �Ǻ���ID��
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

 
	//print_r($segments);

	return $segments;
}

function ProductsParseRoute($segments)
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
 	//Handle View and Identifier
	switch($item['query']['view'])
	{
 

		case 'category'   :
		{
			$vars['id']   = $segments[$count-1];
			$vars['view'] = 'product';

		} break;

		case 'frontpage'   :
		{
			$vars['id']   = $segments[$count-1];
			$vars['view'] = 'product';

		} break;

		case 'article' :
		{
			$vars['id']	  = $segments[$count-1];
			$vars['view'] = 'product';
		} break;
	}

	return $vars;
}
