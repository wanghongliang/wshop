<?php
import('application.component.model');
class EvaluationsModel extends Model
{
	var $nav = null;
	var $client_id=0;

	function EvaluationsModel()
	{
		parent::__construct();
		$this->tableName = '#__evaluation';
		$this->client_id = intval($_REQUEST['client_id']);
	}
	function getList()
	{
		global $app;
		
		$context = $_REQUEST['com'];
		$key =	 trim($_REQUEST['key']);
        
		$where = array();

		if( !empty( $key ) ){
			$where[] = " c.contents like ('%".$key."%') ";
		}

		$where = count($where)>0?" where ".implode(" and ",$where ):"";
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName." as c ";

	 
		$sql .= $where; 
		$this->db->query($sql);
		$result = $this->db->getRow();
		$this->nav = new Navigations(20,$result['n']);
		
 		$sql = " select c.*,p.name,p.thumbnail,p.shop_price from ".$this->tableName." as c left join #__products as p on c.product_id=p.id ";
		$sql .= $where;
		$sql .= " order by c.id desc "; 
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