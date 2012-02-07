 
<div class="logo" >
	<?php
		if( $GLOBALS['config']['logo'] ){
	?>
		<div id="webtitle" >
			<a href="/" >
				<img src="<?php echo $GLOBALS['config']['logo'];?>" border=0 alt="<?php echo $GLOBALS['config']['title'];?>"  />
 			</a>
		</div>

	<?php	
		}else if( $params['logo'] )
		{
	?>
		<div id="webtitle" >
			<a href="/" >
				<img src="<?php echo $params['logo'];?>" border=0 alt="<?php echo $GLOBALS['config']['title'];?>"  />
 			</a>
		</div>

	<?php
		} 
 	?>
 
</div>

