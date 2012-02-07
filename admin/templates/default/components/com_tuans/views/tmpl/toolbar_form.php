 

 <ul class="com_ com_contents">
	<li <?php if( $_GET['task'] == 'accessories' ){ echo ' class="normal_li" '; }else{ echo ' class="active_li" '; } ?> onclick=""  > 
		
				<?php 
				if( $_GET['id'] > 0 ){
				?>
 					编辑团购信息
 				<?php }else{ ?>
 				添加团购信息
  				<?php } ?>
		
	</li>
</ul>
<div class="clr" ></div>
 
<div class="tackle" >

<ul class="tools tool_border"	>	

 	<li    > 
		<a  class="submit_btn btn_save"  >
		保存
		</a>
	</li>	
	<li    > 
		<a  class="apply_btn btn_apply"  >
		 应用
		</a>
	</li>
	
	<li    > 
		<a  class="cancel_btn btn_cancel"  >
		取消
		</a>
	</li>
</ul>
	<div class="clr" ></div>
</div>