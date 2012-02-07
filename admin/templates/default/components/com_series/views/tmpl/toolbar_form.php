<?php
$lt = HTML::getLT();
foreach( $lt as $k=>$t )
{
	$lan_string .=",[".$k.",'".trim($t)."']";
}
$lan_string = '['.trim($lan_string,',').']';
?>
<div class="toolbar" >
<script language="javascript" >


<?php

/**
if( count($acctype) > 0 ){
    $script_type = array();
	foreach( $acctype as $type ){
		$script_type[$type['language_id']] .= ',"'.$type['type'].'"';
	}
	
 	foreach( $script_type as $k=>$v ){
		$script_string .=',['.$k.','.trim($v,',').']';
	}
	$script_string = '['.trim($script_string,',').']';
}

**/

?>


//var script_option = <?php if( $script_string ){ echo $script_string; }else{ echo '[]'; } ?>;
var lan_arr = <?php if( $lan_string ){ echo $lan_string; }else{ echo '[]'; } ?>;

//alert(lan_string);

function getLanguage(n){
	var c = lan_arr.length;
  
	for(i=0;i<c;i++){
		if( lan_arr[i][0] == n ){
			return lan_arr[i][1];
		}
	}

	return '默认';
}
var script_type = new Array(<?php echo trim($script_type,',');?>);
	$(function(){
 
		///切换命令按钮
		$('.com_contents li').each(function(k,obj){
 			var con = $('.form_content li');
			$(obj).click(function(){
				$('.com_contents li').removeClass('active_li');
			    $(this).addClass('active_li');
				con.hide(); 
				$(con[k]).show();
 
			});
		});
		


		$('.addacc').click(function(){
			var name = $('.download_name').val();
			var type = $('.selecttype').val();
			var lan  = 0;
			$('input[name=lan]').each(function(){
				if( this.checked ){
					lan = this.value;
				}
			});
 
			//alert(lan);

		 
			if( !type   || type == 'add' ){
 		 
				 type = $('.download_type').val();
			}
			var file = $('.download_file').val();
			

			if( name && type && file ){

				$('.new_downloads').val($('.new_downloads').val()+','+name+'|'+type+'|'+file+'|'+lan);
				tr = ('<tr><td>'+name+'</td><td>'+type+'</td><td>'+file+'</td><td>'+getLanguage(lan)+'</td><td><a href="javascript:;;" onclick="delacc(this.parentNode,0);" >删除</a></td></tr>');
				$('.acc').append(tr);
				



				var ordering = '';
				$('.acc tr').each(function(k,obj){
				 
					//alert(obj.children[0].nodeName);
					if( obj.children[0].nodeName == 'TD' ){
						var s = obj.children[0].innerHTML;
						ordering += ','+k+'|'+s;
					}
				});

				$('.downloads_ordering').val(ordering);

			}else{
				alert(' 请先添加附件信息！');
			}

		});




	});


 	function delacc(obj,id){
 		 if(confirm('确实要删除吗?')){
			 var uri = "<?php echo $this->baseuri;?>&no_html=1&task=accessories&act=del&file_id="+id;
				$.get(uri,function(data){
					//alert('删除成功！');
					$(obj.parentNode).remove();
				});
				//alert(uri);
				//alert(obj.parentNode.nodeName);
		 }
	}


	function selectTask(obj){
		if( obj.value=='add' ){
			$('.createtype').show();
		}else{
			$('.createtype').hide();
		}
	}
</script>

<style type="text/css" >
.createtype{display:none; padding:5px 0px; }
</style>


 <ul class="com_ com_contents">
	<li <?php if( $_GET['task'] == 'accessories' ){ echo ' class="normal_li" '; }else{ echo ' class="active_li" '; } ?> onclick=""  > 
		
				<?php 
				if( $_GET['id'] > 0 ){
				?>
 					编辑商品信息
 				<?php }else{ ?>
 				添加新商品信息
  				<?php } ?>
		
	</li>
</ul>
<div class="clr" ></div>
 
<div class="tackle" >

<ul class="tools tool_border"	>	

 	<li    > 
		<a  class="submit_btn btn_save"  >
		保存
		</a>
	</li>	
	<li    > 
		<a  class="apply_btn btn_apply"  >
		 应用
		</a>
	</li>
	
	<li    > 
		<a  class="cancel_btn btn_cancel"  >
		取消
		</a>
	</li>
</ul>
	<div class="clr" ></div>
</div>

 
</div>