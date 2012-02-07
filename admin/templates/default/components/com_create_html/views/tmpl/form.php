<?php

include($this->path.DS.'tmpl'.DS.'toolbar_form.php');

?>
<div class="create_body">
	<div class="message" style="display:none;" >
	
	</div>
	<ul class="data" >
		<?php
		foreach( $item['data'] as $k=>$row ){
			?>
			<li url="<?php echo $row['url'];?>" page="<?php echo $row['page'];?>" >
			<?php
				echo $row['text'];
			?>
			&nbsp;<?php echo $row['url'];?>
			<span class="info" ></span>
			<div class="info_page" ></div>
			</li>
			<?php
		}
		?>
	</ul>

	<?php
	//print_r($item);
	?>
</div>
 

<script language="javascript" >
 	
	var url = [];
	var url_page =[];
	function goURL(k){
		if( k > url.length || !url[k]){
			//alert('完成!');
			
			$('.message').html('所有分类页已生成完成！');
			$('.message').show();
 			getUrlPage(0,2);
 			return;
		}

 		$.get(url[k],function(data){
			$('.info',$('.data li').get(k)).html( data );
			goURL(k+1);
		});
	}

 

	//k为列表，p为列表的页面
	function getUrlPage(k,p){

		if( k > url.length || !url[k]){
			//alert('完成!');
			$('.message').html( $('.message').html()+'<br/>所有分类的内页已生成完成！' );
 			return;
		}
		
		if( parseInt(p) > parseInt(url_page[k]) || !parseInt(url_page[k]) ){
			p=2;
			k +=1;
			return getUrlPage(k,p);
		}

		//alert(url_page[k]);
		$.get(url[k]+'?page='+p,function(data){
			$('.info',$('.data li').get(k)).html( data );
			getUrlPage(k,p+1);
		});
	}

 	$(function(){
		//首页静态页生在
		var create_home_url = 'index.php?com=create_html&task=start&no_html=1';
		$('.btn_save').click(function(){
			/**
 			$.get(create_home_url,function(data){
				$('.create_body').html(data);
			});
			**/

			$('.data li').each(function(k,obj){
				url[k] =create_home_url + '&url='+$(obj).attr('url');
				url_page[k]=parseInt($(obj).attr('page'));
			});
			goURL(0);
 		});
 

		$('.cancel_btn').click(function(){	
			location.href='index.php?com=create_html<?php if( $_REQUEST['tmpl']== 'component' ){ echo "&tmpl=component";}?>&menuid=<?php echo $this->menuid;?>';
 		});
	});
</script>