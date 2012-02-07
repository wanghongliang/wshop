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
function loading(){ $('.con',div).html('<div class="loading"></div>'); 	$('.loading',div).height( $(div).height()-20  );	 }

//收藏产品
function addFav(id){
	openDialog('','/index.php?com=users&view=fav&act=add&no_html=1&pid='+id,260,100);
}



//得到当前选择的ID
function getIDS()
{
	ids = '';
 	$('.ids').each(function(k,obj){
		if (obj.checked )
		{
			ids +=','+ obj.value;
		}

	});
	if( !ids ){
		alert(' 请选择一项! ');
		return false;
	}
 	return ids.substring(1,ids.length);
}

$(function(){ 
	$('.selectall').click(function(){
  		$('.ids').attr('checked',this.checked);
	});
});

/** 删除所有提示 **/
function delall(href){ 
	ids = getIDS();	//ID字符串
	if( ids && confirm('确实要删除吗?') )
	{
		location.href=(href+'&ids='+ids);
	}
}
$(function(){

	var star_li;
	//点评的按钮
	$(".starRating li").mouseover(function(){
		$(".starRating li").each(function(k,obj){
			if(  this.className.substr(0,1) == 's'  ){
				obj.className = obj.className.substr(0,2);
			}
		});
		if(  this.className.substr(0,1) == 's'  ){
			this.className = this.className.substr(0,2)+'-on';
		}
 		$('.starRating .info').html($(this).attr('alt'));
	 
	}).mouseout(function(){
	 
		if(  this.className.substr(0,1) == 's'  ){
			this.className = this.className.substring(0,2);
		}
	
		//显示当前点击的等级
		if( star_li ){
			star_li.className = star_li.className.substr(0,2)+'-on';
			$('.starRating .info').html($(star_li).attr('alt'));
			$('#star').attr('value',$(star_li).attr('value'));
		}
	}).click(function(){
		star_li = this;
 
	});
});