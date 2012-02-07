<?php
$baseurl = '/'.$GLOBALS['config']['preview_directory'].'/'.URI_DIRECTORY.'/'.$app->getTemplate();
include($app->getPreviewComponentPath().DS.'com_banners'.DS.'helper.php');

$clink = URI::current();
$link = substr($clink,0,strpos($clink,'?'));
?>

<link rel="stylesheet" href="<?php echo $baseurl;?>/css/flashsale.css" type="text/css"/>

<div id="spcontent">
	<?php getBanner(21,true); ?> <div class="clr" ></div>


	<div class="fsbox b-white">
	 
	<div id="newtitle">
		<h2>限时抢购</h2>
		<a id="newmore" href="javascript:history.back();">返回&gt;&gt;</a>
	</div>

	<?php 

		$nav = &$this->lists['nav']; 
		$rows = &$this->lists['rows'];
		$i=0;

		if( count($rows)>0 ){
		foreach( $rows as $row )
		{
			$t = time();
			$t = $row['end_time']-$t;

			//echo $t;
			$d = (int)($t/3600/24);
			//echo $d.'天';

			$t = $t-$d*3600*24;	//减天数

			$h = (int)($t/3600);
			//echo $h.'小时';

			$t = $t-$h*3600;	//减小时数
			$s = (int)($t/60);

			//echo $s.'分钟';

			$t = $t-$s*60;	//减分钟

			$d = $d<1?0:$d;
			$h = $h<1?0:$h;
			$s = $s<1?0:$s;
			$t = $t<1?0:$t;


			$link = Router::_( ProductsHelperRoute::getProductRoute($row['id'],$row['catid']) );
			echo '<dl class="sprobox" t="'.$row['end_time'].'" >';
			echo '<dt class="spimg"><a href="" class="gocheck">抢购</a><a href="'.$link.'" title="点击查看"><img src="'.$row['thumbnail'].'" alt="" width="180"/></a></dt>';
			echo '<dt class="sptime">还剩 <span class="hday">'.$d.'</span>天 <span class="hhour">'.$h.'</span>时 <span class="hmini">'.$s.'</span>分 <span class="hsec">'.$t.'</span>秒</dt>';
			echo '<dt class="spname"><a href="'.$link.'" title="'.$row['name'].'">'.String::substr($row['name'],0,40).'</a></dt>';
			echo '<dd class="spric"><span class="price">'.Utility::price_format($row['shop_price']).'</span></dd>';
			echo '</dl>';
		}  
		}else{

			echo '<div class="noproduct" >暂无相关产品</div>';
		}

		echo $nav->showFilePage2();
	?> 
	 </div>
 </div>
 <script type="text/javascript" src="<?php echo $baseurl;?>/js/timeCountDown.js"></script>
<script type="text/javascript">
$('.sprobox').each(function(k,o){
 	var t= parseInt($(o).attr('t'))*1000+8*3600*1000;
 		fnTimeCountDown( t, {
			sec: $(".hsec",o).get(0),
			mini: $(".hmini",o).get(0),
			hour: $(".hhour",o).get(0),
			day: $(".hday",o).get(0)
		});
 });

</script>