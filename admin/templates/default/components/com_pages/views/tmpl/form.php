<?php
include($this->path.DS.'tmpl'.DS.'toolbar.php');

import('html.editor');
$editor = Editor::getInstance($GLOBALS['config']['editor']);
?>
<form action="index.php?com=pages"  method="post"  id="menage_form"  >

	<?php
	echo $editor->display('content',$item['content'],'100%','450');
	?>
	<input type="hidden" value="save" name="task" id="task" />
	<input type="hidden" value="<?php echo $item['id'];?>" name="id" />
	<input type="hidden" value="<?php echo $this->menuid;?>" name="menuid" />
	<input type="hidden" value="<?php echo $_REQUEST['mtid'];?>" name="mtid" />
	<input type="hidden" value="" name="return" id="return"  />
	<input type="hidden" value="<?php echo $_REQUEST['tmpl'];?>" name="tmpl" />
 
</form>

<script language="javascript" >
 
 	$(function(){
  
		$('.submit_btn').click(function(){	
			$('#menage_form').get(0).submit();
 		});
		$('.cancel_btn').click(function(){
			location.href='index.php?com=pages';
		});
 	});
</script>