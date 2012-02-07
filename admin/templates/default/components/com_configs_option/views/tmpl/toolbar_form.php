<?php
 
?>


<div class="toolbar" >

	<ul class="com_ com_contents" >	
 
				<li   class='active_li'  > 
 									<?php 
				if( $item['attr_id'] > 0 ){
				?>
				编辑配置选项信息
				<?php }else{ ?>
				添加配置选项信息
				<?php } ?>
 				 </li> 
 
	</ul>
 
 <div class="clr" ></div>


<div class="editor-tabs" >
	<ul class="switch_btn" >
		<li class="active" >基本信息</li>
	</ul>
</div>

</div>
 

 <script language="javascript" >
var tr = ('<tr><td><input class="te" type="text" name="opt_field[]" value="" size=15 ></td><td><input class="te" type="text" name="opt_name[]" value="" size=20 ></td><td><select name="opt_way[]" ><option value=0 >文本框</optoin><option value=1 >下拉项</optoin><option value=2 >单选项</optoin><option value=3 >多行文本</optoin></select></td><td><input class="te" type="text" name="opt_value[]" value="" size=50 ></td> <td><input class="te" type="text" name="opt_remark[]" value="" size=25 ></td> <td><a href="javascript:;;" onclick="delSpec(this.parentNode,0);" >删除</a><input type="hidden" name="spec_id_list[]" value="" /></td></tr>');
				
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
 