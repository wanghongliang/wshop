 
<div class="toolbar" > 
<ul class="com_ com_contents">
	<li class="active_li" >
	内容管理
	</li>
</ul>

<div class="clr" ></div>

<div class="tackle" >
<ul class="tools"  > 
	<?php if($_REQUEST['menuid'] > 0  ){?>
	<li>
		<a href="<?php echo $this->baseuri;?>&task=add" class="btn_add" > 添加 </a>
	</li>
	<?php } ?>
 
 	<li  <?php if(!$_REQUEST['client_id']){ ?>  class="iscurrent"   <?php } ?>  >
		<a href="javascript:moveAll('<?php echo $this->baseuri;?>&no_html=1','selectmenu')" class="btn_move" >
			移动
		</a>
	</li> 
 	<li  <?php if(!$_REQUEST['client_id']){ ?>  class="iscurrent"   <?php } ?>  >
		<a href="javascript:href('<?php echo $this->baseuri;?>&task=copy')"   class="btn_copy"  >
		复制
		</a>
	</li>

	<li  <?php if(!$_REQUEST['client_id']){ ?>  class="iscurrent"   <?php } ?>  >
		<a href="javascript:delall('<?php echo $this->baseuri;?>&task=deleleall')"   class="btn_delele"  >
		删除
		</a>
	</li>

</ul>
<div class="filter">	
	<div class="db-fl db-pl5" >
	所属菜单：<?php echo $options;?>
	</div>
	<div class="db-fl db-pl5" >
	快速搜索：
	<input type="text" name="key" value="<?php echo  $lists['key'];?>" size=20 />
	<input type="button" value="搜索" onclick="submitForm()" class="sbutton"/>
	<input type="button" value="清空" onclick="$('input[name=key]').attr('value','');submitForm()" class="sbutton"/>
	</div>

</div>

<div class="clr" ></div>
</div>

</div>
	



 