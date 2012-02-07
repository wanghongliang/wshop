<?php
 		
class modBreadCrumbsHelper
{
	function getList(&$params)
	{
		global $app;
		$items = array();
		$pathway = &$app->getPathWay();
 		$items   = $pathway->getPathWay();


 		return $items;
	}

 }