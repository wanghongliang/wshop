<?php


/***
 * �������ӵ�URL��Ϣ
 * ���ºͲ˵���ID... 
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
	 * ��ͼ������
	 * ��û�в˵�IDʱ��������ͼ
	 * ���裺����в˵�ID��ֱ�ӴӲ˵�ID���ҵ���Ӧ����ͼ,�������ö�Ӧ����ͼ��
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
	//�����ڴ���һ�����ӵ�һ���˵�������£�

	/**
	 * ��������һ���Ͳ˵�������������Ϣ����ȥ��URL�����е�������Ϣ,��Ϊ�˵��а�����������Ϣ
	 */
	if (($mView == 'buy') and (isset($query['id'])) and ($mId == intval($query['id']))) {
		unset($query['view']);
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

				//������ʾ���б�
				$vars['view'] = 'tuan';

				//print_r($vars);exit;
			}else{
				$category=$menu->getCategoryByAlias($segments);

				//print_r($category);
				$vars['catid']   = $category['id'];//$segments[$count-1];
				$vars['view'] = 'category';

				//������ʾ���б�
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
