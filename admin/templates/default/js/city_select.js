var select_count =5;//允许选择的最大数量。


//
TC = new Object();
TC.EventMonitor = function(){
    this.listeners = new Object();
}


TC.EventMonitor.prototype.broadcast=function(widgetObj, msg, data){
    var lst = this.listeners[msg];
    if(lst != null){
        for(var o in lst){
            lst[o](widgetObj, data);
        }
    }
}


TC.EventMonitor.prototype.subscribe=function(msg, callback){
    var lst = this.listeners[msg];
    if (lst) {
        lst.push(callback);
    } else {
        this.listeners[msg] = [callback];
    }
}


TC.EventMonitor.prototype.unsubscribe=function(msg, callback){
    var lst = this.listener[msg];
    if (lst != null){
        lst = lst.filter(function(ele, index, arr){return ele!=callback;});
    }
}
var event_monitor = new TC.EventMonitor();
function load_event_monitor(root) {

	//正则表达式
    var re = /a_(\w+)/;
    var fns = {};
    $(".j", root).each(function(i) {

		//返回匹配的字段数组
        var m = re.exec(this.className);

		//如果找到
        if (m) {
            var f = fns[m[1]];
            if (!f) {
                f = eval("TC.init_"+m[1]);
                fns[m[1]] = f;
            }
            f && f(this);
        }
    });
}
$(function() {
    load_event_monitor(document);
});

//工作地点键值匹配数组
var ja=[];
 
//获取滚动条的高度
function getPageScroll(){
	var yScroll;
	if (self.pageYOffset) {
		yScroll = self.pageYOffset;
	} else if (document.documentElement && document.documentElement.scrollTop){	 // Explorer 6 Strict
		yScroll = document.documentElement.scrollTop;
	} else if (document.body) {// all other Explorers
		yScroll = document.body.scrollTop;
	}
	arrayPageScroll = new Array('',yScroll) 
	return arrayPageScroll;
}
//获取页面实际大小
function getPageSize(){ 
    
    var xScroll, yScroll; 
    
    if (window.innerHeight && window.scrollMaxY) {    
        xScroll = document.body.scrollWidth; 
        yScroll = window.innerHeight + window.scrollMaxY; 
    } else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac 
        xScroll = document.body.scrollWidth; 
        yScroll = document.body.scrollHeight; 
    } else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari 
        xScroll = document.body.offsetWidth; 
        yScroll = document.body.offsetHeight; 
    } 
    
    var windowWidth, windowHeight; 
    if (self.innerHeight) {    // all except Explorer 
        windowWidth = self.innerWidth; 
        windowHeight = self.innerHeight; 
    } else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode 
        windowWidth = document.documentElement.clientWidth; 
        windowHeight = document.documentElement.clientHeight; 
    } else if (document.body) { // other Explorers 
        windowWidth = document.body.clientWidth; 
        windowHeight = document.body.clientHeight; 
    }    
    
    // for small pages with total height less then height of the viewport 
    if(yScroll < windowHeight){ 
        pageHeight = windowHeight; 
    } else {  
        pageHeight = yScroll; 
    } 
  
    // for small pages with total width less then width of the viewport 
    if(xScroll < windowWidth){    
        pageWidth = windowWidth; 
    } else { 
        pageWidth = xScroll; 
    } 
  
    arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight); 
    return arrayPageSize; 
}

TC.init_del_sele=function(o)
{
	$(o).click(function(){
		var id=$(o).attr('id').split('-')[1];
		event_monitor.broadcast(this, "sele_deled", id);

		
	});
}

/** 选择岗位 **/
TC.init_sele_city=function(o)
{
	$(o).click(function(){
		var id=$(o).attr('id').split('-')[1];

		//是否已经选择这个省
		if($(o).hasClass("seled")){
		 
			//删除已经选择的岗位
			event_monitor.broadcast(this, "sele_deled", id);
			return;
		}


		//
		var sel_arr=$('#sv').val().split('+');

		//判断已经选择了 5 个岗位
		if(sel_arr.length == select_count+1){
			alert('您只能选择'+select_count+"个岗位。");
			return;
		}
		
		if($('#se-'+id).length==0)
		{
			 
			$('#pop_sele').html($('#pop_sele').html()+"<li><a class='j a_del_sele' id='se-"+id+"' href='javascript:void(0);'>"+$(o).html()+"</a></li>");


			load_event_monitor($('#pop_sele'));
			event_monitor.broadcast(this, "sele_add", id);

			$('#c-'+id).addClass('seled');
			if($('#pc-'+id).length!=0)
			{
				$('#pc-'+id).addClass('seled');



			};
			//给省也加上背景
			$('#p-'+id).addClass('seled');
		}
	});
}


