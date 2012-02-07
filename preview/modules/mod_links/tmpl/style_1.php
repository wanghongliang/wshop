<?php
/**
 * 此样式是由FLASH切换
 */
?>
<div  class="mod mod_link"     >
	<div class="doc2" >

	<dl>
		<dt>
 
			<?php
				echo $module->title;
 			?>
				 
		</dt>
		<dd>
			<?php 
 			foreach($list as $item ){
				$link = $item['url'];
				?>
				<a href="<?php echo $link;?>" target=_blank >
					<?php 
					echo $item['name'];
					?>
				</a>
				<?php
			 }
			 ?> 
			 
 		</dd>
	</dl>
	</div>
</div>
 