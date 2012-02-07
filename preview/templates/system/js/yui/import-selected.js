(function() {


var Dom = YAHOO.util.Dom;
var Event = YAHOO.util.Event;
var DDM = YAHOO.util.DragDropMgr;


//////////////////////////////////////////////////////////////////////////////
// example app
//////////////////////////////////////////////////////////////////////////////
YAHOO.example.DDApp = {

    init: function() {

		//alert($('.layout').length);
		$('.layout').each(function(k,obj){
				new YAHOO.util.DDTarget(obj);
				$(obj).children().each(function(x,y){	//循环输出
				
					//加载工具条
					 
						var offset = $(y).offset();
						var tool = $('<div class="layout_tool" ><div class="lay_close"></div><div class="lay_config"></div></div>');
						tool.css({'left':offset.left+$(y).width()-100,'top':offset.top});
						y.tool = tool;
						$(y).append(tool);

						/** 加编辑事件 **/
						tool.find('.lay_config').click(function(){
							//alert('ok');
							parent.configModule(this.parentNode.parentNode.id);
							//alert(parent.document);//.configModule();
							//alert(this.parentNode.parentNode.id);
						});


						/** 添加删除组件事件 **/
						tool.find('.lay_close').click(function(){
							closeModule(this.parentNode.parentNode);
 						});
					//});
					new YAHOO.example.DDList(y);
				});
			 
		});
 


		//new YAHOO.example.DDList("mod_logo");
		//new YAHOO.example.DDList("mod_company");
		//new YAHOO.example.DDList("mod_product");

        //Event.on("showButton", "click", this.showOrder);
        //Event.on("switchButton", "click", this.switchStyles);
    },

    showOrder: function() {
        var parseList = function(ul, title) {
            var items = ul.getElementsByTagName("li");
            var out = title + ": ";
            for (i=0;i<items.length;i=i+1) {
                out += items[i].id + " ";
            }
            return out;
        };

        var ul1=Dom.get("ul1"), ul2=Dom.get("ul2");
        alert(parseList(ul1, "List 1") + "\n" + parseList(ul2, "List 2"));

    },
	
    switchStyles: function() {
        Dom.get("ul1").className = "draglist_alt";
        Dom.get("ul2").className = "draglist_alt";
    },

	setToolPosition:function(){
		//重设工具条位置
		var offset;
		setTimeout(function(){
			//alert($(proxy).offset().top);
			$('.layout_tool').each(function(k,o){
				offset=$(o.parentNode).offset();
				$(o).css({'left':offset.left+$(o.parentNode).width()-100,'top':offset.top});
				//$(o).css('top',$(o.parentNode).offset().top);
				$(o).show();
			});
			
		},300);
		//重设当前文档高度
		setIframeHeight();

	}
};

//////////////////////////////////////////////////////////////////////////////
// custom drag and drop implementation
//////////////////////////////////////////////////////////////////////////////

YAHOO.example.DDList = function(id, sGroup, config) {

    YAHOO.example.DDList.superclass.constructor.call(this, id, sGroup, config);

    this.logger = this.logger || YAHOO;
    var el = this.getDragEl();
    Dom.setStyle(el, "opacity", 0.67); // The proxy is slightly transparent

    this.goingUp = false;
    this.lastY = 0;
};



YAHOO.extend(YAHOO.example.DDList, YAHOO.util.DDProxy, {

    startDrag: function(x, y) {
        this.logger.log(this.id + " startDrag");

        // make the proxy look like the source element
        var dragEl = this.getDragEl();
        var clickEl = this.getEl();
        Dom.setStyle(clickEl, "visibility", "hidden");

        dragEl.innerHTML = clickEl.innerHTML;

        Dom.setStyle(dragEl, "color", Dom.getStyle(clickEl, "color"));
        Dom.setStyle(dragEl, "backgroundColor", Dom.getStyle(clickEl, "backgroundColor"));
        Dom.setStyle(dragEl, "border", "2px solid gray");
    },

    endDrag: function(e) {

        var srcEl = this.getEl();
        var proxy = this.getDragEl();
		
	
        // Show the proxy element and animate it to the src element's location
        Dom.setStyle(proxy, "visibility", "");
        var a = new YAHOO.util.Motion( 
            proxy, { 
                points: { 
                    to: Dom.getXY(srcEl)
                }
            }, 
            0.2, 
            YAHOO.util.Easing.easeOut 
        )
        var proxyid = proxy.id;
        var thisid = this.id;

        // Hide the proxy and show the source element when finished with the animation
        a.onComplete.subscribe(function() {
                Dom.setStyle(proxyid, "visibility", "hidden");
                Dom.setStyle(thisid, "visibility", "");
            });
        a.animate();
		//$('.layout').removeClass('clayout');
		
		//alert($(proxy).find('.layout_tool').html());




		//重设工具条位置
		YAHOO.example.DDApp.setToolPosition();
     },

    onDragDrop: function(e, id) {

        // If there is one drop interaction, the li was dropped either on the list,
        // or it was dropped on the current location of the source element.
        if (DDM.interactionInfo.drop.length === 1) {

            // The position of the cursor at the time of the drop (YAHOO.util.Point)
            var pt = DDM.interactionInfo.point; 
			
            // The region occupied by the source element at the time of the drop
            var region = DDM.interactionInfo.sourceRegion; 
 
            // Check to see if we are over the source element's location.  We will
            // append to the bottom of the list once we are sure it was a drop in
            // the negative space (the area of the list without any list items)
            if (!region.intersect(pt)) {
                var destEl = Dom.get(id);
                var destDD = DDM.getDDById(id);
				
				//if( !destDD.isEmpty){ return;}
					var cEL =this.getEl();

 					destEl.appendChild(cEL);
					destDD.isEmpty = false;
					DDM.refreshCache();
             }
		
			//alert('ok');
        }
    },

    onDrag: function(e) {

        // Keep track of the direction of the drag for use during onDragOver
        var y = Event.getPageY(e);

        if (y < this.lastY) {
            this.goingUp = true;
        } else if ( y > this.lastY) {
            this.goingUp = false;
        }

        this.lastY = y;
		$('.layout_tool').hide();
    },

    onDragOver: function(e, id) {
    
        var srcEl = this.getEl();
        var destEl = Dom.get(id);
		
		if( srcEl.parentNode.className.indexOf('layout') != -1 && destEl.parentNode.className.indexOf('layout') != -1 ){
		 
		 

			/**
			if( destEl.parentNode.id !='ul1' )
			{
				var len = destEl.parentNode.children.length;
				if( len > 0  ) return false;
			}
			**/
			
			// We are only concerned with list items, we ignore the dragover
			// notifications for the list.
			//if (destEl.nodeName.toLowerCase() == "li") {
				var orig_p = srcEl.parentNode;
				var p = destEl.parentNode;
				
				//$('.layout').removeClass('clayout');
				//$(p).addClass('clayout');


				//$(destEl).css('border','1px solid red');
				if (this.goingUp) {
					//alert(srcEl.nodeName+srcEl.className);
 					p.insertBefore(srcEl, destEl); // insert above
				} else {
					p.insertBefore(srcEl, destEl.nextSibling); // insert below
				}


 				//$(srcEl).find('.layout_tool').css({'top':$(destEl).offset().top});

				//$(destEl).find('.layout_tool').css({'top':$(srcEl).offset().top});


				//自定义的显示需要移到指定的位置
				//this.showTargetPosition(srcEl,destEl,this.goingUp);
				DDM.refreshCache();

		   // }

		}
    },
	//自定义的显示需要移到指定的位置
	showTargetPosition:function(srcEl,destEl,up){

		if( !document.body.targetPos )
		{
 			document.body.targetPos = $("<div class='showposition'></div>");
			$(document.body).append(document.body.targetPos);
		}
		
		document.body.targetPos.html(destEl.nodeName+up);
		if( up )	//如果是上的话
		{
			document.body.targetPos.css({
				'left':$(destEl).offset().left,
				'top':$(destEl).offset().top-$(srcEl).height()+5,
				'width':$(destEl).width(),
				'height':$(srcEl).height()-10
 			});
		}else{	//如果是下的话
			document.body.targetPos.css({
				'left':$(destEl).offset().left,
				'top':$(destEl).offset().top+$(destEl).height()+5,
				'width':$(destEl).width(),
				'height':$(srcEl).height()
			});
		}
	}
});

Event.onDOMReady(YAHOO.example.DDApp.init, YAHOO.example.DDApp, true);




//当加载完毕后，重设高度
setIframeHeight();


//重写a标签的CLICK属性
$('a').click(function(){
 
	if( this.className !='lay_close' && this.className != 'lay_config' ){
		if( confirm('是否离开当前的布局管理?') ){
 			var href= this.href;
			setTimeout(function(){	parent.location.href = href; },100);
		}else{
			//parent.location.href = this.href;
		}
		return false;
	}else{
		return true;
		
	}
});
})();


