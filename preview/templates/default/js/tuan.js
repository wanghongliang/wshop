

$(function(){
 
	$('#ebtn').click(function(){ 
		var k = $('#email').val();
		if( $.trim(k) == '输入EMAIL信息，订阅每日团购信息！' ){
			k = '';
		}
		 
		if( k == '' ){ alert(' 请输入您的email信息。 '); $('#email').val(''); $('#email').get(0).focus(); return false; }

		if (k.search(/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/) == -1  ){
			alert(' 邮件地址格式错误，请检查。');
			return false;
		}
		$('#subscribe').submit();

	});
	$('#email').focus(function(){
 		if( this.value == '输入EMAIL信息，订阅每日团购信息！' ){
			this.value='';
		}
	});
	$('.gocity').hover(function(){
		$('.citylist').show();
	},function(){
		$('.citylist').hide();
	
	});


});

