<?php
class modBannersHelper
{
	function getList(&$params)
	{
 		$db = &Factory::getDB();

		$num = intval( $params['num'] );
		$catid = intval($params['catid']);
		$sql = "select * from #__banners where  tid='".$catid."'  "; 
		$db->query($sql); 
		$rows = $db->getRow(); 
		return $rows;
	}



}
