$(function(){
	$('#invite_select').click(function(){
		
		var value='';
		
		var isSelect = false;
 		$('.cs').each(function(){
			if(this.checked){
				value+='|'+this.value;

				isSelect = true;
			}
		});

		if( !isSelect ){
			alert('请选择简历!');
			return;
		}

		var uri='index.php?com=ajax&act=invite_resumes&ids='+value;
		$.get(uri,function(data){
 			if( data == '1' )
			{
				alert('发送通知成功!');
			}else if( data=='2') {
				alert('你还没有登陆,请先登陆!');
				window.open('index.php?com=member');
			}else if( data == '3' )
			{
				alert('你已经申请所有选择的简历信息了!');
			}else{
				alert(data);
			}

		});

		
	});
});