

//取页面宽度
var isIE = document.all;

function bookmarksite( url,title){
if(isIE)
	window.external.AddFavorite(url, title);
else if(window.sidebar)
	window.sidebar.addPanel(title, url, "")
}
function copyToClipBoard(text){
     if(window.clipboardData){//判断是否具有clipboardData对象，IE
         window.clipboardData.setData("Text",text);
     }else if(window.netscape){//判断是否存在netscape对象，FF
         try{//用try来尝试使用对象
             netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
         }catch(e){//如果不能使用剪贴板，提示用户出错
             alert('您的firefox安全限制限制您进行剪贴板操作。您可以点击下方的"分享到.."按钮或者\n请打开 "about:config" 将signed.applets.codebase_principal_support "设置为true" 之后重试');
             return false;
         }
         var clip,trans,str={},clipid;
         if(!(clip=Components.classes["@mozilla.org/widget/clipboard;1"].createInstance(Components.interfaces.nsIClipboard))) return;
         if(!(trans=Components.classes["@mozilla.org/widget/transferable;1"].createInstance(Components.interfaces.nsITransferable))) return;
         trans.addDataFlavor("text/unicode");
         str=Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
         str.data=text;
         trans.setTransferData("text/unicode",str,text.length*2);
         clipid=Components.interfaces.nsIClipboard;
         try{
             clip.setData(trans,null,clipid.kGlobalClipboard);
         }catch(e){return false}
     }
 
    alert("复制成功，请粘贴到你的QQ/MSN上推荐给你的好友");
}

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
	mask.hide();
	div.hide();
}
 
//打开并向内容框加入HTML内容
function openDialog(t,uri,w,h){
	var s=clint();

 	if( div ){
		$(mask).show();
		$(div).show();
	}else{
		mask = $('<div class="mask" ></div>');
		div = $('<div class="dialog" ><div class="t" ><a href="javascript:;;" class="dclose"></a><div class="h3" ></div></div><div class="con" ></div></div>');
		$(document.body).append(mask.get(0));
		$(document.body).append(div.get(0));
		mask.css('height',s.ph).click(function(){  closeDialog(); });
		$('.dclose',div).click(function(){ closeDialog(); });
	}	
	if( w ){ div.css('width',w); }
	if( h ){ div.css('height',h); }

	var top = s.h/2-div.height()/2 + s.t -10;
	if( top<10 ){ top=10; }
	div.css('left',s.w/2-div.width()/2);
 	div.css('top', top  );

	loading();

	$('.h3',div).html(t);
	$.get(uri,function(data){
		$('.con',div).html(data);
	});
}
function loading(){  $('.con',div).html('<div class="loading"></div>'); 	$('.loading',div).height( $(div).height()-35  );	 }


//添加到收藏
function addFav(id){
	var uri='/index.php?com=website&view=ajax&act=addfav&no_html=1&id='+id;
 	openDialog('添加收藏',uri,420,200);
}

//保存到收藏
function saveFav(){
	 
	var n = encodeURI($('.fname').val());
	var v=  encodeURI($('.fhttp').val());
	var t = $('.ftid').val();
	var id = $('.id').val();
	var gname =  encodeURI($('.fnt').val());
	var type = $('.type').val();
	var thumb = $('.thumb').val();
	var uri='/index.php?com=website&view=ajax&act=savfav&no_html=1';
	$.post(uri,{name:n,http:v,tid:t,wid:id,new_group:gname,type:type,thumb:thumb},function(data){
		$('.con',div).html(data);
	});
}


//报错信息
function sendError(id){
	var uri='/index.php?com=website&view=ajax&act=senderror&no_html=1&id='+id;
 	openDialog('网站报错',uri,420,200);
}


//添加新的网址
function publishW(id){
	var uri='/index.php?com=website&view=ajax&act=addweb&no_html=1';
 	openDialog('发布优秀网站',uri,680,450);
}

//提交新网址
function ajaxaddweb(){
   var url = $("#file").val();
   $("#loading").ajaxStart(function(){
	  $(this).show();
  }).ajaxComplete(function(){
	  $(this).hide();
  });
	
  var name = encodeURI( $('#name').val() );
  var value = encodeURI(  $('#http').val() );

  if( name.length<3 || value.length<10 ){ alert('请填写网站名称和网址，谢谢。'); return; }
  var cat = $('#cat').val();
  var remark = encodeURI(  $('.remark').val() );
  var key1 = encodeURI(  $('input[name=key1]').val() );
  var key2 = encodeURI(  $('input[name=key2]').val() );
  var key3 = encodeURI(  $('input[name=key3]').val() );

  var areaid,topicid,colorid;
  $('select').each(function(k,obj){
	  switch( obj.name ){
		  case 'areaid':
			  areaid = obj.value;
			  break;
		  case 'topicid':
			  topicid = obj.value;
			  break;

		  case 'colorid':
			  colorid = obj.value;
			  break;
	  }
 
  });

 
  $.ajaxFileUpload({
	  url:'/index.php?com=website&view=ajax&act=saveweb&no_html=1',
	  data:{'name':name,'value':value,'cat':cat,'remark':remark,'key1':key1,'key2':key2,'key3':key3,'areaid':areaid,'topicid':topicid,'colorid':colorid},
	  secureuri:false,
	  fileElementId:'file',//与页面处理代码中file相对应的ID值
	  dataType: 'text',//返回数据类型:text，xml，json，html,scritp,jsonp五种
	  success: function (data, status){

		   $('.con',div).html(data);
		  /*if(typeof(data.error) != 'undefined')   {   
				if(data.error != '')   { 
					$("#file").val(data.fileUrl); 
					$("#msg").html("<b style='color:red;'>"+data.error+"</b>");   
				}else {
					 $("#file").val(data.fileUrl);    
					$("#msg").html("<b style='color:green;'>"+data.msg+"</b>"); 
				}   
			}*/ 
	  },
	  error: function (data, status, e){
		  alert(e);
	  }
  });

  return false;
}


