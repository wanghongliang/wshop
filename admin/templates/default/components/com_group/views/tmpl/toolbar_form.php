<?php

?>
<div class="toolbar" >
	<ul class="com_ com_contents" >	
		<li class='active_li' >组管理</li>
	</ul>
	<div class="tackle" >
	<ul class="tools">

		<li     > 
			<a href="javascript:v();"   class="cancel_btn btn_cancel"  >
			取消
			</a>
		</li>
		<li   > 
			<a  href="javascript:v();" class="apply_btn btn_apply"  >
			 应用
			</a>
		</li>
		<li     > 
			<a href="javascript:v();" class="submit_btn btn_save"  >
			保存
			</a>
		</li>


	</ul>

	</div>


</div>

<script language="javascript" >
$(function(){
	$('.createbtn').click(function(){
		$.w.createDialog({title:'添加菜单',url:'index.php?com=group&task=selectcomtype&next=add&mtid=<?php echo $this->menutypeid;?>&no_html=1',isget:true},3);
	});
});
</script>