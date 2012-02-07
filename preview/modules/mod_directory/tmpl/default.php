<?php
global $app;
$menu = &$app->getMenu();
$active = $menu->getItem(6);
$menu->buildLink(&$active);

include($app->getMemberOptionPath());
//URI对象
$uri = &URI::getInstance();
//$link = $uri->buildLink(array());

$param = array(
	'area'=>$_REQUEST['area'],
	'topic'=>$_REQUEST['topic'],
	'color'=>$_REQUEST['color'],
);

//分类选择
$province = modDirectoryHelper::getProvince();

//print_r($province);
//print_r($active);

?>



 <div class="mod search_nav" >
 <div class="r"></div><div class="l" ></div>

 <div class="bod">
 					<ul >		
					<?php $catid=$_REQUEST['catid']; ?>
						<li  <?php if( $catid < 1 ){
								echo ' class="foucs" ';
							}?> ><a href="<?php echo $active['link'];?>">全部酷站</a></li>

						<?php
	
 						foreach( $province as $k=>$v ){
 							?>
							<li <?php if( $catid==$v['id'] ){
								echo ' class="foucs" ';
							}?> >
							
							<a href="<?php echo $menu->bLink( $v['alias'].'/list/'.$v['id'] );?>" >
							<?php echo $v['name'];?>
							<?php //echo $v['num'];?>
							</a>
							
							</li>
							<?php
						}
						?>						
						

 					</ul>
					<div class="clr" ></div>
</div>
							
			 
</div>