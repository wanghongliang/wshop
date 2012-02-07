(function($) {


	////////////////后台左边快捷菜单点击打开
	//$(".navmenu .b").hide();
	$(".navmenu .t").click(function(){
		$(".navmenu .b").slideUp('fast');
		$(".b",this.parentNode).slideToggle('fast',function(){
			//设置加减号
			$(".navmenu .t").attr('class','t jia');
			 if( this.style.display == 'block' ){
				 $(".t",this.parentNode).get(0).className = 't';
			 }else{
				 $(".t",this.parentNode).get(0).className ='t jia';
			 }
			
 			// alert(this.className);
		});

		//alert($(".b",this.parentNode).get(0).style.display);
		//if( $(".b",this.parentNode).get(0).style.display != 'block' ){
 		//    this.className == 't';
		//}else{
		//	this.className == 't jia';
		//}

		///alert(this.className);

		 
 	});
	/**
	var finded=false;
	$(".navmenu ul li").each(function(k,obj){
		if( obj.className == 'active' ){
			//alert(this.parentNode.parentNode.parentNode);
			$(".navmenu .b").hide();
			$(".b",this.parentNode.parentNode.parentNode).toggle();
			finded = true; //找到当前的菜单列表
		}
	});

	//如果没有找到
	if( !finded ){
		///alert($(".navmenu").get(0));
		$(".b",$(".navmenu").get(0)).show();
	}
	**/
	/////////完成JS控制左边快捷菜单///////////////
	
	//表格排序
	orderTable();
	
	addTREvent(); //给列表加事件

	//alert($(document).scrollTop());



	$('.selectall').click(function(){
  		$('.ids').attr('checked',this.checked);
		$('.ids').each(function(k,o){
			if(o.checked){
				$(o.parentNode.parentNode).addClass('trc2');
			}else{
				$(o.parentNode.parentNode).removeClass('trc2');
			}
		});
	});

	///切换命令按钮
	$('.switch_btn li').each(function(k,obj){
		var con = $('.switch_con .con');
		$(obj).click(function(){
			con.hide();
			$('.switch_btn li').removeClass('active');
			$(con[k]).show();
			$(obj).addClass('active');
		});
	});
	$('.switch_btn li').hover(function(){
		$(this).addClass('hover');
	},function(){
		$(this).removeClass('hover');
	});

	if( $('#system-message').get(0) ){	//有消息则自动关闭
		if( !$('#system-message').get(0).init ){
			$('#system-message').css('left',( document.body.clientWidth-500 )/2  );
			$('#system-message').show();
			
			if( $('#system-message').find('ul').attr('class') == 'error-text' ){
				closeBtn = $('<dd class="messageclose" >关闭</dd>');
				closeBtn.click(function(){
					$('#system-message').fadeOut("fast");
				});
				$('#system-message').get(0).appendChild( closeBtn.get(0) );
			}else{
				setTimeout(function(){   $('#system-message').fadeOut("fast"); $('#system-message').get(0).init=true;},1000);
			}
		}
	}

   	/** 文章商品等组件专用排序 **/
	$('.ordering').focus(function(){
		if( !$.w.orderbtn )
		{
			 $.w.orderbtn = $('<div class="order_savebtn" >保存</div>').get(0);
		}
  		var obj = this;
		var savebtn = $.w.orderbtn;
		var value= this.value;
		var offset = $(this).offset();

		$(savebtn).css({'left':offset.left+32,'top':offset.top});
		$(savebtn).show();
		this.parentNode.appendChild(savebtn);
		
		//TR
		var tr = this.parentNode.parentNode;
		var id;
		if( tr.nodeName == 'TR')
		{
			 id = $(tr).find('.ids').get(0).value;
			//alert(id);
		}

		$(savebtn).click(function(){
			if( obj.value != value ){
				var uri = 'index.php?com='+$('input[name=com]').attr('value')+'&task=ordering&id='+id+'&from='+value+'&to='+obj.value+'&tmpl='+$('input[name=tmpl]').attr('value');
				 uri+='&menuid='+$('input[name=menuid]').attr('value');
				// alert(uri);
				gotohref(uri);
			}
		});
		
		//$(this).mouseout(function(){ 
			//setTimeout(function(){
			//$(savebtn).fadeOut("fast"); },1000);
		//});
 


	});
	

})(jQuery);

