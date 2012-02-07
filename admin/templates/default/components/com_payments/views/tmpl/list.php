<?
include($this->path.DS.'tmpl'.DS.'toolbar.php');
?>

<form action="index.php?com=feedbacks"  method="post"  id="menage_form" name="listform">


<table class="listtable"  >
	<thead>
		<tr>
			<th><input type="checkbox" class="selectall" /></th>
			<th width=90 >
				支付方式 LOGO
			</th>
			<th > 支付方式名称 </th>
			<th > 支付方式描述 </th>
			<th > 插件版本 </th>
			<th > 插件作者 </th>
			<th > 费率 </th>
			<th > 排序 </th>
 			<th > 操作 </th>
			<th> ID </th>
		</tr>
	</thead>

	<?php 

 	if( is_array($this->rows) ){
		$i = 0;

		//print_r( $this->rows );
		foreach($this->rows as $k=>$row )
		{
		?>
			<tr class="trbg<?echo $i;?>" >

			
				<td>
					<input type="checkbox" name="id[]" value="<?php echo $row['id'];?>" class="ids" />
				</td>
				<td align=center >
				<?php if( $row['params']['logo'] ){ ?>
					<a  class="img" href="<?php echo $row['params']['logo'];?>"   >
					<img src="<?php echo $row['params']['logo'];?>" width="90" />
					</a>
				<?php }else{ ?>
					无图
				<?php } ?>
				</td>


				<td>

				<a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $row['id'];?>" >
 
					<?php 
 						echo $row['name'];
					?>
				</a>
				</td>

				<td>
					<?php echo $row['params']['desc'];?>
				</td>
				<td>
					<?php echo $row['version'];?>
				</td>

				<td>
					<?php
						echo $row['author'];
					?>
				</td>

 
				<td>
					<?php echo $row['params']['rates'];?>
				</td>

 				<td>
					<?php
					echo $row['published']==0?'<a href="'.$this->baseuri.'&task=lock&id='.$row['id'].'&published='.$row['published'].'">
					<img src="templates/default/images/publish_x.png" alt="已锁定" border="0">
					</a>':'<a href="'.$this->baseuri.'&task=lock&id='.$row['id'].'&published='.$row['published'].'"><img src="templates/default/images/tick.png" alt="已开启" border="0"></a>';
					?>
				</td>


 				<td>
		 
					<a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $row['id'];?>" class="list_edit">
					编辑 
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