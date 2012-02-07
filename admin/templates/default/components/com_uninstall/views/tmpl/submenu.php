<?php

?>
<div class="submenu" >

<ul>
	<Li>模块
		<ul>
			<li  <?php if(!$_REQUEST['client_id']){ ?>  class="iscurrent"   <?php } ?>  > 
				<a href="<?php echo $this->baseuri;?>&client_id=0" >前台</a></li>

			<li <?php if( $_REQUEST['client_id']==1 ){?>  class="iscurrent"   <?php } ?>  >
				<a href="<?php echo $this->baseuri;?>&client_id=1" >后台</a>
			</li>
		</ul>
	</li>
	

	<li>|</li>
	<li><a href="index.php?com=uninstall&type=component" >组件</a></li>
</ul>


</div>