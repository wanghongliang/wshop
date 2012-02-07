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
		
		$menuid = intval($_REQUEST['itemid']);

		if( $menuid == 0 ){ $menuid = intval($_REQUEST['id']); }	//没有指定菜单,将以ID为分类ID
		//获取菜单分类信息
		$menu = &$app->getMenu();
		$menu_item = $menu->getItem($menuid);

		
		//print_r($params);
		$lists = array();
		$where = " where  p.uid=".$app->uid." and m.lft >=".$menu_item['lft']." and m.rgt <= ".$menu_item['rgt']." ";
 		$order = " order by p.id desc ";

 
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName." as p ";
		$sql.= " inner join #__menu as m on m.id = p.menuid ";
		
		$sql .= $where;
		

		$this->db->query($sql);
		$result = $this->db->getRow();
		$lists['nav'] = new Navigations(20,$result['n']);
		$lists['nav']->setRequest(array('task','tmpl'));

 
 		$sql = " select p.thumbnail,p.menuid,p.title,p.id from ".$this->tableName." as p ";
		$sql.= " inner join #__menu as m on m.id = p.menuid ";
		$sql .= $where;
		$sql .= $order;

		$sql.= $lists['nav']->getLimit($_REQUEST['page']);
 
		$this->db->query($sql);
		$lists['rows'] = $this->db->getResult();

		return $lists;
	}
}
?>