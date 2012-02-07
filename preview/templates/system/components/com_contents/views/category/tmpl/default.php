
<div  class="mod db-mt5"  >
	<dl>
		<dt>
			<span>
				<span>
					<a href="#" >内容列表</a>
				</span>
			</span>
		</dt>
		<dd>

		<ul>
 		<?php

		$rows = &$this->lists['rows'];
		foreach( $rows as $row )
		{
			?>
			<li>
			<a href="<?php echo Router::_( ContentsHelperRoute::getArticleRoute($row['id'],$row['menuid']) );?>" >
			<?php
			echo $row['title'];
			?>
			</a>
			</li>

			<?php
		}

		?>
		</ul>

 		</dd>
	</dl>
</div>