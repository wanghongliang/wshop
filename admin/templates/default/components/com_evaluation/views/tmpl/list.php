<style>
	.listtable{
		font-family:'arial';
	}
</style>





<form action="<?php echo $this->baseuri;?>"  method="post"  id="menage_form" name="listform">

<?
include($this->path.DS.'tmpl'.DS.'toolbar.php');
?>

<table class="listtable"  >
	<thead>
		<tr>
			<th><input type="checkbox" class="selectall" /></th>
			<th > 商品 </th>
			<th > 评价内容 </th>
			<th > 会员 </th>
			<th > 时间 </th>
			<th > 状态 </th> 
 			<th > 操作 </th>
			<th> ID </th>
		</tr>
	</thead>

	<?php 

 	if( is_array($this->rows) ){
		$i = 0;
		foreach($this->rows as $k=>$row )
		{
		?>
			<tr class="trbg<?echo $i;?>" > 
				<td>
					<input type="checkbox" name="id[]" value="<?php echo $row['id'];?>" class="ids" />
				</td>

				<td> 
					<div class="img" >
					<img src="<?php echo $row['thumbnail'];?>" width=60 />
					</div>
					<?php echo $row['name'];?>
					<div >￥<?php echo $row['shop_price'];?></div>
				</td> 

				<td>
					<?php echo $row['contents'];?>
				</td>
				<td>
					<?php echo $row['uname'];?>
				</td> 
				<td>
					<?php
						echo  $row['created'] ;
					?>
				</td> 
 
 				<td>
					<?php
					echo $row['published']==1?'<a href="'.$this->baseuri.'&task=lock&id='.$row['id'].'&published='.$row['published'].'">
					<img src="/menage/templates/default/images/publish_x.png" alt="已锁定" border="0">
					</a>':'<a href="'.$this->baseuri.'&task=lock&id='.$row['id'].'&published='.$row['published'].'"><img src="/menage/templates/default/images/tick.png" alt="已开启" border="0"></a>';
					?>
				</td>


 				<td>
		 
					<a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $row['id'];?>" class="list_edit">
					查看 
					</a>
					<a href="<?php echo $this->baseuri;?>&task=delete&id=<?php echo $row['id'];?>" class="list_del">
					删除
					</a>

				</td>

				<td>
					<?php echo $row['id'];?>
				</td>
			</tr>
		<?

			$i = 1-$i;
		}
	}
	?>

	<tr>
		<td colspan=9 >
		<?php echo $nav->showFilePage2();?>
		</td>
	</tr>
</table>
</form>
 <script language="javascript" >

 $(function(){
	 $('.v').wDialog({title:'编辑模块内容',width:800,height:500,top:30});
 });


</script>
<style type="text/css" >
.img{ float:left; padding:0px 5px; }
</style>