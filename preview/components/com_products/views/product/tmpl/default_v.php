<?php
//基本URL信息
$baseurl = '/'.$GLOBALS['config']['preview_directory'].'/'.URI_DIRECTORY.'/'.$app->getTemplate();

//产品图片信息
$images = explode(',',$this->item['images']); 

$thumb = '';
foreach( $images as $k=>$img ){
	if( strpos($img,'|1') !== false ){
		$images[$k] = $thumb = substr($img,0,-2);
	}
} 

?>
<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>/css/bigimg.css" />
<div id="pcontent">
 
<div id="dtroot" style="padding:0px 0px 10px 0px;" >
<?php
$item	=& ModuleHelper::getModule('mod_breadcrumbs');
echo ModuleHelper::renderModule($item);
?>
</div>
    <div class="imgleft">
        <div class="imgtitle">
            <h1><?php echo $this->item['name'];?></h1>
            <a href="<?php $c = URI::current(); echo substr($c,0,strpos($c,'?'));  ?>" class="imgback">返回商品页</a>
        </div>
        <div id="imgshow">
            <p id="primg"><img src="<?php echo $thumb;?>" id="showimages" alt="" width=580 /></p>
            <p id="imgprev" class="prevno">上一张</p> <p id="imgnext" class="nextyes">下一张</p>
        </div>
        <p align="center"><a href="cart.php" title="立即购买"><img src="images/btngo.gif" alt="" /></a></p>
    </div>
    <div class="imgright">
        <h2 class="imgtitle2">全部图片 <span>（<?php echo count($images);?>张）</span></h2>
        <ul id="imgsmall">
		<?php
		foreach( $images as $k=>$img ){
		?>
			<li <? echo ($k==0)? ' class="now"':''; ?> ><img src="<?php echo $img;?>" alt="" width="70" height="70"/></li>
		<?php
		}
		?>
 
        </ul>
        <div id="imgpage"><a href="" id="pageprev">上一页</a> 1/1 <a href="" id="pagenext">下一页</a></div>
    </div>
 
</div>
<script>
$(function(){
    //点击上一张
    $('#imgprev').click(function(){
		var now = $('#imgsmall .now').get(0);
		//alert( $('#imgsmall li').index( $('.now').get(0) ) );
        var nums = $('#imgsmall li').index(now) - 1;
        setHoverImg(nums);
    });

    //点击下一张
    $('#imgnext').click(function(){
	
		var now = $('#imgsmall .now').get(0);
		//alert( $('#imgsmall li').index( $('.now').get(0) ) );
        var nums = $('#imgsmall li').index(now) + 1;
        setHoverImg(nums);
    });

    //单击缩略图
    $('#imgsmall li').click(function(){
        var nums = $(this).index('#imgsmall li');
        setHoverImg(nums);
    });

    //设置当前图片
    function setHoverImg(nums)
    { 
        var tols = $('#imgsmall li').length  - 1;
        if(nums<0 || nums>tols){
            return false;
        }
        //设置当前大图
        $('#showimages').attr('src', $('#imgsmall li').eq(nums).children('img').attr('src'));

        //设置小图焦点
        $('#imgsmall li').removeClass('now');
        $('#imgsmall li').eq(nums).addClass('now');

        //设置上一张按钮
        if(nums>0){
            changebtn('#imgprev', 'prev', true);
        }else{
            changebtn('#imgprev', 'prev', false);
        }

        //设置下一张按钮
        if(nums<tols){
            changebtn('#imgnext', 'next', true);
        }else{
            changebtn('#imgnext', 'next', false);
        }
    }

    //更改上下张图标
    function changebtn(obj, arr, flag)
    {
        if(flag){
            $(obj).removeClass(arr+'no');
            $(obj).addClass(arr+'yes');
        }else{
            $(obj).removeClass(arr+'yes');
            $(obj).addClass(arr+'no');
        }
        return true;
    }
});
</script>