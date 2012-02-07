<?php
require_once ($app->getPreviewComponentPath().DS.'com_products'.DS.'helpers'.DS.'route.php');
$db = &Factory::getDB();
$sql = "select * from #__products_activity where act_type=2 and end_time>'".time()."'  limit 3 ";
$db->query($sql);
$rows = $db->getResult();

global $app;
$baseurl = '/preview/templates/'.$app->getTemplate();

?>



<?php
 ?>
<h2 id="limited">限时抢购 <a href="<?php echo Router::_('index.php?itemid=354');?>" class="hmore">更多</a></h2>
<?php foreach( $rows as $k=>$row ){
	$link = Router::_( ProductsHelperRoute::getProductRoute($row['products_id'],$row['catid']) );

	$param = unserialize($row['ext_info']);
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

	?>
	<dl class="limitbox" t="<?php echo $row['end_time']; ?>" >
		<dt class="good-time">仅剩 <span class="hday"><?php echo $d;?></span> 天 <span class="hhour"><?php echo $h;?></span> 时 <span class="hmini"><?php echo $s;?></span> 分 <span class="hsec"><?php echo $t;?></span> 秒</dt>
		<dt class="good-img"><a href="<?php echo $link;?>"><img src="<?php if( substr($row['img'],-6,-4) == '_s' ){ echo substr($row['img'],0,-4); }else{ echo substr($row['img'],0,-4),'_s'; } ?>.jpg" alt="" width="130" height="130" /></a></dt>
		<dt class="good-name"><a href="<?php echo $link;?>"><?php echo $row['act_name'];?></a></dt>
		<dd class="good-price">
			<span class="price"><?php echo Utility::price_format($row['shop_price']);?></span>
 		</dd>
	</dl>
<?php } ?>
<script type="text/javascript" src="<?php echo $baseurl;?>/js/timeCountDown.js"></script>
<script type="text/javascript">
$('.limitbox').each(function(k,o){
 	var t= parseInt($(o).attr('t'))*1000+8*3600*1000;
 		fnTimeCountDown( t, {
			sec: $(".hsec",o).get(0),
			mini: $(".hmini",o).get(0),
			hour: $(".hhour",o).get(0),
			day: $(".hday",o).get(0)
		});
 });

</script>