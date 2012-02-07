(function($){

	/**原拖动插件 **/
	$.fn.jqDrag=function(h){return i(this,h,'d');};
	$.fn.jqResize=function(h){return i(this,h,'r');};
	$.jqDnR={dnr:{},e:0,
	drag:function(v){
	 if(M.k == 'd')E.css({left:M.X+v.pageX-M.pX,top:M.Y+v.pageY-M.pY});
	 else E.css({width:Math.max(v.pageX-M.pX+M.W,0),height:Math.max(v.pageY-M.pY+M.H,0)});
	  return false;},
	stop:function(){ // E.css('opacity',M.o);
	  $().unbind('mousemove',J.drag).unbind('mouseup',J.stop);}
	};
	var J=$.jqDnR,M=J.dnr,E=J.e,
	i=function(e,h,k){return e.each(function(){h=(h)?$(h,e):e;
	 h.bind('mousedown',{e:e,k:k},function(v){var d=v.data,p={};E=d.e;
	 // attempt utilization of dimensions plugin to fix IE issues
	 if(E.css('position') != 'relative'){try{E.position(p);}catch(e){}}
	 M={X:p.left||f('left')||0,Y:p.top||f('top')||0,W:f('width')||E[0].scrollWidth||0,H:f('height')||E[0].scrollHeight||0,pX:v.pageX,pY:v.pageY,k:d.k,o:E.css('opacity')};
	 //E.css({opacity:0.8});
	 $().mousemove($.jqDnR.drag).mouseup($.jqDnR.stop);
	 return false;
	 });
	});},
	f=function(k){return parseInt(E.css(k))||false;};
	
	$.w = {};

	/**
	 * 打开和关闭遮罩
	 */
 	$.w.openMask=function(){
		if( !$.w.dialogMask )
		{
			$.w.dialogMask = $('<div class="mask" ></div>').get(0);
			var s = clint(); 
			var h = document.body.scrollHeight;
			if( s.h > document.body.scrollHeight ){
				h=s.h;
			}
			$($.w.dialogMask).css('height',h);
			$('body').get(0).appendChild($.w.dialogMask); 
			$($.w.dialogMask).click(function(){
				$.w.closeDialog();
				$.w.closeN(3); $.w.closeN(2); 
			});
		}
		$('select').css('visibility','hidden');
		$('.wDialog_body select').css('visibility','visible');
 		$($.w.dialogMask).show();
	};
	 
	$.w.closeMask=function(){
 		$($.w.dialogMask).hide();
		$('select').css('visibility','visible');
 	};
 
	/** 关对话框 **/
	$.w.closeDialog = function(){	
		$($.w.mergeFrame).fadeOut("fast");		
		$.w.closeMask();
	};	
	 
	/** 关对话框 **/
	$.w.closeN = function(n){	
		obj=eval( "$.w.mergeFrame"+n );
		if( obj ){ $(obj).fadeOut("fast");	$.w.closeMask();}
		
	};	
	//重新加载对话框
	$.w.loadDialog = function(uri,n){
		$.get(uri,function(data){
			if( n > 0 ){  obj=eval( "$.w.mergeFrame"+n ); }else{ obj = $.w.mergeFrame; }
			$(obj).find('.wDialog_body').html(data);
			$.w.loadTop(n);
		});
	};
	/** 当AJAX方式加载完后重设top 值 **/
	$.w.loadTop = function(n){
		if( n > 0 ){  obj=eval( "$.w.mergeFrame"+n ); }else{ obj = $.w.mergeFrame; } 
 
		var s = clint(); 
		//$(obj).css('top',s.h/2-$(obj).height()/2 + s.t -10);
		var t = s.h/2-$(obj).height()/2 + s.t -10;
		t = t<1?0:t;
		$(obj).animate({'top':t},300);
	};


	/** isget:true 是否在创建时加载 
	 *  width:
		top:
		height:
		reload: 每次打开都重新加载


		说明：2 为菜单类型选择框 , 上传对话框
			  10 为上传文件框
			  8 为确认对话框
			  9 为移动对话框

			  11 为模块编辑
	**/
	$.w.createDialog = function(options , n){

		//用n记数器可以打开多个窗品
		if( n > 0 ){  
			obj=eval( "$.w.mergeFrame"+n );
			if( obj ){   
				//alert(obj.innerHTML);
				//设置当前高度
				//if( $.browser.msie ){
					//alert(options.top+document.body.scrollTop); 
					//var s = clint(); 
					//$(obj).css('top',s.h/2-$(obj).height()/2 + s.t -10);
					//alert(document.body.scrollTop);
					//options.top = s.h/2-$(wdialog).height()/2 + s.t -10;
					//$(obj).css('top',parseInt(options.top+document.body.scrollTop) );	//设置当前显示的高度

					$.w.loadTop(n);
				//}
 
				if( options.reload )//每次打开都重新加载
				{
					if( options.title ){ $(obj).find('.wDialog_text').html(options.title); }

 					if( options.iframe  )
					{
						$(obj).find('.wDialog_body').get(0).src=options.url;
					}else{
						$.get(options.url,function(data){
							$(obj).find('.wDialog_body').html(data);
							$.w.loadTop(0);
						});
					}
				}
				$.w.openMask();
				$(obj).show(); 
				return obj; 
			}
		}else{
			if( $.w.mergeFrame ){ return true; }
		}


		


		if( !options.width ){ options.width=500;}
		if( !options.top ){ options.top=100;}
		var str='<div class="wDialog" ><div class="wDialog_title" > <div class="wDialog_text" >'+options.title+'</div><div class="wDialog_cancel" >关闭</div></div>';
		if( options.iframe ){
			str+='<iframe FRAMEBORDER=0 id="dialogiframe" name="dialogiframe" class="wDialog_body" width=100% height='+options.height+'/>';
		}else{
			str+='<div class="wDialog_body" ></div>';
		}
		str+='</div>';
		
		var wdialog  = $(str).get(0);
		

		//if( !options.iframe ){
			//添加拖动事件
			$(wdialog).jqDrag('.wDialog_text');//.jqResize('.jqResize');
		//}


		var s = clint();
		//添加到当前窗口文档中
		$('body').get(0).appendChild(wdialog);	
		options.top = (s.h -$(wdialog).height() )/2 + s.t -10;
  		if( options.top < 1 ) options.top=0;
		 
		$(wdialog).css( {'width':options.width,'top':options.top,'left':(document.body.clientWidth -options.width) /2} );
		$(wdialog).css('zIndex','100000'); 


		//取消事件
		$(wdialog).find('.wDialog_cancel').click(function(){
			$(wdialog).fadeOut("fast");
			$.w.closeMask();
		});
			
		//是否创建时就加载GET
		if( options.isget ){
			if( !options.iframe && options.url )
			{
				$.get(options.url,function(data){
					$(wdialog).find('.wDialog_body').html(data);
					$.w.loadTop(0);
					if( options.loadAfter )	//回调加载后的方法
					{
						options.loadAfter(wdialog);
					}
				});
			}else if( options.iframe ){
				$(wdialog).find('.wDialog_body').get(0).src=options.url;
			}
		}

		//打开蒙板
		$.w.openMask();
		
		 
		//设置当前高度
		//if( $.browser.msie ){
		//	$(wdialog).css('top',options.top+document.body.scrollTop );	//设置当前显示的高度
		//}

		
		if( n > 0 ){ 
			eval( "$.w.mergeFrame"+n+" =  wdialog " );
			$(wdialog).show();
		}else{
			$.w.mergeFrame = wdialog;//$(wdialog).clone().get(0);//wdialog;// $(wdialog).clone().get(0);
			//wdialog = null;
		}
 
		return wdialog; 
	};

	$.w.openDialog = function(options,n)
	{
		
	}


	/**
	 * 确认对话框 8 
	 */
	$.w.confirm = function(options,href){
		var defaults = {width:300,height:80,top:130};
		// 继承属性
		var options = $.extend(defaults, options);  	
		var d =  $.w.createDialog(options,8 );  
		if( this.init != true){	//先用笨方法做单例2010-1-14	
			var confirm = $('<div class="confirm" ><span class="yes" >是</span><span class="no" >否</span></div>').get(0);
			$(confirm).find('.yes').click(function(){
				options.confirm(1,d);
			});
			$(confirm).find('.no').click(function(){
				options.confirm(0,d);
			});
			$(d).find('.wDialog_body').get(0).appendChild(confirm);
		}
 		this.init = true;

	};

	$.w.doPost =function(form){	//构造提交表单的元素
		var parm="";
		for(i=0;i<form.length;i++){
			var value=form.elements[i].value;
			if( form.elements[i].type == 'checkbox' || form.elements[i].type == 'radio')
			{
				if( form.elements[i].checked ){
					parm +=form.elements[i].name + "=" + value + "&";
				}
			}else{
				parm +=form.elements[i].name + "=" + value + "&";
			}
		}
		parm=parm.substr(0,parm.length-1);
		return parm;
	};


	$.fn.wDialog = function(options){	 
		// 默认属性
		var defaults = {
			title:'选择框',
			initValue:0,		// 初始化时选择的项
			width:400,			//实始化选择的数组值
			height:200,
			top:50,
			iframe:false,
			onPost:false,
			ajax:false,
			onclickfront:false,
			onsuccess:false,
			url:''		//URL的属性
 		}; 
		// 继承属性
		var options = $.extend(defaults, options);  
		var s = clint();
		 
		this.each(function() {  
			var obj = $(this); 	
			obj.click(function(){
				//回调
				if( options.onclickfront )
				{
					options.onclickfront();
				}
				 
				//创建根窗口
				$.w.createDialog(options,0); 
				//标题 - 重设对话框标题
				title = obj.attr('title');
				if( title )
				{
					$($.w.mergeFrame).find('.wDialog_text').html(title);
				}else{   $($.w.mergeFrame).find('.wDialog_text').html(options.title);   }

				//打开蒙板
				$.w.openMask(); 
				//URL get 获取
				url = obj.attr('url');
				if( url ){
					post = obj.attr('post');	//是否为POST提交表单
					if( post )
					{
						//alert(post).get(0));
						var f_data = $.w.doPost( $(post).get(0) );
						$.post(url,f_data,function(data){
							$($.w.mergeFrame).find('.wDialog_body').html(data);
							$.w.loadTop(0);

							if( options.onsuccess )
							{
								options.onsuccess();
							}
						});

					}else{
						if( options.iframe ){
							$($.w.mergeFrame).find('.wDialog_body').get(0).src=url;
						}else{
							$.get(url,function(data){
								$($.w.mergeFrame).find('.wDialog_body').html(data);
								$.w.loadTop(0);
							});
						}
					}
				 } 
				if( $.browser.msie ){  $.w.loadTop(0); }
				// 显示对话框
				//alert( $.w.mergeFrame );
 				$($.w.mergeFrame).show();

			});
		});
	};




})(jQuery);

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