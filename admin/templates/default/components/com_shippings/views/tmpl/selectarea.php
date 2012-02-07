 
<div class="popupscroll">
	
 
	<form name="theForm" action="" method="post" >
	<div class="" id="regionCell"  >
	</div>
	<div id="DIVBrowse">
		<div class="db-fl"  >		
			国家：
			<select name="country" id="country"  size=10 onchange="selectFUCat(this)" >
 			<?php   
				foreach( $item[0] as $row ){?>			
				<option pid="<?php echo $row['parent_id'];?>" lft="<?php echo $row['lft'];?>"  rgt="<?php echo $row['rgt'];?>" value="<?php echo $row['id'];?>" <?php if( $row['id'] == 1 ){ echo ' selected '; } ?> pathName="<?php echo $row['name'];?>" ><?php echo $row['name'];?></option>
			<?php }?>
			</select>
		</div>
		<div class="db-fl"  >	
			省份：
			<select name="province" id="province"   size=10 onchange="selectFUCat(this)" > 
				<option value="0" >请选择..</option>
			<?php 
				foreach( $item[1] as $row){?>			
				<option pid="<?php echo $row['parent_id'];?>" lft="<?php echo $row['lft'];?>" rgt="<?php echo $row['rgt'];?>" value="<?php echo $row['id'];?>" pathName="<?php echo $row['name'];?>" ><?php echo $row['name'];?></option>
			<?php }?>
			</select>
		</div>
		<div class="db-fl" >		
			城市：
			<select name="city" id="city"   size=10 onchange="selectFUCat(this)" >
				<option value="0" >请选择..</option>
			<?php 
				foreach($lists as $row){?>			
				<option pid="<?php echo $row['parent_id'];?>" lft="<?php echo $row['lft'];?>" rgt="<?php echo $row['rgt'];?>" value="<?php echo $row['id'];?>" pathName="<?php echo $row['text'];?>" ><?php echo $row['text'];?></option>
			<?php }?>
			</select>
		</div>

		<div class="db-fl" >
			<input type="button" value="+" style="width:30px;height:30px;background:#eee;" onclick="selectArea()" />
		</div>
	</div> 
	
	<div class="clr" ></div>
	<div class="formbtn">
	<input type="button" class="diyButBold" id="confirmBut" onclick="confirmArea()" value="确认" name="Move">
	<input type="button" class="diyBut" id="cancelBut" onclick="parent.$.w.closeN(3);" value="取消" name="Cancel">
	</div> 
	

	</form>
</div>

<style type="text/css" >
	.popupscroll{ padding:20px 0px 0px 20px; }
	#DIVBrowse{
		line-height:14px;
	}
	#DIVBrowse select{ vertical-align:top; }
	#DIVBrowse .db-fl{ padding-left:10px; }
	#regionCell{ text-align:left; padding-left:10px; min-height:30px;_height:30px; }
</style>

<script language="javascript" >
var selAreas = [<?php $n = count($selAreas)-1; foreach( $selAreas as $k=>$v ){ echo "[".$v['id'].",'".$v['parent_id']."','".$v['lft']."','".$v['rgt']."']";  if( $k<$n ){ echo ","; } }?>];
$(function(){
	$('#regionCell').get(0).innerHTML =  parent.getSelArea() ;
	$('input[type=checkbox]').each(function(k,o){
		//alert(o.value);

		if( o.value > 0 ){
			for(i=0;i<selAreas.length;i++ ){
				if( selAreas[i][0] == o.value){
					$(o).attr('pid',selAreas[i][1]);
					$(o).attr('lft',selAreas[i][2]);
					$(o).attr('rgt',selAreas[i][3]);
				}
			}
		}
	});
});
function confirmArea(){
	  try{
		 //alert($('#regionCell').get(0).innerHTML);
 		 parent.selectarea($('#regionCell').get(0).innerHTML);
		 //parent.setGroupID( ids + ','+regionId );
	  }catch(e){ alert(e.info);}
	parent.$.w.closeN(3);
}
function selectFUCat(obj){
	
	if( obj.value > 0 ){
	var url = '<?php echo $this->baseuri;?>&act=getarea&no_html=1&id='+obj.value;
 		if( obj.id == 'province' ){
			$.get(url,function(data){
 			var d = eval(data); 
			createOpt($('#city').get(0),d);
			});
		}
	}
}
//加载后添加OPEION
function createOpt(obj, arr)
{
   
	if( !arr ){ return; }
	obj.length = 0;
	for (var i=0; i < arr.length; i++)
	{
	  var opt   = document.createElement("OPTION");
	  opt.value = arr[i][0];
	  opt.text  = arr[i][1];  
	  $(opt).attr('lft',arr[i][2]);  
	  $(opt).attr('rgt',arr[i][3]);  
	  $(opt).attr('pid',arr[i][4]); 
	  obj.options.add(opt);
	}
}

