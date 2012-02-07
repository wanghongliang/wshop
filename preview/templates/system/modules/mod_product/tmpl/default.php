<div  class="mod db-mt5"  >
	<dl>
		<dt>
			<span>
				<span>
					<a href="#" >推荐产品</a>
				</span>
			</span>
		</dt>
		<dd>

		<table class="isfront" >
		
		<tr>
		<?php
		$i=0;
		foreach( $list as $row )
		{
			if( $i++ % 4 == 0 && $i>1 ){ echo '</tr><tr>'; }
			echo '<td>';
	
			?>
				<a href="<?php echo Router::_( ProductsHelperRoute::getProductRoute($row['id'],$row['menuid']) );?>" >
				<?php		
				
			
				echo '<div>';
				echo '<img src="'.$row['thumbnail'].'" width=120 height=120  />';
				echo '</div>';


				echo $row['title'];
				?>
				</a>
			<?php
			echo '</td>';
		}
		?>
		</tr>

		</table>
 		</dd>
	</dl>
</div>