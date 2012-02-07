<?php
if( $_POST['mode'] == 'flash' ){
	echo 's:'.$lists['uri_path'].':'.$_REQUEST['iname'];
}else{
?>
<div class="db-padding10" >
<h1 >
	上传成功!
</h1>
</div>
<script>
	if( window.parent ){	//如果是弹出子框，将关闭
		iframe = window.parent;
		iframe.uploadSuccess('<?php echo $_REQUEST['iname'];?>','<?php echo $lists['uri_path'];?>');
	} 
</script>
<?php
}
?>
 