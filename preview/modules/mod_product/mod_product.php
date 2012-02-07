<?php
require_once ($app->getPreviewComponentPath().DS.'com_products'.DS.'helpers'.DS.'route.php');
require_once($app->getPreviewComponentPath().DS.'com_banners'.DS.'helper.php');
require_once (dirname(__FILE__).DS.'helper.php');
$list = & modProductsHelper::getList($params);

require(ModuleHelper::getLayoutPath('mod_product'));