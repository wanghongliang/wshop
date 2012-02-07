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
			<th > 内容 </th>
			<th > 作者 </th>
			<th > Email </th>
			<th > 留言时间 </th>
			<th > 状态 </th>
			<th > 锁定 </th>
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
					<input type="checkbox" name="id[]" value="<?php echo $row['comment_id'];?>" class="ids" />
				</td>

				<td> 
				<a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $row['comment_id'];?>" >
					<?php
					if( $row['title'] )
					{
						echo '<b>'.$row['title'].'</b><br/>';
					}
					?>
					<?php 
 						echo $row['content'];
					?>
				</a>
				
				<?php if( $row['reply_content'] != '' ){ ?>
				<div class="re_txt" >回复：<?php echo $row['reply_content'];?> </div>
				<?php } ?>
				</td> 
				<td>
					<?php echo $row['author'];?>
				</td>
				<td>
					<?php echo $row['email'];?>
				</td> 
				<td>
					<?php
						echo date('Y-m-d H:i:s',$row['created']);
					?>
				</td> 
				<td>
					<?php
					echo $row['reply_content']==''?'未回复':'已回复';
					?>
				</td>

 				<td>
					<?php
					echo $row['published']==0?'<a href="'.$this->baseuri.'&task=lock&id='.$row['id'].'&published='.$row['published'].'">
					<img src="/menage/templates/default/images/publish_x.png" alt="已锁定" border="0">
					</a>':'<a href="'.$this->baseuri.'&task=lock&id='.$row['id'].'&published='.$row['published'].'"><img src="/menage/templates/default/images/tick.png" alt="已开启" border="0"></a>';
					?>
				</td>


 				<td>
		 
					<a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $row['comment_id'];?>" class="list_edit">
					编辑/回复
					</a>
					<a href="<?php echo $this->baseuri;?>&task=delete&id=<?php echo $row['comment_id'];?>" class="list_del">
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