/** 重设 inframe 高度 **/
function setIframeHeight(){
	if( window.parent)
	{
		var height = document.body.scrollHeight;
		//alert(height);
		//$(document.body).height(height+35);
		//alert(height);
  		$(parent.document.getElementById("front")).height(height);
		//alert(height);
	}
}


/**
 * 重新加载单个的模块
 */
function loadModule(m)
{
	var s = m.split('-');
	var uri = 'index.php?com=style&task=ajaxgetmodule&no_html=1&custom=1&loadmodule='+s[1];
	$.get(uri,function(data){
		
		//创建一个新模型
		var new_module = $(data);
		$('#'+m).html(new_module.html());
		//alert(data+uri);

		var tool =$('#'+m).get(0).tool;
		$('#'+m).append(tool);


		
		/** 加编辑事件 **/
		tool.find('.lay_config').click(function(){
			//alert('ok');
			parent.configModule(this.parentNode.parentNode.id);
			//alert(parent.document);//.configModule();
			//alert(this.parentNode.parentNode.id);
		});


		/** 添加删除组件事件 **/
		tool.find('.lay_close').click(function(){
			closeModule(this.parentNode.parentNode);
		});

		//释放变量
		new_module=null;


		//重设工具条的位置
		YAHOO.example.DDApp.setToolPosition();
 		//new YAHOO.example.DDList($('#'+m).get(0));
	});
	//alert(m);
	//$('#'+m).html('');
}