function orderTable(){
		/** 表排序 **/
	$(".moveordertable").tableDnD({onDragClass: "myDragClass",
		onFilterDown:function(obj,row){
 			return ( $(obj).find('.orderinput').attr('pos') ==  $(row).find('.orderinput').attr('pos') );
		},
		onFilterUp:function(obj,row){
 			return ( $(obj).find('.orderinput').attr('pos') ==  $(row).find('.orderinput').attr('pos') );
		},
		onDrop: function(table, row) {
            var rows = table.tBodies[0].rows;
           // var debugStr = "Row dropped was "+row.id+". New order: ";
			var debugStr = "";
			var ids = "";

			var order ="";			
			
			
			var old_order = $('input[name=input_ordering]').attr('value');
			old_order_array = old_order.split(',');
			 
            for (var i=0; i<rows.length; i++) {
				if( $(rows[i]).find('.orderinput').get(0) ){
					 debugStr += ","+$(rows[i]).find('.orderinput').attr('value');
					 order += ","+i;
					 ids += ","+$(rows[i]).find('input[type=checkbox]').attr('value');

					 $(rows[i]).find('.orderinput').attr('value',old_order_array[i]);
				}
            }
 
 		    debugStr = debugStr.substring(1,debugStr.length);
			ids = ids.substring(1,ids.length);
			order = order.substring(1,order.length);

			//alert( debugStr );
			if( old_order != debugStr )
			{
				 
				var uri = "index.php?com="+$('input[name=com]').attr('value')+"&task=moveorder&no_html=1";
				$.get(uri,{ostring:old_order,order:order,ids:ids},function(data){
					//alert(data);
					// $('input[name=input_ordering]').attr('value',debugStr);
				});
			}
	    }
	});
}

function addTREvent(){ 
	$('.listtable tr').hover(function(){
		$(this).addClass('trcurrent');
	},function(){
		$(this).removeClass('trcurrent');
	}).click(function(){
		 
		if( this.className.indexOf('trc2') != -1 ){
			$(this).removeClass('trc2');$('input',this).get(0).checked = false;
		}else{
			$(this).addClass('trc2');$('input',this).get(0).checked = true;
		}
	});
}

function v(){ }	//空链接

//js直接转向
function href(uri){
	ids = getIDS();	//ID字符串
	if( ids )
	{
 		location.href=uri+'&ids='+ids;	//加上选择的ID字符串
	}
}
function gotohref(href){location.href=href};



//得到当前选择的ID
function getIDS()
{
	ids = '';
 	$('.ids').each(function(k,obj){
		if (obj.checked )
		{
			ids +=','+ obj.value;
		}

	});
	if( !ids ){
		alert(' 请选择一项! ');
		return false;
	}
 	return ids.substring(1,ids.length);
}

var up_selct_obj = null;
//参数 obj 为当前击活的按钮
function upload(name,rename)
{ 
	//FCK 扩展用的
	if( typeof(name) != "string" && typeof(name) != null && typeof(name) != 'undefined' ){
		up_selct_obj = name;
	}
 	$.w.createDialog({
		title:'上传',
		width:520,
		height:250,
		iframe:true,
		url:'index.php?com=uploads&tmpl=component&iname='+name+'&rename='+rename,
		isget:true,
		reload:true
	},2); 
 }
 function uploadIMG(name,rename,com){
 	if( typeof(name) != "string" && typeof(name) != null && typeof(name) != 'undefined' ){ up_selct_obj = name; }
 	$.w.createDialog({
		title:'上传图片文件',
		width:520,
		height:250,
		iframe:true,
		url:'index.php?com=uploads&tmpl=component&iname='+name+'&rename='+rename+'&iscom='+com,
		isget:true,
		reload:true
	},2);
 }


