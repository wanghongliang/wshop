 
/**
 * ���ߣ�whl
 * ���ڣ�2009-10-20
 * ���ܣ�ȫѡ���
 */
 
(function($) {
	

	$.fn.selectAll = function(options){	  
		// Ĭ������
		var defaults = {			
			className:'cs'
		}; 
		

		// ��д����
		var options = $.extend(defaults, options);  
		

		var className = options.className;

		// �����ڶ������
		this.each(function() {  

			var obj = $(this); 	
			obj.click(function(){
				$('.'+className).attr('checked',this.checked);
			});
		});
	};

	$.fn.inverse = function(){
		// Ĭ������
		var defaults = {			
			className:'cs'
		}; 
 		// ��д����
		var options = $.extend(defaults, options);  
		

		var className = options.className;

		// �����ڶ������
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



