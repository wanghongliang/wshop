var select_count =5;//允许选择的最大城市数量。


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
    var re = /a_(\w+)/;
    var fns = {};
    $(".j", root).each(function(i) {
        var m = re.exec(this.className);
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
ja['0100']='北京市';
ja['0200']='上海市';
ja['0300']='广东省';ja['0302']='广州市';ja['0303']='惠州市';ja['0304']='汕头市';ja['0305']='珠海市';ja['0306']='佛山市';ja['0307']='中山市';ja['0308']='东莞市';ja['0310']='从化市';ja['0314']='韶关市';ja['0315']='江门市';ja['0316']='增城市';ja['0317']='湛江市';ja['0318']='肇庆市';ja['0319']='清远市';ja['0320']='潮州市';ja['0321']='河源市';ja['0322']='揭阳市';ja['0323']='茂名市';ja['0324']='汕尾市';ja['0325']='顺德市';
ja['0400']='深圳市';
ja['0500']='天津市';
ja['0600']='重庆市';
ja['0700']='江苏省';ja['0702']='南京市';ja['0703']='苏州市';ja['0704']='无锡市';ja['0705']='常州市';ja['0706']='昆山市';ja['0707']='常熟市';ja['0708']='扬州市';ja['0709']='南通市';ja['0710']='镇江市';ja['0711']='徐州市';ja['0712']='连云港市';ja['0713']='盐城市';ja['0714']='张家港市';
ja['0800']='浙江省';ja['0802']='杭州市';ja['0803']='宁波市';ja['0804']='温州市';ja['0805']='绍兴市';ja['0806']='金华市';ja['0807']='嘉兴市';ja['0808']='台州市';ja['0809']='湖州市';ja['0810']='丽水市';ja['0811']='舟山市';ja['0812']='衢州市';
ja['0900']='四川省';ja['0902']='成都市';ja['0903']='绵阳市';ja['0904']='乐山市';ja['0905']='泸州市';ja['0906']='德阳市';ja['0907']='宜宾市';ja['0908']='自贡市';ja['0909']='内江市';ja['0910']='攀枝花市';
ja['1000']='海南省';ja['1002']='海口市';ja['1003']='三亚市';
ja['1100']='福建省';ja['1102']='福州市';ja['1103']='厦门市';ja['1104']='泉州市';ja['1105']='漳州市';ja['1106']='莆田市';ja['1107']='三明市';ja['1108']='南平市';ja['1109']='宁德市';ja['1110']='龙岩市';
ja['1200']='山东省';ja['1202']='济南市';ja['1203']='青岛市';ja['1204']='烟台市';ja['1205']='潍坊市';ja['1206']='威海市';ja['1207']='淄博市';ja['1208']='临沂市';ja['1209']='济宁市';ja['1210']='东营市';ja['1211']='泰安市';ja['1212']='日照市';ja['1213']='德州市';
ja['1300']='江西省';ja['1302']='南昌市';ja['1303']='九江市';
ja['1400']='广西';ja['1402']='南宁市';ja['1403']='桂林市';ja['1404']='柳州市';ja['1405']='北海市';
ja['1500']='安徽省';ja['1502']='合肥市';ja['1503']='芜湖市';ja['1504']='安庆市';ja['1505']='马鞍山市';ja['1506']='蚌埠市';ja['1507']='阜阳市';ja['1508']='铜陵市';ja['1509']='滁州市';ja['1510']='黄山市';ja['1511']='淮南市';ja['1512']='六安市';ja['1513']='巢湖市';ja['1514']='宣城市';ja['1515']='池州市';
ja['1600']='河北省';ja['1602']='石家庄市';ja['1603']='廊坊市';ja['1604']='保定市';ja['1605']='唐山市';ja['1606']='秦皇岛市';
ja['1700']='河南省';ja['1702']='郑州市';ja['1703']='洛阳市';ja['1704']='开封市';
ja['1800']='湖北省';ja['1802']='武汉市';ja['1803']='宜昌市';ja['1804']='黄石市';ja['1805']='襄樊市';ja['1806']='十堰市';ja['1807']='荆州市';ja['1808']='荆门市';ja['1809']='孝感市';ja['1810']='鄂州市';
ja['1900']='湖南省';ja['1902']='长沙市';ja['1903']='株洲市';ja['1904']='湘潭市';ja['1905']='衡阳市';ja['1906']='岳阳市';ja['1907']='常德市';ja['1908']='益阳市';ja['1909']='郴州市';ja['1910']='邵阳市';ja['1911']='怀化市';ja['1912']='娄底市';ja['1913']='永州市';ja['1914']='张家界市';
ja['2000']='陕西省';ja['2002']='西安市';ja['2003']='咸阳市';ja['2004']='宝鸡市';ja['2005']='铜川市';ja['2006']='延安市';
ja['2100']='山西省';ja['2102']='太原市';ja['2103']='运城市';ja['2104']='大同市';ja['2105']='临汾市';
ja['2200']='黑龙江省';ja['2202']='哈尔滨市';ja['2203']='伊春市';ja['2204']='绥化市';ja['2205']='大庆市';ja['2206']='齐齐哈尔市';ja['2207']='牡丹江市';ja['2208']='佳木斯市';
ja['2300']='辽宁省';ja['2302']='沈阳市';ja['2303']='大连市';ja['2304']='鞍山市';ja['2305']='营口市';ja['2306']='抚顺市';ja['2307']='锦州市';ja['2308']='丹东市';ja['2309']='葫芦岛市';ja['2310']='本溪市';ja['2311']='辽阳市';ja['2312']='铁岭市';
ja['2400']='吉林省';ja['2402']='长春市';ja['2403']='吉林市';ja['2404']='辽源市';ja['2405']='通化市';
ja['2500']='云南省';ja['2502']='昆明市';ja['2503']='曲靖市';ja['2504']='玉溪市';ja['2505']='大理市';ja['2506']='丽江市';ja['2507']='蒙自市';ja['2508']='开远市';ja['2509']='个旧市';ja['2510']='红河州';
ja['2600']='贵州省';ja['2602']='贵阳市';ja['2603']='遵义市';
ja['2700']='甘肃省';ja['2702']='兰州市';ja['2703']='金昌市';
ja['2800']='内蒙古';ja['2802']='呼和浩特市';ja['2803']='赤峰市';ja['2804']='包头市';
ja['2900']='宁夏';ja['2902']='银川市';
ja['3000']='西藏';ja['3002']='拉萨市';ja['3003']='日喀则市';
ja['3100']='新疆';ja['3102']='乌鲁木齐市';ja['3103']='克拉玛依市';ja['3104']='喀什地区市';
ja['3200']='青海省';ja['3202']='西宁市';
ja['3300']='香港';
ja['3400']='澳门';
ja['3500']='台湾';
ja['3600']='国外';
//主要城市数据字典
var maincity=[['华北-东北',['0100','0500','2303','2302','2402','2202']],['华东 地区',['0200','0702','0703','0802','0803','1502','1102','1202','1203']],['华南-华中',['0302','0400','0308','1802','1902','1702']],['西北-西南',['2002','0902','0600','2502']]];
//所有省份数据字典
var allprov=[['华北-东北',['1600','2100','2800','2300','2400','2200']],['华东 地区',['0700','0800','1500','1100','1300','1200']],['华南-华中',['0300','1400','1000','1700','1800','1900']],['西北-西南',['2000','2700','3200','2900','3100','0900','2600','2500','3000']],['其它',['3300','3400','3500','3600']]];
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

/** 选择城市 **/
TC.init_sele_city=function(o)
{
	$(o).click(function(){
		var id=$(o).attr('id').split('-')[1];

		//是否已经选择这个省
		if($(o).hasClass("seled")){
		 
			//删除已经选择的城市
			event_monitor.broadcast(this, "sele_deled", id);
			return;
		}


		//
		var sel_arr=$('#sv').val().split(' ');

		//判断已经选择了 5 个城市
		if(sel_arr.length == select_count+1){
			alert('您只能选择'+select_count+"个城市。");
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
	var sel_arr=$('#sv').val().split(' ');

	
	//判断已经选择了 5 个城市
	//if(sel_arr.length == select_count+1){
	//	alert('您只能选择'+select_count+"个城市。");
	//	return;
	//}


		//文本数组
	var sel_arr_text = $('#sh').val().split(' ');

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



//初始化选择城市对话框
TC.init_sh_city=function(o)
{
	$(o).click(function(e){

		var obj = $(o).attr('id').split('-')[1];

		var id=obj.substring(0,2);
		var content='<ul>';
		var key;
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
		content+='</ul>';

		//alert(content);

		var px = e.pageX-15;
		var py = e.pageY-15;
		$("#spop").html(content).css('top',py+'px').css('left',px+'px').show();
		load_event_monitor($('#spop'));
	});
}
function getValue(data){var val='';var selvalue = data.split(' ');	for(i=0;i<selvalue.length-1;i++){val+=ja[selvalue[i]+''] + ' ';}return val;};

var isbuild=false;
var ismd=false;
var lmX=0;
var lmY=0;
var leX=0;
var leY=0;
$(function(){


	//自定义已经选择的城市初始化
	init_selected();




	$("#sub_form").click(function(){
		var se = getValue($("#sv").val());alert('您选择了：'+se+', id: ' + $("#sv").val());  
	});  

	if(!isbuild) {
	var content = '';
		

		/**
		content+='<h2>主要城市</h2>';
		for(var i=0;i<maincity.length;i++)
		{
			content +='<h3>' +maincity[i][0]+"</h3><div class='optcon'><ul>";
			for(var k=0;k<maincity[i][1].length;k++)
			{
			content+="<li><a class='j a_sele_city' id='c-"+maincity[i][1][k]+"' href='javascript:void(0);'>"+ja[maincity[i][1][k]]+"</a></li>";
			}
			content+='</ul></div>';
		}
		**/

		content +="<h2>所有省份</h2>";


		var sel_arr=$('#sv').val().split(' ');

		//alert($('#sv').val());
		for(var i=0;i<allprov.length;i++)
		{
			//content+='<h3>'+allprov[i][0]+"</h3>";
			content+="<div class='optcon'><ul>";


			//省份初始化
			for(var k=0;k<allprov[i][1].length;k++){

				//查找省是否已经选择
				if( cruel_search( sel_arr,allprov[i][1][k] ) > -1 )
				{
					content+="<li><a class='j a_sh_city seled' id='p-"+allprov[i][1][k]+"' href='javascript:void(0);'>"+ja[allprov[i][1][k]]+"</a></li>";

				}else{
					content+="<li><a class='j a_sh_city' id='p-"+allprov[i][1][k]+"' href='javascript:void(0);'>"+ja[allprov[i][1][k]]+"</a></li>";
				}
				
			}
			content+="</ul></div>";
		}


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

	/** 已经选择然后删除 ***/
	event_monitor.subscribe("sele_deled",function(o,data){
			$('#c-'+data).removeClass('seled');
			if($('#pc-'+data).length!=0){$('#pc-'+data).removeClass('seled');}
			//alert($('#c-'+data).length);
			//$('#c-'+data).each(function(i,obj){obj.removeClass('seled');});  

			$('#p-'+data).removeClass('seled');
			$('#sv').val($('#sv').val().replace(data+' ',''));
			//$('#mycity').html(getValue($('#sv').val()));

			//设置按钮的文本
			$("#sh")[0].value=getValue($('#sv').val());

			$('#se-'+data).remove();
	   });
	  event_monitor.subscribe("sele_add",function(o,data){
			var cv=$('#sv').val();	
			if(cv.lastIndexOf(data)<0 && ja[data])
			{
				$('#sv').val($('#sv').val()+data+' ');
				//$('#mycity').html(getValue($('#sv').val()));
				$("#sh")[0].value=getValue($('#sv').val());
			}
			if(data.substring(2)=='00'){var key='';for(var i=1;i<20;i++){
				if(i<10) key=data.substring(0,2)+'0'+i;else key=data.substring(0,2)+i;
				event_monitor.broadcast(null, "sele_deled", key);}
				}
			else{event_monitor.broadcast(null, "sele_deled", data.substring(0,2)+'00');}
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