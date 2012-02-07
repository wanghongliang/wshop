var select_cities_count =5;//允许选择的最大城市数量。


//
TC_cities = new Object();
TC_cities.EventMonitor = function(){
    this.listeners = new Object();
}


TC_cities.EventMonitor.prototype.broadcast=function(widgetObj, msg, data){
    var lst = this.listeners[msg];
    if(lst != null){
        for(var o in lst){
            lst[o](widgetObj, data);
        }
    }
}


TC_cities.EventMonitor.prototype.subscribe=function(msg, callback){
    var lst = this.listeners[msg];
    if (lst) {
        lst.push(callback);
    } else {
        this.listeners[msg] = [callback];
    }
}


TC_cities.EventMonitor.prototype.unsubscribe=function(msg, callback){
    var lst = this.listener[msg];
    if (lst != null){
        lst = lst.filter(function(ele, index, arr){return ele!=callback;});
    }
}
var event_cities_monitor = new TC_cities.EventMonitor();
function load_event_cities_monitor(root) {

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
                f = eval("TC_cities.init_"+m[1]);
                fns[m[1]] = f;
            }
            f && f(this);
        }
    });
}
$(function() {
    load_event_cities_monitor(document);
});

//工作地点键值匹配数组
var ja=[];
 



TC_cities.init_del2_sele=function(o)
{
	$(o).click(function(){
		var id=$(o).attr('id').split('-')[1];
		event_cities_monitor.broadcast(this, "sele_deled", id);		
	});
}

/** 选择城市 **/
TC_cities.init_sele2_city=function(o)
{
	$(o).click(function(){
		var id=$(o).attr('id').split('-')[1];

		//是否已经选择这个省
		if($(o).hasClass("seled")){
		 
			//删除已经选择的城市
			event_cities_monitor.broadcast(this, "sele_deled", id);
			return;
		}


		//
		var sel_arr=$('#sv2').val().split('+');

		//判断已经选择了 5 个城市
		if(sel_arr.length == select_cities_count+1){
			alert('您只能选择'+select_cities_count+"个城市。");
			return;
		}
		
		if($('#se2-'+id).length==0)
		{
			 
			$('#pop_sele2').html($('#pop_sele2').html()+"<li><a class='j a_del2_sele' id='se2-"+id+"' href='javascript:void(0);'>"+$(o).html()+"</a></li>");


			load_event_cities_monitor($('#pop_sele2'));
			event_cities_monitor.broadcast(this, "sele_add", id);

			$('#c2-'+id).addClass('seled');
			if($('#pc2-'+id).length!=0)
			{
				$('#pc2-'+id).addClass('seled');
			};
			//给省也加上背景
			$('#p2-'+id).addClass('seled');
		}
	});
}


/**** 已选择的初始化 *****/
function init_cities_selected()
{
	var sel_arr=$('#sv2').val().split('+');

	
	//判断已经选择了 5 个城市
	//if(sel_arr.length == select_cities_count+1){
	//	alert('您只能选择'+select_cities_count+"个城市。");
	//	return;
	//}

	

	//判断默认是否已经选择，如果默认的是 "请选择" 将不初始化
	if( sel_arr.length>1 ){
		//文本数组
		var sel_arr_text = $('#sh2').val().split('+');

		var len = sel_arr_text.length;
		for(var i=0;i<len;i++)
		{
			//已经选择城市的ID数组
			id = sel_arr[i];
			if($('#se2-'+id).length==0 && sel_arr_text[i].length>0 )
			{
				$('#pop_sele2').html($('#pop_sele2').html()+"<li><a class='j a_del2_sele' id='se2-"+id+"' href='javascript:void(0);'>"+sel_arr_text[i]+"</a></li>");
				load_event_cities_monitor($('#pop_sele2'));
				event_cities_monitor.broadcast(this, "sele_add", id);
				$('#c2-'+id).addClass('seled');
				if($('#pc2-'+id).length!=0)
				{
					$('#pc2-'+id).addClass('seled');
				
				};

			}
		}
	}
}



