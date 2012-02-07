<?php

include($this->path.DS.'tmpl'.DS.'toolbar.php');

?>
<div class="create_body">
	<div class="message" style="display:none;" ></div>
	<ul>
	<?php
	foreach( $lists as $k=>$row ){
		?>
		<li>
		<a href="index.php?com=create_html&task=edit&act=<?php echo $k;?>" >
		<?php
			echo $row['text'];
		?>
		</a>

		</li>
		<?php
	}
	?>
	</ul>
</div>
 

<script language="javascript" >
 
 	$(function(){
		//首页静态页生在
		var create_home_url = 'index.php?com=create_html&task=create&act=home&no_html=1';
		$('.btn_save').click(function(){	
 			$.get(create_home_url,function(data){
				$('.message').show();
				$('.message').html(data);
			});
 		});


		var delete_home= 'index.php?com=create_html&task=deleteall&no_html=1';
		$('.btn_delele').click(function(){
			$.get(delete_home,function(data){
				$('.create_body').html(data);
			});
		});
 	});
</script>