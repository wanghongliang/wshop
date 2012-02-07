<?php


/***
 * �������ӵ�URL��Ϣ
 * ���ºͲ˵���ID... 
 */
function WebsiteBuildRoute(&$query)
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
	if (($query['view'] == 'site' ||$query['view']=='directory' ) and ( isset($query['id'])) ) {
		unset($query['view']);
  	}else{
		if( $query['view'] != 'category'){
			$segments[] = $query['view'];
		}
 
		unset($query['view']);
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

function WebsiteParseRoute($segments)
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
		if( count($segments)==1 ){
			$vars['view']  = 'site';
			$vars['id']    = $segments[0];

		}else{
				if( $segments[0] == 'list' ){
					$vars['view']  = 'directory';
				}else{
					$vars['view']  = $segments[0];
				}
			$vars['id']    = $segments[$count - 1];
		}
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
				 
				if( count($segments)>1 ){
					//������ʾ���б�
					//$vars['view'] = 'site';
					if( $segments[0] == 'list' ){
						$vars['view']  = 'directory';
					}else{
						$vars['view']  = $segments[0];
					}
					if( $segments[0]=='gourl'){
						$_REQUEST['no_html']=1;
					}
				}else{
					$vars['view'] = 'site';
				}

				$vars['id']    = $segments[$count - 1];
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
			$vars['view'] = 'site';

		} break;

		case 'article' :
		{
			$vars['id']	  = $segments[$count-1];
			$vars['view'] = 'site';
		} break;
	}

 	return $vars;
}
