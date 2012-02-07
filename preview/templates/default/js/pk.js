var dbnr,bbv,xsyc,xul,dbimg;

//初始化页面选框
function renew()
{
	var cooks=GetCookie("listhc").split("/");
	var bdbb=$("#bdbb input");
	for(var c=1;c<cooks.length;c++){var wf=cooks[c].split("_");for(var i=0;i<bdbb.length;i++){if(bdbb[i].id=="a"+wf[0]){bdbb[i].checked=true;break;}}}
}
//初始化漂浮层
function newpos()
{
	var ouli="",alls=0;
 
	var cooks=GetCookie("listhc").split("/");
	for(var i=1;i<cooks.length;i++){
		alls++;
 
		var wf=cooks[i].split("_|_");
		if( wf[2] ){
			ouli+="<li><img src='"+wf[2].replace(/&%#/g,"/")+"' width=50 class='img' />";
		}		
		if( wf[1] ){
			ouli+=wf[1].replace("&%#","/");
		}	
		ouli+=" <img src='/preview/templates/default/images/closex.gif' align='absmiddle' onclick='delli("+wf[0]+")' /> ";		
		ouli+="</li>";
	}
	xul.innerHTML=ouli;
	dbimg.innerHTML=alls;
	$("#tishi").get(0).style.display=(ouli=="")?"block":"none";
	xul.style.display=(ouli=="")?"none":"block";
	//if(!alls){dbnr.style.display="none";}
}

//点击处理，增加使用其他按钮加入对比的功能-liuliqiang，090304增加替换/分割符
function dblist(id,event,linkproname,img,tid)
{
	
 
	if( typeof(img) == "undefined" ){ 
		img = '';  
	}else{ img = img.replace(/\//g,"&%#"); }

	if( typeof(tid) == "undefined" ){ 
		tid = 't0';  
	}else{
		tid = 't'+tid;
	}
 

    if(typeof(linkproname) != "undefined" && linkproname.length > 0)
    {
        var nrid=$("link"+id);
	    var cook=GetCookie("listhc");
	    var cooks=cook.split("/");
	   
        //判断是否重复添加
        if(cook.indexOf("/"+id) > -1)
        {
            alert(linkproname+"已经加入对比");
            return;
        }
       // if( cook.indexOf("_|_"+tid) != -1 && cook.length>1 )
       // {
       //     alert(linkproname+"对比的产品不是一个类型.");
       //     return;
      //  }

        if(cooks.length>3){
			alert("最多只允许添加3条");
			return;
		}else{
			SetCookie("listhc",cook+"/"+id+"_|_"+linkproname.replace("/","&%#")+"_|_"+img+"_|_"+tid);
			zbyd(window.event||event);
		}
	   
    }
    else
    {
	    var cook=GetCookie("listhc");
	    var cooks=cook.split("/");
	    
        //090305liuliqaing修改：支持页面上有多个相同产品
        var ischecked = false;
        var nrid=document.getElementsByTagName("input");
 
        for(var i = 0;i<nrid.length;i++)
        {
            if(nrid[i].id == "a"+id && nrid[i].checked)
            {
                //增加判断重复-liuliqiang
                if(cook.indexOf("/"+id) > -1)
                {
                    alert(nrid[i].value+"已经加入对比");
                    return;
                }
                else if(cooks.length>3)
                {
                    nrid[i].checked=false;alert("最多只允许添加3条");return;
                }
                else
                {
					img = $(nrid[i]).attr('img').replace(/\//g,"&%#"); 
                    SetCookie("listhc",cook+"/"+id+"_|_"+nrid[i].value.replace("/","&%#")+"_|_"+img+"_|_"+tid);
					ischecked=true;
					zbyd(window.event||event);
                }
            }
        }
        if(!ischecked)
	        delCookie(id);
	}
	
	newpos();
	dbnr.style.display="block";
}

//漂浮窗口删除
function delli(id){
    delCookie(id);
    var nrid=document.getElementsByTagName("input");
    for(var i = 0;i<nrid.length;i++)
    {
        if(nrid[i].id == "a"+id)
        {
            nrid[i].checked = false;
        }
    }
    newpos();
}

function clears()
{
	SetCookie("listhc","")
	newpos();
	var kk=$("bdbb","input").length;
	for(var k2=0;k2<kk;k2++){
		$("bdbb","input")[k2].checked=false
	}
    dbhidd();
}
//增加点击开始对比的处理--liuliqiang
function comparepro()
{
    var cook=GetCookie("listhc");
	var cooks=cook.split("/");
	var url = "";
	for(var i = 0;i<cooks.length ;i++)
	{ 
	    var proid = cooks[i].substr(0,cooks[i].indexOf("_"));
	    if(proid.length > 0 )
	        url += ","+proid;
	}

	 
	if(url.length >0)
	{
	    window.open("/?com=products&view=compare&ids="+url.substr(1,url.length)+"");
	}
	else
	{
	    alert("请先选择要对比的产品");
	}
	return false;
}

function l(obj,v){
	if(v){ 
		obj.style.left=v+"px"; 
	}else{ 
		return obj.offsetLeft||(obj.documentElement.scrollLeft||obj.body.scrollLeft||0);
	}
}
function attr(obj,key,v){if(Fun.ie&&Fun.props[key]){key=Fun.props[key];}if(v){obj.setAttribute(key,v);}else{return obj.getAttribute(key);}}
//获取或设置节点属性
function w(obj,v){if(v){obj.style.width=v+"px";}else{return obj.offsetWidth||obj.body.offsetWidth||0;}}	//获取或设置节点宽
function h(obj,v){if(v){obj.style.height=v+"px";}else{return obj.offsetHeight||obj.body.offsetHeight||0;}}	//获取或设置节点高
function t(obj,v){if(v){obj.style.top=v+"px";}else{return obj.offsetTop||(obj.documentElement.scrollTop||obj.body.scrollTop||0);}}	//设置或返回上边距
function v(obj,v){if(v){obj.innerHTML?obj.innerHTML=v:obj.value=v;}else{return obj.innerHTML||obj.value||"";};}	//设置或返回值
function op(obj,v){if(Fun.ie){obj.filters.alpha.opacity=v;}else{obj.style.opacity=(v/100);}}	//设置层的透明度


//提示位置方法
function zbyd(event)
{
	var sw=50,sh=50,vw=15,vh=15,tjs=35;
	var sl=l(bbv);
	var vl=(event.pageX||(event.clientX+(document.documentElement.scrollLeft||document.body.scrollLeft)))-7;
	var st=(document.documentElement.scrollTop||document.body.scrollTop)+200;
	var vt=(event.pageY||(event.clientY+(document.documentElement.scrollTop||document.body.scrollTop)))-7;
	var spl=Math.floor(Math.abs((sl-vl)/tjs)),spt=Math.abs((st-vt)/tjs);
	xsyc.style.display="block";
	l(xsyc,vl);
	t(xsyc,vt);
	w(xsyc,vw);
	h(xsyc,vh);
	var maxTime=setInterval(function()
	{
		l(xsyc, (vl+spl)<sl?vl+=spl:((vl-spl)>sl?vl-=spl:vl=sl));
		t(xsyc, (vt+spt)<st?vt+=spt:((vt-spt)>st?vt-=spt:vt=st));
		w(xsyc, vw+2<sw?vw++:vw=sw);
		h(xsyc,vh+2<sh?vh++:vh=sh);
		tjs--;
		if(!tjs){
			xsyc.style.display="none";
			clearInterval(maxTime);
		}
	},10);
}
//显示/隐藏列表
function dbhidd(){dbnr.style.display=(dbnr.style.display=="block")?"none":"block";}

/*** 浮动发布代码 **/
var moveTime;
var bodyTop = 0;
var isTop = 200;
function moveEffect(obj,pos){
	if(moveTime){
		clearTimeout(moveTime);
	}
	var offset = obj.offset();
	moveUpEffect(obj,pos);
 
}
function moveUpEffect(obj,pos){
	var offset = obj.offset();
	//obj.css('top',offset.top+5);
	obj.css('top', offset.top + ( bodyTop + isTop - offset.top )/10 );
	moveTime=setTimeout(function(){ moveUpEffect(obj,pos);} , 20);
	return;
 
}
 



$(function(){
	$('body').append('<div id="xsyc"></div> <div id="bbv"><div id="prel"> <div id="dbimg" onclick="dbhidd()"><span></span></div><div id="pshou"><a href="/index.php?com=users&view=fav">我的收藏</a></div><div id="dbnr"> <b><span>商品对比</span><span class="span2" onclick="dbhidd()"><img src="/preview/templates/default/images/closex.gif" align="absmiddle" /></span></b> <div id="tishi">对不起，您还没有选择产品</div>  <ul></ul><div class="pkbut"><span><a href="#" onclick="return comparepro();">开始对比</a></span><span onclick="clears()">清&nbsp;空</span></div> </div></div></div>	');
	dbnr=$("#dbnr").get(0);
	bbv=$("#bbv").get(0);
	xsyc=$("#xsyc").get(0);
	xul=$("#dbnr ul")[0];
	dbimg=$("#dbimg span").get(0);

	newpos();
	renew();


	$(window).scroll(function(){

		if (typeof window.pageYOffset != 'undefined') {
			bodyTop = window.pageYOffset;
		}
		else if (typeof document.compatMode != 'undefined' && document.compatMode != 'BackCompat')
		{
			bodyTop = document.documentElement.scrollTop;
		}
		else if (typeof document.body != 'undefined') {
			bodyTop = document.body.scrollTop;
		}

		 moveEffect($("#bbv"),isTop+bodyTop);
		//$('.friendlist').animate({'top':(300+bodyTop)},100);

	});
});