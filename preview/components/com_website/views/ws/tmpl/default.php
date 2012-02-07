<?php
$lists = $this->get('post');
$nav = $lists['nav'];
$posts = $lists['rows'];
?>
 


<div class="path" >
	<a href="/" >首页</a>
	>
	<a href="/" >酷站欣赏</a>
	> 
	<a href="#" >酷站分析点评</a>	
</div>

<div class="web_review" >
	<div class="website_img" >
		<div class="cont"><div class="cont2"><div class="cont3">
		<div class="cont_tr" ></div><div class="cont_tl" ></div> <div class="clr" ></div>
		<div class="content_body" >
			<div class="img" >
			<img src="<?php echo $this->item['thumbnail']; ?>" width=162 height=122 />
			</div>
			<div align=center >
			<a href="<?php echo $this->item['http'];?>" target=_blank  >
				进入该网站
			</a>
			</div>
		</div><div class="clr" ></div>
		<div class="cont_br" ></div><div class="cont_bl" ></div><div class="clr" ></div>
		</div></div></div>
	</div>

	<div class="web_info" >

		<?php
		//分类
		$menu = &$app->getMenu();
		$cat  = $menu->getCategoryItem($this->item['catid']);
		
		//区域
		$area = $areas[$this->item['areaid']];

		//主题
		$topic = $topics[$this->item['topicid']];

		$colorid = $this->item['colorid'];
		foreach( $colors as $color ){
			if( $colorid == $color['id'] ){
				break;
			}
		}
		//颜色
		//$color = $colors[$this->item['colorid']];

		?>
		网站名称： <?php echo $this->item['name']; ?>
		<br/>
		更新时间： <?php echo $this->item['modified']; ?>
		<br/>
		所属分类： <?php if( is_array($cat) ){ echo $cat['name']; }else{ echo '暂无'; } ?>
		<br/>
		所属区域：  <?php if( $area ){ echo $area; }else{ echo '暂无'; } ?>
		<br/>
		所属主题：  <?php if( $topic ){ echo $topic; }else{ echo '暂无'; } ?>
		<br/>
		所属色系：  <?php if( $color ){ echo $color['text']; }else{ echo '暂无'; } ?>
		<br/>

		相关标签：  暂无


	</div>

	<div class="star_info">
		<?php
		$lev = (int)$this->item['star'];

		if( $lev > 1 ){
		if( strpos($this->item['star'],'.')!==false ){
			$lev .='-';
		}?>
		
			<div class="star_<?php echo $lev;?>" >	
			</div>
		<div  class="star_v" >
			<?php echo substr($this->item['star'],0,3);?>
		</div>
		分
		<div class="clr" ></div>

		<div >
		共有
		<?php echo $nav->totalFile; ?>
		位会员评分
		</div>	
		<?php
		}else{
		?>
		<div class="star_3" >	
		</div>
		<div class="clr" ></div>

		<div class="no_view" >
		暂无会员评价。 
		</div>
		<?php } ?>
		
		
		<a href="#post" >
		<div class="reviewbtn" ></div>
		</a>
	</div>




	<div class="clr" ></div>
	<div class="reviewlist" >
		<div class="review_t" >
			<div class="act" >
				酷站点评列表(<?php echo $nav->totalFile;?>)
			</div>
		</div>
		<div class="review_c" >
		<?
		
		if(count($posts) > 0 ){
			foreach( $posts as $post ){
				?>
				<div class="post" >
					<div class="u">
						<?php if( $post['photo'] ){ ?>
						<img src="<?php echo $post['photo'];?>" width=50 height=50 />
						<?php }else{ ?>
						<img src="/china/templates/system/images/photo2.jpg" width=50 height=50 />
						<?php } ?>
						
					</div>
					<div class="p" >
						<div class="uname" >
							<div class="db-fr">
								<?php echo substr($post['created'],0,10);?>&nbsp;
							</div>
							<a href="#" >

								<?php
								if( $post['username'] ){
									echo $post['username'];
								}else{
									?> 匿名 <?php
								}
								?>
							
							</a>
							
							
						</div>
						<div class="pcont">
						 <div class="" >
							<div class="st_<?php echo $post['star'];?>" ></div>
						 </div>

						<?php echo $post['content']; ?>
						</div>

					</div><div class="clr" ></div>
				</div>
				<?	
			}
		}else{
		?>
		<div align=center ><br/>暂无点评信息</div>
		<?php } ?>

		<div class="review_page">
		<?php echo $nav->showFilePage2();?>
		</div>
		<div class="clr" ></div>
		<a name="post"></a>
			
		</div>
	</div>


	<div class="review_form" >
		<div class="review_form_t" >
			网站点评 (*)为必填项
		</div>
		<div class="review_form_c" >
		<form action="<?php
		echo URI::current();?>" method="post" >
			评价打分:<span class="req" >(*)</span>
			
			<div class="wp">
				<ul class="box starRating">
				<li value="1" alt="很差" class="s1">1星</li>
				<li value="2" alt="差" class="s2">2星</li>
				<li value="3" alt="还行" class="s3">3星</li>
				<li value="4" alt="好" class="s4">4星</li>
				<li value="5" alt="很好" class="s5">5星</li>
				<li class="info">点击星星为网站打分</li>
				<li class="data">
				<input type="hidden" autocomplete="off" value="20"  id="$review_form_star">
				</li>
				</ul>
			</div>
			<br/>
			评价<span class="req" >(*)</span>:
			<br>
			<textarea cols=80 rows=8 name="content" ></textarea>
			<br>

			<?php
			if( $app->uid < 1 ){
				?>
				<div class="validate" >
				验证码：
				<input type="text" name="code" value="" size=8	 />
				<img valign="bottom" src="/index.php?com=feedbacks&task=securimage&no_html=1" id="validate">
				&nbsp;
				<span class="val_remark" >登陆后，不用输入验证码。</span>
				</div>
				<?php
			}
			?>
			<input type="hidden" name="website_id" value="<?php echo $this->item['id'];?>"  />
			<input type="hidden" name="star" value="" id="star" />
			<input type="hidden" name="task" value="saveview" />
			<input type="submit" value="提交点评" />
		</form>
		</div>
		
	</div>
