
<div class="toolbar" >

	<ul class="com_ com_contents" >	
		<li class="active_li">模块管理</li>
	</ul>
<div class="clr" ></div>
<div class="tackle" >
	<ul class="tools">
		<li    > 
			<a href="javascript:;;" url="<?php echo $this->baseuri;?>&task=selectadd&tmpl=component"   title="添加新的模块-请选择模块类型"  class="v  btn_add"  >
			添加
			</a>
		</li>
		<li     > 
			<a href="javascript:href('<?php echo $this->baseuri;?>&task=copy')" class="btn_copy" >
			复制
			</a>
		</li>

		<li    > 
			<a href="javascript:href('<?php echo $this->baseuri;?>&task=deleleall')" class="btn_delele"  >
			删除
			</a>
		</li>
	</ul>
<div class="filter" >

	<div class="db-fl db-pl5" >	
	&nbsp;搜索：
	<input type="text" name="key" value="<?php echo  $lists['key'];?>" size=10 />

		<?php
		$pos[0]='位置...'; 
		$mod[0]='类型...'; 
		echo Form::dropdown('pos',$pos,$_REQUEST['pos'],'  ');
		echo Form::dropdown('m',$mod,$_REQUEST['m'],'  ');
		?>
 
	<input type="button" value="搜索" onclick="submitForm()" class="sbutton"/>
	<input type="button" value="清空" onclick="$('input[name=key]').attr('value','');submitForm()" class="sbutton"/>
	</div>

</div>


<div class="clr" ></div>
</div>
</div>

 