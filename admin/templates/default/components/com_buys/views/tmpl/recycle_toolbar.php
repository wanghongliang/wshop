<?php

?>
<div class="toolbar" >

<ul>
 
 	<li  <?php if(!$_REQUEST['client_id']){ ?>  class="iscurrent"   <?php } ?>  > 
		<a href="javascript:moveAll('<?php echo $this->baseuri;?>&no_html=1&tmpl=component&return[task]=recycle','selectmenu')"  >
			恢复
		</a>
	</li>
 
	<li  <?php if(!$_REQUEST['client_id']){ ?>  class="iscurrent"   <?php } ?>  > 
		<a href="javascript:delall('<?php echo $this->baseuri;?>&task=deleleall&tmpl=component&return[task]=recycle')"  >
		彻底删除
		</a>
	</li>
</ul>

</div>