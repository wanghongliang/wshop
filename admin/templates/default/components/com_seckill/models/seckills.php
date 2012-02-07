<?php
import('application.component.model');
class SeckillsModel extends Model
{
	var $nav = null; 

	function SeckillsModel()
	{
		parent::__construct();
		$this->tableName = '#__products_activity'; 
	}
	function getList()
	{
		global $app;
		
		$context = $_REQUEST['com'];
		$key =	 $app->getUserStateFromRequest('key','',$context  );
        
		$where = " where act_type=3 ";
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName;

		if($key){
			$where.=" and act_name like ('%".$key."%')  ";
		}

		$sql .= $where; 
		$this->db->query($sql);
		$result = $this->db->getRow();
		$this->nav = new Navigations(20,$result['n']);
		
 		$sql = " select * from ".$this->tableName;
		$sql .= $where;
		$sql .= " order by act_id desc "; 
		$sql.= $this->nav->getLimit($_REQUEST['page']);

		$this->db->query($sql);
		return $this->db->getResult();
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