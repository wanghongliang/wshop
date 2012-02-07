<?php
$baseurl = '/'.$GLOBALS['config']['preview_directory'].'/'.URI_DIRECTORY.'/'.$app->getTemplate();
include($app->getPreviewComponentPath().DS.'com_banners'.DS.'helper.php');

$clink = URI::current();
$link = substr($clink,0,strpos($clink,'?'));
?>

<link rel="stylesheet" href="<?php echo $baseurl;?>/css/newproducts.css" type="text/css"/>

<div id="spcontent">
<?php getBanner(19,true); ?> <div class="clr" ></div>
<div id="newtitle">
	<h2>新品上架</h2>
	<ul id="newtime">
		<li><a href="<?php echo $link;?>?s=0">所有新品</a></li>
		<li><a href="<?php echo $link;?>?s=1">本周新品</a></li>
		<li><a href="<?php echo $link;?>?s=2">本月新品</a></li>
		<li><a href="<?php echo $link;?>?s=3">年度新品</a></li>
	</ul>
</div>
<div class="fsbox b-white">
 


<?php 

	$nav = &$this->lists['nav']; 
	$rows = &$this->lists['rows'];
	$i=0;

	if( count($rows)>0 ){
	foreach( $rows as $row )
	{
		$link = Router::_( ProductsHelperRoute::getProductRoute($row['id'],$row['catid']) );
		echo '<dl class="sprobox">';
		echo '<dt class="spimg"><a href="'.$link.'" title="点击查看"><img src="'.$row['thumbnail'].'" alt="" width="180"/></a></dt>';
		echo '<dt class="spname"><a href="'.$link.'" title="'.$row['name'].'">'.String::substr($row['name'],0,40).'</a></dt>';
 		echo '<dd class="spric"><span class="price">'.Utility::price_format($row['shop_price']).'</span></dd>';
		echo '<dd ><a href="'.$link.'"class="spbuy">购买</a></dd>';
		echo '</dl>';
	}  
	}else{

		echo '<div class="noproduct" >暂无相关产品</div>';
	}

	echo $nav->showFilePage2();
?> 
 </div>
 </div>
 <script type="text/javascript" src="<?php echo $baseurl;?>/js/pk.js"></script>
