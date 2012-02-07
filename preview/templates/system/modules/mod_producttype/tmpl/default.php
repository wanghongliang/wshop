<div  class="mod db-mt5"  >
	<dl>
		<dt>
			<span>
				<span>
					<a href="#" >产品分类</a>
				</span>
			</span>
		</dt>
		<dd>

		<ul>
		<?php
		$i=0;
		foreach( $list as $row )
		{
 			echo '<li>';
			echo '<a href="'.$row['link'].'" >';
			echo $row['name'];
			echo '</a>';
			echo '</li>';
		}
		?>
		</ul>
 		</dd>
	</dl>
</div>