<?php

?>

<div class="toolbar" >

	<ul class="com_ com_contents" >	
 
 
				<li   class='active_li'  > 
					<a name="#" >
						组管理
					</a>
				 </li> 
	 
	</ul>
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
</div>

</div>


 

<script language="javascript" >
$(function(){
	$('.createbtn').click(function(){
		gotohref('index.php?com=group&task=add');	
	});
});
</script>