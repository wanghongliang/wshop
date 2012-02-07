<div class="toolbar" >
<ul class="com_ com_links">
	<li class="active_li">
	<?php
	if($_REQUEST['id']){
		echo '编辑友情链接';
	}else{
		echo '添加友情链接';
	}
	?>
	</li>
</ul><div class="clr" ></div>
<div class="tackle" >
<ul class="tools">
    <li  <?php if(!$_REQUEST['client_id']){ ?>  class="iscurrent"   <?php } ?>  >
		<a href="javascript:href('<?php echo $this->baseuri;?>&task=help')"   class="btn_help"  >
		帮助
		</a>
	</li>
	<li  <?php if(!$_REQUEST['client_id']){ ?>  class="iscurrent"   <?php } ?>  >
        <a href="javascript:v();"   class="cancel_btn btn_cancel"  >
        取消
        </a>
    </li>
    <li  <?php if(!$_REQUEST['client_id']){ ?>  class="iscurrent"   <?php } ?>  >
        <a  href="javascript:v();" class="apply_btn btn_apply"  >
         应用
        </a>
    </li>
     <li  <?php if(!$_REQUEST['client_id']){ ?>  class="iscurrent"   <?php } ?>  >
        <a href="javascript:v();" class="submit_btn btn_save"  >
        保存
        </a>
    </li>
</ul>
<div class="clr" ></div>
</div>
</div>