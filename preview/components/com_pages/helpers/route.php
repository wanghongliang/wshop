<?php

function getHttpRoute($id, $catid = 0)
{
	$needles = array(
		'navigation'  => (int) $id,
		'category' => (int) $catid,//ָ��ǰ�˵������µ�ID,������ǽ��Ҳ�����Ӧ�Ĳ˵���
	);

	//Create the link
	$link = 'index.php?com=pages&view=navigation&id='. $id;
 	$link .= '&catid='.$catid;	//ֱ������
 	return $link;
}
function getHttpCatRoute($catid)
{
	static $active = null;
	if( !$active ){
		global $app;
 		$menu = &$app->getMenu();
		$active = &$menu->getActive();
	}
	
 
	//Create the link
	$link = 'index.php?com=pages&view=navigation&tid='.$catid;
 	$link .= '&itemid='.$active['id'];
	return $link;
}
 

?>