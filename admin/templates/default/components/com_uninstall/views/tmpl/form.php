<?php

?>
<form action="index.php?com=contents&tmpl=component"  method="post"  id="menage_form"  >
	<table class="formtable" >
		<tr class="style1" >
			<td class="form_text" >文章标题</td>
			<td>
				<input type="text" id="title"  name="title" size=50 value="<?php echo $item['title'];?>" />
			</td>
		</tr>
		<tr>
			<td  class="form_text" >文章内容</td>
			<td>
				<textarea cols=60 rows=6 name="fulltext" ><?php echo $item['fulltext'];?></textarea>
			</td>
		</tr>


 
		
		<tr>
			<td colspan=2 >
				<input type="button" id="submit_btn"  value="提交" />
				<input type="button" id="apply_btn"  value="应用" />
				<input type="button" id="cancel_btn"  value="取消" />


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
  
		$('#submit_btn').click(function(){	
			$('#menage_form').get(0).submit();
 		});

		$('#apply_btn').click(function(){	
			$('#return').attr('value','<?php echo URI::current();?>');
			$('#menage_form').get(0).submit();
 		});

		$('#cancel_btn').click(function(){	
			location.href='index.php?com=contents&tmpl=component&menuid=<?php echo $this->menuid;?>';
 		});
	});
</script>