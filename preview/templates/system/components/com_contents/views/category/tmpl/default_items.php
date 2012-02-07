<div class="db-fs14 db-flh25" >
	<?php
	/**
	 * 以下为文章列表信息
	 */
	?>
 	<?php 

	//文章项目列表显示
	foreach ($this->items as $item) : ?>
			<div   >
				<span class="db-fr db-fc7EA" >			

					<?php if ($this->params->get('show_hits')) : ?>
					   点击：<?php echo $item->hits ? $item->hits : '-'; //点击次数　?>
					<?php endif; ?>

					<?php if ($this->params->get('show_date')) : ?>
						时间：<?php echo substr($item->created,5,5);　//时间 ?>&nbsp;&nbsp;
					<?php endif; ?>
				</span>

				<a href="<?php echo $item->link;?>" target=_blank >
					<?php echo $this->pagination->getRowOffset( $item->count );  //序号?>
					<strong><?php echo $item->title;?></strong>
				</a>
				<div class="article_description" >
					&nbsp;
					<?php 
					$text =	 trim( str_replace('&nbsp;','',strip_tags($item->text) ) ) ;

					if( strlen($text)>10 )
					{
						echo WString::substr($text,0,120);
					}else{
						echo '[图集]';
					}
					?>
					..	
					<Div>
					<a href="<?php echo $item->link;?>" target=_blank class="db-fc7EA" >
						【浏览全文】
					</a>
					</div>
				</div>
			
			</div>

	<?php endforeach; ?>
 	<?php 

	//分页导航信息
	if ($this->params->get('show_pagination')) : ?>
	　
			<?php echo $this->pagination->getPagesLinks(); ?>
　			<?php //echo $this->pagination->getPagesCounter(); ?>
　	<?php endif; ?>
  </div>