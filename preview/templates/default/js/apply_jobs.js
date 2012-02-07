$(function(){
	$('#apply_select').click(function(){
		
		var value='';
		
		var isSelect = false;
 		$('.cs').each(function(){
			if(this.checked){
				value+='|'+this.value;

				isSelect = true;
			}
		});

		if( !isSelect ){
			alert('请选择职位!');
			return;
		}

		//alert(value);
		
		var uri='index.php?com=ajax&act=apply_jobs&ids='+value;
		$.get(uri,function(data){
 			if( data == '1' )
			{
				alert('申请成功!');
			}else if( data=='2') {
				alert('你还没有登陆,请先登陆!');
				window.open('index.php?com=member&u=person');
			}else if( data == '3' )
			{
				alert('你已经申请所有选择的职位信息了!');
			}else{
				alert(data);
			}

		});

		
	});
});