</div>


<div class="web_rel" >
		<div class="cont"><div class="cont2"><div class="cont3"><div class="cont4">
		<div class="cont_tr" ></div><div class="cont_tl" ></div> <div class="clr" ></div>
		<div class="content_body" >
<?php
	require(dirname(PATH_COMPONENT).DS.'com_website'.DS.'helpers'.DS.'route.php');
	$db= &Factory::getDB();
	$sql = "select id,name,thumbnail,catid from #__website where thumbnail!='' order by id desc limit 3";
	$db->query($sql);
	$rows=$db->getResult();


	//最新点评的
	$db= &Factory::getDB();
	$sql = "select id,name,thumbnail,catid from #__website where thumbnail!='' order by postdate desc limit 3";
	$db->query($sql);
	$latestpost=$db->getResult();
?>	
		<div class="rel_t" >
			最新加入酷站
		</div>
		<div class="rel_b" >
 			<ul>
 					<?php
					//print_r($rows);
 					foreach( $rows as $row ){
						$link = Router::_( WebsiteHelperRoute::getRoute($row['id'],$row['catid']) );

						?>
						<li  >
						  <div>
						  <a href="<?php echo $link; ?>" title="<?php echo $row['name'];?>" target=_blank  >
							<?php echo $row['name']; ?>
						  </a>
						  </div>
										
					      <a href="<?php echo $link; ?>" title="<?php echo $row['name'];?>" target=_blank  >
							<img src="<?php echo $row['thumbnail'];?>" width=120 height=90 />
						  </a>
					

						</li>
						<?php 
					}
					?>
 			</ul>
			<div class="clr" ></div>
		</div>


		<br/>
		<div class="rel_t" >
			最新点评的网站
		</div>
		<div class="rel_b" >
 			<ul>
 					<?php
					//print_r($rows);
 					foreach( $latestpost as $row ){
						$link = Router::_( WebsiteHelperRoute::getRoute($row['id'],$row['catid']) );
						//print_r($row);
						?>
						<li  >
						  <div>
						  <a href="<?php echo $link; ?>" title="<?php echo $row['name'];?>" target=_blank  >
							<?php echo $row['name']; ?>
						  </a>
						  </div>
										
					      <a href="<?php echo $link; ?>" title="<?php echo $row['name'];?>" target=_blank  >
							<img src="<?php echo $row['thumbnail'];?>" width=120 height=90 />
						  </a>
					

						</li>
						<?php 
					}
					?>
 			</ul>
			<div class="clr" ></div>
		</div>




 		</div><div class="clr" ></div>
		<div class="cont_br" ></div><div class="cont_bl" ></div><div class="clr" ></div>
		</div></div></div></div>
</div>



<div class="clr" ></div>