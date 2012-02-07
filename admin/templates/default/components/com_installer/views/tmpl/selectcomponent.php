<div class="selectmenutype"  >
	<ul>
	<?php
		foreach( $linkType as $k => $type )
		{
			switch($k){
				case 'menulink':
				?>
				<li><div class="root-node" >菜单别名</div></li>
				<?
					break;
				case 'url':
				?>
				<li><div class="root-node" >外部链接</div></li>
				<?
					break;
				case 'component':
				?>
				<li><div class="root-node" >请选择相应的组件布局</div>
					<ul class=""  >
						<?php

						//print_r($lists);
						foreach( $lists as $item )
						{
							?>
								<li>
									<div class="node" >
										<?php echo $item['name']; ?>
									</div>

									<?php echo $item['parameter']; ?>
								</li>
							<?php
						}

						?>
					</ul>
				</li>
				<?php
					break;
			}
		}
	?>
	</ul>
</div>