<?php

?>

<div class="toolbar" >

	<ul class="com_ com_contents" >	
 
		<?php
		if( is_array($types) )
		{
			foreach( $types as $t )
			{
				?>
				<li 
				<?php
				if( $this->menutypeid == $t['id'] ){
					echo " class='active_li' ";
				}else{
					echo ' class="normal_li" ';
				}
				?>
				 > 
					<a href="index.php?com=menu&mtid=<?php echo $t['id'];?>" >
						<?php echo $t['title']; ?>
					</a>
				 </li> 
				<?php
			}
		}
		?>
	</ul>
	<div class="clr" ></div>
<div class="tackle" >
	<div class="filter" >
		说明：本栏目对网站的导航菜单参数，SEO等配置。
	</div>
	<ul class="tools">
		<li> 
			<a class="createbtn btn_add" href="javascript:v();"  > 添加 </a>
		</li>
		<li> 
			<a   href="javascript:href('<?php echo $this->baseuri;?>&task=sethome')"  class="btn_default" > 设为默认 </a>
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

	</ul><div class="clr" ></div>
</div>


</div>


 

<script language="javascript" >
$(function(){
	$('.createbtn').click(function(){
		$.w.createDialog({title:'添加菜单',url:'index.php?com=menu&task=selectcomtype&next=add&mtid=<?php echo $this->menutypeid;?>&no_html=1',isget:true},3);
	});
});
</script>