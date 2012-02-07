<?php
include($this->path.DS.'tmpl'.DS.'toolbar_form.php');
?>
<div class="clr" ></div>
<form action="<?php echo $this->baseuri;?>"  method="post"   id="menage_form"  >
	<table class="formtable" >
		<tr>
			<td class="form_text" >问答标题</td>
			<td>
				<input type="text" name="title" size=80 value="<?php echo $item['title'];?>" />
			</td>
		</tr> 
		
 
		<tr>
			<td class="form_text" >是否显示</td>
			<td>
				<?php echo Form::radio('published',0,($item['published']==0) );; ?> 不显示
				&nbsp; <?php echo Form::radio('published',1,($item['published']==1));; ?> 显示
  
			</td>
		</tr> 
 

		<tr>
			<td class="form_text" >排序值</td>
			<td>
				<input type="text" name="ordering" size=5 value="<?php echo $item['ordering'];?>" />
			</td>
		</tr> 


	</table>		


		<input type="button" class="btn" value="添加问答选项" onclick="addSpec();" />
	
		<table class="listtable spec moveordertable"     > 

 		<tr >
			<th>选项标题</th>
			<th>是否默认</th> 
			<th>操作</th> 
		</tr>	
		
		<?php
			$spec = (array)unserialize( $item['contents'] );
			$defaulted = (int)$item['defaulted']; //默认的ID信息
 
  			foreach( $spec as $k=>$v ){
				?>
				<tr>
					<td>
						<input type="text"  class="te"  name="value[]" value="<?php echo $v;?>" size=80 />
					</td>
					<td>
						<input type="radio" value="<?php echo $k;?>" name="defaulted" <?php echo $k==$defaulted?' checked ':'';?> />
					</td>
					<td>
						<a href="javascript:;;" onclick="delSpec(this.parentNode,0);" >删除</a><input type="hidden" name="spec_id_list[]" value="<?php echo $v['value_id'];?>" />
					</td>
				</tr>
				<?php
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
		<input type="hidden" value="<?php echo $item['id'];?>" name="id" />
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
var tr = ('<tr><td><input class="te" type="text" name="value[]" value="" size=80 ></td><td><input type="radio" value="0" name="defaulted" /></td> <td><a href="javascript:;;" onclick="delSpec(this.parentNode,0);" >删除</a><input type="hidden" name="spec_id_list[]" value="" /></td></tr>');
				
function addSpec(){
	$('.spec').append(tr);
	orderTable();
}

function delSpec(obj,id){
	 if(confirm('确实要删除吗?')){ 
		 $('input',obj.parentNode).each(function(k,obj){
			  
			 //$('.deleteFrom').append(obj);
			 
		 });
			
		//$('.deleteFrom input[type=text]').each(function(k,obj){
		//	$(obj).val('');
		//});
		 
		 
		// $('.deleteFrom .te').attr('value','');
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
 