<?php 
$menu = &$app->getMenu();
$c_uri = URI::current();  
//基本URL信息
$baseurl = '/'.$GLOBALS['config']['preview_directory'].'/'.URI_DIRECTORY.'/'.$app->getTemplate();


?>

<LINK href="<?php echo $baseurl;?>/css/products.css" type="text/css" rel="stylesheet">
<div id="dtroot">
<?php
$item	=& ModuleHelper::getModule('mod_breadcrumbs');
echo ModuleHelper::renderModule($item);
?>
</div>



<?php
//产品属性标题列表
$th = array(

);
?>
<div class="clr" ></div>
<div class="flv">

<table class="compare"  >

<?php

$rows = &$this->lists['rows'];
$v = $rows[0];

$fields = array('name'=>'产品名称','model'=>'产品型号','price'=>'产品价格','thumbnail'=>'产品图片');

$count = count($rows);

 
?>
	<tr>
		<th colspan=4 class="title" >
		产品基本信息
		</th>
	</tr>
<?php 
foreach( $fields as $x=>$y ){

 	?>
	<tr>
		<th width="160" ><?php echo $y;?></th>
	<?php
	if( $x == 'thumbnail' ){

		for($i=0;$i<$count;$i++){
		?>
		<td><img src="<?php echo $rows[$i][$x];?>" width=180 /></td> 
		<?php
		}
	} else if( $x == 'price' ){
		for($i=0;$i<$count;$i++){
		?>
		<td><font color=red >￥<?php echo Utility::price_format($rows[$i][$x]);?></font></td> 
		<?php
		}
	}else{

		for($i=0;$i<$count;$i++){
		?>
		<td><?php echo $rows[$i][$x];?></td> 
		<?php
		}
	}
	?>


	</tr>
	<?php
}
   
  ?>

	<tr>
		<td></td>
		<?php
		for($i=0;$i<$count;$i++){
 		?>
			<td><a href="/index.php?com=cart&act=add&id=<?php echo  $rows[$i]['id'];?>" class="probuy2" >立即购买</a>  </td> 
		<?php
		}
		?>
	</tr>
	<tr>
		<th colspan=4  class="title" >
			产品参数信息
		</th>
	</tr>
<?php 
 
		
	//该产品分类有相关的产品属性 
	$attr = $this->lists['attr'];

	$attr_values = $this->lists['attr_value'];
 	$values = array();

 
 	foreach( $attr as $k=>$v ){
	?>
	<tr>
		<th ><?php echo $v['attr_name'];?></th>
		<?php
		foreach( $rows as $x=>$y ){
			$attrs = (unserialize( $y['attribs'] ));

		?>
			<td><?php
			echo empty($attrs['attr'][$v['attr_id']][0])?'-':$attrs['attr'][$v['attr_id']][0];	
		 ?></td>
		<?php
		}
		?>
	
	</tr>
	<?php
	}
 	?>
		
 
			<?php 
			/**
			foreach( $attr as $row ){
				$values = (array)$attr_values[$row['attr_id']]; 
				if( count($values)>1 ){	
					foreach( $values as $k=> $val ){  
					?>
					<tr>
						<td class="form_text" >
						<?php
						  
						if( $k == 0 ){ ?>
							<a href="javascript:;" onclick="addSpec2(this)">[+]</a> 
						<?php }else{ ?>
							<a href="javascript:;" onclick="removeSpec2(this)">[-]</a> 
						<?php } ?>
						<?php echo $row['attr_name'];?></td>
						<td><?php 
						echo $attr_values[$row['attr_id']][0]['attr_value'];
						 ?></td>
					</tr>
					<?php
					} 
				}else{
				?>
				<tr>
					<td class="form_text" >
					<?php if( $row['attr_type']>1 ){ ?>
					<a href="javascript:;" onclick="addSpec2(this)">[+]</a> 
					<?php } ?>
					<?php echo $row['attr_name'];?></td>
					<td><?php 
					//echo $attr_values[$row['attr_id']][0]['attr_value'];
 
					 ?></td>
				</tr>
				<?php
				}
				
			}
			**/
			
			?>
 
		
	<?php
 
	 









?>
</table>

</div>
