<?
include($this->path.DS.'tmpl'.DS.'toolbar.php');

$num = (int)$type_params[0];
$width = (int)$type_params[1];
$height = (int)$type_params[2];
if( $num < 1 ){ $num = 1; }
if( $width<10 ){ $width = 100; }
if( $height<10 ){ $height = 100; }

?>
<div class="clr" ></div>
<form action="<?php echo $this->baseuri;?>"  method="post"  id="menage_form" name="listform" enctype="multipart/form-data" >

<table class="banner_form" width=100% >
<?php

$img_w = $width>300?300:$width;
//print_r($params);
for($i=0;$i<$num;$i++){ 
?>
<tr>
	<td>
		<?php echo $i+1;?>,
	</td>
	<td  class="banner_thumb"  >
		<?php
		if( $params[$i]['thumb'] ){
		?>	
			<img src="<?php echo $params[$i]['thumb'];?>" width=<?php echo $img_w; ?> />
		<?php
		}else{
		?>

		<div class="img" >无图</div>
		<?php }	?>
	</td>

	<td class="banner_in" >
		广告标题：<input type="text" name="title[]" size=30 class="text" value="<?php echo $params[$i]['title'];?>" />
		<br/>
		广告链接：<input type="text" name="http[]" size=60  class="text" id="http_<?php echo $i;?>" value="<?php echo $params[$i]['http'];?>" />
	 
		<br/>
		上传图片：<input type="file" name="thumb[]" />
		<input type="hidden" name="img[]"  value="<?php echo $params[$i]['thumb'];?>" />
		&nbsp; 宽 <?php echo $width;?>px &nbsp; 高 <?php echo $height;?>px
	</td>
</tr>
<?php
}
?>
</table>


	<input type="hidden" value="savebanner" name="task" id="task" />
 	<input type="hidden" value="<?php echo $item['id'];?>" name="id" />
	<input type="hidden" value="<?php echo $tid;?>" name="tid" />
	<input type="hidden" value="" name="return" id="return"  />
	<input type="hidden" value="<?php echo $width;?>" name="width"  />
	<input type="hidden" value="<?php echo $height;?>" name="height"   />
	<div class="formbtn" >
		<input type="button" class="submit_btn" value="保存"/>
 	</div>
</form>
<script language="javascript" >
var name;
 	$(function(){
		$('.submit_btn').click(function(){
 			$('#menage_form').get(0).submit();
			return true;
 		});
 
	});
	function setObject(n){ name= n; }
	function selectProduct(id,title,thumb,catid){
		try{ 
			$("#"+name).val('index.php?com=products&view=product&id='+id+'&catid='+catid); 
			$("#dialog").dialog("close");
		}catch(e){
		}
	}


</script>