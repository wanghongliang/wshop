<?php
$modules	=& ModuleHelper::getModules('home');
foreach($modules as $item)
{
	echo ModuleHelper::renderModule($item);
}
?>