<div class="toolbar" >

<ul class="com_ com_advertypes">
 
	<li class="normal_li"><a href="index.php?com=advers">广告管理</a></li>
	<li class="active_li">广告分类管理</li>

</ul>

<div class="clr" ></div>
<div class="tackle" >
<ul class="tools" >
    <li  <?php if(!$_REQUEST['client_id']){ ?>  class="iscurrent"   <?php } ?>  >
		<a href="javascript:href('<?php echo $this->baseuri;?>&task=help')"   class="btn_help"  >
		帮助
		</a>
	</li>
	<li  <?php if(!$_REQUEST['client_id']){ ?>  class="iscurrent"   <?php } ?>  >
		<a href="javascript:delall('<?php echo $this->baseuri;?>&task=deleteAllType')"   class="btn_delele"  >
		删除
		</a>
	</li>
    <li  <?php if(!$_REQUEST['client_id']){ ?>  class="iscurrent"   <?php } ?>  >
		<a href="javascript:href('<?php echo $this->baseuri;?>&task=unlocktype')"  class="btn_unlock"  >
		 解锁
		</a>
	</li>
    <li  <?php if(!$_REQUEST['client_id']){ ?>  class="iscurrent"   <?php } ?>  >
		<a href="javascript:href('<?php echo $this->baseuri;?>&task=locktype')"  class="btn_lock"  >
		 锁定
		</a>
	</li>
    <li  <?php if(!$_REQUEST['client_id']){ ?>  class="iscurrent"   <?php } ?>  >
        <a href="javascript:href('<?php echo $this->baseuri;?>&task=edit')"   class="btn_edit"  >
        编辑
        </a>
    </li>
	<li>
		<a href="<?php echo $this->baseuri;?>&task=addtype" class="btn_add" > 添加 </a>
	</li>
</ul>
<div class="clr" ></div>
</div>

</div>