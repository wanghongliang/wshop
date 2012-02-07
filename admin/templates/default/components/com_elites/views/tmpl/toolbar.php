 <?php
		$s=(int)$_REQUEST['s'];
		$s = $s<1?1:$s;
 ?>

<div class="toolbar" >

	<ul class="com_ com_contents" >	
 
				<li   class='active_li'  > 
 					推荐商品管理
 				 </li> 
 
	</ul> 

 <div class="clr" ></div>	
<div class="tackle" >
	<div class="filter" >
	小提示：每个推荐类型，推荐的商品总数不可大于50个.
	</div>


	<ul class="tools">
	<li  class="createbtn btn_add" > 
			<a href="javascript:loadClick();" > 添加 </a>
	</li>
		<li   > 
			<a href="javascript:delall('<?php echo $this->baseuri;?>&task=deleleall&s=<?php echo $s;?>')"   class="btn_delele"  >
			删除
			</a>
		</li>
</ul>
<div class="clr"></div>
</div>
</div>



 