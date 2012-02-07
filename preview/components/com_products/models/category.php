<?php
import( 'application.component.model');

class CategoryModel extends Model
{
	function CategoryModel()
	{
		parent::__construct();
		$this->tableName = '#__products';
	}
	function getList()
	{
		global $app;
		$params 	   =& $app->getParams('com_products');
		

		$catid = intval($_REQUEST['catid']);  	//没有指定菜单,将以ID为分类ID
 		$key = trim($_REQUEST['key']);
		 
		$o = trim($_GET['o']);	//排序字段
		$s = trim($_GET['s']);	//排序方式

		$menu = &$app->getMenu();
		$cat = $menu->getCategoryItem($catid);
 		$lists = array();
		$where= " where p.published=1   ";
		if( $catid > 0 ){
			$where .=" and  m.lft >=".$cat['lft']." and m.rgt <= ".$cat['rgt']." ";
		} 
		$attr_keys =   array(); //是否按属性值过滤
		$attr_values = '';
		foreach( $_GET as $k=>$v ){
			if( substr($k,0,2) == 'f_' ){
				$aid = substr($k,2);
				
				$v = trim($v);
				 
				if( $v != '' ){
					$attr_keys[] = $aid;
					$attr_values.= " and a.attr_value_id='".$v."' ";
					//$tmp .=" or a.attr_id='".$aid."' and a.attr_value='".$v."' ";
				}
			}
		}

		if( count($attr_keys)>0 ){
			$where .=" and a.attr_id in (".implode(',',$attr_keys).") ".$attr_values;
		}
		

		if( $key )
		{
			$where = $where?$where." and p.title like('%".$key."%') ":" where p.title like('%".$key."%') ";
		} 
		

		switch($o){
			case 's':
				$o = ' p.sales ';
				break;
			case 't':
				$o = ' p.created ';
				break;
			case 'p':
				$o = ' p.shop_price ';
				break;

			default:
				$o = ' p.created ';
		}

		switch($s){
			case 'a':
				$s = ' asc ';
				break;
			case 'd':
				$s = ' desc ';
				break; 
			default:
				$s = 'desc ';
		}
 		$order = "  order by ".$o." ".$s." ";

 
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName." as p ";
		$sql.= " inner join #__category as m on m.id = p.catid ";
 
		if( count($attr_keys)>0 ){
			$sql .= " inner join #__products_attr_v as a on p.id=a.products_id ";
		}


		$sql .= $where;
		
 
		$this->db->query($sql);
		$result = $this->db->getRow();
		$lists['nav'] = new Navigations(10,$result['n']);
		if( $key ){
		$lists['nav']->setRequest(array('com','view','tmpl','key'));
		} 
 		$sql = " select p.thumbnail,p.name,p.price_e,p.id,p.catid,p.introtext,p.market_price ,p.shop_price from ".$this->tableName." as p ";
		$sql.= " inner join #__category as m on m.id = p.catid ";
 		if( count($attr_keys)>0 ){
			$sql .= " inner join #__products_attr_v as a on p.id=a.products_id ";
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
			$cCat = null;
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
					$cCat = $cat; //记录当前的分类
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
			$lists = array('rows'=>$cats,'child'=>$child_num,'catid'=>$catid,'cat'=>$cCat);
		}
		return $lists;
	}
}
?>