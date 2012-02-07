<?php
$baseurl = '/'.$GLOBALS['config']['preview_directory'].'/'.URI_DIRECTORY.'/'.$app->getTemplate();

include($app->getPreviewComponentPath().DS.'com_banners'.DS.'helper.php');

?>
 

<link rel="stylesheet" href="<?php echo $baseurl;?>/css/special.css" type="text/css"/>
 
<?php getBanner(20,true); ?> <div class="clr" ></div>
</div>
</div>
<div class="clr" ></div>

<div id="sptitles">特价产品</div>
<div id="spcontent">
<div class="fsbox b-white">


<?php
	$nav = &$this->lists['nav'];
	$rows = &$this->lists['rows'];
	$i=0;
	foreach( $rows as $row )
	{
		$link = Router::_( ProductsHelperRoute::getProductRoute($row['id'],$row['catid']) );
		echo '<dl class="sprobox">';
		echo '<dt class="spimg"><span class="teback">￥'.(int)ABS($row['market_price']-$row['shop_price']).'</span><a href="'.$link.'" title="点击查看" target=_blank  ><img src="'.$row['thumbnail'].'" alt="" width="180" height=180 /></a></dt>';
		echo '<dt class="spname"><a href="'.$link.'" title="'.$row['name'].'" target=_blank >'.String::substr($row['name'],0,40).'</a></dt>';
		echo '<dd class="c-gray">原价：￥<s>'.Utility::price_format($row['market_price']).'</s></dd>';
		echo '<dd class="sprice"><a href="'.$link.'" class="spge" target=_blank  >抢购</a>特价：<span class="price" >'.Utility::price_format($row['shop_price']).'</span></dd>'; 
		echo '</dl>';
	} 
	echo $nav->showFilePage2();  
?> 
  
</div>
</div>

<div id="mainbox" style="background:white;" >
<div id="spcontent" >
 