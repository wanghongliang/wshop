<?php

?> 
<ul class="com_ com_contents">
	<li class="active_li"  style="height:30px;" >
	区域信息
	</li>
</ul>


<script language="javascript" >
$(function(){
	$('.createbtn').click(function(){
		$.w.createDialog({title:'添加菜单',url:'index.php?com=area&task=selectcomtype&next=add&mtid=<?php echo $this->menutypeid;?>&no_html=1',isget:true},3);
	});
});
</script>