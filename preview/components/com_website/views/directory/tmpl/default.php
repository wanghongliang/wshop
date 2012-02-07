<?php
$uri = &URI::getInstance();
?>
		<div class="header" >
			<div   class="logo">
				<div class="logo_img">
				<a href="/">
					<img border="0" alt="优秀网站欣赏-ui58酷站欣赏" src="/preview/templates/ukehu/home-images/logo.jpg">
					<div class="logon">网站案例的分析，收藏，点评！</div>
				</a>
				</div>
				<br class="clr">
			</div>
			<?php
 			//导航条
			$menu = &$app->getMenu();
			$data = $menu->getMenus(1);
				$data = $menu->buidTree($data);
			$menus = $data[0];

			?>
			<div class="nav nbg" >
				<div class="nav-srh">
						<form action="/index.php?com=website&view=search" method="post" name="ssform">
					<div class="inp">
						<span><input type="text" value="" maxlength="60" size="22" title="" name="key" style="color: rgb(212, 212, 212);"></span>
					<span><input type="submit" value="搜索" class="bn-srh"></span>
					</div>
					</form>
				</div>
			<ul>
			<?php
			$n = count($menus)-1;
			$i=0;
			foreach( $menus as $item )
			{

			?>
				<li <?php if( $i++ == $n ) echo ' class="end" '; ?> >
				<a href="<?php echo $item['link'];?>" >
				<?php echo $item['name'];?>
				</a>
				
				</li>
			<?php
			}

			?>
			</ul>
			</div>
		</div>
		<div class="clr" ></div>

 
<?php
$item	=& ModuleHelper::getModule('mod_directory');
echo ModuleHelper::renderModule($item);
?>

<div class="lasted" >
	<div class="lt sort" >
	<h2><strong>酷站列表：</strong></h2>
 
						<a href="<?php echo $uri->getByURL(array('by'=>'news','sort'=>'asc'));?>" <?php if($_GET['by']=='news' || $_GET['by']==''){ echo 'class="act"'; }?> >最新排序</a>

						<a href="<?php echo $uri->getByURL(array('by'=>'star','sort'=>'asc'));?>" <?php if($_GET['by']=='star' ){ echo 'class="act"'; }?> >按星级排序</a>
	 
						<a href="<?php echo $uri->getByURL(array('by'=>'hits','sort'=>'asc'));?>" <?php if($_GET['by']=='hits' ){ echo 'class="act"'; }?> >按点击量排序</a>

						<a href="<?php echo $uri->getByURL(array('by'=>'favs','sort'=>'asc'));?>" <?php if($_GET['by']=='favs' ){ echo 'class="act"'; }?> >按热门收藏</a>
</div>


 	<div class="lastweb" >
   			<ul  class="site_list" >
 			<?php
			$rows = &$this->lists['rows'];
			$i=1;
			foreach( $rows as $row )
			{

 				echo '<li class="sli bg';
				if( $i++%5==0 && $i>1  ){
					echo 'last';
				}
				echo '" >';

 				$imgs = explode(',',$row['images']);
				if( $imgs[0] ){
					$img = $imgs[0];
				}else{
					$img = $row['thumbnail'];
				}

 				$link = Router::_( WebsiteHelperRoute::getRoute($row['id'],$row['catid']) );
				?>

			
				<div class="cb" >
			     <a href="<?php echo $link; ?>" title="<?php echo $row['name'];?>" target=_blank class="ai"  >
				   <img src="<?php echo $img;?>" width=162  height=122 alt="<?php echo trim(substr($row['http'],7),'/');?>" />
			     </a>  

				<?php /**
				 <div class="opt" >
					<a href="<?php echo $link;?>" target=_blank  >点评</a>/<a href="javascript:addFav('<?php echo  $row['id']; ?>')"    >收藏</a>/<a href="javascript:sendError('<?php echo  $row['id']; ?>');"  >报错</a>
				 </div>
				 **/ ?>
 
				 




 				</div>
				<div class="info" >
					<div class="fr"> >><a href="<?php echo $link;?>"  target=_blank > <u>详细/点评</u></a></div>


					<div class="cs" >
						<div class="hit" >
							名称：<?php echo $row['name'];?> 
							&nbsp;&nbsp;
						</div>
						<br>
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
						
						<strong>Hit</strong>:<?php echo $row['hits'];?>&nbsp;&nbsp;

					 </div>
 					网址：<a href="<?php echo $row['http'];?>" target=_blank ><?php echo $row['http'];?></a>
					<br>
					<?php echo $row['introtext'];?>
				</div>


				<?php
				echo '</li>';
			}
			?>

			</ul>
			
			<div >
			<?php
			echo $this->showFilePage2();
			?>
			</div>
		</div>
			<div class="clr" ></div>
 	 
</div>


<div class="lasttag" >
	<div class="t" >
	热门标签
	</div>
	<div class="bod" >
	<ul>
		<Li>
		<a href="#" >
		设计公司
		</a>
		</li>
	</ul>
	</div>
</div>

 


<?php
$db = &Factory::getDB();
//最近加入的会员
$sql =" select id,username,photo from #__users order by id desc";
$db->query($sql);
$results = $db->getResult();


?>
<div class="lastjoin" >
	<div class="t" >
	最新加入的会员..
	</div>
	<div class="bod" >
	<ul>
	<?php
	foreach( $results as $re ){
				$link = $app->buildMemberLink( $re['username'] ); 

		?>
		<li>
			<a href="<?php echo $link;?>" target=_blank >
			<?php if( $re['photo'] !='' ){?>
				<img src="<?php echo $re['photo'];?>" width=50 height=50 />
			<?php }else{ ?>
				<img src="/i/templates/system/images/photo2.jpg" width=48 height=48 class="bor"  />
			<?php } ?>
			 <br>
			<?php echo $re['username'];?>
			</a>
		</li>
		<?php
	}
	?>
	</ul><div class="clr" ></div>
	</div>
</div>



<div class="clr" ></div>
<div class="publish" >
</div>


 