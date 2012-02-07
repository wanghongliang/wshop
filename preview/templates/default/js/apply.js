$(function(){
	$('#apply_job').click(function(){

		var uri='index.php?com=ajax&act=apply_job&id='+this.className;
		$.get(uri,function(data){
			
			
			if( data == '1' )
			{
				alert('申请成功!');
			}else if( data=='2') {
				alert('你还没有登陆,请先登陆!');
				window.open('index.php?com=member&u=person');
			}else if( data == '3' )
			{
				alert('你已经申请该职位信息了!');
			}else{
				alert(data);
			}

		});
	});
});