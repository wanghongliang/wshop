<?php

 ?>


<?php
	//�����Ǹ��������ã����ں������ı���ֵʱ���ᷢ������!!!!!!!!!!!!!
	$menu = &$app->getMenu();
	//print_r($menu->menus);
 	$data = $menu->getMenus(1);
  	$menus = $menu->buidTree($data);

  ?>
<div class="nav" >
<span>
<span>

<ul>
 
		<?php
		if( is_array( $menus[0] ) ){
			foreach( $menus[0] as $m )
			{
				?>
				<li>
					<a href="<?php echo $m['link'];?>" ><?php echo $m['name'];?></a>

					<?php
					/**
					if( is_array( $nodes = $menus[$m['id']] ) ){
						echo '<ul>';
						foreach( $nodes as $node )
						{
							?>
							<li>
								<a href="<?php echo $node['link'];?>" ><?php echo $node['name'];?></a>
							</li>

							<?php
						}
						echo '</ul>';
					}
					**/
					?>
				
				</li>
				<li class="separation" ></li>
				<?php
			}
		}
		?>
		 
</ul>

</span>
</span>
</div>
 






