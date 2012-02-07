<?php
require_once (PATH_PREVIEW.DS.'components'.DS.'com_products'.DS.'helpers'.DS.'route.php');

require_once (dirname(__FILE__).DS.'helper.php');

$list = & modProductsHelper::getList(&$params);
require(ModuleHelper::getLayoutPath('mod_product'));