/** 加载一个模块并创建一个HTML模块 **/
function loadNewModule(m,pos)
{
 	var s = m.split('-');
	var uri = 'index.php?com=style&task=ajaxgetmodule&no_html=1&custom=1&loadmodule='+s[1];
 	$.get(uri,function(data){ 
 		if( pos && $('#'+pos).get(0) ){
			 
		}else{
			pos = "left";
		}
 			var  y=$(data).get(0);
			$('#'+pos).append(y);


			/** 加工具条 **/
			var offset = $(y).offset();
			var tool = $('<div class="layout_tool" ><div class="lay_close"></div><div class="lay_config"></div></div>');
			tool.css({'left':offset.left+$(y).width()-100,'top':offset.top});
			y.tool = tool;
			$(y).append(tool);

			/** 加编辑事件 **/
			tool.find('.lay_config').click(function(){
				//alert('ok');
				parent.configModule(this.parentNode.parentNode.id);
				//alert(parent.document);//.configModule();
				//alert(this.parentNode.parentNode.id);
			});


			/** 添加删除组件事件 **/
			tool.find('.lay_close').click(function(){
				closeModule(this.parentNode.parentNode);
			});
			new YAHOO.example.DDList(y);
			//重设工具条的位置
			YAHOO.example.DDApp.setToolPosition();
 		 
	});

}


/** 关闭模块 **/
function closeModule(obj)
{
	//
	$(obj).remove();
	parent.checkboxState(obj.id);
	YAHOO.example.DDApp.setToolPosition();
}

//提交保存按钮
function getLayout()
{

	var order = '';
	$('.layout').each(function(k,obj){
 		$(obj).children().each(function(x,y){	//循环输出
			y.order = (x+1);
		});
	});
 

}