//上传完毕后设定上传图片值
function uploadSuccess(name,value)
{
  	setTimeout(function(){  $.w.closeN(2);},200); 
	//如果添加的是商品图片,将调用商品JS 
	if( name.indexOf('addpimg') != -1 ){
		addpimg(value,name);
	}else if( up_selct_obj ){
		$(up_selct_obj).attr('value',value);
	}else{
 		$('#'+name).attr('value',value);
	}
}

function selectSuccess(name,value)
{
 	setTimeout(function(){  $.w.closeN(3);},200);
	if( up_selct_obj ){
		$(up_selct_obj).attr('value',value);
	}else{ 
 		$('#'+name).attr('value',value);
	}
}

//选择已上传的图片文件 
function selectImage(name){
	//FCK 扩展用的
	if( typeof(name) != "string" && typeof(name) != null && typeof(name) != 'undefined' ){
		up_selct_obj = name;
	}
 	$.w.createDialog({
		title:'选择',
		width:800,
		height:520,
		top:10,
		iframe:true,
		url:'index.php?com=media&no_html=1&iname='+name,
		isget:true,
		reload:true
	},3);
}



//添加ＴＲ
function addTR(obj){
	var tr =obj.parentNode.parentNode;
	if( tr.nodeName == 'TR' )
	{
		tr.parentNode.insertBefore( tr.cloneNode(true) , tr.nextSibling );
	}
}

function delTR(obj){
	var tr =obj.parentNode.parentNode;
	if( tr.nodeName == 'TR' )
	{
		tr.parentNode.removeChild(tr);
	}
}


//通过菜单过滤
function filterByMenu(tv,v)
{	$('input[name=mtid]').attr('value',tv);
	$('input[name=menuid]').attr('value',v);
	submitForm();
} 
function submitForm(){
	$('form[name=listform]').get(0).submit();
}

 // 排序专用
function tableOrdering( order, dir, task ) {
	var form = document.listform;
	form.filter_order.value 	= order;
	form.filter_order_dir.value	= dir;
	form.submit();
}

/** 内容删除提示 **/
function del(href)
{
	$.w.confirm({title:'请确认是否删除',confirm:function(tag,d){
		if( tag == 0 ){ $(d).fadeOut("fast"); $.w.closeMask(); }else{ location.href=href;};
	}},href);
}

/** 删除所有提示 **/
function delall(href){ 
	ids = getIDS();	//ID字符串
	if( ids )
	{
		del(href+'&ids='+ids);
	}
}

/** 移动提示 **/
function moveAll(href,task){
	ids = getIDS();	//ID字符串
	if( ids )
	{
 		// 继承属性
		var options = {title:'移动所选文章',width:250,height:80,top:30,
			url:href+'&task='+task,
			isget:true,
			loadAfter:function(obj){
				$(obj).find('select').change(function(){
 					//alert(href+'&task=moveall&movetoid='+this.value+'&ids='+ids;);
					location.href=href+'&task=moveall&movetoid='+this.value+'&ids='+ids;;
				});
			}
		};
		var d =  $.w.createDialog(options,9 );
	}
}





///////////////////////  以下JS 是布局用的 ///////////////////

var cModule;	//当前操作的模块



/** 打开配置管理对话框 **/
function configModule(str)
{
 	var s = str.split('-');
	cModule = str;
 
	if( !parseInt(s[1])){ alert('没有指定模块ID信息或不是模块.');return; }
	
  	// 继承属性
	var options = {title:'配置模块信息',width:850,height:500,top:20,
		url:'index.php?com=modules&tmpl=component&task=edit&id='+s[1],
		iframe:true,
		reload:true,
		isget:true,
		loadAfter:function(obj){
 
		}
	};

	//打开配置对话框
	var d =  $.w.createDialog(options,11 );
}

/** 保存模块后调用前台脚本更新当前模块 **/

