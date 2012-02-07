<?php
$baseurl = '/'.$GLOBALS['config']['preview_directory'].'/'.URI_DIRECTORY.'/'.$app->getTemplate();
?>
<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>/css/questions.css" />

<div class="q_box">

<form action="" method="post" >
<div class="questions" >
<h2>请回答下面的问题，然后提交:</h2>
<?php
foreach( $this->questions as $k=>$v ){

	//相关选项
	$options = unserialize( $v['contents'] );
	echo "<dl><dt class='t' >".$v['title']."</dt><dd>";
	echo '<ul>';
	foreach( $options as $x=>$y ){
?>
	<li><input type="radio" class="radio" name="q<?php echo $v['id'];?>" value="<?php echo $x;?>" /><?php echo $y;?></li>
	
<?php
	}
	echo '</ul></dd></dl>';
}
?>

<input type="submit" value="提交" />
<input type="hidden" name="a" value="answer" />
</div>
</form>

</div>

<style type="text/css" >
.questions{ margin:10px 0px 0px 0px; }
.questions h2{ line-height:35px; }
.questions .t{ font-size:14px; color:#333; }
.questions ul li{ line-height:25px; color:#777; }
.questions .radio{ vertical-align:middle;margin:0px 10px 0px 10px; }
.questions dl{ margin:10px 0px; }
.questions dl dt{ font-weight:bold; }
</style>