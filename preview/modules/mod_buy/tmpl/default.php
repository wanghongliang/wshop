<?php
$db = &Factory::getDB();
$sql = "select * from #__products_activity where act_type=1 limit 2 ";
$db->query($sql);
$rows = $db->getResult();

global $app;
$baseurl = '/preview/templates/'.$app->getTemplate();

?>

<?php /**
<div class="hthus">
	<?php
	if( $row['act_id']>0 ){

	$param = unserialize($row['ext_info']);
	$link = Router::_('index.php?itemid=369');

	$t = time();

	//是否过期
	if( $t > $row['end_time'] ){
	?><div class="hltime">
		该团购已过期!
	</div>
	<?php

	}else{
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


		//echo $t.'秒';



	?>
	<div class="hltime">仅剩 <span id="hday"><?php echo $d;?></span>天 <span id="hhour"><?php echo $h;?></span>时 <span id="hmini"><?php echo $s;?></span>分 <span id="hsec"><?php echo $t;?></span>秒</div>

	<?php
	}
	?>


	<dl class="hnbox2">
		<dt><a href="<?php echo $link;?>?id=<?php echo $row['act_id'];?>"><img src="<?php if( substr($row['img'],-6,-4) == '_s' ){ echo substr($row['img'],0,-4); }else{ echo substr($row['img'],0,-4),'_s'; } ?>.jpg" alt="" width="150" height="150" /></a></dt>
		<dt class="good-names"><a href="<?php echo $link;?>?id=<?php echo $row['act_id'];?>"><?php echo $row['products_name'];?></a></dt>
		<dl class="good-market-price">原 价：<s><?php echo $row['market_price'];?></s></dl>
		<dl class="good-price"><span><?php echo $param['ladder_price'][0];?></span></dl>
	</dl>

	<?php }else{ ?>
	<p align=center >
	<br/>
	<br/>
	<br/>
	暂无团购商品.
	</p>

	<?php } ?>
</div>


**/?>

<?php
$link = Router::_('index.php?itemid=369');
?>
<h2 id="groupbuy">今日团购</h2>
<?php foreach( $rows as $k=>$row ){
	$param = unserialize($row['ext_info']);
	?>
	<dl class="tuanbox" t="" >
		<dt class="tuan-img"><a href="<?php echo $link;?>?id=<?php echo $row['act_id'];?>" target="_blank" ><img src="<?php if( substr($row['img'],-6,-4) == '_s' ){ echo substr($row['img'],0,-4); }else{ echo substr($row['img'],0,-4),'_s'; } ?>.jpg" alt="" width="130" height="130" /></a></dt>
		<dt class="tuan-name"><a href="<?php echo $link;?>?id=<?php echo $row['act_id'];?>" target="_blank" ><?php echo $row['products_name'];?></a></dt>
		<dd class="tuan-price">
			<span><?php echo $param['ladder_price'][0];?></span>	
			<a href="<?php echo $link;?>?id=<?php echo $row['act_id'];?>" target="_blank" >团购</a>
		</dd>
		<dd class="tuan-person">目前已有<?php echo $row['purchase_people'];?>人参加团购</dd>
	</dl>
<?php } ?>

