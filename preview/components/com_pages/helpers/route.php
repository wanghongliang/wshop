<?php

function getHttpRoute($id, $catid = 0)
{
	$needles = array(
		'navigation'  => (int) $id,
		'category' => (int) $catid,//指当前菜单分类下的ID,如果不是将找不到对应的菜单项
	);

	//Create the link
	$link = 'index.php?com=pages&view=navigation&id='. $id;
 	$link .= '&catid='.$catid;	//直接引用
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