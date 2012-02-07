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
	第一关，请填写网站主菜单信息
	<br/>
	<span class="fs" >
		这里有默认的标准菜单，你可以修改或添加对应的菜单.
	</span>
</div>

<form action="index.php?com=boot&task=step2" method="post"  name="step" >

<div class="boot_steps_body" >
以下是初始化的主导航菜单：
<ul>
	<?php
	//配置菜单信息
	if( is_array($menu) )
	{
		foreach( $menu as $m )
		{
			?>
			
			<li>
				<input type="text" name="menu[]" value="<?php echo $m['name'];?>" />
			</li>

			<?php
		}
	}
	?>
</ul>
</div>

	<div class="boot_btn" >

		<div class="boot_start" >
			<a href="javascript:document.step.submit();" >
				确认，下一步
			</a>
		</div>
	</div>

</form>


</div>