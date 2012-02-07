<?php
$model = &$this->getModel();
$catid = intval($_GET['catid']);
$type = $model->getTypeID($catid);
$id = intval($_GET['id']);

$type_id = $type['type_id'];
if( $type_id ){
	
	//该商品分类有相关的商品属性 
	$attr = $model->getAttr( $type_id );
	 
	$attr_values = $model->getAttrValue($id); 
	
?>
商品扩展属性：
<table class="formtable"     >
	<?php foreach( $attr as $row ){
		$values = (array)$attr_values[$row['attr_id']];
		if( count($values)>1 ){
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

<?php
}
?>