//选择地区
function selectArea(){
    var selCountry  = $('#country').get(0);
    var selProvince = $('#province').get(0);
    var selCity     = $('#city').get(0);
	var regionCell = $('#regionCell').get(0);
 
	var curOption = null;
	if (selCity.selectedIndex > 0)
	{
		regionId = selCity.options[selCity.selectedIndex].value;
		regionName = selCity.options[selCity.selectedIndex].text;
		curOption = selCity.options[selCity.selectedIndex];
	}
	else
	{
		if (selProvince.selectedIndex > 0)
		{
			regionId = selProvince.options[selProvince.selectedIndex].value;
			regionName = selProvince.options[selProvince.selectedIndex].text;
			curOption = selProvince.options[selProvince.selectedIndex];
		}
		else
		{
			if (selCountry.selectedIndex >= 0)
			{
				regionId = selCountry.options[selCountry.selectedIndex].value;
				regionName = selCountry.options[selCountry.selectedIndex].text;
				curOption = selCountry.options[selCountry.selectedIndex];
			}
			else
			{
				return;
			}
		}
	}
 
	var lft =  parseInt( $(curOption).attr('lft') );
	var rgt =  parseInt( $(curOption).attr('rgt') );
	var pid =  parseInt( $(curOption).attr('pid') );

	var ele;

	//var slft,srgt;

    // 检查该地区是否已经存在
    exists = false;
	//var ids = '';
   $('input[type=checkbox]').each(function(k,ele){
       if ( ele.type=="checkbox")
      {
		//  ids+=','+document.forms['theForm'].elements[i].value;
         if ( ele.value == regionId)
        {
          exists = true;
          alert('该地区已经选择.');
        }
		
		if( lft >  parseInt( $(ele).attr('lft') ) && rgt <  parseInt( $(ele).attr('rgt') ) && pid ==  parseInt( ele.value ) ){
          exists = true;
          alert('该地区的上级地区已选择.');
		}
  		if( lft <  parseInt( $(ele).attr('lft') ) && rgt >  parseInt( $(ele).attr('rgt') ) ){
			//alert( lft+':'+$(ele).attr('lft')+'-'+rgt+':'+$(ele).attr('rgt') );
 			reSelArea(ele);
		}

      }
    });

    // 创建checkbox
    if (!exists)
    {
      regionCell.innerHTML += "<input type='checkbox' name='regions[]' lft='"+lft+"' rgt='"+rgt+"' pid='"+pid+"' title='" + regionName + "'  onclick='reSelArea(this)'  value='" + regionId + "' checked='true' /><label> " + regionName + "</label>&nbsp;&nbsp;";

    }

}

function reSelArea(obj){
	//$('#regionCell ') 
	var checkbox = $('input[type=checkbox]');
	var label = $('label');

	checkbox.each(function(k,o){
		
		if( o.value == obj.value || (!o.checked) ){

			$(o).remove();
			$(label[k]).remove();
		} 
	});
}
</script>