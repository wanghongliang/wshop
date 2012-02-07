<?php

?>
<div class="toolbar" >

<ul>
	<li> 
		<a href="<?php echo $this->baseuri;?>&task=add" > 添加 </a>
	</li>
 	<li  <?php if(!$_REQUEST['client_id']){ ?>  class="iscurrent"   <?php } ?>  > 
		<a href="javascript:moveAll('<?php echo $this->baseuri;?>','selectmenu')"  >
		移动
		</a>
	</li>
 	<li  <?php if(!$_REQUEST['client_id']){ ?>  class="iscurrent"   <?php } ?>  > 
		<a href="javascript:href('<?php echo $this->baseuri;?>&task=copy')"  >
		复制
		</a>
	</li>

	<li  <?php if(!$_REQUEST['client_id']){ ?>  class="iscurrent"   <?php } ?>  > 
		<a href="javascript:delall('<?php echo $this->baseuri;?>&task=deleleall')"  >
		删除
		</a>
	</li>
</ul>

</div>