<?php
/**
 * 此样式是由FLASH切换
 */
?>
<div   class="mod mod_link"   >
	<div class="doc2" >

	<dl>
		<dt>
			<span>
				<span>
					<a href="#" >	
			<?php
				echo $module->title;
 			?>
					</a>
				</span>
			</span>
		</dt>
		<dd>
			<?php 
			global $app;
 
			//banner模块相关信息类
			$w = $params['width'];
			$h = $params['height'];
		  
			$w = $w?$w:'960';
			$h = $h?$h:'160';
			//图片总数量
			$num =count($list);
			
		  
			$i=0;
			foreach($list as $item ){
				$link = $item['url'];
				?>
				<?php /***<a href="<?php echo $link;?>" target=_blank >***/?>
				<img src="
					<?php 
					echo $item['img'];
					?>" border=0 width="<?php echo $w;?>" height="<?php echo $h;?>" />
				<?php /***</a>***/?>
				<?php
			 }
			 ?> 
			 
 		</dd>
	</dl>
	</div>
</div>
 