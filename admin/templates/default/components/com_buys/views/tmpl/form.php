<?php
include($this->path.DS.'tmpl'.DS.'toolbar_form.php');
import('html.editor');
import('html.form');
$editor = Editor::getInstance($GLOBALS['config']['editor']);
?>
<form action="index.php?com=contents"  method="post"  id="menage_form"  >
  <div class="switch_con" >
	<ul >
	<li class="active con" >
	<table class="formtable" >
		<tr class="style1" >
			<td class="form_text" width=12%  >文章标题</td>
			<td width=40% >
				<input type="text" id="title"  name="title" size=80 value="<?php echo $item['title'];?>" />
			</td>

			<td class="form_text" width=3% >属性</td>
			<td>
				<?php
				echo Form::dropdown('attr',$attr,$item['attr']);
				?>
			</td>
		</tr>

		<?php
		$lt = HTML::getLT();
		foreach( $lt as $k=>$t )
		{
		?>
			<tr  class="style1">
				<td  class="form_text" >
					<?php echo $t;?>
				</td>
				<td colspan=3 >
					<input type="text" name="title<?php echo $k;?>" size=90 value="<?php echo $item['title'.$k];?>" />
				</td>
			</tr>
		<?php
		}
		?>

 		<tr>
			<td  class="form_text" >相关附件/图片</td>
			<td colspan=3  >
 				<input type="text" id="images"  name="images" size=30 value="<?php echo $item['images'];?>" />
				<input type="button" name="" value="上传" onclick="upload('images')" />
				<input type="button" name="" value=".." onclick="selectImage('images')" />
			</td>
		</tr>
		<tr>
			<td  colspan=4 >
				内容：<br>
				<?php
				echo $editor->display('content',$item['content'],'100%','400');
				?>
			</td>
		</tr>
 

 
	 
 
	</table>
	<input type="hidden" value="save" name="task" id="task" />
	<input type="hidden" value="<?php echo $item['id'];?>" name="id" />
	<input type="hidden" value="<?php echo $this->menuid;?>" name="menuid" />
	<input type="hidden" value="" name="return" id="return"  />
	<input type="hidden" value="<?php echo $_REQUEST['tmpl'];?>" name="tmpl" />

	</li>
	<li class="con" >
		<table class="formtable " >
		<tr  >
			<td class="form_text" width=12%  >关键字</td>
			<td>

				<input  name="metakey" value="<?php echo $item['metakey'];?>" size=80 /> 

				
			</td>
		</tr>
		<?php
		foreach( $lt as $k=>$t )
		{
		?>
		<tr  >
			<td class="form_text"  ><?php echo $t;?></td>
			<td colspan=3  >
			<input  name="metakey<?php echo $k;?>" value="<?php echo $item['metakey'.$k];?>" size=80 /> 
 				</td>
			</tr>
		<?php
		}
		?>


 		<tr>
			<td  class="form_text" >描述信息</td>
			<td colspan=3  >
 		      <textarea cols=80 rows=5 name="metadesc" ><?php echo $item['metadesc'];?></textarea>
 			</td>
		</tr>
		<?php
		foreach( $lt as $k=>$t )
		{
		?>
		<tr  >
			<td class="form_text"  ><?php echo $t;?></td>
			<td colspan=3  >
 			 <textarea cols=80 rows=5 name="metadesc<?php echo $k;?>" ><?php echo $item['metadesc'.$k];?></textarea>
 				</td>
			</tr>
		<?php
		}
		?>

		</table>
	</li>
	</ul>
</div>

</form>

<script language="javascript" >
 	$(function(){
		$('.submit_btn').click(function(){
 			$('#menage_form').get(0).submit();
			return true;
 		});

		$('.apply_btn').click(function(){	
			$('#return').attr('value','<?php echo URI::current();?>');
			$('#menage_form').get(0).submit();
 		});

		$('.cancel_btn').click(function(){	
			location.href='index.php?com=contents<?php if( $_REQUEST['tmpl']!= '' ){ echo "&tmpl=".$_REQUEST['tmpl'];}?>&menuid=<?php echo $this->menuid;?>';
 		});
	});
</script>