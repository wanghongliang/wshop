<?php
require_once(dirname(__FILE__).DS.'helper.php');

$list = & modTypeHelper::getList(&$params);
require(ModuleHelper::getLayoutPath('mod_type'));