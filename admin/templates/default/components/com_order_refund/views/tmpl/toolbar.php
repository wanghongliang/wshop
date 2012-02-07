<?php

?>

<?php

?>
<div class="toolbar" >

<ul class="com_ com_contents">
	<li class="active_li" >
	退款单管理
	</li>
</ul>

<div class="clr" ></div>
<div class="tackle" >

<ul class="tools" >	 
	<li   > 
		<a href="javascript:delall('<?php echo $this->baseuri;?>&task=deleleall')"   class="btn_delele"  >
		删除
		</a>
	</li>
 



</ul>

	<div class="filter" >

 		<div class="db-fl " >
		 &nbsp;搜索：
		<input type="text" name="key" value="<?php echo  $lists['key'];?>" size=10 />
	<input type="button" value="搜索" onclick="submitForm()" class="sbutton"/>
	<input type="button" value="清空" onclick="$('input[name=key]').attr('value','');submitForm()" class="sbutton"/>
		</div>

	</div>
<div class="clr" ></div>
</div>
</div>

<?php/**
<div class="toolbar" >

<ul>
	<?php if($_REQUEST['tmpl'] == 'com' ){?>

	<li> 
		<a href="<?php echo $this->baseuri;?>&task=add" > 添加 </a>
	</li>

	<?php } ?>


 	<li  <?php if(!$_REQUEST['client_id']){ ?>  class="iscurrent"   <?php } ?>  > 
		<a href="javascript:moveAll('<?php echo $this->baseuri;?>&no_html=1','selectmenu')"  >
		移动
		</a>
	</li>
 	<li  <?php if(!$_REQUEST['client_id']){ ?>  class="iscurrent"   <?php } ?>  > 
		<a href="javascript:href('<?php echo $this->baseuri;?>&task=copy')"  >
		复制
		</a>
	</li>
	<li  <?php if(!$_REQUEST['client_id']){ ?>  class="iscurrent"   <?php } ?>  > 
		<a href="javascript:delall('<?php echo $this->baseuri;?>&task=movetorecycle')"  >
		移入回收站
		</a>
	</li>
	<li  <?php if(!$_REQUEST['client_id']){ ?>  class="iscurrent"   <?php } ?>  > 
		<a href="javascript:delall('<?php echo $this->baseuri;?>&task=deleleall')"  >
		删除
		</a>
	</li>
</ul>

</div>

<?php **/ ?>