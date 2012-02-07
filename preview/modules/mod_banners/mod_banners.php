<?php
$mod_path = dirname(__FILE__);
require_once ($mod_path.DS.'helper.php');

$list = modBannersHelper::getList($params);
require(ModuleHelper::getLayoutPath('mod_banners'));
