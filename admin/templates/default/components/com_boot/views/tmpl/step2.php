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
		第二关，请添加商品信息
		<br/>
		<span class="fs" >
			这里需要上传一个 宽 120px  高 120px 的商品图片,及添加相对应的商品名称及描述信息.
		</span>
	</div>

	<form action="index.php?com=boot&task=step3" method="post"  name="step" enctype="multipart/form-data" >

	<div class="boot_steps_body" >
	以下是添加商品信息：
	<ul>
		<li>
			<table >
				<tr>
					<td>
					商品名称
					</td>
					<td>
					商品类型
					</td>
					<td>
					图片
					</td>
					<td>
					描述
					</td>
				</tr>


				<tr>
					<td>
					<input type="text" name="name[]" value="" />
					</td>
					<td>
						<input type="text" name="type[]" value="" />
					</td>
					<td>
					<input type="file" name="img[]" value="" />
					</td>
					<td>
					<textarea cols=30 height=8 ></textarea>
					</td>
				</tr>


			</table>
			
		</li>
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