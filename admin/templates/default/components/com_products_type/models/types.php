<?php
import('application.component.model');
class TypesModel extends Model
{
	function TypesModel()
	{
		parent::__construct();
		$this->tableName = '#__products_type';
	}
	function getList()
	{
		$sql =" select t.*,count(a.attr_id) as num from ".$this->tableName." as t left join #__products_attribute as a on t.id=a.type_id group by t.id ";
		$this->db->query($sql);
		$result = $this->db->getResult();
		return $result;
	}
}
?>