//初始化选择城市对话框
TC_cities.init_sh2_city=function(o)
{
 	$(o).click(function(e){
		var obj = $(o).attr('id').split('-')[1];
		//原是用 12012 这种字符
		//var id=parseInt(obj.substring(0,2);
		var id = obj;
		var content='<ul>';
		var key;
 
		
		for(var i=0;i<cities.length;i++)
		{
			if( cities[i][0] == id ){

				 key= cities[i][2];

					if($('#se2-'+key).length==0)
						content+="<li><a href='javascript:void(0);' id='pc2-"+key+"' class='j a_sele2_city'> "+cities[i][1]+" </a></li>";//<input type='checkbox' name=city[] id='' />
					else
						content+="<li><a href='javascript:void(0);' id='pc2-"+key+"' class='j a_sele2_city seled'> "+cities[i][1]+" </a></li>";
			}
		}


		content+='</ul>';

		//alert(content);

		var px = e.pageX-15;
		var py = e.pageY-15;
		$("#spop2").html(content).css('top',py+'px').css('left',px+'px').show();
		load_event_cities_monitor($('#spop2'));
	});
}


//取对应ID的文本
function getValue2(data){

		var val='';
		var selvalue = data.split('+');	
		for(i=0;i<selvalue.length-1;i++){
			val+=getValueTo2(selvalue[i]) + '+';
		}
		
		
		return val;
};

function getValueTo2(k)
{

	 
	for(var i=0;i<provinces.length;i++)
	{
		if( k == provinces[i][0] )
		{
 			return provinces[i][1];
		}
	}


	for(var i=0; i<cities.length; i++)
	{
		if( k == cities[i][2] )
		{
			return cities[i][1];
		}
	}
}

		var c_isbuild=false;
		var c_ismd=false;
		var c_lmX=0;
		var c_lmY=0;
		var c_leX=0;
		var c_leY=0;


