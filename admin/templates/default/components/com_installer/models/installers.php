<?php
import('application.component.model');
class InstallersModel extends Model
{
 	function InstallersModel()
	{
		parent::__construct();
		$this->tableName = '#__components';
 	}
	function getList()
	{
 		$sql = " select * from ".$this->tableName." where parent = 0 ";
		$sql .= " order by id desc ";
		$this->db->query($sql);
		return $this->db->getResult();
	}
}
?>