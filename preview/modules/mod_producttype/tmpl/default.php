<?php

$menu = &$app->getMenu();
$result = $menu->getCategory(0);
 ?>
<div  class="mod <?php echo $params['moduleclass_sfx'];?>"　   id="<?php echo $module->module,'-',$module->id;?>" >
	<dl>
		<dt>
			<span>
				<span>
					<a href="#" ><?php echo $module->title;?></a>
				</span>
			</span>
		</dt>
		<dd >

		<ul class="ptype"  >
			<li>
		<?php
		$i=0;	//父和子的标识
		$br = 0;

		$bg = 0;

		foreach( $result as $row )
		{
			if( $row['parent_id'] == 0 ){
				if( $br++ % 3 == 0){
					$css =  'br';
					$bg = 1-$bg;
				}else{
					$css =  'bd';
				}

				if( $bg == 0){ $css .= " bg"; }

				if( $i > 0 ){
					echo '</li><li class="'.$css.'" >';
				}
				$i=1;

				echo '<div class="pcat" ><a href="'.$menu->bLink($row['route']).'" >';
				echo $row['name'];
				echo '</a></div>';
				//echo '</li>';
			}else if( $i++<8 ){
				//echo '<li>';
				if( $i>2 ){ echo '|'; }
				echo '<a href="'.$menu->bLink($row['route']).'"  class="sub" >';
				echo $row['name'];
				echo '</a>';
				//echo '</li>';
			}
		}
		?>
			</li>
		</ul>

		<div class="clr" ></div>
  		</dd>
	</dl>
</div>