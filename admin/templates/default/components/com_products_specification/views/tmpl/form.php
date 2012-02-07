<?php
include($this->path.DS.'tmpl'.DS.'toolbar_form.php');
?>
 <form action="<?php echo $this->baseuri;?>"  method="post"   id="menage_form"    >

	<ul class="switch_con" >
	<li class="con active" > 


	<table class="formtable" >
		<tr>
			<td class="form_text" >规格名称</td>
			<td>
				<input type="text" name="name" size=30 value="<?php echo $item['name'];?>" />
			</td>
		</tr> 
		<tr>
			<td class="form_text" >显示类型</td>
			<td>
 
				<?php echo Form::radio('spec_type',0,($item['spec_type']==0) );; ?> 文字 
				<?php echo Form::radio('spec_type',1,($item['spec_type']==1) );; ?> 图片 

			</td>
		</tr> 
		<tr>
			<td class="form_text" >显示方式</td>
			<td>
	 
				<?php echo Form::radio('spec_show_type',0,($item['spec_show_type']==0) );; ?> 平铺显示 
				<?php echo Form::radio('spec_show_type',1,($item['spec_show_type']==1) );; ?> 下拉显示 

			</td>
		</tr> 
 
	</table>

	<input type="button" class="btn" value="添加规格值" onclick="addSpec();" />
	
		<table class="listtable spec moveordertable"     > 

 		<tr >
			<th>规格值名称</th>
			<th>规格图片</th> 
			<th>操作</th> 
		</tr>	
		
		<?php
		if( $item['id'] ){
			$model = &$this->getModel();
			$spec = $model->getSpec($item['id']);
			
 			foreach( $spec as $k=>$v ){
				?>
				<tr>
					<td>
						<input type="text"  class="te"  name="spec_value[]" value="<?php echo $v['spec_value'];?>" size=30 />
					</td>

					<td>
					<img height="30" width="30" src="<?php if($v['spec_image']){ echo $v['spec_image']; }else{ ?>templates/default/images/spec_def.gif<?php }?>" class="spec_pic" >
					<input type="hidden"  class="te" id="addpimg<?php echo $v['spec_value_id'];?>"  name="spec_image[]" value="<?php echo $v['spec_image'];?>" size=30 />
					<input type="button" value="上传图片" class="btn" onclick="upload('addpimg<?php echo $v['spec_value_id'];?>')" />
					</td>
 
					<td><a href="javascript:;;" onclick="delSpec(this.parentNode,0);" >删除</a><input type="hidden" name="spec_id_list[]" value="<?php echo $v['spec_value_id'];?>" />
					</td>
				</tr>
				<?php
			}
			
		}
		?>
		</table>
		<div class="formbtn" >
			<input type="button" class="submit_btn" value="保存"/>
			<input type="button" class="apply_btn" value="应用" />
			<input type="reset" class="cancel_btn" value="取消" />
		</div>
		<input type="hidden" value="save" name="task" />
		<input type="hidden" value="" name="return" id="return"  />

		<input type="hidden" value="<?php echo $item['id'];?>" name="id" />
		<div class="deleteFrom"   >
		</div>
	</li>
	</ul>
</form>


<script language="javascript" >
	$(function(){
		$('.submit_btn').click(function(){	
			$('#menage_form').get(0).submit();
 		});

		$('.apply_btn').click(function(){	
			$('#return').attr('value','<?php echo URI::current();?>');
			$('#menage_form').get(0).submit();
 		});

		$('.cancel_btn').click(function(){
			location.href='<?php echo $this->baseuri;?><?php if( $_REQUEST['tmpl'] != '' ){ echo "&tmpl=".$_REQUEST['tmpl'];}?>';
 		});
	});
</script>