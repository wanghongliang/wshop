//取页面宽度
var isIE = document.all;
function clint( win )
{

	var clientHeight=0;
	var width  = document.body.clientWidth;
    if(document.body.clientHeight&&document.documentElement.clientHeight)
    {
		clientHeight = (document.body.clientHeight<document.documentElement.clientHeight)?document.body.clientHeight:document.documentElement.clientHeight;

    }
    else
    {
       clientHeight = (document.body.clientHeight>document.documentElement.clientHeight)?document.body.clientHeight:document.documentElement.clientHeight;
    }

    var scrollTop=0;
    if(document.documentElement&&document.documentElement.scrollTop)
    {
        scrollTop=document.documentElement.scrollTop;
    }
    else if(document.body)
    {
        scrollTop=document.body.scrollTop;
    }

	var page_h = Math.max(document.body.scrollHeight,document.documentElement.scrollHeight);
	return {w:width,h:clientHeight,t:scrollTop,ph:page_h}
}



/** 创建对话框，并解析对话框  ***/
var div;
var mask;

function closeDialog(){
	//mask.hide();
	div.hide();
}

//打开并向内容框加入HTML内容
function openDialog(t,uri,w,h){
	var s=clint();

 	if( div ){
		//$(mask).show();
		$(div).show();
	}else{
		//mask = $('<div class="mask" ></div>');
		div = $('<div class="dialog" ><div class="b" ><div class="t" ><a href="javascript:;;" class="dclose">关闭</a><div class="h3" ></div></div><div class="con" ></div></div></div>');
		//$(document.body).append(mask.get(0));
		$(document.body).append(div.get(0));
		//mask.css('height',s.ph).click(function(){  closeDialog(); });
		$('.dclose',div).click(function(){ closeDialog(); });
	}
	if( w ){ div.css('width',w); }
	//if( h ){ $('.b',div).css('height',h); }

	var top = s.h/2-div.height()/2 + s.t -10;
	if( top<10 ){ top=10; }
	div.css('left',s.w/2-div.width()/2);
 	div.css('top', top  );

	loading();

	$('.h3',div).html(t);
	$.get(uri,function(data){
		$('.con',div).html(data);
		var top = s.h/2-div.height()/2 + s.t -10;
		div.css('top', top  );
	});
}
function loading(){
	$('.con',div).html('<div class="loading"></div>');
	//$('.loading',div).height( $(div).height()-20  );
}

//收藏产品
function addFav(id){
	openDialog('','/index.php?com=users&view=fav&act=add&no_html=1&pid='+id,260,100);
}



$(function(){

	//所有产品分类去最后底线
	$('#typemenu li:last').css('border-bottom','none');	

	//头部搜索事件
	$('#keywords').css('color','#999');
	var keyval = $('#keyword').val();
	$('#keyword').focus(function(){
		if ($(this).val() == keyval){
			$(this).val('');
			$(this).css('color','#333');
		}
	});

	$('#keyword').blur(function(){
		if($(this).val() == ''){
			$(this).val(keyval);
			$(this).css('color', '#999');
		}
	});
	//搜索按钮
	$('#psbtn').click(function(){
		//alert( $('#sfm').get(0) );
		var k = $('#keyword').val();
		if( $.trim(k) == keyval ){
			k = '';
		}

		if( k == '' ){ alert(' 请输入关键字! '); $('#keyword').val(''); $('#keyword').get(0).focus(); return false; }

		searchsubmit(k);

	});	
	
	$('.gocity').hover(function(){
		$('.citylist').stop(true,true).fadeIn("fast");
	},function(){
		$('.citylist').stop(true,true).fadeOut("fast");

	});

	jQuery("#pcart").hover(function(){
		jQuery(".clist").fadeIn("show");
	},
	function(){		
		jQuery(".clist").hide();		
	});
 
 
	//所有商品分类收缩
 
	$(".opencat").hover(function(){
		$("#typemenu").stop(true, true).show();
		//$("#typetitle").css('background-position','left top');
	},function(){
		$("#typemenu").stop(true, true).hide();
		//$("#typetitle").css('background-position','-200px top');
	});




});

//提交搜索
function searchsubmit(k){
	k = encodeURI(k);
	var f = $('#sfm');
	var uri = f.attr('action');
	if( uri.indexOf('k=') != -1 ){
		uri = uri.substring(0,uri.indexOf('k='))+k;
	}else{
		uri += '&k='+k;
	}
	f.attr('action',uri);
	f.submit();
}


//删除购物车中的产品
function delcart(obj,id){
	//$(obj).parent().parent().remove();
	$(obj).parent().parent().remove();
	$.get('/index.php?com=cart&act=delete&no_html=1&id='+id,function(data){
		//alert(data);
		var n=0,total=0;

		if( !$('.clist dd').get(0) ){
			$('.clist dl').html('<div align=center >暂无商品</div>');
		}else{

			$('.clist dd').each(function(k,o){
				n++;
				total+=parseInt( $(o).attr('pe') );
			});
			//alert(n+':'+total);
		}	
		$('.totalPrice').html(total);
		$('.cartnum').html(n);
	});
}


 //设置COOKIE  //liuliqiang 增加设置path，使各目录能取到相同的COOKIE
function SetCookie(name,value){var exp=new Date();exp.setTime(exp.getTime()+24*3600000);document.cookie=name+"="+escape(value)+";expires="+exp.toGMTString()+";path=/";}
//获得COOKIE
function GetCookie(name){var arr=document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));if(arr!=null){return unescape(arr[2]);}else{return "";}}
//删除COOKIE
function delCookie(id)
{
	var cooks=GetCookie("listhc").split("/"),dstr="";
	for(var i=1;i<cooks.length;i++){if(cooks[i].split("_")[0]!=id){dstr+="/"+cooks[i];}}
	SetCookie("listhc",dstr);
}
