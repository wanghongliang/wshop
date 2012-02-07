<?php
require_once(dirname(PATH_COMPONENT).DS.'com_products'.DS.'helpers'.DS.'route.php');
require(dirname(__FILE__).DS.'helper.php');

$list = & modProducttypeHelper::getList(&$params);
require(ModuleHelper::getLayoutPath('mod_producttype'));