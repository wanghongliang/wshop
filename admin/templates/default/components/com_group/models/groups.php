<?php
import('application.component.model');
class GroupsModel extends Model
{

	function getList()
	{
		$helperFile = PATH_COMPONENT.DS.'helper'.DS.'group.php';
		include($helperFile);

		$tree = new GroupHelper();
		//$result = $tree->getcatagory(1,2);
		$result = $tree->getAll();
		return $result;
		
	}
}
?>