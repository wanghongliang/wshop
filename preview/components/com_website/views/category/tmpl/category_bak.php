<?php
$item	=& ModuleHelper::getModule('mod_filter');
echo ModuleHelper::renderModule($item);
$uri = &URI::getInstance();
?>
<div  class="mod site"  >
	<dl>
		<dt>
			<span>
				<span>


					<div class="sort" >
						<h2><strong>酷站排序：</strong></h3>

						<a href="<?php echo $uri->getByURL(array('by'=>'news','sort'=>'asc'));?>" <?php if($_GET['by']=='news' ){ echo 'class="act"'; }?> >最新排序</a>

						<a href="<?php echo $uri->getByURL(array('by'=>'star','sort'=>'asc'));?>" <?php if($_GET['by']=='star' ){ echo 'class="act"'; }?> >按星级排序</a>
	 
						<a href="<?php echo $uri->getByURL(array('by'=>'hits','sort'=>'asc'));?>" <?php if($_GET['by']=='hits' ){ echo 'class="act"'; }?> >按点击量排序</a>

						<a href="<?php echo $uri->getByURL(array('by'=>'favs','sort'=>'asc'));?>" <?php if($_GET['by']=='favs' ){ echo 'class="act"'; }?> >按热门收藏</a>
					</div>
				</span>
			</span>
		</dt>
		<dd>
   			<ul  class="site_list" >
 			<?php
			$rows = &$this->lists['rows'];
			$i=1;
			foreach( $rows as $row )
			{

 				echo '<li class="bg';
				if( $i++%4==0 && $i>1  ){
					echo 'last';
				}
				echo '" >';

 				$imgs = explode(',',$row['images']);
				if( $imgs[0] ){
					$img = $imgs[0];
				}else{
					$img = $row['thumbnail'];
				}

 				$link = Router::_( WebsiteHelperRoute::getGoRoute($row['id'],$row['catid']) );
				?>
				<div class="cb" >
			     <a href="<?php echo $link; ?>" title="<?php echo $row['name'];?>" target=_blank  >
				   <img src="<?php echo $img;?>" width=162  height=122 />
			     </a>  

				
				 <div class="opt" >
				 <?php echo $row['uid']; ?>/<a href="<?php echo Router::_( WebsiteHelperRoute::getRoute($row['id'],$row['catid']) ); ?>" title="<?php echo $row['name'];?>" target=_blank  >点评</a>/<a href="javascript:addFav('<?php echo  $row['id']; ?>')"    >收藏</a>/<a href="javascript:sendError('<?php echo  $row['id']; ?>');"  >报错</a>
				 </div>
				 <div class="name" >
				 <a href="<?php echo $link; ?>" title="<?php echo $row['name'];?>" target=_blank   >
				 <?php echo String::substr($row['name'],0,10);?>
				 </a>
				 </div>
				 

				 <div class="cs" >
					<div class="hit" >
						<strong>Hit</strong>:<?php echo $row['hits'];?>
					</div>
					<div class="star" >
						<?php
						$star = $row['star'];
						if( $star < 1 ){
							$star = 3;
						}
						
						if( strlen($star)>1 ){
							$star = substr($star,0,1). '-';
						}


						?>
						<div class="st_<?php echo $star;?>" ></div>
					</div>
				 </div>
 				</div>
				<?php
				echo '</li>';
			}
			?>

			</ul>
			
			<div >
			<?php
			echo $this->lists['nav']->showFilePage2();
			?>
			</div>

			<div class="clr" ></div>
 		</dd>
	</dl>
</div>





<?php
	$db= &Factory::getDB();
	$sql = "select id,name,thumbnail,catid from #__website  order by star desc limit 20";
	$db->query($sql);
	$rows=$db->getResult();

	$db= &Factory::getDB();
	$sql = "select id,name,thumbnail,catid from #__website order by hits desc limit 20";
	$db->query($sql);
	$hits=$db->getResult();

	$db= &Factory::getDB();
	$sql = "select id,name,thumbnail,catid from #__website order by favs desc limit 20";
	$db->query($sql);
	$favs=$db->getResult();

