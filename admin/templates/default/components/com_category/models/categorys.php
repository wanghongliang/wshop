<?php
import('application.component.model');
class CategorysModel extends Model
{
	function getType(){
		$sql = "select name,id from #__products_type ";
		$this->db->query($sql);
		$rows = $this->db->getResult();

		$data = array();
		foreach( $rows as $row ){
			$data[$row['id']] = $row['name'];
		}
		return $data;
	}
	function getList()
	{
		$helperFile = PATH_COMPONENT.DS.'helper'.DS.'category.php';
		include($helperFile);

		$tree = new CategoryHelper();
		//$result = $tree->getcatagory(1,2);
		$result = $tree->getAll();
		return $result;
		
	}
}
?>