var star_li;

$(function(){
		
		$('.paratitle ul li').each(function(k,o){
			$(o).click(function(){
				var p = this.parentNode.parentNode.parentNode;
				var pb = $('.parabody .se',p);
 				var pt = $('.paratitle li',p);
 				for(i=0;i<pt.length;i++){ if( pt[i]==o){ k=i;} }
  				pb.hide();
				$('li',this.parentNode).attr('class','');
				this.className='first';
 				$(pb[k]).show();
			});
		});

	$.w={};
	$.w.tag=0;
	var uri;
 	$('a.bo').mouseover(function(){	
		var obj = this;
		var btn = $.w.btn;
 		var offset = $(this).offset();
		
		uri='/index.php?com=website&view=ajax&act=addfav&type=http&no_html=1&id='+obj.id;

 		if( !$.w.btn )
		{
			 $.w.btn = $('<div class="nf" ><span class="addF"><a href="javascript:;;" >加入我的导航</a></span></div>').get(0);
			 $($.w.btn).mouseover(function(){
				 $.w.tag = 1;
			 }).mouseout(function(){
				$.w.tag = 0;
				closeNF();
			});
			$('.addF', $.w.btn).click(function(){
 				openDialog('添加收藏',uri);
			});
			
 			 $('body').append($.w.btn);
		}




		$(btn).css({'left':offset.left+5,'top':offset.top+15});
		$(btn).fadeIn('slow');
 		$.w.tag = 1;
		

	

 
		//var uri = 'index.php?com='+$('input[name=com]').attr('value')+'&task=ordering&id='+id+'&from='+value+'&to='+obj.value+'&tmpl='+$('input[name=tmpl]').attr('value');
		// uri+='&menuid='+$('input[name=menuid]').attr('value');
		// alert(uri);
		// gotohref(uri);
		 
 
 
	}).mouseout(function(){
		$.w.tag = 0;
		closeNF();
	});
	
 
	function closeNF(){
		setTimeout(function(){
			if( $.w.tag == 0 ){
				$($.w.btn).hide();
			}
		},300);
	}

	$('#key').keydown(function(e){
 		if( window.event ){
			 var key = e.keyCode;
		}else{
 			var key = e.which; 
		}
		if( key ==13){
 			search();
		}
	});
	$('.white').height($('.n_center2').height());

	$('.publish').mouseover(function(){
		$(this).css('backgroundPosition','left -138px');
	}).mouseout(function(){
		$(this).css('backgroundPosition','left top');
	}).click(function(){ publishW(); });



	/*** 浮动发布代码 **/
	var moveTime;
	function moveEffect(obj,pos){
		if(moveTime){
			clearTimeout(moveTime);
		}
		var offset = obj.offset();
		 if(offset.top<pos){
			  moveUpEffect(obj,pos);
		}else{
			 moveDownEffect(obj,pos);
		}
	}
	function moveUpEffect(obj,pos){
		var offset = obj.offset();
		 if(offset.top<pos   ){
			obj.css('top',offset.top+5);
			moveTime=setTimeout(function(){ moveUpEffect(obj,pos);} , 10);
			return;
		}
	}

	function moveDownEffect(obj,pos){
		var offset = obj.offset();
		if(offset.top>pos   ){
			obj.css('top',offset.top-5);
			moveTime=setTimeout(function(){ moveDownEffect(obj,pos);} , 10);
			return;
		}
	}


	$(window).scroll(function(){

		var bodyTop = 0;
		if (typeof window.pageYOffset != 'undefined') {
			bodyTop = window.pageYOffset;
		}
		else if (typeof document.compatMode != 'undefined' && document.compatMode != 'BackCompat')
		{
			bodyTop = document.documentElement.scrollTop;
		}
		else if (typeof document.body != 'undefined') {
			bodyTop = document.body.scrollTop;
		}

		//moveEffect($('.publish'),90+bodyTop);

	});



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


/** 网址导航页 **/
function shutup(ids){ document.getElementById(ids).style.display='none';}
function intro_float(ids){ document.getElementById(ids).style.display='block'; }

var search_obj;
function changeSearchEngine(obj){
	p = obj.parentNode;
	search_obj = $(obj);
	$('#engineIcon').attr('src',$('img',p).attr('src'));
	$('#s1').hide();
} 
 
function search(){
	if( !search_obj ){
		search_obj=$('#google');
	}
 	window.open( search_obj.attr('url') +'?'+search_obj.attr('key')+'='+encodeURI($('#key').val())+'&'+search_obj.attr('param'));
}

 
function getResult(){
  var url = "/index.php?com=users&task=memberstatus&no_html=1";
  if (window.XMLHttpRequest) { 
    req = new XMLHttpRequest(); 
  }else if (window.ActiveXObject){ 
    req = new ActiveXObject("Microsoft.XMLHTTP"); 
  }
  if(req){ 
     req.open("GET",url, true); 
     req.onreadystatechange = complete; 
     req.send(null); 
  } 
}
/*分析返回的XML文档*/
function complete(){
  if (req.readyState == 4){ 
     if (req.status == 200) { 
       //alert(req.responseText);
	   document.getElementById('mstatus').innerHTML=req.responseText;
   }
 }
}
