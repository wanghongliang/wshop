<?php
$baseurl = '/'.$GLOBALS['config']['preview_directory'].'/'.URI_DIRECTORY.'/'.$app->getTemplate();

include($app->getPreviewComponentPath().DS.'com_banners'.DS.'helper.php');
?>
<link href="<?php echo $baseurl;?>/css/products.css" type="text/css" rel="stylesheet"/>
<?php //echo getBanner(18); 
?>




<div class="flv">
	<div class="fleft190">
 		<?php
		$modules	=& ModuleHelper::getModules('left');
		foreach($modules as $item)
		{
			echo ModuleHelper::renderModule($item);
		}
		?>
	</div>
	<div class="fbig">


<div id="listroot">
<?php
$module	=& ModuleHelper::getModule('mod_breadcrumbs'); 
echo ModuleHelper::renderModule($module);
?>
<a name="filter" ></a>
</div>

<?php

$nav = &$this->lists['nav'];
//$item	=& ModuleHelper::getModule('mod_filter');
//echo ModuleHelper::renderModule($item);
$uri = &URI::getInstance();

$o = trim($_GET['o']);
if( $o == '' ){ $o = 't'; }
$s = $_GET['s'];
if( $s == '' ){ $s = 'b'; }



//产品过滤条件
$cat = &$this->lists['cat'];

if( $cat['type_id'] > 0 ){
	$sql = "select * from #__products_attribute where type_id=".$cat['type_id']." and attr_type > 0";
	//echo $sql;
	$db = &Factory::getDB();
	$db->query($sql);
	$rows = $db->getResult();
	
	if( count($rows)>0 ){
 	?>
		<div class="prosearch">
			<h2><?php echo $cat['name'];?> - 商品筛选</h2>

			<ul id="proslab">
				<?php
				foreach( $rows as $k=>$v ){
					$values = explode("\n",trim($v['attr_values']));

					$f_key = 'f_'.$v['attr_id'];//键值
					$f = trim($_GET[$f_key]);
					?>
					<li>
						<span class="slab"><?php echo $v['attr_name'];?>：</span>
						<p class="showlk">
						<a href="<?php echo $uri->getByURL(array($f_key=>''));?>" <?php if( $f == '' ){ echo ' class="now" '; }?> >全部</a>  |
						<?php
						foreach( $values as $val ){
							$val = explode(':', $val );
						?>
							<a href="<?php echo $uri->getByURL(array($f_key=>$val[0]));?>" <?php if( $f == $val[0] ){ echo ' class="now" '; }?> >
							<?php echo $val[1]; ?>
							</a>
						<?php
						}
						?>
						</p>
					</li>
					<?php
				}
				?>
			</ul>
			<div class="clear" ></div>
		</div>
	<?php
	}
}





$sorts = array('s'=>'销量','t'=>'时间','p'=>'价格' );


//select sorts
$select_sorts = array(
	array('t'=>'默认排序',
		  'o'=>'',
		  's'=>'',
	),
	array('t'=>'按销量从低到高',
		  'o'=>'s',
		  's'=>'a',
	),
	array('t'=>'按销量从高到低',
		  'o'=>'s',
		  's'=>'d',
	),
	array('t'=>'按上架时间排序',
		  'o'=>'t',
		  's'=>'a',
	),
	array('t'=>'按价格排序',
		  'o'=>'p',
		  's'=>'a',
	),
);
?>


<div id="pdshow">
	<div id="topage">

			<?php
			$end=$nav->totalPage;
			?>
			<?php /**当前第<?php echo $nav->currentPage;?>页/共<?php echo $nav->totalPage;?>页&nbsp;&nbsp; **/?>

			<?php
			//上一页
			if($nav->currentPage>1){
				echo '<a href="'.$nav->buildLink($nav->currentPage-1).'" >上一页</a>';
			}else{
				echo '<span >上一页</span>';
			}

			if( $nav->currentPage < $end ){
				echo '<a href="'.$nav->buildLink($nav->currentPage+1).'" >下一页</a>';
			}else{
				echo '<span >下一页</span>';
			}

			?>
	</div>
			<div id="plsots">
			排序方式：

			<?php
			foreach( $sorts as $k=> $v ){

				if( $o == $k ){
					if( $s == 'a' ){ $s2 = 'b';$c = 'psot_htop'; }else{ $s2 = 'a'; $c = 'psot_hbtm';}
			?>
				<a href="<?php echo $uri->getByURL(array('o'=>$k,'s'=>$s2));?>" class="<?php echo $c; ?>" >
				<?php echo $v; ?>
				</a>

			<?php }else{ ?>
				<a href="<?php echo $uri->getByURL(array('o'=>$k,'s'=>'a'));?>" class=" psot" >
				<?php echo $v; ?>
				</a>

			<?php
				}
			}

			?>
			<select onchange="location.href= this.value; " >
			<?php
			foreach( $select_sorts as $k=>$v ){ 
				?>
				<option value="<?php echo $uri->getByURL(array('o'=>$v['o'],'s'=>$v['s']));?>" <?php
					if( $v['o'] == $o && $v['s'] == $s ){ echo ' selected '; } ?> >
				<?php echo $v['t'];?>
				</option>
				<?php
			}
			?>
			</select>
			</div>
		</div>


		<?php

			$rows = &$this->lists['rows'];
			$i=0;
			foreach( $rows as $row )
			{
				$link = Router::_( ProductsHelperRoute::getProductRoute($row['id'],$row['catid']) );
				echo '<dl class="pdlbox">';
				echo '<dt class="good-img"><a href="'.$link.'" title="点击查看"><img src="'.$row['thumbnail'].'" alt="" width="130"/></a></dt>';
				echo '<dt class="good-name"><a href="'.$link.'" title="'.$row['name'].'">'.String::substr($row['name'],0,40).'</a></dt>';
				//echo '<dd class="good-market-price">市场价：<s>'.$row['market_price'].'</s></dd>';
				echo '<dd class="good-price"> <span class="price" >'.Utility::price_format($row['shop_price']).'</span></dd>';
				echo '<dd class="good-btn"><a href="'.$link.'"  class="probuy">购买</a> <a href="javascript:void(0)" onclick="dblist('.$row['id'].',event,\''.$row['name'].'\',\''.$row['thumbnail'].'\','.$row['catid'].');" class="produ">对比</a> <a href="javascript:addFav('.$row['id'].')" class="proshw">收藏</a></dd>';
				echo '</dl>';
			}
			echo $nav->showFilePage2();
		?>


	</div>


</div>

<script type="text/javascript" src="<?php echo $baseurl;?>/js/pk.js"></script>