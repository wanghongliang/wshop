<?php
//print_r($this->item);
$basepath = dirname(__FILE__);
//include($basepath.DS.'header.php');
$baseurl = '/preview/templates/'.$app->getTemplate();

?>

<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>/css/tuan.css" />



	<div class="hfleft">
		<h1 class="histitle">往期团购</h1>
		<div class="histcontent">
        <?php
			if( is_array($rows = $this->item['rows']) ){
			foreach( $rows as $k=>$v ){
				$v['market_price']=$v['market_price']<1?1:$v['market_price'];
				 $param = unserialize( $v['ext_info']);
				?>
                <dl class="teamdl">
				<dt class="team-date"><?php echo date('Y-m-d',$v['start_time']);?></dt>
				<dd class="team-desc"><a href="<?php echo $link;?>?id=<?php echo $v['act_id'];?>"><?php echo $v['act_name'];?></a></dd>
				<dd class="team-pic"><a href="<?php echo $link;?>?id=<?php echo $v['act_id'];?>"><img src="<?php echo $v['img'];?>" width="180" alt="" /></a></dd>
				<dd class="team-arg"><p><span class="team-num">2000</span>人购买</p> 原价：<s class="bcolor2">¥<?php echo $v['market_price'];?></s> <br/> 现价：<span class="bcolor2">¥<?php echo $param['ladder_price'][0];?></span><br/> 折扣：<span class="bcolor3"><?php echo number_format( $param['ladder_price'][0]/$v['market_price']*10,1,'.','');?>折</span><br/> 节省：<span class="bcolor2">¥<?php echo $v['market_price']-$param['ladder_price'][0];?></span></dd>
				</dl>
				<?php
			}
			}
 
        ?>
		</div>
		<?php echo $this->item['nav']->showFilePage2();?>  
		<div class="hisbtm"></div>
	</div>
	<div class="hfright">
		<div class="tuanbox">
			<h3 class="teamtitle">今日团购</h3>
			<div class="boxcon">
			<?php
				if( count($rows = $this->item['today'])>0 ){
					foreach( $rows as $k=>$v ){
						 $param = unserialize( $v['ext_info']);

						echo '<dl class="todayteam">';
						echo '<dt class="td-name"><a href="'.$link.'?id='.$v['act_id'].'">'.$v['act_name'].'</a></dt>';
						echo '<dd class="padd-tb5"><a href="'.$link.'?id='.$v['act_id'].'"><img src="'.$v['img'].'" width="170" alt="" /></a></dd>';
						echo '<dd class="td-price">原价：<s class="bcolor2">¥'.$v['market_price'].'</s></dd>';
						echo '<dd class="td-price">折扣：<span class="bcolor3">'.number_format( $param['ladder_price'][0]/$v['market_price']*10,1,'.','').'折</span></dd>';
						echo '<dd class="td-price">现价：<span class="bcolor2">¥'.$param['ladder_price'][0].'</span></dd>';
						echo '<dd class="td-price">节省：<span class="bcolor2">¥'.$v['market_price']-$param['ladder_price'][0].'</span></dd>';
						echo '<dd class="td-ord"><a href="" class="td-btn">立即购买</a></dd>';
						echo '</dl>';
		 
					}
				}else{
					echo '<div align="center" ><br/>今日暂无团购信息!<br/><br/></div>';
				}
	 
			?>
 
			</div>
		</div> 
	</div>


<?php include($basepath.DS.'footer.php');?>