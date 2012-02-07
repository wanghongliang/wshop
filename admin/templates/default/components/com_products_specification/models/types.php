<?php
import('application.component.model');
class TypesModel extends Model
{
	function TypesModel()
	{
		parent::__construct();
		$this->tableName = '#__products_specification';
	}
	function getList()
	{
		$sql =" select t.*,count(a.spec_value_id) as num from ".$this->tableName." as t left join #__products_spec_values as a on t.id=a.spec_id group by t.id ";
		$this->db->query($sql);
		$result = $this->db->getResult();
		return $result;
	}
}
?>