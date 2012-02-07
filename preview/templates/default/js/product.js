$(function(){

	$(".jqzoom").hover(function(){
		$(this).css({position:'relative'});
	},
	function(){
		$(this).css({position:'static'});
	});
	$(".jqzoom").jqueryzoom({
		xzoom:400,
		yzoom:400,
		offset:10,
		position:"right",
		preload:1,
		lens:1
	});
	$("#spec-list").jdMarquee({
		deriction:"left",
		width:326,
		height:56,
		step:2,
		speed:4,
		delay:10,
		control:true,
		_front:"#spec-right",
		_back:"#spec-left"
	});
	$("#spec-list img").bind("mouseover",function(){
		var src=$(this).attr("src");
		$("#spec-n1 img").eq(0).attr({
			src:src.replace("\/n5\/","\/n1\/"),
			jqimg:src.replace("\/n5\/","\/n0\/")
		});
		$(this).css({
			"border":"2px solid #ff6600",
			"padding":"1px"
		});
	}).bind("mouseout",function(){
		$(this).css({
			"border":"1px solid #ccc",
			"padding":"2px"
		});
	});




	//产品详细功能切换
	/**
	$('#dplab li').click(function(){
		$('#dplab li').removeClass('now');
		$(this).addClass('now');

		var ptnum = $(this).index('#dplab li');
		if(ptnum == 0){
			$('.dpcons').stop(true, true).hide();
			$('.dpcons').eq(0).show();$('.dpcons').eq(1).show();
			$('.dpcons').children('.ptboxh2').stop(true, true).show();
		}else{
			$('.dpcons').stop(true, true).hide();
			$('.dpcons').children('.ptboxh2').stop(true, true).hide();
			$('.dpcons').eq(ptnum).stop(true, true).show();
		}
	});
	**/

	//加载产品评论
	var uri = '/index.php?com=products&task=ajax&a=getcomment&no_html=1&product_id='+$('input[name=id]').val(); 
	$.get(uri,function(data){
		 constructReview(data);
	});
  

	var uri = '/index.php?com=products&task=ajax&a=getadvisory&no_html=1&product_id='+$('input[name=id]').val();
	$.get(uri,function(data){
  		constructComment(data);
	});

	//最佳拍档商品选择
	$(".paid").click(function(){
		if($(this).attr('checked')){
			$(this).parents().parents().addClass('addpaid');
		}else{
			$(this).parents().parents().removeClass('addpaid');;
		}
		var mp=market_price,sp=shop_price;
		var cn = 1;
		$('.paid').each(function(k,o){
			if( o.checked ){
				mp+=parseInt( $(o).attr('mp') );
				sp+=parseInt( $(o).attr('sp') );
				cn++;
			}
		});
		
		$('#combin').html(cn);
 		$('#cmp').html(mp);
		$('#csp').html(sp); 
	});

});

function addCart(){
	var ids='';
	$('.paid').each(function(k,o){
		if( o.checked ){
			ids+=','+$(o).attr('id'); 
		}
	});

	if( ids == '' ){ alert('请选择组合.'); return; }
 	location.href='/index.php?com=cart&act=add&id='+id+ids;
}

function submitComment(obj){
	var con = $('#goods_question_contens_box').val();
	if( con.length < 6 ){
		alert( '咨询内容需要大小5个字.');
		return;
	}

	var uri = '/index.php?com=products&task=ajax&a=advisory&no_html=1&product_id='+$('input[name=id]').val();
	$.get(uri,{contents:con},function(data){
		data  = $.trim(data); 
		if( data == '0' ){
			alert(' 您还没有登陆，请登陆后，再提交,谢谢.');
			return;
		}
		
		constructComment(data);
		alert(' 提交成功,会尽快回复您. ');
	});
}

function constructReview(data){
	var d = eval('('+data+')');
	
 
	var n = d.rows.length;
 
	if( n == 0 ){
		$('#reviewlist').html('<div class="noping" align=center > 暂无相关评论！</div>');
		$('#reviwtab').hide();
		return;
	}
	var s='';
	for(i=0;i<n;i++){ 
		s+= ' <dl class="reviewdiv"> <dt><b> '+d.rows[i].uname+' </b>给予 “<span class="reviewh1">';
		if( d.rows[i].star == 1 ){
			s+=' 差评！';
		}else if( d.rows[i].star==2 ){
			s+=' 中评！';
		}else if( d.rows[i].star == 3 ){
			s+=' 好评！';
		}
		 
		s+='” </span> '+d.rows[i].created+'</dt>   <dd>'+d.rows[i].contents+'</dd> <dd class="pingbei">此评论对您有用吗？ <span class="pbtn2" onclick="useful('+d.rows[i].id+',this)" >有用(<span class="uf" >'+d.rows[i].useful+'</span>)</span> <span class="pbtn2" onclick="useless('+d.rows[i].id+',this)" >无用(<span class="ul" >'+d.rows[i].useless+'</span>)</span></dd>  </dl>';
	}
 

	 
	$('#reviewlist').html(s);
	$('#reviewpage').html(d.page);
	


	   //产品评价
   $('#progress1').progressBar(d.info.a3, {height:10});
   $('#progress2').progressBar(d.info.a2, {height:10});
   $('#progress3').progressBar(d.info.a1, {height:10});
	
   $('.bold20').html(d.info.a8+'%');

}

function constructComment(data){
 
	try{

	var d = eval('('+data+')');
	var n = d.rows.length;
	if( n == 0 ){
		$('#show_comments').html('<div class="noping" align=center > 暂无相关咨询！</div>');

		return;
	}
	var s='';
	for(i=0;i<n;i++){ 
		s+= ' <dl class="pdask" >  <dt class="cask" ><span class="askman" > '+d.rows[i].author+' </span>';
		s+='<span class="da"> ['+d.rows[i].created+'] </span></dt> <dt class="caskcon" >'+d.rows[i].content+'</dt> ';

		if( d.rows[i].recontent ){
			s+= ' <dd class="cans" > 客服回复：</dd><dd class="caskcon" >'+ d.rows[i].recontent+'</dd>';
		}
		s+='</dl>   </div>';
	}
	$('#show_comments').html(s + d.page); 

	}catch(e){ alert(e.message); }
}

function getPage(a,p){
	if( a == 'getadvisory' ){
		var uri = '/index.php?com=products&task=ajax&a=getadvisory&no_html=1&product_id='+$('input[name=id]').val();
		$.get(uri,{'page':p},function(data){
			constructComment(data);
		});
	}else{
		//加载产品评论
		var uri = '/index.php?com=products&task=ajax&a=getcomment&no_html=1&product_id='+$('input[name=id]').val(); 
		$.get(uri,{'page':p},function(data){
			 constructReview(data);
		});
	}
  
}

function useful(id,obj){

	var visited = GetCookie('e'+id);

	if( visited ){
		alert(' 已投过票! ');
	}else{
		var uri = '/index.php?com=products&task=ajax&a=useful&no_html=1&id='+id;
		$.get(uri ,function(data){
			 SetCookie('e'+id,id);
			 $('.uf',obj).html(parseInt($('.uf',obj).html())+1);
		});
	}
}
function useless(id,obj){
	var visited = GetCookie('e'+id);
	if( visited ){
		alert(' 已投过票! ');
	}else{
		var uri = '/index.php?com=products&task=ajax&a=useless&no_html=1&id='+id;
		$.get(uri ,function(data){
			 SetCookie('e'+id,id);
			 $('.ul',obj).html(parseInt($('.ul',obj).html())+1);
		});
	}
}