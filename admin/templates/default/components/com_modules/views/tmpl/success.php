<H1>
	保存成功!

	<?php $module = $this->_models['module'];?>
</H1>
<script language="javascript" >

	<?php
	/** 前台可视化保存时的脚本 **/
	
	?>
	if( window.parent )
	{
		if( parent.saveM )
		{	var json ={'id':'<?php echo $module->item['id'];?>','title':'<?php echo $module->item['title'];?>','position':'<?php echo $module->item['position'];?>','module':'<?php echo $module->item['module'];?>'};
			parent.saveM(json);
		}

	}
	try{
		setTimeout(function(){ parent.$.w.closeDialog(); },300);
		
	}catch(e){ alert(e); }
</script>