?>
<div class="lastright" >
	
	<div class="searchform" >
		<form action="/index.php?com=website&view=search" id="searchform" method="post" >
			<input type="text" name="key" value="" size=40 class="itext" onfocus="this.value=''" />
			<input type="submit"   class="ibtn"   value="搜索酷站" />

		</form>
	</div>

	<div class="clr" ></div>
	<div class="paragraph" >
		<div class="paratitle" >
			<ul>
				<li class="first" ><div class="text" >星级酷站</div></li>
				<li><div class="text" >热点酷站</div> </li>
				<li><div class="text" >热门收藏</div></li>
			</ul>
		</div>
		<div class="parabody" >
 			<ul>
				<li  class="se first" >
					<ul>
					<?php
					//print_r($rows);
 					foreach( $rows as $row ){
						$link = Router::_( WebsiteHelperRoute::getRoute($row['id'],$row['catid']) );

						?>
						<li class="half" >
						<?php/**
					      <a href="<?php echo $link; ?>" title="<?php echo $row['name'];?>" target=_blank  >
							<img src="<?php echo $row['thumbnail'];?>" width=80  height=60 />
						  </a>
						**/?>
						  <div>
						  <a href="<?php echo $link; ?>" title="<?php echo $row['name'];?>" target=_blank  >
							<?php echo $row['name']; ?>
						  </a>
						  </div>
				
						</li>
						<?php 
					}
					?>
					</ul>
				</li>
				<li class="se" >
					<ul>
					<?php
					//print_r($rows);
 					foreach( $hits as $row ){
						$link = Router::_( WebsiteHelperRoute::getRoute($row['id'],$row['catid']) );

						?>
						<li class="half" >
						<?php/**
					      <a href="<?php echo $link; ?>" title="<?php echo $row['name'];?>" target=_blank  >
							<img src="<?php echo $row['thumbnail'];?>" width=80  height=60 />
						  </a>
						**/?>
						  <div>
						  <a href="<?php echo $link; ?>" title="<?php echo $row['name'];?>" target=_blank  >
							<?php echo $row['name']; ?>
						  </a>
						  </div>
				
						</li>
						<?php 
					}
					?>
					</ul>

				</li>
				<li class="se" >
					<ul>
					<?php
					//print_r($rows);
 					foreach( $favs as $row ){
						$link = Router::_( WebsiteHelperRoute::getRoute($row['id'],$row['catid']) );

						?>
						<li class="half" >
						<?php/**
					      <a href="<?php echo $link; ?>" title="<?php echo $row['name'];?>" target=_blank  >
							<img src="<?php echo $row['thumbnail'];?>" width=80  height=60 />
						  </a>
						**/?>
						  <div>
						  <a href="<?php echo $link; ?>" title="<?php echo $row['name'];?>" target=_blank  >
							<?php echo $row['name']; ?>
						  </a>
						  </div>
				
						</li>
						<?php 
					}
					?>
					</ul>				
				
				</li>
			</ul>
			<div class="clr" ></div>
		</div>
	</div>
    <div class="clr" ></div>



<?php
	$db= &Factory::getDB();
	$sql = "select id,username,photo,favorites_num,hits from #__users order by id desc limit 6 ";
	$db->query($sql);
	$rows=$db->getResult();
	$ids =  array();
	foreach( $rows as $row ){
		$ids[]=$row['id'];
	}

	$sql = "select count(id) as num , uid from #__website where uid in (".implode(',',$ids).")  group by uid ";
	$db->query($sql);
	$results = $db->getResult('uid');
?>
	<div class="paragraph" >
		<div class="paratitle" >
			<ul>
				<li class="first" ><div class="text" >发布排行</div></li>
				<li><div class="text" >最新加入</div> </li>
				<li><div class="text" >活跃排行</div></li>
			</ul>
		</div>
		<div class="parabody" >
			<ul>
				<li  class="se first" >
					<ul>
					<?php
					//print_r($rows);
 					foreach( $rows as $row ){
						$link = $app->buildMemberLink( $row['username'] ); 
						?>
						<li class="all" >
							<div class="db-fl" >
								<a href="<?php echo $link;?>" target=_blank >
									<img src="<?php if( $row['photo'] != '' ){ echo $row['photo']; }else{ ?>/china/templates/system/images/photo2.jpg<?php }?>" width=60  height=60 />
								</a>
							</div>
							<div class="uinfo" >
								<a href="<?php echo $link;?>"  target=_blank  >
								<?php echo $row['username']; ?>
								</a>
								<div>收藏：<?php echo $row['favorites_num'];?></div>
								<div>点击：<?php echo $row['hits'];?></div>
								<div>整理：<?php echo $results[$row['id']]['num'];?></div>
							</div>
						</li>
						<?php 
					}
					?>
					</ul>
				</li>
				<li class="se" >
					<ul>
					<?php
					//print_r($rows);
 					foreach( $rows as $row ){
						$link = $app->buildMemberLink( $row['username'] ); 
						?>
						<li class="all" >
							<div class="db-fl" >
								<a href="<?php echo $link;?>" target=_blank >
									<img src="<?php if( $row['photo'] != '' ){ echo $row['photo']; }else{ ?>/china/templates/system/images/photo2.jpg<?php }?>" width=60  height=60 />
								</a>
							</div>
							<div class="uinfo" >
								<a href="<?php echo $link;?>"  target=_blank  >
								<?php echo $row['username']; ?>
								</a>
								<div>收藏：<?php echo $row['favorites_num'];?></div>
								<div>点击：<?php echo $row['hits'];?></div>
 							</div>
						</li>
						<?php 
					}
					?>
					</ul>
				</li>
				<li class="se" >
					<ul>
					<?php
					//print_r($rows);
 					foreach( $rows as $row ){
						$link = $app->buildMemberLink( $row['username'] ); 
						?>
						<li class="all" >
							<div class="db-fl" >
								<a href="<?php echo $link;?>" target=_blank >
									<img src="<?php if( $row['photo'] != '' ){ echo $row['photo']; }else{ ?>/china/templates/system/images/photo2.jpg<?php }?>" width=60  height=60 />
								</a>
							</div>
							<div class="uinfo" >
								<a href="<?php echo $link;?>"  target=_blank  >
								<?php echo $row['username']; ?>
								</a>
								<div>收藏：<?php echo $row['favorites_num'];?></div>
								<div>点击：<?php echo $row['hits'];?></div>
 							</div>
						</li>
						<?php 
					}
					?>
					</ul>
				</li>
			</ul>
			<div class="clr" ></div>
		</div>
	</div>

</div>



<div class="clr" ></div>

<div class="publish" >
</div>