<?php
import( 'application.component.model');

class SearchModel extends Model
{
	function SearchModel()
	{
		parent::__construct();
		$this->tableName = '#__products';
	}
	function getList()
	{
		global $app;
		//$params 	   =& $app->getParams('com_products');
		
		$pathway = &$app->getPathWay();
 		$pathway->addItem('产品搜索','#');

 
		

		$catid = intval($_REQUEST['catid']);  	//没有指定菜单,将以ID为分类ID
 		$key = trim($_REQUEST['k']);
		  
		$menu = &$app->getMenu();
		$cat = $menu->getCategoryItem($catid);
 		$lists = array();
		$where= " where p.published=1   ";
		if( $catid > 0 ){
			$where .=" and  m.lft >=".$cat['lft']." and m.rgt <= ".$cat['rgt']." ";
		} 
 

		if( $key )
		{
			$where = $where?$where." and p.name like('%".$key."%') ":" where p.name like('%".$key."%') ";
		} 
		

 
 		$order = "  order by p.id ";

 
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName." as p ";
		$sql.= " inner join #__category as m on m.id = p.catid ";
 
		if( count($attr_keys)>0 ){
			$sql .= " inner join #__products_attr as a on p.id=a.products_id ";
		}


		$sql .= $where;
		
 
		$this->db->query($sql);
		$result = $this->db->getRow();
		$lists['nav'] = new Navigations(20,$result['n']);
		if( $key ){
		$lists['nav']->setRequest(array('com','view','tmpl','key'));
		} 
 		$sql = " select p.thumbnail,p.name,p.price_e,p.id,p.catid,p.introtext,p.market_price ,p.shop_price as price from ".$this->tableName." as p ";
		$sql.= " inner join #__category as m on m.id = p.catid ";
 		if( count($attr_keys)>0 ){
			$sql .= " inner join #__products_attr as a on p.id=a.products_id ";
		}
 		$sql .= $where;
		$sql .= $order;
		$sql.= $lists['nav']->getLimit($_REQUEST['page']);
		 
 		$this->db->query($sql);
		$lists['rows'] = $this->db->getResult();
		$lists['cat'] = $cat;
		return $lists;
	}

	function getTypelist()
	{
		$catid = intval($_REQUEST['catid']);  	//没有指定菜单,将以ID为分类ID
		$itemid  = intval($_REQUEST['itemid']);
 
 		/**
	    $sql = " select  c.*,count(p.id) as num  from #__category as c left join #__products as p on p.catid=c.id where c.parent_id=".$catid." group by c.id ";
		$this->db->query($sql);
		$lists['rows'] = $this->db->getResult();
		
		**/

		$lists = array();
 

		$menu = &SiteApplication::getMenu();

		$categroys = &$menu->getCategory();
		
 		//是否为产品目录全部列表
		if( $catid == 0 )
		{
			$cats = array();
			foreach( $categroys as $cat )
			{
				$cats[$cat['parent_id']][] = $cat;
			}
			$lists = array('rows'=>$cats,'child'=>$child_num,'catid'=>0);
		}else{
			
			$start=false;	//标记开始
			$cats = array();

			$child_num = 0;

			/**
			 * 目标:　找出所有相关的子分类,及子子分类
			 *　条件:　必需是按树状排列表数组
			 *  算法:　当找出对应分类时开始记录 ------- 直到下一个父级分类时结束
			 */
			foreach( $categroys as $cat )
			{
				if( $cat['id'] == $catid )
				{
					$start=true;	//标记开始
				}else if( $start && $cat['id'] != $catid && $cat['parent_id'] == 0 ){
					break;
				}

				if( $start)
				{
					$cats[] = $cat;

					if( $cat['parent_id'] == $catid ){ $child_num++; }	//记录当前目录下有多少子目录
				}	

			}

			array_shift($cats);
			$lists = array('rows'=>$cats,'child'=>$child_num,'catid'=>$catid);
		}
		return $lists;
	}
}
?>