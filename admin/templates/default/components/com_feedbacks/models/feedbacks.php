<?php
import('application.component.model');
class FeedbacksModel extends Model
{
	var $nav = null;
	var $client_id=0;

	function FeedbacksModel()
	{
		parent::__construct();
		$this->tableName = '#__feedbacks';
		$this->client_id = intval($_REQUEST['client_id']);
	}
	function getList()
	{
		global $app;
		
		$context = $_REQUEST['com'];
		$key =	 $app->getUserStateFromRequest('key','',$context  );
        
		$where = "";
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName;

		if($key){
			$where.=" where title like ('%".$key."%')  ";
		}

		$sql .= $where;

		$this->db->query($sql);
		$result = $this->db->getRow();
		$this->nav = new Navigations(20,$result['n']);
		

 
 		$sql = " select * from ".$this->tableName;
		$sql .= $where;
		$sql .= " order by id desc ";

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