<div  class="mod <?php echo $params['moduleclass_sfx'];?>" id="<?php echo $module->module,'-',$module->id;?>" >
	<dl>
		<dt>
			<span>
 						<?php
						if( $params['titlelink'] ){
						?>
							<a href="<?php echo $params['titlelink'];?>" >	
							<?php
								echo $module->title;
							?>
							</a>
						<?php
						}else{
 							?>
							<span class="a" >
							<?php echo $module->title; ?>
							</span>
							
						<?php
						}
						?>
 			</span>
		</dt>
		<dd>
			<?php
				echo $module->content;
 			?>
			 
 		</dd>
	</dl>
</div>