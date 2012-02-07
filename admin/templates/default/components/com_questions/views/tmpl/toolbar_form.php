<?php

?>


<div class="toolbar" >

	<ul class="com_ com_contents" >	 
	<li class='active_li'  > 
	<?php 
	if( $item['attr_id'] > 0 ){
	?>
	编辑问答信息
	<?php }else{ ?>
	添加问答信息
	<?php } ?>
	 </li> 
 
	</ul>
 <div class="clr" ></div>	
<div class="tackle" >
	<ul class="tools">
	<li  class="createbtn btn_add" > 
			<a href="<?php echo $this->baseuri;?>" > 取消 </a>

	</li>

</ul>
<div class="clr"></div>
</div>
</div>



 