



	//添加商品图片
	function addpimg(value){
		$('.pimg_thumb').removeClass('active');
		//alert(value);
		//图片
		var pimg = $('#pimg'); 
    
		if(  $('img',pimg).get(0) ){
			 $('img',pimg).attr('src',value);
			 $('.pimg_list ul').append('<li><div class="pimg_thumb active" onclick="selectPIMG(this)" ><img src="'+value+'" width=50 height=50 /></div><div class="del" ><a onclick="delpimg(this);">删</a> <a onclick="setThumb(this);" >缩</a>  <a onclick="setDefault(this);" >默</a></div></li>');
 			 
		}else{
			pimg.html('<img src="'+value+'" width=200 />');
			$('.pimg_list ul').html('<li><div class="pimg_thumb active  def" onclick="selectPIMG(this)" ><img src="'+value+'" width=50 height=50 /></div><div class="del" ><a  onclick="delpimg(this);" >删</a> <a onclick="setThumb(this);" >缩</a>  <a onclick="setDefault(this);" >默</a></div></li>');
			recreateThumb();
 
		}
		savePS();
	}
 
	//删除图片
	function delpimg(obj){
		if(confirm( "要刪除码，此操作不可恢复. ")){ 
			var thumbclass = $('.pimg_thumb',obj.parentNode.parentNode).attr('class');
			var img = $('img',obj.parentNode.parentNode).attr('src');
			$(obj.parentNode.parentNode).remove();
			//alert($('.pimg_list li').get(0));
			
			var pimg = $('.pimg_list li').get(0);

			//把当前的缩略图设为第一个
			if( pimg && thumbclass.indexOf('active')!=-1 ){
				$('#pimg img').attr('src',$('img',$('.pimg_list li').get(0)).attr('src'));
				$('.pimg_thumb',pimg).addClass('active');
				if(  thumbclass.indexOf('def')!=-1){
					$('.pimg_thumb',pimg).addClass('def');
				}
			}else if(!$('.pimg_list li').get(0)){
				$('#pimg').html('没有图片预览.');
			}

			//$.get('index.php?com='+com+'&task=deleteImg&no_html=1&img='+img,function(data){ 
				//删除成功
				//if( $.trim(data) == '1' ){
			var id = parseInt($('#productid').get(0).value);
			if( id>0 ){
				$.get('index.php?com='+com+'&task=saveImg&id='+id+'&no_html=1&img='+savePS(),function(data){
				// alert(data);
				});
			}
				//}else{

				//} 
			//}); 

			//if( com == 'series' ){ 
				$.get('index.php?com='+com+'&task=deleteImg&no_html=1&img='+img,function(data){
					//alert(data);
					//alert('图片彻底删除成功!');
				});
			//}

 
		}
	}

	//设为默认
	function setDefault(obj){
		$('.pimg_thumb').removeClass('def');
		//alert($('.pimg_thumb',obj.parentNode.parentNode).html());
		var pimg=$('.pimg_thumb',obj.parentNode.parentNode);
		pimg.addClass('def');
		var id = parseInt($('#productid').get(0).value);
		if( id>0 ){
			$.get('index.php?com='+com+'&task=ajax&act=setdefimg&id='+id+'&no_html=1&img='+savePS(),function(data){ 
				$('.pimg_thumb').removeClass('active');
				$(pimg).addClass('active');
				$('#pimg img').attr('src',$('img',pimg).attr('src'));
				alert(' 设置默认图片成功. ');

			});
		} 
	}
	function setThumb(obj){
		if(confirm( "确定要设为缩略图吗？ ")){
			var img = $('img',obj.parentNode.parentNode).attr('src');
 			var id = parseInt($('#productid').get(0).value);
			if( id>0 ){
				$.get('index.php?com='+com+'&task=ajax&act=setthumb&id='+id+'&no_html=1&img='+img,function(data){
					alert(' 设置缩略图成功. ');
				});
			}else{
				alert(' 设置缩略图成功. ');
				$('#thumbnail').val(img.substring(0,-4)+'_s.jpg');
			}
		}
	}



	//选择图片
	function selectPIMG(obj){
		//alert(obj);
		$('.pimg_thumb').removeClass('active');
		$(obj).addClass('active');
		$('#pimg img').attr('src',$('img',obj).attr('src')); 
		//savePS();
		//recreateThumb();//重新生成
	}
	


	//把图片路径保存到表单中
	function savePS(){
		var pimg_str = '';
		$('.pimg_list .pimg_thumb').each(function(k,obj){
			var s = $('img',this).attr('src');
				s = s.substring(s.indexOf('/media'),s.length);
			if( this.className.indexOf('def') != -1 ){
				//alert(this.className);
				pimg_str+=s+'|1,';
			}else{
				pimg_str+=s+',';
			}
		});

		//alert(pimg_str);
		$('#images').attr('value',pimg_str);

		return pimg_str;
	}

	
	//上传缩略图
	function openThumb(){
		$('#uploadthumb').toggle();
	}

	//当选择其它的图片后，自动生成缩略图
	function recreateThumb(){
		$('#recreate').attr('value',1);
	}



	//加载图集
	function selectSeries(id){
		//alert(id);
		
		$.get('index.php?com=series&no_html=1&task=ajax&act=loadseries&id='+id,function(data){
			 var d = eval('(' + data + ')');   
			 //alert(d.images);

			 //加载图集后，显示
			 if( d.images && d.images.length>0 ){
				// alert(d.images);
				var img = explode(',',d.images);
				var s = '<ul>';
				for(i=0;i<img.length;i++){
					if( img[i].length<2 ){ continue; }	//是否有值

					if( img[i].indexOf('|1') != -1 ){
						img[i] = img[i].substring(0,img[i].length-2);
						

						var pimg = $('#pimg');
						if(  $('img',pimg).get(0) ){
 							//$('img',pimg).attr('src',img[i]);
						}else{
							pimg.html('<img src="'+img[i]+'" width=200 />');
						}
						s += '<li><div class="pimg_thumb" onclick="selectPIMG(this)" ><img src="'+img[i]+'" width=50 height=50 /></div>';
					}else{
						s += '<li><div class="pimg_thumb" onclick="selectPIMG(this)" ><img src="'+img[i]+'" width=50 height=50 /></div>';
					}
					s += '<div class="del" ><a  onclick="delpimg(this);" >删</a>  <a onclick="setThumb(this);" >缩</a>  <a onclick="setDefault(this);" >默</a></div>';
					s += '</li>';
				}
				s+='</ul>';
				$('.pimg_list').append(s);
				savePS();
			 }

			// if( d.thumbnail ){ $('#thumbnail').val(d.thumbnail); }
		});
		
		$.w.closeN(3);
	}
	
	var relIn = {};
	//为属性选择关联图片
	function selectRelated(obj){
		//alert(obj);
		relIn = obj;

 		// 继承属性
		var options = {title:'选择相关联的图片',width:600,height:400,top:30, 
			loadAfter:function(obj){
				$(obj).find('select').change(function(){
 					//alert(href+'&task=moveall&movetoid='+this.value+'&ids='+ids;);
					location.href=href+'&task=moveall&movetoid='+this.value+'&ids='+ids;;
				});
			}
		};
		var d =  $.w.createDialog(options,9 );

		var c = '';
		$('.pimg_list img').each(function(k,o){
			c +='<li><img ondblclick="setRelated(this)" src="'+o.src+'" width=120 height=120 /></li>';
		});
		$(d).find('.wDialog_body').html('<div>&nbsp;双击图片后作为关联图片</div><ul  class="related" >'+c+'</ul>');
		$(d).css('height',400);
		$.w.loadTop(9);
	}

	function setRelated(obj){
 		var s = obj.src.substring(obj.src.indexOf('/media'),obj.src.length);
	 
		$.w.closeN(9);
		$('.i_thumb',relIn.parentNode).val(s);
		$('.a_thumb',relIn.parentNode).html('<img src="'+s+'" width=50 height=50 />');
	}

 

	//更换商品分类后，加载属性
	function changeAttr(catid,id){ 
 		$.get(baseuri+'&no_html=1&task=ajaxattr&catid='+catid+'&id='+id+'&type_id='+$('#type_id').val(),function(data){
			 
			if( data.length>10 ){
					$('#attrlist').html(data);
			}
		});
	} 

	//添加规格
	var tr ='<tr><td><input type="text" name="pn[]" size=10 /></td>'+addTR+'<td><input type="text" name="price[]" size=5  /></td><td><input type="text" name="cost[]"  size=5  /></td><td><input type="text" name="weight[]"  size=5  /></td><td><input type="text" name="store[]"  size=5  /></td><td><a href="javascript:;;" onclick="delSpec(this.parentNode,0);" >删除</a><input type="hidden" name="products_spec_id[]" value="" /> </td></tr>';
	function addSpec(){
 		$('.spec').append(tr);
		orderTable();
	}

	function delSpec(obj,id){
		 if(confirm('确实要删除吗?')){ 
			 $('input',obj).each(function(k,o){
 		         $('input[name=delspec]').val( $('input[name=delspec]').val()+','+$(o).val()); 
			 }); 
			 $(obj.parentNode).remove();
		 }
	}
	

	//ajax方式搜索商品
	function searchProducts(obj,catid_name,key_name){
		var catid = ($('select[name='+catid_name+']').val());
		var key = ($('input[name='+key_name+']').val());


		$.get( baseuri+'&no_html=1&task=ajax&act=search&catid='+catid+'&key='+key,function(data){
			var d = eval(data); 
			createOptions(obj.sourceSel,d);

		});

	}

  //加载后添加OPEION
  function createOptions(obj, arr)
  {
	   
	if( !arr ){ return; }
	obj.length = 0;
	for (var i=0; i < arr.length; i++)
	{
	  var opt   = document.createElement("OPTION");
	  opt.value = arr[i][0];
	  opt.text  = arr[i][1];  
	  opt.id  = arr[i][2];  
	  obj.options.add(opt);
	}
  }
	  
