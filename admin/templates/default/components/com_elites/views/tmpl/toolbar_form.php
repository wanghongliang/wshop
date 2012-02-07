<?php
 
?>


<div class="toolbar" >

	<ul class="com_ com_contents" >	
 
				<li   class='active_li'  > 
 									<?php 
				if( $item['attr_id'] > 0 ){
				?>
				编辑规格信息
				<?php }else{ ?>
				添加规格信息
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
 
<style type="text/css" >
.deleteFrom{ display:none;}
</style>
 <script language="javascript" >
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
 