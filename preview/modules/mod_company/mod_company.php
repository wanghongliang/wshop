<?php

require_once (dirname(__FILE__).DS.'helper.php');

$item = modCompanyHelper::getList(&$params);
require(ModuleHelper::getLayoutPath('mod_company'));