function SelectZone()
{
  this.filters   = new Object();

  this.id        = arguments[0] ? arguments[0] : 1;     // 过滤条件
  this.sourceSel = arguments[1] ? arguments[1] : null;  // 1 商品关联 2 组合、赠品（带价格）
  this.targetSel = arguments[2] ? arguments[2] : null;  // 源   select 对象
  this.priceObj  = arguments[3] ? arguments[3] : null;  // 目标 select 对象
  this.is_single  = arguments[4] ? arguments[4] : null;  // 目标 select 对象
  this.check = function()
  {
    /* source select */
    if ( ! this.sourceSel)
    {
      alert('source select undefined');
      return false;
    }
    else
    {
      if (this.sourceSel.nodeName != 'SELECT')
      {
        alert('source select is not SELECT');
        return false;
      }
    }

    /* target select */
    if ( ! this.targetSel)
    {
      alert('target select undefined');
      return false;
    }
    else
    {
      if (this.targetSel.nodeName != 'SELECT')
      {
        alert('target select is not SELECT');
        return false;
      }
    }

    /* price object */
    if (this.id == 2 && ! this.priceObj)
    {
      alert('price obj undefined');
      return false;
    }

    return true;
  }

  this.addItem = function(all, act)
	{	
   if( act == 'addlink' ){
		 this.is_single = $('input[name=is_single]').get(0).checked?0:1; 
	}else{
		this.is_single = this.priceObj.value;
	}
 

    if (!this.check())
    {
      return;
    }

    var selOpt  = new Array();

    for (var i = 0; i < this.sourceSel.length; i ++ )
    {
      if (!this.sourceSel.options[i].selected && all == false) continue;

      if (this.targetSel.length > 0)
      {
        var exsits = false;
        for (var j = 0; j < this.targetSel.length; j ++ )
        {
          if (this.targetSel.options[j].value == this.sourceSel.options[i].value)
          {
            exsits = true;

            break;
          }
        }

        if (!exsits)
        {
          selOpt[selOpt.length] = this.sourceSel.options[i].value;
        }
      }
      else
      {
        selOpt[selOpt.length] = this.sourceSel.options[i].value;
      }
    }

    if (selOpt.length > 0)
    {
      var args = new Array();
		

		var targetSel = this.targetSel;
			$.get(baseuri+'&no_html=1&task=ajax&act='+act+'&id='+product_id+'&is_single='+this.is_single+'&ids='+implode(selOpt),function(data){
				var d = eval(data);
 				createOptions(targetSel,d);
			});
    }
}
  this.dropItem = function(all, act)
  {
    if (!this.check())
    {
      return;
    }

    var arr = new Array();

    for (var i = this.targetSel.length - 1; i >= 0 ; i -- )
    {
      if (this.targetSel.options[i].selected || all)
      {
        arr[arr.length] = this.targetSel.options[i].value;
      }
    }

    if (arr.length > 0)
    {
      var args = new Array();

      for (var i=2; i<arguments.length; i++)
      {
        args[args.length] = arguments[i];
      }
		var targetSel = this.targetSel;
		$.get(baseuri+'&no_html=1&task=ajax&act='+act+'&id='+product_id+'&ids='+implode(arr),function(data){
			var d = eval(data);
 			createOptions(targetSel,d);
		});
    }
  }

}
var elements = document.forms['menage_form'].elements;
var sz1 = new SelectZone(1, elements['source_select1'], elements['target_select1']);
var sz2 = new SelectZone(2, elements['source_select2'], elements['target_select2'],elements['price2']);

  