//参数为模块JSON对象
function saveM(moduleJSON){
	if( !window.frames["front"] ) return false;
	var m = window.frames["front"].document.getElementById(cModule);
	
	//首先判断是否存在该模块，如果不存在，刚是新建
	if( m ){
		window.frames["front"].loadModule(cModule);
		//window.frames[0].document.ElementById(cModule).innerHTML='';	
		setTimeout(function(){$.w.closeN(11);},200);	//关闭对话框
	}else{
 
		//动态生成模块列表
		$('#exists_module').append('<li><a href="#" > <input  class="md" type="checkbox" name="'+moduleJSON.module+'" value="'+moduleJSON.id+'"  onclick="javascript:toggleM(\''+moduleJSON.module+'-'+moduleJSON.id+'\',\''+moduleJSON.position+'\',this)"; ></a>'+moduleJSON.title+'</li>');
		setTimeout(function(){$.w.closeN(11);},200);	//关闭对话框
	}
}




/** 添加对话框 **/
function openCreateMD(type){
  	// 继承属性
	var options = {title:'配置模块信息',width:850,height:500,top:20,
		url:'index.php?com=modules&tmpl=component&task=add&client_id=0&select='+type,
		iframe:true,
		reload:true,
		isget:true,
		loadAfter:function(obj){
			
		}
	};
	var d =  $.w.createDialog(options,11 );
}

 



/** 打开或关闭模块 **/
function toggleM(str,pos,obj)
{
	//查找到当前风格中是否有该模块
	var m = window.frames["front"].document.getElementById(str);
	//alert('#'+str);

	
	//有的话直接打开和关闭
	if( m )
	{
		if( obj.checked ){
			$(m).show();
		}else{
			$(m).hide();
		}
		
		//重设工具条的位置
		window.frames["front"].YAHOO.example.DDApp.setToolPosition()
	}else{	
 		if( obj.checked ){
  			//没有的话就直接加载一个新的模块，到该对象上
			 window.frames["front"].loadNewModule(str,pos);
		}
	}
}

//设置CHECKBOX状态
function checkboxState(id){
	var s = id.split('-');

	//找到checkbox ，并关闭状态
 	$('input[value='+s[1]+']').get(0).checked = false;

}
var timeoutProcess; 
//设置高度,滚动条同步
$(function(){

	//重设iframe设度，上他的模块要编辑
	//var height = document.compatMode=="CSS1Compat" ? document.documentElement.clientHeight : document.body.clientHeight; 
	//alert(height);
	//$("#front").height(height-35); 
 	$('.menu li').mouseover(function(){
		var obj = this;
		$('.ss').hide();
		$('.home').removeClass('over');
		$('.dropmenu').removeClass('over');//$('select').css('visibility','visible');
 		if( timeoutProcess ){
			$('.menu .ss').hide();
			//alert(this);
			$('.menu li').removeClass('over');
			clearTimeout(timeoutProcess);
		} 
		$('.ss',this).show();
		//$('select').css('visibility','hidden');
		if( this.className == 'dropmenu' || this.className == 'home' ){
			$(this).addClass('over');
		}
	}).mouseout(function(){
		var obj = this;
		//obj.hide();
		//timeoutProcess = setTimeout( 
			//function(){
				//$('.ss',obj).hide();
				//$(obj).removeClass('over');//$('select').css('visibility','visible');
			//},100 
			
		//);
 		
 	});
	$('body').click(function(obj){
		if( obj.target.parentNode.parentNode.className != 'ss'  ){
		$('.home').removeClass('over');
		$('.dropmenu').removeClass('over'); 
		$('.ss').hide();
		}
	});
	 
 
});

///////////////////////// 完成 //////////////////////////////


//生成导航管理菜单
function createNav(id){
	var nav =  '<div class="contentmenu" >&nbsp;</div>';
	var childs = $('.component').children();

	if( childs.length == 1 ){
		childs.each(function(k,o){
			$(o).css({float:'left','margin-left':'10px','width':$(o).width()-130});
		});
		$('.component').html( nav + $('.component').html() );
	}
	var uri = 'index.php?com=menu&task=ajaxmenu&no_html=1&t='+id;
	$.get(uri,function(data){
		//alert(data);
	$('.component .contentmenu').html(data);
	});
}



