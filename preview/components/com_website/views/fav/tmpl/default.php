
<div  class="db-mt5"  >
	<dl>
		<dt>
 

		</dt>
		<dd>
			<?php
			switch($this->status){
				case 1:
					?>
					收藏成功！
					<?php
					break;
				case 2:
					?>
					您已经收藏过！
					<?php
					break;
				default:
					?>
					用户没有登陆！
					<?php
			}
			?>


			<div class="clr" ></div>
 		</dd>
	</dl>
</div>