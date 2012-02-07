<?php
import('application.component.model');
class MenutypesModel extends Model
{

	function MenutypesModel()
	{
		parent::__construct();
		$this->tableName = '#__menu_types';
	}
	function getList()
	{
		$sql =" select * from ".$this->tableName." where uid=".$this->db->Quote($this->uid)." order by ordering ";
		$this->db->query($sql);
		$result = $this->db->getResult();

		return $result;
	}
}
?>