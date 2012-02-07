<div class="clr"  style="border:1px solid #f00;"></div>
<div class="<?php echo $params['moduleclass_sfx']?>" id="<?php echo $module->module,'-',$module->id;?>" >

<?php
/** 是否指定有模块位置信息 **/
if( $params['modulepos'] ){
	?>

	<div class="wrapleft" >
	<?php
	$modules	=& ModuleHelper::getModules($params['modulepos'].'_left');
	foreach($modules as $item)
	{
		echo ModuleHelper::renderModule($item);
	}
	?>
	</div>


	<div class="wrapcenter" >
	<?php
	$modules	=& ModuleHelper::getModules($params['modulepos'].'_center');
	foreach($modules as $item)
	{
		echo ModuleHelper::renderModule($item);
	}
	?>
	</div>



	<div class="wrapright" >
	<?php
	$modules	=& ModuleHelper::getModules($params['modulepos'].'_right');
	foreach($modules as $item)
	{
		echo ModuleHelper::renderModule($item);
	}
	?>
	</div>




	<?php
}
?>

</div>
<div class="clr" ></div>
