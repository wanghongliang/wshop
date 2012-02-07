<?php
import('application.component.model');
class CachesModel extends Model
{
	var $nav = null;
	var $client_id=0;


 	function CachesModel()
	{
		parent::__construct();
		$this->tableName = '#__modules';
		$this->client_id = intval($_REQUEST['client_id']);

 	}
	function getList()
	{
		
		global $app;	
		$sql = "select * from #__components where cache=1 ";
		$this->db->query($sql);
		$data = $this->db->getResult();
		return $data;
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