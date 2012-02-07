<?php
import('application.component.model');
class AreasModel extends Model
{
	function AreasModel(){
		parent::__construct();
		$this->tableName = '#__area';
	}
	function getList()
	{
		//$helperFile = PATH_COMPONENT.DS.'helper'.DS.'area.php';
		//include($helperFile);

		//$tree = new AreaHelper();
		//$result = $tree->getcatagory(1,2);
		//$result = $tree->getAll();

		$sql = "select a.*,count(sa.id) as n from ".$this->tableName." as a left join ".$this->tableName." as sa on a.id = sa.parent_id  where a.parent_id=0 group by a.id ";
		$this->db->query($sql);
		$result = $this->db->getResult();
		return $result;
		
	}

	function getSubarea(){
		$id = (int)$_GET['id'];  
		$sql = "select a.*,count(sa.id) as n from ".$this->tableName." as a left join ".$this->tableName." as sa on a.id = sa.parent_id  where a.parent_id=".$id." group by a.id ";
		
 		$this->db->query($sql);
		return $this->db->getResult();
 
	}
}
?>