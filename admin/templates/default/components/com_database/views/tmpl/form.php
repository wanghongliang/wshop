<?php

?>
<form action="index.php?com=modules&no_html=1"  method="post"  id="menage_form"  >


	<table class="innerform"  >

		<tr class="style1" >
			<td class="form_text" colspan=2 >
			参数配置 
			</td>
		</tr>
		<tr>
			<td class="form_text" colspan=2 >
			<?php
			echo $item['parameter'];
			?>
			</td>
		</tr>

		<tr class="style1" >
			<td class="form_text" >模块标题</td>
			<td>
				<input type="text" id="title"  name="title" size=50 value="<?php echo $item['title'];?>" />
			</td>
		</tr>

		<tr class="style1" >
			<td class="form_text" >模块位置</td>
			<td>
				<input type="text" id="position"  name="position" size=50 value="<?php echo $item['position'];?>" />
			</td>
		</tr>

		<?php if( $item['id']>0 ){?>
		<tr class="style1" >
			<td class="form_text" >模块排序</td>
			<td>
				<input type="text" id="ordering"  name="ordering" size=50 value="<?php echo $item['ordering'];?>" />
			</td>
		</tr>
		<?php } ?>

		<tr class="style1" >
			<td class="form_text" >是否发布</td>
			<td>
				<input type="radio" id="published"  name="published"  value="0" <?php echo $item['published']==0?'checked':''; ?> /> 不发布

				<input type="radio" id="published"  name="published"  value="1" <?php echo $item['published']==1?'checked':''; ?> /> 发布
			</td>
		</tr>
		<tr>
			<td  class="form_text" >模块自定义内容</td>
			<td>
			<?php
			import('html.editor');
			$editor = Editor::getInstance($GLOBALS['config']['editor']);
			$editor->display('content',$item['content'],'500','200');
			?>
 			</td>
		</tr>


 
		
		<tr>
			<td colspan=2 >
				<?php /**<input type="button" class="submit_btn" post="#menage_form" url="index.php?com=modules&no_html=1" value="提交" />

				**/
				?>
				<input type="submit"  value="提交" />
				<input type="button" id="cancel_btn"  value="取消" />
				<input type="hidden" value="<?php echo $item['module'];?>" name="module" id="module" />

				<input type="hidden" value="save" name="task" id="task" />
				<input type="hidden" value="<?php echo $item['id'];?>" name="id" />
				<input type="hidden" value="<?php echo $this->menuid;?>" name="menuid" />
				<input type="hidden" value="" name="return" id="return"  />
			</td>
		</tr>

	</table>
</form>

<script language="javascript" >
 	$(function(){
		$('.submit_btn').wDialog({onsuccess:function(){
 			setTimeout(function(){ $.w.closeDialog(); },300);
		}});
 
		$('#cancel_btn').click(function(){	
			$.w.closeDialog();
 		});
	});
</script>