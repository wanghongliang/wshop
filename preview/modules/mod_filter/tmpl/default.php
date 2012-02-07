<?php
global $app;
$menu = &$app->getMenu();
$active = $menu->getActive();
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

//省区域选择
$province = modFilterHelper::getProvince();

//print_r($province);
//print_r($active);

?>
 <div class="mod search_nav" >
	<dl>
		
		<dd>
			<ul>
				<li class="ct" >
					<div class="t" >行业分类</div>
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
							
							<a href="<?php echo $menu->bLink( $v['alias'] );?>" >
							<?php echo $v['name'];?>
							<?php //echo $v['num'];?>
							</a>
							
							</li>
							<?php
						}
						?>						
						

 					</ul>
						<div class="clr" ></div>	
				</li><li class="lb"  >
				<?php
				$c = $_REQUEST['area'];
				?>
				
				<div class="t" >国家分类</div>
					<ul>
						<li  <?php if( $c < 1 ){
								echo ' class="foucs" ';
							}?> >
							<?php 

							//全部酷站	
							$p = array_merge($param,array('area' => 0));
							?>
							<a href="<?php echo $uri->buildLink( $p );?>" >全部国家</a>
						</li>
 						<?php
 						foreach( $areas as $k=>$v ){
							$p = array_merge($param,array('area' => $k));
							?>
							<li <?php if( $c==$k ){
								echo ' class="foucs" ';
							}?> ><a href="<?php echo $uri->buildLink( $p );?>" ><?php echo $v;?></a></li>
							<?php
						}

						?>

					</ul>
					 <div class="clr" ></div>	
				</li>

				<li class="lt" >
					<?php 						
					$c = $_REQUEST['topic'];
					?>

					<div class="t" >专题分类</div>
					<ul >
						<li  <?php if( $c < 1 ){
								echo ' class="foucs" ';
							}?> >
							<?php 						//全部酷站	
							$p = array_merge($param,array('topic' => 0));
							?>
							<a href="<?php echo $uri->buildLink( $p );?>" >全部专题</a>
						</li>
 						<?php 						
 						foreach( $topics as $k=>$v ){
 							$p = array_merge($param,array('topic' => $k));
							?>
							<li  <?php if( $c==$k ){
								echo ' class="foucs" ';
							}?> ><a href="<?php echo $uri->buildLink( $p );?>" ><?php echo $v;?></a></li>
							<?php
						}
 						

						?>


					</ul><div class="clr" ></div>	
				</li>

				<li  class="last"  >
					<?php 						
					$c = $_REQUEST['color'];
					?>

					<div class="t" >颜色分类</div>
					<ul >	
						<li <?php if( $c < 1 ){
								echo ' class="foucs" ';
							}?> >
							<?php 						//全部酷站	
							$p = array_merge($param,array('color' => 0));
							?>
							<a class="caa" href="<?php echo $uri->buildLink( $p );?>" >全部</a>
						</li>
 						<?php 
 						foreach( $colors as $k=>$v ){
							$id = $v['id'];
 							$p = array_merge($param,array('color' => $id ));
							?>
							<li  <?php if( $c==$id ){
								echo ' class="foucs" ';
							}?> ><a href="<?php echo $uri->buildLink( $p );?>" CLASS="c<?php echo $k;?>" ><?php echo $v['text'];?></a></li>
							<?php
						}
						?>

					</ul><div class="clr" ></div>	
				</li>
			</ul>
			<div class="clr" ></div>
 
		</dd>
	</dl>
</div>