/**** 已选择的初始化 *****/
function init_selected()
{
	var sel_arr=$('#sv').val().split('+');

	
	//判断已经选择了 5 个城市
	//if(sel_arr.length == select_count+1){
	//	alert('您只能选择'+select_count+"个城市。");
	//	return;
	//}

	

	//判断默认是否已经选择，如果默认的是 "请选择" 将不初始化
	if( sel_arr.length>1 ){
		//文本数组
		var sel_arr_text = $('#sh').val().split('+');

		var len = sel_arr_text.length;
		for(var i=0;i<len;i++)
		{
			//已经选择城市的ID数组
			id = sel_arr[i];
			if($('#se-'+id).length==0 && sel_arr_text[i].length>0 )
			{
				$('#pop_sele').html($('#pop_sele').html()+"<li><a class='j a_del_sele' id='se-"+id+"' href='javascript:void(0);'>"+sel_arr_text[i]+"</a></li>");
				load_event_monitor($('#pop_sele'));
				event_monitor.broadcast(this, "sele_add", id);
				$('#c-'+id).addClass('seled');
				if($('#pc-'+id).length!=0)
				{
					$('#pc-'+id).addClass('seled');
				
				};

			}
		}
	}
}



//初始化选择城市对话框
TC.init_sh_city=function(o)
{
	$(o).click(function(e){
		
 
		var obj = $(o).attr('id').split('-')[1];

		//原是用 12012 这种字符
		//var id=parseInt(obj.substring(0,2);
		var id = obj;


		var content='<ul>';
		var key;

		/***
		for(var i=0;i<20;i++)
		{
			if(i<10) key=id+'0'+i;else key=id+i+'';
			if(ja[key])
			{
				if($('#se-'+key).length==0)
					content+="<li><a href='javascript:void(0);' id='pc-"+key+"' class='j a_sele_city'> "+ja[key]+" </a></li>";//<input type='checkbox' name=city[] id='' />
				else
					content+="<li><a href='javascript:void(0);' id='pc-"+key+"' class='j a_sele_city seled'> "+ja[key]+" </a></li>";
			}
		}

		***/
		
		for(var i=0;i<hr_sub.length;i++)
		{
			if( hr_sub[i][0] == id ){

				 key= hr_sub[i][2];

					if($('#se-'+key).length==0)
						content+="<li><a href='javascript:void(0);' id='pc-"+key+"' class='j a_sele_city'> "+hr_sub[i][1]+" </a></li>";//<input type='checkbox' name=city[] id='' />
					else
						content+="<li><a href='javascript:void(0);' id='pc-"+key+"' class='j a_sele_city seled'> "+hr_sub[i][1]+" </a></li>";
			}
		}


		content+='</ul>';

		//alert(content);

		var px = e.pageX-15;
		var py = e.pageY-15;
		$("#spop").html(content).css('top',py+'px').css('left',px+'px').show();
		load_event_monitor($('#spop'));
	});
}


//取对应ID的文本
function getValue(data){

		var val='';
		var selvalue = data.split('+');	
		
		
		for(i=0;i<selvalue.length-1;i++){
			val+=getValueTo(selvalue[i]) + '+';
		}
		
		
		return val;
};

function getValueTo(k)
{

	 
	for(var i=0;i<hr_top.length;i++)
	{
		if( k == hr_top[i][0] )
		{
 			return hr_top[i][1];
		}
	}


	for(var i=0; i<hr_sub.length; i++)
	{
		if( k == hr_sub[i][2] )
		{
			return hr_sub[i][1];
		}
	}
}

		var isbuild=false;
		var ismd=false;
		var lmX=0;
		var lmY=0;
		var leX=0;
		var leY=0;


