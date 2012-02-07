<?php

?>

<div class="toolbar" >

	<ul class="com_ com_contents" >	
 
	<li   class='active_li'  >  
		商品分类目录 
		<?php //echo count($this->rows); ?>
			<span id="num" ></span>
	 </li> 

	</ul>
<div class="clr" ></div>
 
<div class="tackle" >
	<ul class="tools">
		<li> 
			<a class="createbtn btn_add"   > 添加 </a>
		</li>
 

		<li  >
			<a href="javascript:href('<?php echo $this->baseuri;?>&task=unlock')"  class="btn_unlock"  >
			 解锁
			</a>
		</li>
		<li   >
			<a href="javascript:href('<?php echo $this->baseuri;?>&task=lock')"  class="btn_lock"  >
			 锁定
			</a>
		</li>

	</ul>
	<div class="clr"></div>
</div>
</div>


 

<script language="javascript" >
$(function(){
	$('.createbtn').click(function(){
		gotohref('index.php?com=category&task=add');	
	});
});
</script>