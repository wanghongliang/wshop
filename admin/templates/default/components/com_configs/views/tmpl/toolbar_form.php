<?php

?>
<div class="toolbar" >

<ul class="com_ com_contents" >
	
	<li class="active_li">
	配置信息管理
	</li>
	
</ul>
<div class="clr" ></div>
<div class="filter" >
	小提示：本栏目是针对网站首页的默认SEO的设置.
</div>
<ul class="tools">	
 
 	<li > 
	<div  class="db-pl15" >
		<a href="#" class="submit_btn btn_save"  >
		保存
		</a>
	</div>
	</li>
 

</ul>


</div>
<div class="clr"></DIV>

<div class="editor-tabs" >
	<ul class="switch_btn" >
		<li class="active" >商站基本设置</li>
		<?php
		foreach( $option as $v ){
			?>
			<li><?php echo $v['name'];?></li>
			<?php
		}
		?>
	</ul>
</div>