<?php
$uri = &URI::getInstance();

//基本URL信息
$baseurl = '/'.$GLOBALS['config']['preview_directory'].'/'.URI_DIRECTORY.'/'.$app->getTemplate();
?>
<link href="<?php echo $baseurl;?>/css/service2.css" type="text/css" rel="stylesheet"/>

<div id="dtroot">
<?php
$item	=& ModuleHelper::getModule('mod_breadcrumbs');
echo ModuleHelper::renderModule($item);
?> 
</div>
<div class="clr" ></div>
<div class="flv  " style="padding-top:10px;" >


<div class="sleft">
	<h2 class="stitle">关于格力在线</h2>
	<ul class="snav">
		<?php
		$rows = $menu->getMenus( 11 ); 
		foreach( $rows as $row ){
			$menu->buildLink($row);
		?>
			<li class="l" >
				<a href="<?php echo $row['link'];?>"><?php echo $row['name'];?></a>
			</li>
		<?php

		}
		?>
		<li><br/></li>
	</ul>
	 
 
</div>

<div class="sright">

<div  class="pages"  >
 
	<div class="db-p10" >
	<?php
		echo $this->item['content'];
	?>
	</div>
  
</div>
</div>


</div>