<?php
import('application.component.model');
class TypesModel extends Model
{
	function TypesModel()
	{
		parent::__construct();
		$this->tableName = '#__configs_option';
	}
	function getList()
	{
		$sql =" select t.*  as num from ".$this->tableName." as t   group by t.id ";
		$this->db->query($sql);
		$result = $this->db->getResult();
		return $result;
	}
}
?>