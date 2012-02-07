<?php

?>
<div class="toolbar" >
<ul class="com_ com_links">
	<li class="active_li">友情链接</li>
	<li class="normal_li"><a href="index.php?com=links&task=linktype">友情链接分类</a></li>
</ul>

<div class="clr" ></div>
<div class="tackle" >
<div class="filter">

	<div class="db-fl db-pr5" >
	菜单 <select name="tid" onchange="location.href = '<? echo $this->baseuri; ?>&tid=' + this.value;">
	<option value="">--请选择--</option>
		<?php 
			echo $this->showSelect($types, 0, 0, $lists['tid']);
		?>
	</select>
	</div>
	
	<div class="db-fl db-pl5" >
	搜索 
	<input type="text" name="key" value="<?php echo  $lists['key'];?>" size=10 />
	<input type="button" value="搜索" onclick="submitForm()" class="sbutton"/>
	<input type="button" value="清空" onclick="$('input[name=key]').attr('value','');submitForm()" class="sbutton"/>
	</div>
</div>


<ul class="tools">
    <li  >
		<a href="javascript:href('<?php echo $this->baseuri;?>&task=help')"   class="btn_help"  >
		帮助
		</a>
	</li>
	<li  >
		<a href="javascript:delall('<?php echo $this->baseuri;?>&task=deleteAllLinks')"   class="btn_delele"  >
		删除
		</a>
	</li>
    <li  >
		<a href="javascript:href('<?php echo $this->baseuri;?>&task=unlock')"  class="btn_unlock"  >
		 解锁
		</a>
	</li>
    <li   >
		<a href="javascript:href('<?php echo $this->baseuri;?>&task=lock')"  class="btn_lock"  >
		 锁定
		</a>
	</li>
    <li  >
        <a href="javascript:href('<?php echo $this->baseuri;?>&task=editlink')"   class="btn_edit"  >
        编辑
        </a>
    </li>
 	<li  >
		<a href="javascript:href('<?php echo $this->baseuri;?>&task=copy')"   class="btn_copy"  >
		复制
		</a>
	</li>
 	<li >
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