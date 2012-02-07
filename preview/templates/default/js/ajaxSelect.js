 
/**
 * 作者：王洪亮
 * 网址：http://www.daybillion.com 
 * 日期：2009-10-27
 * 功能：AJAX联动下拉列表框插件
 */
 
(function($) {
	function fillOption(el_id , json , selected) {
		var el	= el_id;
 		if (json) {
			var index	= 0;
			var selected_index	= 0;
			var option = '';
			$.each(json , function(k , v) {
  				if (k == selected) {
					option	= '<option value="'+k+'" selected >'+v+'</option>';
				}else{
					option	= '<option value="'+k+'">'+v+'</option>';
				}
				el.append(option);
				//index++;
			})
			//el.attr('selectedIndex' , selected_index);
		}
	}


	function buildOption(url,object,defaultValue)
	{
		var area_data={};
		$.get(url,function(data){
			area_data = eval('('+data+')');
			fillOption(object,area_data,defaultValue);
		});
	}

	$.fn.ajaxSelect = function(options){	  
		// 默认属性
		var defaults = {
			initValue:0,		// 初始化时选择的项
			data:null,			//实始化选择的数组值
			ajax:false,
			url:'',				//URL的属性
			parent_id:0,		//当前选择的父项ID值
			correlation:null, //相关的联动ID
			correlation2:null
 		}; 
		
		// 继承属性
		var options = $.extend(defaults, options);  		
		var correlation = options.correlation;
		var initValue = options.initValue;
		var url = options.url+'&id='+options.parent_id;
		if( !options.data )
		{
			 
			//默认是AJAX方式读取数据
			if( options.ajax == true )
			{
				var area_data = {};
				var object=$(this);
				buildOption(url,object,initValue);
			}
		}

		//是否有相关联动的菜单
		if( options.correlation ){
			// 可用于多个对象
			this.each(function() {  
				var obj = $(this); 	
				obj.change(function(){
					var pid = obj.val();

					
					url = options.url+'&id='+pid;
					var subObj = $('#'+options.correlation);
					subObj.get(0).options.length = 1;   
				
					// 当选择指定的选项时才联动
					if( pid>0 ){	
						buildOption(url,subObj,'');
					}
					///$('.'+className).attr('checked',this.checked);
					//alert(url);
					// 第三级同时设为
					if( options.correlation2 )
					{
						$('#'+options.correlation2).get(0).options.length = 1;   
					}
				});
			});
		}


	};

})(jQuery);



