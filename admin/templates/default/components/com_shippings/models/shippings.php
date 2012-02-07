<?php
import('application.component.model');
class ShippingsModel extends Model
{
	var $nav = null;
 	function ShippingsModel()
	{
		parent::__construct();
		$this->tableName = '#__shipping';
 	}
	function getList()
	{
		global $app; 
		$context = $_REQUEST['com'];
		$key =	 $app->getUserStateFromRequest('key','',$context  ); 
		$where = array( );  
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName;

		if($key){
			 
		}
		$where = count($where)>0 ? " where ".implode(' and ',$where):'';

		$sql .= $where;

		$this->db->query($sql);
		$result = $this->db->getRow();
		$this->nav = new Navigations(20,$result['n']);
		

 
 		$sql = " select * from ".$this->tableName;
		$sql .= $where;
		$sql .= " order by ordering";

		$sql.= $this->nav->getLimit($_REQUEST['page']);

		$this->db->query($sql);
		$rows = $this->db->getResult();
 
		//print_r($rows);
		return $rows;
	}

	function getNav()
	{
		if( !$this->nav )
		{
			$this->getList();
		}
		return $this->nav;
	}
}
?>