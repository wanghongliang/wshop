<?php

?>
<div class="toolbar" >

<ul class="com_ com_contents">
	<li class="active_li" >
	<?php 
	if( $item['id'] > 0 ){
	?>
	编辑文章信息
	<?php }else{ ?>
	添加文章信息
	<?php } ?>
	</li>
	<li   >
	<a href="index.php?com=contents<?php if( $_REQUEST['tmpl']!= '' ){ echo "&tmpl=".$_REQUEST['tmpl'];}?>&menuid=<?php echo $this->menuid;?>" >
	返回列表
	</a>
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
 
</div>	
<div class="editor-tabs" >
	<ul class="switch_btn" >
		<li class="active" >基本参数</li>
		<li>搜索引擎优化</li> 
	</ul>
</div>
