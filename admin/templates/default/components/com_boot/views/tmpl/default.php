<?php

?>

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
	欢迎进入天亿平台初始化之旅.
	<br/>
	<span class="fs" >
		在这里，你将体验添加基本信息的过程，及简单的配置，有助于你更快发布各种商品等信息.
	</span>
</div>


<div class="boot_steps" >
	<ul>
		<li>
			第一关，请填写网站主菜单
			<span >
				这里有默认的标准菜单，你可以修改或添加对应的菜单.
			</span>
		</li>


		<li>
			第二关，请添加商品信息
			<span >
				这里需要上传一个 宽 120px  高 120px 的商品图片,及添加相对应的商品名称及描述信息.
			</span>
		</li>


		<li>
			第三关, 请添加企业简介，及网站描述.
			<span>
				有助于SEO.
			</span>
		</li>

		<li>
			每四关，请添加对应的菜单内容.
			<span>
				这里可以省略过去，以后在后台管理中再添加。
			</span>
		</li>
	</ul>
</div>
	<div class="boot_btn" >
	<div class="boot_start" >
		<a href="index.php?com=boot&task=step1" >
			开始
		</a>
	</div>
	</div>

</div>