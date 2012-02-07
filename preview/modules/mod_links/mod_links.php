<?php
if( $_REQUEST['page']<2 && $_REQUEST['catid']<1 && $_REQUEST['area']<1 && $_REQUEST['color']<1 && $_REQUEST['topic']<1 ){
$mod_path = dirname(__FILE__);
require_once ($mod_path.DS.'helper.php');

$list = modLinksHelper::getList($params);
require(ModuleHelper::getLayoutPath('mod_links'));
}
