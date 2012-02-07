<?php
import( 'application.component.model');

class CategoryModel extends Model
{
	function CategoryModel()
	{
		parent::__construct();
		$this->tableName = '#__contents';
	}
	function getList()
	{
		global $app;
		$params 	   =& $app->getParams('com_contents');
		
		$menuid = intval($_REQUEST['itemid']);
		//print_r($params);
		$lists = array();
		$where = " where uid='".$this->uid."' ";

		$where .= " and menuid=".$menuid;
 
		$order = " order by id desc ";

 
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName;
		$sql .= $where;
		

		$this->db->query($sql);
		$result = $this->db->getRow();
		$lists['nav'] = new Navigations(20,$result['n']);
		$lists['nav']->setRequest(array('task','tmpl'));

 
 		$sql = " select menuid,title,id from ".$this->tableName;
		$sql .= $where;
		$sql .= $order;

		$sql.= $lists['nav']->getLimit($_REQUEST['page']);


		$this->db->query($sql);
		$lists['rows'] = $this->db->getResult();

		return $lists;
	}
}
?>