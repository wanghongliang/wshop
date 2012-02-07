$(function(){
	///«–ªª√¸¡Ó∞¥≈•
	$('.switch_btn li').each(function(k,obj){
		var con = $('.switch_con .con');
		$(obj).click(function(){
			con.hide();
			$('.switch_btn li').removeClass('active');
			$(con[k]).show();
			$(obj).addClass('active');
		});
	});
});
function clint()
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
function ajaxMessage(){
	var panel = $('#am').get(0);
	if( !panel ){
		//alert('LOAD.');
		$('body').append('<div id="am" ></div>');
		panel = $('#am').get(0);
	}
	var s = clint(); 

	
	//$(obj).css('top',s.h/2-$(obj).height()/2 + s.t -10);
	var t = s.h/2-$(panel).height()/2 + s.t -10;
	t = t<1?0:t;
	$(panel).css({'top':t,'left':(document.body.clientWidth -$(panel).width()) /2});
	$(panel).show();
	
	return panel;

}