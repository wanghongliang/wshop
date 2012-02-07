 
/**
 * 作者：whl
 * 日期：2009-10-20
 * 功能：全选插件
 */
 
(function($) {
	

	$.fn.selectAll = function(options){	  
		// 默认属性
		var defaults = {			
			className:'cs'
		}; 
		

		// 重写属性
		var options = $.extend(defaults, options);  
		

		var className = options.className;

		// 可用于多个对象
		this.each(function() {  

			var obj = $(this); 	
			obj.click(function(){
				$('.'+className).attr('checked',this.checked);
			});
		});
	};

	$.fn.inverse = function(){
		// 默认属性
		var defaults = {			
			className:'cs'
		}; 
 		// 重写属性
		var options = $.extend(defaults, options);  
		

		var className = options.className;

		// 可用于多个对象
		this.each(function() {  

			var obj = $(this); 	
			obj.click(function(){
				$('.'+className).each(function(){
					if( this.checked )
					{
						this.checked = false;
					}else{
						this.checked = true;
					}
				});
			});
		});

	}

})(jQuery);



