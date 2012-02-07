
<div  class="mod db-mt5"  >
	<dl>
		<dt>
			<span>
				<span>
					<a href="#" >产品列表</a>
				</span>
			</span>
		</dt>
		<dd>

		<table width=100% class="isfront" >
		
		<tr>
		<?php
		$rows = &$this->lists['rows'];

		$i=0;
		foreach( $rows as $row )
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

		<div >
			<?php
			echo $this->lists['nav']->showFilePage2();
			?>
		</div>

		<br class="clr" />
 		</dd>
	</dl>
</div>