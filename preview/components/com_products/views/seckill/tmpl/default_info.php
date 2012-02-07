<?php
$baseurl = '/'.$GLOBALS['config']['preview_directory'].'/'.URI_DIRECTORY.'/'.$app->getTemplate();
?>
<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>/css/questions.css" />

<div class="q_box">
	<div class="q_error_info" >
	<?php  
	echo $this->info;
	?>
	<br/>
	<a href="<?php echo URI::base();?>" ><font color=red>返回首页</font></a>
	</div>
</div> 