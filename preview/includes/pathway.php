<?php
class PathwaySite extends Pathway
{

	function PathwaySite($options = array())
	{
		//初始化数组
		$this->_pathway = array();


		// 得到路径
		$menu =& SiteApplication::getMenu();
		 
		$active_menus = $menu->getActive(); 
		$tree =  $active_menus['tree']; 
 		//print_r($active_menus);
		$items = array();

		//查找当前的路径菜单
		if( is_array($tree)  )
		{
 			foreach( $tree as $v )
			{
				//$items[] = &$menu->getItem( $v );
				$m = $menu->getItem( $v );
				if( $m['home'] != 1 ){
 					$this->addItem( $m['name'],Router::_( $m['link'].'&itemid='.$m['id']) );
				}
			}
		}


 

		if( isset($_REQUEST['catid']) && $_REQUEST['catid']>0 ){
			$cat = &$menu->getCategoryItem($_REQUEST['catid']);
			
			 
			$tree =  $cat['tree']; 
			//print_r($active_menus);
			$items = array();

			//查找当前的路径菜单
			if( is_array($tree) )
			{
				foreach( $tree as $v )
				{
					//$items[] = &$menu->getItem( $v );
					$m = $menu->getCategoryItem( $v );
					$this->addItem( $m['name'],$menu->bProductsLink( $m['route']) );

 				}
			}
		
		}
	}
}