<div class="toolbar" >
	<div class="filter">
		<div class="db-fr db-pr5" >
		搜索 
		<input type="text" name="key" value="<?php echo  $lists['key'];?>" size=10 />
		<input type="button" value="搜索" onclick="submitForm()" class="sbutton"/>
		<input type="button" value="清空" onclick="$('input[name=key]').attr('value','');submitForm()" class="sbutton"/> 
		</div>
	</div>
<div class="clr" ></div>
<div class="tackle" >
<ul class="tools">	

	<li> 
		<a href="javascript:delall('<?php echo $this->baseuri;?>&task=deleteall')"   class="btn_delele"  >
		删除
		</a>
	</li>
	<li> 
		<a href="<?php echo $this->baseuri;?>&task=add" class="btn_add" > 添加 </a>
	</li>
	<li> 
		<a href="javascript:delall('<?php echo $this->baseuri;?>&task=unlockall')" class="btn_unlock" > 解锁 </a>
	</li>
	<li> 
		<a href="javascript:delall('<?php echo $this->baseuri;?>&task=lockall')" class="btn_lock" > 锁定 </a>
	</li>



</ul>
<div class="clr" ></div>
</div>

</div>

