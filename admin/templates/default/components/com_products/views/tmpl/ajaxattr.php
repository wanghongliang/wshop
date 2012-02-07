<?php
$model = &$this->getModel();
$catid = intval($_GET['catid']);
$type = $model->getTypeID($catid);

$attribs = (array)unserialize( $item['attribs'] );
$aimg = $attribs['aimg'];

 $attribs = $attribs['attr'];


$id = intval($_GET['id']);

$type_id = $type['type_id'];

if( $type_id == (int)$_GET['type_id'] ){ return ''; }

if( $type_id ){
	
	//该商品分类有相关的商品属性 
	$attr = $model->getAttr( $type_id );
	$specs_list = array();
	foreach( $attr as $row ){
		if( $row['attr_type']>1 ){
			$specs_list[] = &$row;
		}
	}
	//$attr_values = $model->getAttrValue($id); 


		if( count($specs_list)>0 ){
?>

			相关规格
			<table class="formtable attrtable" >
			<?php
			//关联的商品值 
			$attr_v= $model->getAttrV($item['id']); 
			$attr_select = array();
			


			$n=0;

 			foreach( $specs_list as $row ){
 			//已加载的相关图片
			$attr_img = '';
			?>
			<tr>
				<td   class="form_text" >
					<?php echo $row['attr_name'];?>
				</td>
				<td class="at<?php echo $n++;?>" >
					<?php
					$values = explode("\n",$row['attr_values']); 
					foreach( $values  as $va ){
						$v2  = explode(':',$va);
						$v = isset($v2[1])?trim($v2[1]):trim($v2[0]);
						 ?>
							<input type="checkbox"  onclick="loadSpec(this);" title="<?php echo $v;?>" aid="<?php echo $v2[0];?>" name="attr_value_id[<?php echo $v2[0];?>]" value="<?php echo $row['attr_id'];?>"
							
							<?php 
							//选取对应的值，用于扩展属性	
							if( isset($attr_v[$v2[0]]) ){ 
								echo ' checked '; 
								$attr_select[$row['attr_id']][] = $v;
							} ?>
							/>
						 <?php
							 echo $v;
							 echo '&nbsp;&nbsp;';

							if( isset($aimg[$v2[0]]) ){
								$attr_img.='<div class="aimg" id="'.$v2[0].'" ><span class="a_thumb" >';
								if( !empty( $aimg[$v2[0]] ) ){
								$attr_img.='<img src="'.$aimg[$v2[0]].'" width=50 />';
								}
								$attr_img.='</span><div class="atext" >'.$v.'</div><div onclick="selectRelated(this)" class="asimg"   >选图</div><input type="hidden" name="attr_img_list['.$v2[0].']" value="'.$aimg[$v2[0]].'" size=10 class="i_thumb" /></div>';
							}
					}
					?>
					
					<?php if( $n<2 ){ ?>
					<div class="attrimg" >
					<?php 
						echo $attr_img;
					?>
					
					</div>
					<?php } ?>

				</td>
			</tr>

			<?php 
		}

		//print_r($attr_select);
		?>

		<tr>
			<td class="form_text">
			规格

			</td>
			<td>
		<table class="listtable spec"  style="margin:0px;" >
			<tr>
			<th>
				货号
			</th> 
			<?php
			$n = 0;
			$spec_ids = array();

			$spec = array();
			foreach( $attr as $k2=>$row ){

				if( count($attr_select[$row['attr_id']]) < 1 ){
					//continue;
				}
			  if( $row['attr_type']>1 ){ 

				
				$values = (array)$attr_select[$row['attr_id']];

 				//$data=array(0=>'请选择..');
				
				$vals = array();
				foreach( $values as $k=>$v ){ $vals[$v]=$v;}
				 
				$row['data'] = $vals;
			  ?>
				<th width="60" ><?php echo $row['attr_name'];?></th>
				<?php	
				//$addTR .= '<td>'.Form::dropdown('spec_['.$row['attr_id'].'][]',$vals,'',' class="spec_option" ' ).'</td>';
			  $addTR .= '<td><div class="sv2" onclick="selSpec(this,'.$k2.');" >选择</div><input type="hidden" class="svinput" name="spec_['.$row['attr_id'].'][]" value="" /></td>';
				$spec_ids[] = $row['attr_id'];	//附加的规格ID
				$spec[] = $row;
			  }
			}
			?> 
  
			<th>
				销售价
			</th>
			<th>
				市场价
			</th>
			<th>
				重量
			</th>
			<th>
				库存
			</th>
			<th>
				操作
			</th>
			</tr> 
			<?php
			$spec_value = (array)unserialize( $item['specs'] );// $model->getSpecValue($item['id']);
			

			 
				//print_r($spec_value);
		    foreach( $spec_value as $k=>$v ){
				if( empty( $v ) ){ continue; }
				$sv = explode(',',$v['attr']);
				
				//print_r($sv);
 				?>
				<tr>
					<td><input type="text" name="pn[]" size=10  value="<?php echo $v['pn'];?>" /></td>
					<?php
					$n=0;
					foreach( $spec as $k=>$v2 ){ 
					?>
					<td>
						<?php 
						//echo Form::dropdown('spec_['.$v2['attr_id'].'][]',$v2['data'],$sv[$n++],' class="spec_option" ' );

						if( empty( $sv[$k] ) ){
						?>
						<div class="sv2" onclick="selSpec(this,<?php echo $k;?>)" >
							选择
						</div>
						<?php
						}else{
						?>
						<div class="sv" onclick="selSpec(this,<?php echo $k;?>)" >
						<?php echo $sv[$k];?>
						</div>
						<?php
						}
						?>

						<input type="hidden" name="spec_[<?php echo $v2['attr_id'];?>][]" value="<?php echo $sv[$k];?>" class="svinput" />


					</td>
					<?php	 
					}

					?>	
					<td><input type="text" name="price[]" size=5 value="<?php echo $v['price'];?>" /></td>
					<td><input type="text" name="cost[]" size=5 value="<?php echo $v['cost'];?>" /></td>
					
					<td><input type="text" name="weight[]" size=5 value="<?php echo $v['weight'];?>" /></td> <td><input type="text" name="store[]" size=5 value="<?php echo $v['store'];?>" /></td>
					<td><a href="javascript:;;" onclick="delSpec(this.parentNode,0);" >删除</a>
					<input type="hidden" name="products_spec_id[<?php echo $v['products_spec_id'];?>]" value="<?php echo $v['products_spec_id'];?>" /> 
					</td>
				</tr>
				<?php
			}
			?>
		</table>

		<input type="hidden" name="delspec" value=""/>
		<input type="hidden" name="spec_id_str" value="<?php echo implode(',',$spec_ids);?>"/>
 
		<input type="button" class="btn" value="添加规格" onclick="addSpec();" />
	</table>	

					</td>
				</tr>
			</table>

		<?php } ?>


商品扩展属性：
<table class="formtable"     >
	<?php foreach( $attr as $row ){
		//$values = (array)$attr_values[$row['attr_id']];

		if( $row['attr_type']>1 ) continue; 


		$values = (array)$attribs[$row['attr_id']]; 
		if( $row['attr_type'] >0 ){
				?>
				<tr>
					<td class="form_text" >
						-
					<?php echo $row['attr_name'];?>
					</td>

					<td>
					<?php

					//print_r($values);
					$vals = explode("\n",$row['attr_values']); 
					?>
					<select name="attr_value_id2[<?php echo $row['attr_id'];?>]" onchange="setAttrValue(this)"  >
					<option value="" >请选择..</option>
					<?php 
					foreach( $vals  as $va ){
						$v  = explode(':',$va);
						$v2 = isset($v[1])?trim($v[1]):trim($v[0]);
						$data[$v[0]] = $v2;
						?>
						<option value="<?php echo $v[0];?>" <?php if( $values[0]==$v2 ){ echo 'selected';}?> ><?php echo $v2;?></option>
						<?php
					} 
					?>
					</select>
					<input type="hidden" value="<?php echo $values[0];?>" class="avl"  name="attr_value_list[]" />
					<?php
					//',$data,$values[0],'  ' );
					echo Form::hidden('attr_id_list[]',$row['attr_id']); 
					?>
					
					</td>
				</tr>
		<?php
		}else{
		?>
		<tr>
			<td class="form_text" ><?php echo $row['attr_name'];?></td>
			<td><?php 
			//echo $attr_values[$row['attr_id']][0]['attr_value'];
			echo $this->attrForm(&$row,$values[0]['attr_value'],$values[0]['attr_price']);?></td>
		</tr>
		<?php
		}
		
	} ?>
</table>
<input type="hidden" name="type_id" id="type_id" value="<?php echo $type_id;?>" />
<?php
}
?>