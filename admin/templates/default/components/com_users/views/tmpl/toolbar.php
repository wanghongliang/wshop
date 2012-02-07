<?php

?>

<div class="toolbar" >

	<ul class="com_ com_contents" >	
	<li   class='active_li'  > 
		会员管理
	</li>  
	</ul>
<div class="clr" ></div>	
<div class="tackle" >
	
	<ul class="tools">
	<?php /**
	<li  class="createbtn btn_add" > 
		<a href="javascript:v()" url="<?php echo $this->baseuri;?>&task=add&tmpl=component" class="v" title="添加新用户	"  >
		添加
		</a>
	</li>
	**/
	?>

	<li   class="createbtn btn_add" > 
		<a href="javascript:href('<?php echo $this->baseuri;?>&task=deleleall')"  >
		删除
		</a>
	</li>
</ul>

	<div class="filter" >

		<div class="db-fl db-pl5" >
	 
		</div>
		<div class="db-fl db-pl5" >
		 &nbsp;搜索：
		<input type="text" name="key" value="<?php echo  $lists['key'];?>" size=10 />
		<input type="button" value="搜索" onclick="submitForm()" class="sbutton"/>
		<input type="button" value="清空" onclick="$('input[name=key]').attr('value','');submitForm()" class="sbutton"/>
		</div>

	</div>



<div class="clr" ></div>
</div>
</div>



 