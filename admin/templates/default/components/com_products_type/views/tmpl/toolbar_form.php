<?php

?>


<div class="toolbar" >

	<ul class="com_ com_contents" >	
 
				<li   class='active_li'  > 
 									<?php 
				if( $item['id'] > 0 ){
				?>
				编辑商品类型 
				<?php }else{ ?>
				添加商品类型 
				<?php } ?>
 				 </li> 
 
	</ul>
 
	<ul class="tools">
	<li  class="createbtn btn_add" > 
			<a href="<?php echo $this->baseuri;?>" > 取消 </a>

	</li>

</ul>
</div>



 