<?php
import('application.component.model');
class ModulesModel extends Model
{
	var $nav = null;
	var $client_id=0;


 	function ModulesModel()
	{
		parent::__construct();
		$this->tableName = '#__modules';
		$this->client_id = intval($_REQUEST['client_id']);

 	}

	//查找位置选项
	function getBypos(){ 
		$sql = "select position  from ".$this->tableName." where  client_id=".$this->client_id." group by position ";
		$this->db->query($sql);
		$rows = $this->db->getResult();

		$data = array('');
		foreach( $rows as $row ){
			$data[$row['position']] = $row['position'];
		}
		return $data;

	}
	function getBymod(){
		$sql = "select module from ".$this->tableName." where  client_id=".$this->client_id." group by module ";
		$this->db->query($sql);
		$rows = $this->db->getResult();

		$data = array('');
		foreach( $rows as $row ){
			$data[$row['module']] = $row['module'];
		}
		return $data;

	}


	function getList()
	{
		global $app;
		$where = array("  uid =".$this->uid." and client_id=".$this->client_id);

		$context = $_REQUEST['com'];
		$pos = $app->getUserStateFromRequest( 'pos',		'',		$context);
		$m = $app->getUserStateFromRequest('m',		'',		$context  );
 
		if( $pos ){ $where[] = "  position ='".$pos."' "; }
		if( $m ){ $where[] = "  module ='".$m."' "; }
		$key =	 $_REQUEST['key'];
		if( $key )
		{
			$where[] = "  title like ('%".$key."%')  ";
		}
		$where = count($where)>0 ? " where ".implode(' and ',$where):'';
		
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName;
		$sql .= $where;

		$this->db->query($sql);
		$result = $this->db->getRow();
		$this->nav = new Navigations(20,$result['n']);
		

 
 		$sql = " select * from ".$this->tableName;
		$sql .= $where;
		$sql .= " order by  position, ordering ";

		$sql.= $this->nav->getLimit($_REQUEST['page']);
		
	
		$this->db->query($sql);
		return $this->db->getResult();
	}
	function getList_short()
	{
		
		$where = " where client_id=".$this->client_id." and short=1 ";
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName;
		$sql .= $where;

		$this->db->query($sql);
		$result = $this->db->getRow();
		$this->nav = new Navigations(20,$result['n']);
		

 
 		$sql = " select * from ".$this->tableName;
		$sql .= $where;
		$sql .= " order by  position, ordering ";

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