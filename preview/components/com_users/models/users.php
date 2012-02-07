<?php
import( 'application.component.model');

class UsersModel extends Model
{
	function UsersModel()
	{
		parent::__construct();
		$this->tableName = '#__companies';

	}
	function getList()
	{
		global $app;
		$params 	   =& $app->getParams('com_users');

		$catid = intval($_REQUEST['catid']);  	//没有指定菜单,将以ID为分类ID
 		$key = trim($_REQUEST['key']);

		$menu = &$app->getMenu();
		$cat = $menu->getCategoryItem($catid);
 		$lists = array();
		$where = null;
		if( $catid > 0 ){
			$where .=" where  m.lft >=".$cat['lft']." and m.rgt <= ".$cat['rgt']." ";
		}
		
		if( $key )
		{
			$where = $where?$where." and p.title like('%".$key."%') ":" where p.title like('%".$key."%') ";
		}
		
 		$order = "   order by p.id desc ";

 
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName." as p ";
		$sql.= " left join #__category as m on m.id = p.catid ";
	
		$sql .= $where;
		
 
		$this->db->query($sql);
		$result = $this->db->getRow();
		$lists['nav'] = new Navigations(20,$result['n']);
		if( $key ){
		$lists['nav']->setRequest(array('com','view','tmpl','key'));
		}

 
 		$sql = " select p.company_name,p.address,p.intro,p.join_date,p.uname from ".$this->tableName." as p ";
		$sql.= " left join #__category as m on m.id = p.catid ";
		$sql.= " left join #__users as u on u.id=p.uid ";
 		$sql .= $where;

	
		$sql .= $order;
		
		$sql.= $lists['nav']->getLimit($_REQUEST['page']);
		
 		$this->db->query($sql);
		$lists['rows'] = $this->db->getResult();
		$lists['cat'] = $cat;

		//print_r($lists['rows']);
		return $lists;
	}
}
?>