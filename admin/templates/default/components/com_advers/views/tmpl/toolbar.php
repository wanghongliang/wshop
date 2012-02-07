<?php

?>
<div class="toolbar" >

<ul class="com_ com_advers">
	<li class="active_li">广告管理</li>
	<li class="normal_li"><a href="index.php?com=advers&task=type">广告分类管理</a></li>
</ul>

<div class="clr" ></div>
<div class="tackle" >
	<div class="filter">	
		<?php /**
		<div class="db-fl db-pl5" >
		
		分组
		<select name="tid" onchange="location.href = '<? echo $this->baseuri; ?>&tid=' + this.value;">
			<option value="">--请选择--</option>
		<?php 
			echo showSelect($types, 0, 0, $lists['tid']);
		?>
		</select>
		</div>

	
		<div class="db-fl db-pl5" >
		搜索 
		<input type="text" name="key" value="<?php echo $lists['key'];?>" size=10 />
		<input type="button" value="搜索" onclick="submitForm()" class="sbutton"/>
		<input type="button" value="清空" onclick="$('input[name=key]').attr('value','');submitForm()" class="sbutton"/> 
		</div>
	***/
		?>
	</div>


<ul class="tools">
    <li  <?php if(!$_REQUEST['client_id']){ ?>  class="iscurrent"   <?php } ?>  >
		<a href="javascript:href('<?php echo $this->baseuri;?>&task=help')"   class="btn_help"  >
		帮助
		</a>
	</li>
	<li class="iscurrent">
		<a href="javascript:delall('<?php echo $this->baseuri;?>&task=deleteAllAdvers')"   class="btn_delele"  >
		删除
		</a>
	</li>
    <li  <?php if(!$_REQUEST['client_id']){ ?>  class="iscurrent"   <?php } ?>  >
		<a href="javascript:href('<?php echo $this->baseuri;?>&task=unlock')"  class="btn_unlock"  >
		 解锁
		</a>
	</li>
    <li  <?php if(!$_REQUEST['client_id']){ ?>  class="iscurrent"   <?php } ?>  >
		<a href="javascript:href('<?php echo $this->baseuri;?>&task=lock')"  class="btn_lock"  >
		 锁定
		</a>
	</li>
 	<li class="iscurrent" >
		<a href="javascript:href('<?php echo $this->baseuri;?>&task=copy')"   class="btn_copy"  >
		复制
		</a>
	</li>
 	<li class="iscurrent">
		<a href="javascript:moveAll('<?php echo $this->baseuri;?>&no_html=1','selecttype')" class="btn_move" >
			移动
		</a>
	</li>
	<li>
		<a href="<?php echo $this->baseuri;?>&task=addlink" class="btn_add" > 添加 </a>
	</li>

</ul>
<div class="clr" ></div>
</div>

</div>

 
<div class="subbar" >
<ul>

<?php

foreach(  $type as $k=>$t ){
	?>
	<li class="<?php if($t['id']==$tid){ echo 'active_li'; }else{ echo 'normal_li'; }?>"  >
	<a href="<?php echo $this->baseuri;?>&tid=<?php echo $t['id'];?>" class="<?php if($t['id']==$tid){ echo 'active'; }?> db-fl">
	<?php
	echo $t['name'];
	?>
	</a>
	<?php echo $t['num'];?>
	</li>
	<?php
}
?>	

</ul>
</div>