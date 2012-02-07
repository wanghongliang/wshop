<?php
class modLinksHelper
{
	function getList(&$params)
	{
		global $app;
		$db = &Factory::getDB();

		$num = intval( $params['num'] );
		$catid = intval($params['catid']);
		$sql = "select * from #__links where   published=1 ";
		if( $catid>0 ){
			$sql .= " and type_id=".$catid;
		}
		$sql .=" order by ordering ";

		if( $num > 0 ){
			$sql.=" limit ".$num;
		}

 		$db->query($sql);
		$rows = $db->getResult();

 		return $rows;
	}



}
