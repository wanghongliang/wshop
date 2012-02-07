<script type="text/JavaScript" src="templates/default/js/curvycorners.js"></script>
<script type="text/JavaScript">

  addEvent(window, 'load', initCorners);

  function initCorners() {
    var settings = {
      tl: { radius: 10 },
      tr: { radius: 10 },
      bl: { radius: 0 },
      br: { radius: 0 },
      antiAlias: true
    }
 
	curvyCorners(settings, ".com_boot_f");

  }

</script>
<div class="com_boot_f" >


<div class="boot_t" >
	第三关，请添加商品信息
	<br/>
	<span class="fs" >
		这里需要上传一个 宽 120px  高 120px 的商品图片,及添加相对应的商品名称及描述信息.
	</span>
</div>

<form action="index.php?com=boot&task=step3" method="post"  name="step" >

<div class="boot_steps_body" >
 祝贺，你已成功配置所有基本信息，系统正在导入数据请稍后.
</div>

<div class="boot_import" >
<?php
//导入提示
?>
	<ul>
		<li>导入菜单分类信息成功.</li>
		<li>导入菜单信息成功.</li>
		<li>导入基本模块信息成功.</li>
		<li>导入商品信息成功.</li>
		<li>配置信息完成.</li>
	</ul>
</div>

	<div class="boot_btn" >
		<div class="boot_start" >
			<a href="javascript:document.step.submit();" >
				确认 
			</a>
		</div>
	</div>


</form>

<script language="javascript" >
$(function(){
	/** 开始用AJAX导入 **/
	var uri="index.php?com=boot&task=import&no_html=1";
	$.get(uri,function(data){
		alert(data);
	});
});
</script>

</div>