<?php
/**
 * 此样式是由FLASH切换
 */


 	/** 是否输出带标题的广告内容 **/
	if( $params['showtitle'] == '1' ){
		?>
		<div  class="mod <?php echo $params['moduleclass_sfx']?>"   id="<?php echo $module->module,'-',$module->id;?>" >
			<dl>
				<dt>
					<span>
						<span>
						<?php
						if( $params['titlelink'] ){
						?>
							<a href="<?php echo $params['titlelink'];?>" >	
							<?php
								echo $module->title;
							?>
							</a>
						<?php
						}else{
 							?>
							<span class="a" >
							<?php echo $module->title; ?>
							</span>
							
						<?php
						}
						?>
						</span>
					</span>
				</dt>
				<dd>
	<?php 
		global $app;
		$baseurl = '/preview';

 

		//banner模块相关信息类
		$w = $params['width'];
		$h = $params['height'];
	  
		$w = $w?$w:'960';
		$h = $h?$h:'160';
		//图片总数量
		$num =count($list);
		
	//print_r($list);
		 ?>

		<script type="text/javascript">
		

		<?php /***
		var swf_width=<?php echo $w;?>;
		var swf_height=<?php echo $h;?>;
		var files='<?php 

		$i=0;
		foreach($list as $item ){ echo  $item['img']; 
			if( ++$i < $num ){
				echo '|';
			}
		 }?>';

		var links='<?php 
		$i=0;
		foreach($list as $item ){
			$link = Router::_( 'index.php?com=banners&task=click&bid='. $item['id'] );
			echo $link; 
			if( ++$i < $num ){
				echo '|';
			}
		 }?>'
		var texts='<?php 
		$i=0;
		foreach($list as $item ){
			//echo $item['name']; 
			if( ++$i < $num ){
				echo '|';
			}
		 }?>'

		document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="'+ swf_width +'" height="'+ swf_height +'">');
		document.write('<param name="movie" value="<?php echo $baseurl;?>/modules/mod_banners/media/bcastr3.swf"><param name="quality" value="high">');
		document.write('<param name="menu" value="false"><param name=wmode value="opaque">');
		document.write('<param name="FlashVars" value="bcastr_file='+files+'&bcastr_link='+links+'&bcastr_title='+texts+'">');
		document.write('<embed src="<?php echo $baseurl;?>/modules/mod_banners/media/bcastr3.swf" wmode="opaque" FlashVars="bcastr_file='+files+'&bcastr_link='+links+'&bcastr_title='+texts+'& menu="true" quality="high" width="'+ swf_width +'" height="'+ swf_height +'" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />'); document.write('</object>'); 

		***/
		?>

		<!--
		
		var focus_width=<?php echo $w;?>;
		var focus_height=<?php echo $h;?>;
		var text_height=18
		var swf_height = focus_height+text_height
		
		var pics='<?php
		$i=0;
		foreach($list as $item ){ echo  $item['img']; 
			if( ++$i < $num ){
				echo '|';
			}
		 }?>';
		var links='<?php 
		$i=0;
		foreach($list as $item ){
			//$link = Router::_( 'index.php?com=banners&task=click&bid='. $item['id'] );
			$link = $item['url'];
			echo $link; 
			if( ++$i < $num ){
				echo '|';
			}
		 }?>';
		var texts='<?php 
		$i=0;
		foreach($list as $item ){
 			echo $item['name']; 
			if( ++$i < $num ){
				echo '|';
			}
		 }?>';
		
		document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="'+ focus_width +'" height="'+ swf_height +'">');
		document.write('<param name="allowScriptAccess" value="sameDomain"><param name="movie" value="<?php echo $baseurl;?>/modules/mod_banners/media/flash01.swf"><param name="quality" value="high"><param name="bgcolor" value="#F0F0F0">');
		document.write('<param name="menu" value="false"><param name=wmode value="opaque">');
		document.write('<param name="FlashVars" value="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'">');
		document.write('<embed src="<?php echo $baseurl;?>/modules/mod_banners/media/flash01.swf" wmode="opaque" FlashVars="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'" menu="false" bgcolor="#F0F0F0" quality="high" width="'+ focus_width +'" height="'+ swf_height +'" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />');		
		document.write('</object>');
		
		//-->

		</script>



				</dd>
			</dl>
		</div>
		<?
	}else{
 	?>
	
	<div class="bannergroup <?php echo $params['moduleclass_sfx']?>">

		<?php 
		global $app;
		$baseurl = '/preview';

		//banner模块相关信息类
		$w = $params['width'];
		$h = $params['height'];
	  
		$w = $w?$w:'960';
		$h = $h?$h:'160';
		//图片总数量
		$num =count($list);
		
		//print_r($list);
		 ?>

		<script type="text/javascript">
  		var swf_width=<?php echo $w;?>;
		var swf_height=<?php echo $h;?>;
		var files='<?php 

		$i=0;
		foreach($list as $item ){ echo  $item['img']; 
			if( ++$i < $num ){
				echo '|';
			}
		 }?>';

		var links='<?php 
		$i=0;
		foreach($list as $item ){
			$link = Router::_( 'index.php?com=banners&task=click&bid='. $item['id'] );
			echo $link; 
			if( ++$i < $num ){
				echo '|';
			}
		 }?>'
		var texts='<?php 
		$i=0;
		foreach($list as $item ){
			//echo $item['name']; 
			if( ++$i < $num ){
				echo '|';
			}
		 }?>'

		document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="'+ swf_width +'" height="'+ swf_height +'">');
		document.write('<param name="movie" value="<?php echo $baseurl;?>/modules/mod_banners/media/bcastr3.swf"><param name="quality" value="high">');
		document.write('<param name="menu" value="false"><param name=wmode value="opaque">');
		document.write('<param name="FlashVars" value="bcastr_file='+files+'&bcastr_link='+links+'&bcastr_title='+texts+'">');
		document.write('<embed src="<?php echo $baseurl;?>/modules/mod_banners/media/bcastr3.swf" wmode="opaque" FlashVars="bcastr_file='+files+'&bcastr_link='+links+'&bcastr_title='+texts+'& menu="true" quality="high" width="'+ swf_width +'" height="'+ swf_height +'" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />'); document.write('</object>'); 
 
		</script>
		</div>

<?php
}
?>