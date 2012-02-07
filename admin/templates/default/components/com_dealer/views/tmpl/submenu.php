<?php

?>
<div class="submenu" >

<ul>
	<li  <?php if(!$_REQUEST['client_id']){ ?>  class="iscurrent"   <?php } ?>  > 
		<a href="<?php echo $this->baseuri;?>&admin=0" >会员</a></li>

	<li <?php if( $_REQUEST['client_id']==1 ){?>  class="iscurrent"   <?php } ?>  >
		<a href="<?php echo $this->baseuri;?>&admin=1" >管理员</a>
	</li>
</ul>

</div>