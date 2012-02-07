<?php
$db = &Factory::getDB();
$sql = "select * from #__products_activity where act_type=3  and end_time>'".time()."' order by start_time limit 2 ";
$db->query($sql);
$rows = $db->getResult();

global $app;
$baseurl = '/preview/templates/'.$app->getTemplate();

$link = Router::_('index.php?itemid=431');
$row = $rows[0];

$param = unserialize($row['ext_info']);
$t = time();
$t=$t2 = $row['start_time']-$t;

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


<div id="seckill">
	<h2 id="seckilltitle"> </h2>
	<dl id="seckillbox">
		<dt class="seckilltime">
			<span id="th" ><?php echo $h;?></span><span id="ti"><?php echo $s;?></span><span id="ts" ><?php echo $t;?></span>
		</dt>
		<dt class="good-img"><a href="<?php echo $link;?>?aid=<?php echo $row['act_id'];?>" target="_blank" ><img src="<?php if( substr($row['img'],-6,-4) == '_s' ){ echo substr($row['img'],0,-4); }else{ echo substr($row['img'],0,-4),'_s'; } ?>.jpg" alt="" width="130" height="130" /></a></dt>		
		<dt class="good-name">格力电油汀取暖器NDY20K送加湿盒晾衣架</dt>
		<dd class="good-price">
			秒杀价：<span class="price"><?php echo Utility::price_format($row['shop_price']);?></span><br/>
			本场秒杀：<?php echo date('H:i:s',$row['start_time']);?>
		</dd>
		<dd class="sec-btn"><a href="<?php echo $link;?>?aid=<?php echo $row['act_id'];?>" target="_blank" id="hkillbtn">立即秒杀</a></dd>
	</dl>
	<div class="seckillnext" >
		<h2 > </h2>
		<dl id="scnxbox">
			<dt class="scn-time">秒杀时间：<?php echo date('m月d日 H:i',$rows[1]['start_time']);?></dt>
			<dt class="scn-img"><a href="<?php echo $link;?>?aid=<?php echo $rows[1]['act_id'];?>"  target="_blank"  ><img src="<?php if( substr($rows[1]['img'],-6,-4) == '_s' ){ echo substr($rows[1]['img'],0,-4); }else{ echo substr( $rows[1]['img'],0,-4),'_s'; } ?>.jpg" alt="" width="80" height="80" /></a></dt>
			<dd class="scn-price"><span class="price"><?php echo Utility::price_format($rows[1]['shop_price']);?></span></dd>
			<dd class="scn-name"><?php echo String::substr($rows[1]['act_name'],0,14);?></dd>
		</dl>
	</div> 
</div>


<script type="text/javascript">
$(function(){
 	var t= <?php echo $rows[0]['start_time'];?>*1000+8*3600*1000;
	 
 		fnTimeCountDown( t, {
			sec: $("#ts").get(0),
			mini: $("#ti").get(0),
			hour: $("#th").get(0)
		});
 });

</script>