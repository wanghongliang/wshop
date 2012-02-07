<?php
?>
<div class="ajax_succ">
	退款信息保存成功！
	<div class="ajax_succ_re" >
		正在关闭窗口
	</div>
</div>
<script language="javascript" >
try{

setTimeout(function(){ parent.$.w.closeN(3); },500);
parent.setPay();
}catch(e){
	alert(e);
}
</script>
