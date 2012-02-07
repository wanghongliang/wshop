<?php
$menu = &$app->getMenu();
$active = & $menu->getActive();
?>
<div  class="mod pages"  >
		<dl>

		
			<dt>
				<span>
				<h1>
					<?php echo $active['name']; ?>
				</h1>
				</span>
			</dt>
			<dd>
	 
	 
				<div class="db-p10" >
				<?php
					echo $this->item['content'];
				?>
				</div>
			</dd>
		</dl>
	</div>
</div>
