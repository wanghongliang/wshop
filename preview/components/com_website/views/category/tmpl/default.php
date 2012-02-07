<div class="mod search_nav" >
	<dl>
		<dt>
			<span>在当前分类中查找</span>
		</dt>
		<dd>
			<ul>
				<li>
					<ul >
						<li class="t" >按地区显示</li>
						<li><a href="#" >广东省</a></li>
						<li><a href="#" >浙江省</a></li>
							<li><a href="#" >江苏省</a></li>
 					</ul>
				</li>

				<li class="lb" >
					<ul>
						<li class="t" >经营性质</li>
						<li><a href="#" >生产商</a></li>
						<li><a href="#" >贸易商</a></li>
						<li><a href="#" >服务和其它</a></li>
					</ul>
				</li>

				<li  class="lb"  >
					<ul >
						<li class="t" >只显示</li>
						<li><a href="#" >商务会员</a></li>
						<li><a href="#" >企业认证</a></li>
						<li><a href="#" >报价产品</a></li>
						<li><a href="#" >最新产品</a></li>
					</ul>
				</li>

			</ul>
			<div class="clr" ></div>
		</dd>
	</dl>
</div>

<div  class="mod db-mt5"  >
	<dl>
		<dt>
		　
 			
			共有
			<?php
			echo $this->lists['nav']->totalFile;
 			?>
		
			个产品于类别 	<strong><?php echo $this->lists['cat']['name'];?></strong>  
			中
 		</dt>
		<dd>

		<div class="product_tool" >
			<span class="select_all" ><input type="checkbox" /></span>
			<span class="db-fl" >全选</span>

			 <input type="button" value="将选中的产品加入询盘篮" /> 
		</div>

		<?
		$style=1;

		if( $style==1 )
		{
		?>

  			<ul>
			<?php
			$rows = &$this->lists['rows'];

			$i=0;
			foreach( $rows as $row )
			{

				echo '<li class="list_p" >';  
 				$imgs = explode(',',$row['images']);
				if( $imgs[0] ){
					$img = $imgs[0];
				}else{
					$img = $row['thumbnail'];
				}
				
				$link = Router::_( ProductsHelperRoute::getProductRoute($row['id'],$row['catid']) );
				?>
					<?php 
					/**<a href="<?php echo Router::_( ProductsHelperRoute::getProductRoute($row['id'],$row['menuid']) );?>" >
					**/?>
					
					 <span class="product_select" >
					 <input type="checkbox" />
					 </span>

					 <span class="product_left_info" >
						 <span class="thumbnail" >
							

							 <a  class="lightsGal" href="<?php echo $link;?>" title="<?php echo $row['title'];?>" target=_blank > 
								<img src="<?php echo $row['thumbnail'];?>" width=100 height=100  border=0 alt="<?php echo $row['title'];?>"  />
							 </a>

			
						
						 </span> 				 
						 <span class="product_relative" >
								<a href="<?php echo $app->buildMemberLink($row['uname']); ?>/products/category/<?php echo $row['catid'];?>" target=_blank >
								<?php echo $row['num'];?>条符合信息
							  </a>
						</span>
					</span>

					
					<span class="product_right_info" >

						<a  class="lightsGal" href="<?php echo $link;?>" title="<?php echo $row['title'];?>" target=_blank > 
						<strong><?php echo $row['title'];?></strong>
						</a> 
						
						<div class="product_introtext" ><?php echo String::substr($row['introtext'],0,100);?>..</div>
						<div>
							<a href="<?php echo $app->buildMemberLink($row['uname']); ?>" title="<?php echo $row['company'];?>" target=_blank >
								<u><?php echo $row['company'];?></u>
							</a>
						</div>
					</span>

					</li>
					<?php 
					/**
					</a>
					**/
					?>
				<?php
				echo '</li>';
			}
			?>

			</ul>
 		<?php
		}else{
		?>

			<table width=100% class="isfront" >
 			<tr>
			<?php
			$rows = &$this->lists['rows'];

			$i=0;
			foreach( $rows as $row )
			{
				if( $i++ % 4 == 0 && $i>1 ){ echo '</tr><tr>'; }
				echo '<td>';
				$imgs = explode(',',$row['images']);
				if( $imgs[0] ){
					$img = $imgs[0];
				}else{
					$img = $row['thumbnail'];
				}

				?>
					<?php 
					/**<a href="<?php echo Router::_( ProductsHelperRoute::getProductRoute($row['id'],$row['menuid']) );?>" >
					**/?>
					<?php		
					
				
					echo '<div><a  class="lightsGal" href="'.$img.'" title="'.$row['title'].'"  >';
					echo '<img src="'.$row['thumbnail'].'" width=120 height=120  border=0 />';
					echo '</a></div>';


					echo $row['title'];
					?>
					<?php 
					/**
					</a>
					**/
					?>
				<?php
				echo '</td>';
			}
			?>
			</tr>

			</table>
		<?php
		}
		?>

		<div >
			<?php
			echo $this->lists['nav']->showFilePage2();
			?>
		</div>

		<div class="clr" ></div>

 		</dd>
	</dl>
</div>