function implode(arr){
  var s ='';
  for (var i=0; i<arr.length; i++)
  {
	s+=','+arr[i];
  }
  return s.substring(1,s.length);
}

function explode(delimiter, string, limit){
    // http://kevin.vanzonneveld.net
    // +     original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +     improved by: kenneth
    // +     improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +     improved by: d3x
    // +     bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // *     example 1: explode(' ', 'Kevin van Zonneveld');
    // *     returns 1: {0: 'Kevin', 1: 'van', 2: 'Zonneveld'}
    // *     example 2: explode('=', 'a=bc=d', 2);
    // *     returns 2: ['a', 'bc=d']
    var emptyArray = {
        0: ''
    };

    // third argument is not required
    if (arguments.length < 2 || typeof arguments[0] == 'undefined' || typeof arguments[1] == 'undefined') {
        return null;
    }

    if (delimiter === '' || delimiter === false || delimiter === null) {
        return false;
    }

    if (typeof delimiter == 'function' || typeof delimiter == 'object' || typeof string == 'function' || typeof string == 'object') {
        return emptyArray;
    }

    if (delimiter === true) {
        delimiter = '1';
    }

    if (!limit) {
        return string.toString().split(delimiter.toString());
    } else {
        // support for limit argument
        var splitted = string.toString().split(delimiter.toString());
        var partA = splitted.splice(0, limit - 1);
        var partB = splitted.join(delimiter.toString());
        partA.push(partB);
        return partA;
    }
}

