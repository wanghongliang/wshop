<?php
import( 'application.component.model');

class CategoryModel extends Model
{
	function CategoryModel()
	{
		parent::__construct();
		$this->tableName = '#__buys';
	}
	function getList()
	{
		global $app;
		$params 	   =& $app->getParams('com_buys');
		

		$catid = intval($_REQUEST['catid']);  	//没有指定菜单,将以ID为分类ID
 		$key = trim($_REQUEST['key']);

		$menu = &$app->getMenu();
		$cat = $menu->getCategoryItem($catid);





 		$lists = array();
		$where = null;
		if( $catid > 0 ){
 
			$where .=" where m.id='".$catid."' ";
		}
		
		if( $key )
		{
			$where = $where?$where." and p.title like('%".$key."%') ":" where p.title like('%".$key."%') ";
		}
		
 		$order = "   order by p.id desc ";

 
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName." as p ";
		$sql.= " inner join #__category as m on m.id = p.catid ";
		
		$sql .= $where;
		

		//echo $sql;
 
		$this->db->query($sql);
		$result = $this->db->getRow();
		$lists['nav'] = new Navigations(20,$result['n']);
		if( $key ){
		$lists['nav']->setRequest(array('com','view','tmpl','key'));
		}


  
 		$sql = " select p.thumbnail ,p.modified,p.title,p.id,p.catid,p.introtext,c.company_name as company,c.uname  from ".$this->tableName." as p ";
		$sql.= " inner join #__category as m on m.id = p.catid ";
		$sql.=" left join #__companies as c on p.uid=c.uid ";
		$sql .= $where;

	
		$sql .= $order;
		
		$sql.= $lists['nav']->getLimit($_REQUEST['page']);
		
 		$this->db->query($sql);
		$lists['rows'] = $this->db->getResult();

		//print_r($lists['rows']);
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