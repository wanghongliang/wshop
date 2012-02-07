<?php
include($this->path.DS.'tmpl'.DS.'toolbar_form.php');
?>
<div class="clr" ></div>
<form action="<?php echo $this->baseuri;?>"  method="post"   id="menage_form"  >
	<table class="formtable" >
		<tr>
			<td class="form_text" >属性名称</td>
			<td>
				<input type="text" name="attr_name" size=30 value="<?php echo $item['attr_name'];?>" />
			</td>
		</tr> 
		
		<tr>
			<td class="form_text" >所属商品类型</td>
			<td>
				<?php echo $type_id;?>
			</td>
		</tr> 

		<tr>
			<td class="form_text" >属性是否可选</td>
			<td>
				<?php echo Form::radio('attr_type',0,($item['attr_type']==0) );; ?> 唯一属性
				&nbsp; <?php echo Form::radio('attr_type',1,($item['attr_type']==1));; ?> 单选属性 ( 搜索属性 )
				&nbsp; <?php echo Form::radio('attr_type',2,($item['attr_type']==2));; ?> 复选属性 ( 搜索属性 )
				&nbsp; <?php echo Form::radio('attr_type',3,($item['attr_type']==3));; ?> 复选属性 ( 多选属性 )
				<div class="help" >	
					选择"单选/复选属性"时，可以对商品该属性设置多个值，同时还能对不同属性值指定不同的价格加价，用户购买商品时需要选定具体的属性值。选择"唯一属性"时，商品的该属性值只能设置一个值，用户只能查看该值。
				</div>
			</td>
		</tr> 

		<tr>
			<td class="form_text" >该属性值的录入方式</td>
			<td>
				<?php echo Form::radio('attr_input_type',0,($item['attr_input_type']==0) );; ?> 手工录入
				&nbsp; <?php echo Form::radio('attr_input_type',1,($item['attr_input_type']==1));; ?> 从下面的列表中选择（一行代表一个可选值）
				&nbsp; <?php echo Form::radio('attr_input_type',2,($item['attr_input_type']==2));; ?> 多行文本框  
 
			</td>
		</tr> 

		<tr id="attrtext" <?php if( $item['attr_type']>0 ){ ?> style="display:none;" <?php } ?> >
			<td class="form_text" >可选值列表</td>
			<td>
				<?php echo $attr_value; ?>
			</td>
		</tr> 


		<tr>
			<td class="form_text" >排序值</td>
			<td>
				<input type="text" name="ordering" size=5 value="<?php echo $item['ordering'];?>" />
			</td>
		</tr> 


	</table>		


		<input type="button" class="btn" value="添加规格值" onclick="addSpec();" />
	
		<table class="listtable spec moveordertable"     > 

 		<tr >
			<th>属性值名称</th>
			<th>图片</th> 
			<th>操作</th> 
		</tr>	
		
		<?php

 		if( $item['attr_id'] ){
			$model = &$this->getModel();
			$spec = $model->getSpec($item['attr_id']);
			
 			foreach( $spec as $k=>$v ){
				?>
				<tr>
					<td>
						<input type="text"  class="te"  name="spec_value[]" value="<?php echo $v['value'];?>" size=30 />
					</td>
					<td>
					<img height="30" width="30" src="<?php if($v['image']){ echo $v['image']; }else{ ?>templates/default/images/spec_def.gif<?php }?>" class="spec_pic" >

					<input type="hidden"  class="te" id="addpimg<?php echo $v['value_id'];?>"  name="spec_image[]" value="<?php echo $v['image'];?>" size=30 />

					<input type="button" value="上传图片" class="btn" onclick="upload('addpimg<?php echo $v['value_id'];?>')" />
					</td>
 
					<td><a href="javascript:;;" onclick="delSpec(this.parentNode,0);" >删除</a><input type="hidden" name="spec_id_list[]" value="<?php echo $v['value_id'];?>" />
					</td>
				</tr>
				<?php
			}
			
		}
		?>
		</table>


		<input type="hidden" value="<?php echo $item['id'];?>" name="id" />
		<div class="deleteFrom"   >
		</div>



	<div class="formbtn" >
		<input type="submit" value="提交"  class="btn" />
		<input type="button" class="apply_btn" value="应用" />
		<input type="button" class="btn" value="取消" onclick="location.href='<?php echo $this->baseuri;?>'" /> 
		<input type="hidden" value="save" name="task" /> 
		<input type="hidden" value="<?php echo $item['attr_id'];?>" name="id" />
		<input type="hidden" value="" name="return" id="return"  />
	</div>
 
</form>


<style type="text/css" >
.deleteFrom{ display:none;}
</style>
 <script language="javascript" >

 $(function(){
		$('input[name=attr_type]').click(function(){
			if( this.value == '0' ){
				$('#attrtext').show();
			}else{
				$('#attrtext').hide();
			}
		});
	 	$('.apply_btn').click(function(){	
			$('#return').attr('value','<?php echo URI::current();?>');
			$('#menage_form').get(0).submit();
 		});
 });
var tr = ('<tr><td><input class="te" type="text" name="spec_value[]" value="" size=30 ></td><td><img height="30" width="30" src="templates/default/images/spec_def.gif" class="spec_pic"><input type="hidden" class="te" name="spec_image[]" value="" size=30 ></td> <td><a href="javascript:;;" onclick="delSpec(this.parentNode,0);" >删除</a><input type="hidden" name="spec_id_list[]" value="" /></td></tr>');
				
function addSpec(){
	$('.spec').append(tr);
	orderTable();
}

function delSpec(obj,id){
	 if(confirm('确实要删除吗?')){ 
		 $('input',obj.parentNode).each(function(k,obj){
			  
			 $('.deleteFrom').append(obj);
			 
		 });
			
		//$('.deleteFrom input[type=text]').each(function(k,obj){
		//	$(obj).val('');
		//});
		 
		 
		 $('.deleteFrom .te').attr('value','');
		// $('.deleteFrom').append($(obj.parentNode).html());
 		 $(obj.parentNode).remove();
 	 }
}

function addpimg(value,name){
	var obj = $('#'+name).get(0);
	$(obj).attr('value',value); 
	
	$('img',obj.parentNode).attr('src',value);
}
 </script>
 