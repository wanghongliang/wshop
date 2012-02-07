
<form action="<?php echo $this->baseuri;?>"  method="post"  id="menage_form" name="listform">
<?
include($this->path.DS.'tmpl'.DS.'toolbar.php');
?>
 
<table class="listtable"  >
	<thead>
		<tr>
			<th width=10 ><input type="checkbox" class="selectall" /></th>
			<th style="text-align:center;"  > 商品图 </th>
			<th width="35%" > 称杀活动标题 </th>
			<th > 开始时间 </th>
			<th > 结束时间 </th>
 			<th > 活动商品数量 </th>
 			<th> 活动价 </th>
			<th> 操作 </th>
			<th> 序号</th>
		</tr>
	</thead>

	<?php  
 	if( is_array($this->rows) ){
		$i = 0;
		$status = array(
			0=>'未开始',
			1=>'进行中',
			2=>'结束未处理',
 			3=>'成功结束',
			4=>'失败结束',
		);
		foreach($this->rows as $k=>$row )
		{
			$param = unserialize($row['ext_info']);
		?>
			<tr class="trbg<?echo $i;?>" > 
				<td>
					<input type="checkbox" name="id[]" value="<?php echo $row['act_id'];?>" class="ids" />
				</td>
				<td align=center >
				<?php if( $row['img'] ){ ?>
					<a  class="img" href="<?php echo $row['img'];?>"   >
					<img src="<?php echo $row['img'];?>" width="60" />
					</a>
				<?php }else{ ?>
					无图
				<?php } ?>
				</td>
				<td> 
				<a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $row['act_id'];?>" >
 
					<?php 
 						echo $row['act_name'];
					?>
				</a>
				</td> 
 
				<td>
					<?php
						echo date('Y-m-d H:i:s',$row['start_time']);
					?>
				</td> 
				<td>
					<?php
						echo date('Y-m-d H:i:s',$row['end_time']);
					?>
				</td> 
 
				<td>
					<?php echo $row['product_amount'];?>
				</td> 
 
 

				<td>
					<?php echo $row['shop_price'];?>
				</td> 
 				<td>
		 
					<a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $row['act_id'];?>" class="list_edit">
					编辑 
					</a>
					<a href="javascript:del('<?php echo $this->baseuri;?>&task=delete&id=<?php echo $row['act_id'];?>')" class="list_del">
					删除
					</a>

				</td>

				<td>
					<?php echo $row['act_id'];?>
				</td>
			</tr>
		<?

			$i = 1-$i;
		}
	}else{
	?>
		<tr   >
			<td colspan=10 align=center style="padding:20px;"  >
		 
				您还没信息.
				 
			</td>
		</tr>
	<?php } ?>


		<tr class="navigations" >
			<td colspan=10 >
				<?php
				echo $nav->showFilePage2();
				
				?>
			</td>
		</tr>
</table>
</form>
 