$(function(){


	//自定义已经选择的城市初始化
	init_cities_selected();
 	$("#sub_form2").click(function(){
		var se = getValue2($("#sv2").val());alert('您选择了：'+se+', id: ' + $("#sv2").val());  
	});  

	if(!c_isbuild) {
	var content = '';
  		content +="<h2>所有城市<div class='sremark'>(点击省份可以选择对应的城市，第一个是选择省份，即选择所有城市)</div></h2>";
 		//上次选择的记录
		var sel_arr=$('#sv2').val().split('+');
 
 		content+="<div class='opTC_citieson'><ul>";

		///初始化岗位大类
		for(var i=0;i<provinces.length;i++)
		{
			//查找省是否已经选择
			if( cruel_search( sel_arr,provinces[i][0] ) > -1 )
			{	
				content+="<li><a class='j a_sh2_city seled' id='p2-"+provinces[i][0]+"' href='javascript:void(0);'>"+provinces[i][1]+"</a></li>";
			}else{
				content+="<li><a class='j a_sh2_city' id='p2-"+provinces[i][0]+"' href='javascript:void(0);'>"+provinces[i][1]+"</a></li>";
			}
 
		}
		content+="</ul></div>";
 		$('#opt2').html(content);
		load_event_cities_monitor($('#opt2'));
		c_isbuild = true;
	}

	$("#sh2").click(function(){ 
		var arrayPageSize = getPageSize();
		var arrayPageScroll = getPageScroll();
		$('#pop2').css('top',(arrayPageScroll[1] + ((arrayPageSize[3] - 35 - 400) / 2 + 100 ) + 'px')).css('left',(((arrayPageSize[0] - 20 - 600) / 2) + 'px')).show(); 
		var h=arrayPageSize[1] + 35;
		$('#overlay2').css('height',(h+'px')).show();
	}); 

	/** 取消所有已经选择的信息 **/
	$("#cancel2").click(function()
	{
		$('#sv2').val('');
		$('#sh2').val('');
			for(var i=0;i<provinces.length;i++)
			{
 					event_cities_monitor.broadcast(null, "sele_deled", provinces[i][0]);
 			}
			for(var i=0; i<cities.length; i++)
			{
 					event_cities_monitor.broadcast(null, "sele_deled", cities[i][2]);
 			}
	});


	/** 已经选择然后删除 ***/
	event_cities_monitor.subscribe("sele_deled",function(o,data){

 			$('#c2-'+data).removeClass('seled');
			if($('#pc2-'+data).length!=0){$('#pc2-'+data).removeClass('seled');}
			//alert($('#c2-'+data).length);
			//$('#c2-'+data).each(function(i,obj){obj.removeClass('seled');});  
			$('#p2-'+data).removeClass('seled');
			$('#sv2').val($('#sv2').val().replace(data+'+',''));
			//$('#mycity').html(getValue2($('#sv2').val()));

			//设置按钮的文本
			$("#sh2")[0].value=getValue2($('#sv2').val());

			//$('#se2-'+data).remove();

			$('#se2-'+data).each(function(){
			  $(this.parentNode).remove();
			}); 

	   });
	  /*** 给隐藏的字段加上值 **/
	  event_cities_monitor.subscribe("sele_add",function(o,data){

			//保存值的表单对象
			var cv=$('#sv2').val();	

			if(cv.lastIndexOf(data)<0  )
			{
				$('#sv2').val($('#sv2').val()+data+'+');

 				//$('#mycity').html(getValue2($('#sv2').val()));

				$("#sh2")[0].value=getValue2($('#sv2').val());
			}

			//alert($('#sv2').val());
		  var p = 0;
		  for(var i=0;i<provinces.length;i++)
		  {
			  if( provinces[i][0] == data )
			  {
				  p = data;
			  }
		  }
		
		// 大类时
 		  if( p == data ){
			//同步取消所有子类
			//event_cities_monitor.broadcast(null, "sele_deled", data);
			//event_cities_monitor.broadcast(null, "sele_deled", data);

			var key = '';
			var tmp =[];
			for(var k =0;k<cities.length;k++)
			  {
				 if( cities[k][0] == data && cities[k][2] != data )
				  {
					// tmp[cities[k][0]]=cities[k][2];
					event_cities_monitor.broadcast(null, "sele_deled", cities[k][2]);
				  }
			  }

			  //alert(tmp);
		  }else{

			 
			  for(var k =0;k<cities.length;k++)
			  {
				 if( cities[k][2] == data  )
				  {
 					event_cities_monitor.broadcast(null, "sele_deled", cities[k][0]);
				  }
			  }
 		  }
 
	   });

	  $('#pop2').mouseover(function(){$('#spop2').hide();});

	  $('#closepop2').click(function(){$('#pop2').hide();$('#overlay2').hide();});

	  $('#tit2').mousedown(function(e){
			if(c_leX==0)
			{
				c_leX=parseInt($('#pop2').css('left').replace('px',''));
				c_leY=parseInt($('#pop2').css('top').replace('px',''));
			}
			c_lmX = e.pageX;c_lmY=e.pageY;c_ismd=true;
			return false;
	  }).mouseup(function(e){ if(c_ismd){upCitiesPosition(e.pageX,e.pageY);c_ismd=false;} });

	  $(document).mousemove(function(e){if(c_ismd)
	  {upCitiesPosition(e.pageX,e.pageY);return false;}}).mouseup(function(e){ 	if(c_ismd){upCitiesPosition(e.pageX,e.pageY);c_ismd=false;} 		});
	  
});
 
function upCitiesPosition(x,y){ 
	c_leX=parseInt(x-c_lmX+c_leX);
	c_leY=parseInt(y-c_lmY+c_leY);
	$('#pop2').css('left',(c_leX+'px')).css('top',(c_leY+'px')); 
	c_lmX=x;c_lmY=y;
}
