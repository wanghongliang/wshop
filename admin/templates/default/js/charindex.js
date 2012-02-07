 
/**
 * 作者：王洪亮
 * 日期：2009-10-27
 * 功能：索引字符插件
 */
 
(function($) {
	

	$.fn.charIndex = function(options){	  
		// 默认属性
		var defaults = {			
			url:'',				//ajax 动态取数据网址
			positionClass:null //这个是显示索引框的位置
		}; 
		
		// 重写属性
		var options = $.extend(defaults, options);  
		
		var positionClass = options.positionClass;

		//参考位置
		var pObject = $(positionClass);
		var offset = pObject.offset();
		var x= offset.left;
		var y= offset.top;
		
		//显示相关区域的模
		var frame = $('<div id="showAreaFrame" ><br/><br/><center><font color=gray >暂无相关信息!</font></center></div>');
		$(document.body).append(frame); 

		frame.css('left',x);
		frame.css('top',y+60);
 

		var tag=0;	//0 为可以关闭, 1 为不可以关闭
		var timer; //时间控件

		var currentChar;	//当前的字符
		var charX;			//当前鼠标的字母样式

		var indexLetterData=new Array(); //保存数据
		
	

		// 可用于多个对象
		this.each(function() {  

			var obj = $(this); 	
			obj.mouseover(function(){
				
				var a_innerLetter=(this.innerHTML);

				if(! (indexLetterData[a_innerLetter]))
				{
					var url=(options.url+a_innerLetter);
					indexLetterData[a_innerLetter]=1;	

					frame.html('<div class="loading" >加载中..</div>');
					$.get(url,function(data){
						tData=eval('('+data+')');
						var str='<ul>';
						$.each(tData , function(k , v)
						{
							str+='<li><a href="index.php?com=promotions_list&cid='+k+'" target=_blank >'+v+'</a></li>';
						});
						str+='</ul>';
						indexLetterData[a_innerLetter]=str;
						frame.html(str);
					});

				}else{
				
					frame.html(indexLetterData[a_innerLetter]);
				}
				
				
				//显示内容
				frame.show();
				tag=1;

				charOffset = obj.offset();
				charX = charOffset.left;
				if( currentChar )
				{
					$(currentChar).removeClass('indexbg');
				}
				currentChar=this;
				//alert(this.parentNode.nodeName);
				$(currentChar).addClass('indexbg');
				 
				$(currentChar).css('left',charX-10);
			});

			obj.mouseout(function(){
				tag=0;
				timer=setTimeout(function(){
					if( tag == 0 ){
						frame.hide();
						$(currentChar).removeClass('indexbg');
					}
				},1000);
			});
		});

		frame.mouseover(function(){
			tag=1;
		});

		//框架显示时不可以关闭
		frame.mouseout(function(){
			tag=0;
			timer=setTimeout(function(){
				if( tag == 0 ){
					
					$(currentChar).removeClass('indexbg');
					frame.hide();
				}
			},1000);
		});
	};

})(jQuery);



