<?php
/**
 * 此样式是由FLASH切换
 */



//banner模块相关信息类
$w = $params['width'];
$h = $params['height'];

$w = $w?$w:'100%';
$h = $h?$h:'160';


global $app;
$baseurl = '/preview/templates/'.$app->getTemplate();
 
$params = (array)unserialize( $list['params'] ); 
?>


<div id="thumbs">
<script type="text/javascript">
	$(function(){
		$("#KinSlideshow").KinSlideshow({
				moveStyle:"right",
				isHasTitleBar:false,
				isHasTitleFont:false,
				intervalTime:4,
				moveSpeedTime:300,
				mouseEvent:"mouseover",
				btn:{btn_bgColor:"#FFFFFF",btn_bgHoverColor:"#f60",btn_fontColor:"#000000",btn_fontHoverColor:"#FFFFFF",btn_borderColor:"#dcdcdc",btn_borderHoverColor:"#f60",btn_borderWidth:1}
		});
	});
</script>
	<script src="<?php echo $baseurl;?>/js/jquery.KinSlideshow-1.2.1.min.js" type="text/javascript"></script>
	<div id="KinSlideshow" style="visibility:hidden;">
		<?php
		foreach($params as $item ){
			$link = $item['http'];//Router::_( $item['http'] );//'#';// Router::_( 'index.php?com=banners&task=click&bid='. $item['id'] );
			//$type = substr($item['img'],-3);
			//switch($type){
			//	case 'swf':
			//		echo '<li class="click" ><a href="'.$link.'" target=_blank ><script>flash("'.$item['img'].'","'.$w.'","'.$h.'","");</script></a></li>';
			//		break;
			//		default:
			echo '<a href="'.$link.'"  target="_blank"  ><img src="'.$item['thumb'].'" alt="'.$item['title'].'" width="'.$w.'"  height="'.$h.'" /></a>';

			//}
		}
		?>
	</div>

</div>