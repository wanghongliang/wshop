<?php

?>
<div class="toolbar" >

	<ul class="com_ com_contents" >	
		<li class="normal_li">
		<a href="index.php?com=languages">
		语言包管理
		</a>
		</li>
 
 		<li class="active_li" >
			<a href="index.php?com=languages&task=type">
			语言分类管理
			</a>
		</li>
	</ul><div class="clr" ></div>
	<div class="tackle" >
	<ul class="tools">	
	
		<li>
			<a href="<?php echo $this->baseuri;?>&task=addtype" class="btn_add" > 添加 </a>
		</li>

	 
		<li class="iscurrent">
			<a href="javascript:delall('<?php echo $this->baseuri;?>&task=deleteAll')"   class="btn_delele"  >
			删除
			</a>
		</li>
		<li    >
			<a href="javascript:href('<?php echo $this->baseuri;?>&task=unlock')"  class="btn_unlock"  >
			 解锁
			</a>
		</li>
		<li   >
			<a href="javascript:href('<?php echo $this->baseuri;?>&task=lock')"  class="btn_lock"  >
			 锁定
			</a>
		</li>
		<li > 
			<a  href="javascript:href('<?php echo $this->baseuri;?>&task=setDefault')" class="btn_add"  >
			设默认
			</a>
		</li>

	</ul>
	</div>
</div>