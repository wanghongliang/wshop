<?php

?>
<div class="toolbar" >

<ul class="com_ com_contents">
	<li class="active_li" >
		页面信息
	</li> 
</ul>
<div class="clr" ></div>

<div class="tackle" >
	<div class="filter" >
		小提示：请选择下面的菜单列表项，点击后进入页面编辑
	</div>
	<ul class="tools tool_border" >

	  
	</ul>
</div> 
</div>

<div class="pagelist" >
	<?php
	//print_r($item);

	//$rows = $item[0];
	foreach( $item as $k=>$v ){
		?>
		<div  class="ml" >
		<h3><?php echo $v[0]['title'];?></h3>
		<ul>
		<?php
		foreach( $v as $k2=>$v2 ){
		?>
			<li>
			<?php
			
			if( $v2['parent_id'] > 0 ){
				echo '&nbsp;';
			}
			if( $v2['component'] == 'pages' ){ ?>
						·<a href="index.php?com=<?php echo $v2['component'];?>&menuid=<?php echo $v2['id'];?>&mtid=<?php echo $v2['tid'];?>&f=p"   ><?php echo $v2['name'];?>
						</a> 
			<?php }else{ ?>

				·<?php echo $v2['name'];?></li>
			<?php } ?>
		<?php
		}
		?>
		</ul>
		</div>
		<?php
	}
	?>
</div>


<style type="text/css" >
.pagelist{ padding:10px 10px; }

.ml{ width:25%; float:left; }
.ml ul{ margin-left:0px; }
.ml li{ padding-left:0px; display:block; color:#aaa; }
.ml li a{ color:#333; }
</style>