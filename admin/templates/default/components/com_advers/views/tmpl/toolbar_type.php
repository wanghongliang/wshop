<div class="toolbar" >
<ul class="com_ com_advertypes" >
  <li class="active_li" >
	<?echo ($_REQUEST['id']) ? '编辑分类' : '添加分类';?>
  </li>
</ul>
<div class="clr" ></div>
<div class="tackle" >
<ul class="tools" >	
    <li    >
		<a href="javascript:href('<?php echo $this->baseuri;?>&task=help')"   class="btn_help"  >
		帮助
		</a>
	</li>
    <li   >
		<a href="javascript:v();"   class="cancel_btn btn_cancel"  >
		取消
		</a>
	</li>
	<li  >
		<a  href="javascript:v();" class="apply_btn btn_apply"  >
		 应用
		</a>
	</li>
 	<li   >
		<a href="javascript:v();" class="submit_btn btn_save"  >
		保存
		</a>
	</li>
</ul>
<div class="clr" ></div>
</div>


</div>

