<?
include($this->path.DS.'tmpl'.DS.'toolbar_form_component.php');
?>
<form action="<?php echo $this->baseuri;?>"  method="post"  id="menage_form" name="listform"  >

<div class="comment" >
	<b><?php echo $item['uname'];?></b>
	于  <?php echo $item['created'];?> 对 <b>"<?php echo $item['product_name'];?>"</b> 的商品评论
	<div>
	内容：	<?php echo $item['contents'];?>
	</div>
 
 
</div>

<?php
$user= $this->get('user');

?>
 
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
			location.href='index.php?com=evaluation<?php if( $_REQUEST['tmpl']== 'component' ){ echo "&tmpl=component";}?>';
 		});
	});
</script>