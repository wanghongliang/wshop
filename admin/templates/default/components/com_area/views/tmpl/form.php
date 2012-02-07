<?php
include($this->path.DS.'tmpl'.DS.'toolbar_form.php');

?>
<form action="<?php if( $_GET['task'] == 'add' ){ echo 'index.php?com=area';}else{ echo 'index.php?com=area&no_html=1';} ?>"  method="post"  id="menage_form"  >
	<table class="formtable" >
 

		<tr>
			<td  class="form_text" >区域名称</td>
			<td>
				<input type="text" name="name" size=30 value="<?php echo $item['name'];?>" />
			</td>
		</tr> 
		<tr>
			<td  class="form_text" >区域别名</td>
			<td>
					<input type="text" id="alias" name="alias" size=30 value="<?php echo $item['alias'];?>"  <?php if( !$item['alias'] ){ echo 'readonly';}?>   />
					<input type="checkbox" name="autoalias" s value="1" <?php if( !$item['alias'] ){ echo 'checked';}?>  onclick='if(this.checked){ $("#alias").get(0).setAttribute("readOnly","true");  }else{ document.getElementById("alias").removeAttribute("readOnly");    }' /> 自动生成
			</td>
		</tr>


		<tr>
			<td  class="form_text" >父区域</td>
			<td>
				<?php echo $pid;?>
			</td>
		</tr>	
 

 
  
	</table>			
	<div class="formbtn" >
				<input type="button" class="submit_btn"  value="提交" />
				<input type="button" class="apply_btn"  value="应用" />
				<input type="button" class="cancel_btn"  value="取消" />
				<input type="hidden" value="save" name="task" id="task" />
				<input type="hidden" value="<?php echo $item['id'];?>" name="id" />
				<input type="hidden" value="<?php echo $this->menutypeid;?>" name="mtid" />
				<input type="hidden" value="" name="return" id="return"  />
				
				<input type="hidden" value="<?php echo $item['type'];?>" name="type" />
				<input type="hidden" value="<?php echo $item['com'];?>" name="component" />
				<input type="hidden" value="<?php echo $item['view_path'];?>" name="view_path"  />

				<?php //用于保存转移当前菜单内容的方式和菜单ID?>
				<input type="hidden" value="<?php echo $_REQUEST['shiftway'];?>" name="shiftway" />
				<input type="hidden" value="<?php echo $_REQUEST['shiftmenuid'];?>" name="shiftmenuid" />
	</div>

</form>

<script language="javascript" >
 	var url_current ='<?php echo URI::current();?>';

 	$(function(){
  
 
		$('.submit_btn').click(function(){	
		
			if( submitCheck() ){
				$('#menage_form').get(0).submit();
			}
 		});

		$('.apply_btn').click(function(){	
 			$('#return').attr('value',url_current);
			$('#menage_form').get(0).submit();
 		});
		$('.cancel_btn').click(function(){	
			<?php if( $_GET['task'] == 'add' ){  ?>location.href='index.php?com=area' <?php }else{ echo 'parent.$.w.closeDialog();';} ?>
 
 		});
	});

	function submitCheck()
	{
		if( $('#menu_item').get(0) ){
 			if( parseInt($('#menu_item').attr('value')) < 1 ){ 
				alert('请选择菜单.');	
				return false; 
			}
		}


		return true;
	}

	/** 选择组件布局类型时，需要提交刷新表单 **/
	function submit(href,task)
	{
		//alert($('input[name=shiftway]').get(0).value);
		$('#menage_form').get(0).action=href;
		$('input[name=task]').attr('value',task);
 		$('#menage_form').get(0).submit();
	}
</script>