/**
* 新增一个规格
*/
function addSpec2(obj)
{
  var src   = obj.parentNode.parentNode;

 
  var idx   = rowindex(src);
 
  var tbl   = src.parentNode;
  var row   = tbl.insertRow(idx + 1);
  var cell1 = row.insertCell(-1);
  var cell2 = row.insertCell(-1);
  var regx  = /<a([^>]+)<\/a>/i;
 
	cell1.className = 'form_text';
  cell1.innerHTML = $('td',src).get(0).innerHTML.replace(/(.*)(addSpec2)(.*)(\[)(\+)/i, "$1removeSpec2$3$4-");
  cell2.innerHTML = $('td',src).get(1).innerHTML.replace(/readOnly([^\s|>]*)/i, '');
}
  function removeSpec2(obj)
  {
 
      $(obj.parentNode.parentNode).remove();
	  /**
	  	 var s = $('select',obj.parentNode.parentNode).get(0);
	 if( s ){ s.length = 0; }
	 $('input[type=text]',obj.parentNode.parentNode).attr('value','');
     $(obj.parentNode.parentNode).hide();
	 **/
  }

function rowindex(tr)
{
  if ( tr.rowIndex )
  {
    return tr.rowIndex;
  }
  else
  {
    table = tr.parentNode;
    for (i = 0; i < table.rows.length; i ++ )
    {
      if (table.rows[i] == tr)
      {
        return i;
      }
    }
  }
}