$(function(){


	//自定义已经选择的岗位初始化
	init_selected();
 	$("#sub_form").click(function(){
		var se = getValue($("#sv").val());alert('您选择了：'+se+', id: ' + $("#sv").val());  
	});  

	if(!isbuild) {
	var content = '';
  		content +="<h2>所有岗位<div class='sremark'>(点击岗位类别可以选择对应的岗位，第一个是选择岗位类别，即选择所有岗位)</div></h2>";
 		//上次选择的记录
		var sel_arr=$('#sv').val().split('+');
 
 		content+="<div class='optcon'><ul>";

		///初始化岗位大类
		for(var i=0;i<hr_top.length;i++)
		{
			//查找省是否已经选择
			if( cruel_search( sel_arr,hr_top[i][0] ) > -1 )
			{	
				content+="<li><a class='j a_sh_city seled' id='p-"+hr_top[i][0]+"' href='javascript:void(0);'>"+hr_top[i][1]+"</a></li>";
			}else{
				content+="<li><a class='j a_sh_city' id='p-"+hr_top[i][0]+"' href='javascript:void(0);'>"+hr_top[i][1]+"</a></li>";
			}
 
		}
		content+="</ul></div>";
 		$('#opt').html(content);
		load_event_monitor($('#opt'));
		isbuild = true;
	}

	$("#sh").click(function(){ 
		var arrayPageSize = getPageSize();
		var arrayPageScroll = getPageScroll();
		$('#pop').css('top',(arrayPageScroll[1] + ((arrayPageSize[3] - 35 - 400) / 2 + 100 ) + 'px')).css('left',(((arrayPageSize[0] - 20 - 600) / 2) + 'px')).show(); 
		var h=arrayPageSize[1] + 35;
		$('#overlay').css('height',(h+'px')).show();
	}); 

	/** 取消所有已经选择的信息 **/
	$("#cancel").click(function()
	{
		$('#sv').val('');
		$('#sh').val('');

			 
			for(var i=0;i<hr_top.length;i++)
			{
 					event_monitor.broadcast(null, "sele_deled", hr_top[i][0]);
 			}


			for(var i=0; i<hr_sub.length; i++)
			{
 					event_monitor.broadcast(null, "sele_deled", hr_sub[i][2]);
 			}
	});


	/** 已经选择然后删除 ***/
	event_monitor.subscribe("sele_deled",function(o,data){
			$('#c-'+data).removeClass('seled');
			if($('#pc-'+data).length!=0){$('#pc-'+data).removeClass('seled');}
			//alert($('#c-'+data).length);
			//$('#c-'+data).each(function(i,obj){obj.removeClass('seled');});  

			$('#p-'+data).removeClass('seled');
			$('#sv').val($('#sv').val().replace(data+'+',''));
			//$('#mycity').html(getValue($('#sv').val()));

			//设置按钮的文本
			$("#sh")[0].value=getValue($('#sv').val());

			//$('#se-'+data).remove();
			$('#se-'+data).each(function(){
			  $(this.parentNode).remove();
			}); 


	   });


	  /*** 给隐藏的字段加上值 **/
	  event_monitor.subscribe("sele_add",function(o,data){

			//保存值的表单对象
			var cv=$('#sv').val();	

			if(cv.lastIndexOf(data)<0  )
			{
				$('#sv').val($('#sv').val()+data+'+');

 				//$('#mycity').html(getValue($('#sv').val()));

				$("#sh")[0].value=getValue($('#sv').val());
			}

			//alert($('#sv').val());
		  var p = 0;
		  for(var i=0;i<hr_top.length;i++)
		  {
			  if( hr_top[i][0] == data )
			  {
				  p = data;
			  }
		  }
		
		// 大类时
 		  if( p == data ){
			//同步取消所有子类
			//event_monitor.broadcast(null, "sele_deled", data);
			//event_monitor.broadcast(null, "sele_deled", data);

			var key = '';
			var tmp =[];
			for(var k =0;k<hr_sub.length;k++)
			  {
				 if( hr_sub[k][0] == data && hr_sub[k][2] != data )
				  {
					// tmp[hr_sub[k][0]]=hr_sub[k][2];
					event_monitor.broadcast(null, "sele_deled", hr_sub[k][2]);
				  }
			  }

			  //alert(tmp);
		  }else{

			 
			  for(var k =0;k<hr_sub.length;k++)
			  {
				 if( hr_sub[k][2] == data  )
				  {
 					event_monitor.broadcast(null, "sele_deled", hr_sub[k][0]);
				  }
			  }

			  
		  }

			/***
			if(data.substring(2)=='00'){
				var key='';
				for(var i=1;i<20;i++){
					if(i<10) 
						key=data.substring(0,2)+'0'+i;
					else 
						key=data.substring(0,2)+i;
					event_monitor.broadcast(null, "sele_deled", key);}
				}
			else{
				event_monitor.broadcast(null, "sele_deled", data.substring(0,2)+'00');

			
			}

			***/



	   });

	  $('#pop').mouseover(function(){$('#spop').hide();});

	  $('#closepop').click(function(){$('#pop').hide();$('#overlay').hide();});

	  $('#tit').mousedown(function(e){
			if(leX==0)
			{
				leX=parseInt($('#pop').css('left').replace('px',''));
				leY=parseInt($('#pop').css('top').replace('px',''));
			}
			lmX = e.pageX;lmY=e.pageY;ismd=true;
			return false;
	  }).mouseup(function(e){ if(ismd){upPosition(e.pageX,e.pageY);ismd=false;} });

	  $(document).mousemove(function(e){if(ismd)
	  {upPosition(e.pageX,e.pageY);return false;}}).mouseup(function(e){ 	if(ismd){upPosition(e.pageX,e.pageY);ismd=false;} 		});
	  
});
 
function upPosition(x,y){ 
	leX=parseInt(x-lmX+leX);
	leY=parseInt(y-lmY+leY);
	$('#pop').css('left',(leX+'px')).css('top',(leY+'px')); 
	lmX=x;lmY=y;
}

function cruel_search(data,key)       /*JS暴虐查找*/
{
	re = new RegExp(key,[""])
	return (data.toString().replace(re,"┢").replace(/[^,┢]/g,"")).indexOf("┢")
}