<?php
$item	=& ModuleHelper::getModule('mod_filter');
echo ModuleHelper::renderModule($item);
$uri = &URI::getInstance();
?>
<div  class="mod site" style="width:100%;"  >
	<dl>
		<dt>
			<span>
				<span>

					<div class="db-fr" >
						<form action="/index.php?com=website&view=search" id="searchform" method="post" >
							<input type="text" name="key" value="<?php echo $_REQUEST['key'];?>" size=40 class="itext" onfocus="this.value=''" />
							<input type="submit"   class="ibtn"   value="搜索酷站" />

						</form>
					</div>
					<div class="sort" >
						<h2><strong>酷站搜索：</strong></h3>
 
						<a href="<?php echo $uri->getByURL(array('by'=>'news','sort'=>'asc'));?>" <?php if($_GET['by']=='news' || $_GET['by']==''){ echo 'class="act"'; }?> >最新排序</a>

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

 				$link = Router::_( WebsiteHelperRoute::getGoRoute($row['id'],$row['catid']) );
				?>
				<div class="cb" >
			     <a href="<?php echo $link; ?>" title="<?php echo $row['name'];?>" target=_blank class="ai"  >
				   <img src="<?php echo $img;?>" width=162  height=122 alt="<?php echo trim(substr($row['http'],7),'/');?>" />
			     </a>  

				
				 <div class="opt" >
				<a href="<?php echo Router::_( WebsiteHelperRoute::getWsRoute($row['id'],$row['catid']) ); ?>" title="<?php echo $row['name'];?>" target=_blank  >点评</a>/<a href="javascript:addFav('<?php echo  $row['id']; ?>')"    >收藏</a>/<a href="javascript:sendError('<?php echo  $row['id']; ?>');"  >报错</a>
				 </div>
				 <div class="name" >
				 <a href="<?php echo $link; ?>" title="<?php echo $row['name'];?>" target=_blank   >
				 <?php echo String::substr($row['name'],0,10);?>
				 </a>
				 </div>
				 

				 <div class="cs" >
					<div class="hit" >
						<strong>Hit</strong>:<?php echo $row['hits'];?>/<?php echo $row['uid']; ?>
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
			echo $this->showFilePage2();
			?>
			</div>

			<div class="clr" ></div>
 		</dd>
	</dl>
</div>
<div class="clr" ></div>
<div class="publish" >
</div>


 