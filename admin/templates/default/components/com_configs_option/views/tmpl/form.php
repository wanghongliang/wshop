<?php
include($this->path.DS.'tmpl'.DS.'toolbar_form.php');
?>
 <form action="<?php echo $this->baseuri;?>"  method="post"   id="menage_form"    >

	<ul class="switch_con" >
	<li class="con active" > 


	<table class="formtable" >
		<tr>
			<td class="form_text" >配置组名称</td>
			<td>
				<input type="text" name="name" size=30 value="<?php echo $item['name'];?>" />
			</td>
		</tr> 
		<tr>
			<td class="form_text" >选择配置所属的范围</td>
			<td>
 
				<select name="com_name" >
					<option value="" >-全局-</option>
				<?php 
				foreach( $com as $v ){
					?>
					<option value="<?php echo $v['option'];?>" <?php if( $item['com_name'] == $v['option'] ){ echo ' selected ';} ?> ><?php echo $v['name'];?></option>
					<?php
				}
				?>
				</select>
				<div class="remark" >
				选择范围后，该配置信息只可在选择的组件下使用.
				</div>
			</td>
		</tr> 
	</table>

	<input type="button" class="btn" value="添加选项" onclick="addSpec();" />
	
		<table class="listtable spec moveordertable"     > 

 		<tr >
			<th>选项字段</th>
			<th>选项名称</th>
			<th>选项方式</th> 
			<th>选项值信息</th>
			<th>提示备注</th>
			<th>操作</th> 
		</tr>	
		
		<?php
		if( $item['id'] ){
			//$model = &$this->getModel();
			$attr = unserialize($item['attr_group']);
			$data = array(
				0=>'文本框',
				1=>'下拉框',
				2=>'单选项',
				3=>'多行文本',
				5=>'高级编辑器',
			);
			 $attr['opt_field']=(array)$attr['opt_field'];
			
 			foreach( $attr['opt_field'] as $k=>$v ){
				?>
				<tr>
					<td>
						<input type="text"  class="te"  name="opt_field[]" value="<?php echo $v;?>" size=15 />
					</td>
					<td>
						<input type="text"  class="te"  name="opt_name[]" value="<?php echo $attr['opt_name'][$k];?>" size=20 />
					</td>
					<td>
						<?php
						echo Form::dropdown('opt_way[]',$data,$attr['opt_way'][$k]);
						?>
					</td>
					<td>
						<input type="text"  class="te"  name="opt_value[]" value="<?php echo  $attr['opt_value'][$k];?>" size=50 />
					</td>
 					<td>
						<input type="text"  class="te"  name="opt_remark[]" value="<?php echo  $attr['opt_remark'][$k];?>" size=20 />
					</td>
					<td><a href="javascript:;;" onclick="delRows(this.parentNode,0);" >删除</a><input type="hidden" name="spec_id_list[]" value="<?php echo $v['spec_value_id'];?>" />
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

	function delRows(obj,n){
		$(obj.parentNode).remove();
	}
</script>