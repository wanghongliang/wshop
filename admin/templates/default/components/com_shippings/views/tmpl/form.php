


<?
include($this->path.DS.'tmpl'.DS.'toolbar_form_component.php');
import('html.editor');
$editor = Editor::getInstance($GLOBALS['config']['editor']);
$params = unserialize( $item['config'] );
?>
<form action="<?php echo $this->baseuri;?>"  method="post"  id="menage_form" name="listform"  >
  <div class="switch_con" >
	<ul >
	<li class="active con" >
 
		<table class="formtable" >
		<tbody><tr>
		<td  class="form_text"><span class="editlinktip">配送方式名称：</span></td>
		<td class="paramlist_value">
			<input type="text" id="name"  name="name" size=30 value="<?php echo $item['name'];?>" />
		</td>
		</tr>

		<tr>
		<td class="form_text" valign=top >类型：</td>
		<td  >
 			<label><input type="radio"  value="0" name="has_cod" <?php if( $item['has_cod'] == 0 ){ ?> checked="" <?php } ?>  >先收款后发货</label> &nbsp; 
			<label><input type="radio" value="1" name="has_cod" <?php if( $item['has_cod'] == 1 ){ ?> checked="" <?php } ?> >货到付款</label>
			<span class="notice-inline">选择货到付款后顾客无需再选择支付方式</span> 
		</td>
		</tr>


		<?php
		$firstunit = array(
			'500'=>'500克',
			'1000'=>'1公斤',
			'1200'=>'1.2公斤',
			'2000'=>'2公斤',
			'5000'=>'5公斤',
			'10000'=>'10公斤',
			'20000'=>'20公斤',
			'50000'=>'50公斤',
		);
		?>
		<tr>
		<td class="form_text"  >重量设置：</td>
		<td  >
 			首重重量&nbsp;
			<select name="firstunit">
			<?php
			foreach( $firstunit as $k=>$v ){
				?>
				<option <?php echo $params['firstunit']==$k?' selected ':'';?> value="<?php echo $k;?>" ><?php echo $v;?></option>
				<?php
			}
			?>
			</select>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			续重单位&nbsp;
			<select name="continueunit">
			<?php
			foreach( $firstunit as $k=>$v ){
				?>
				<option <?php echo $params['continueunit']==$k?' selected ':'';?> value="<?php echo $k;?>" ><?php echo $v;?></option>
				<?php
			}
			?>
			</select> 
		</td>
		</tr>

		<tr> 
			<td class="form_text"   > </td>
			<td><input type="checkbox" value="1" name="protect" onclick="if( this.checked == true ){ $('#protectrate').show(); }else{ $('#protectrate').hide(); }" <?php if( $item['protect'] == 1 ){ ?> checked="" <?php } ?> > 支持物流保价  </td>
			</tr> 
		   <tr id="protectrate" <?php if( $item['protect'] != 1 ){ ?> class="hide" <?php } ?> > 
		   <td class="form_text"  >保价设置：</td> 
		   <td> 
		   费率&nbsp;<input type="text" caution="该项必填且只允许填写数字金额" class="_x_ipt" style="width: 35px;" value="<?php echo $item['protect_rate'];?>" name="protect_rate">%

		   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		   最低保价费&nbsp;<input type="text" caution="该项必填且只允许填写数字金额"  class="_x_ipt" style="width: 35px;" value="<?php echo $item['minprice'];?>"  name="minprice" > 
			</td>
		</tr>


		<tr> 
		<td class="form_text"   >地区费用类型：</td>
		<td> 
		<div id="deliveryAreaToggle"> 
		<label>
		<input type="radio"  <?php if( $params['setting'] == 'setting_hda' ){ ?> checked="" <?php } ?>  value="setting_hda" name="setting" onclick="setDefaultFree(0)"  >统一设置</label> 
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<label>
		<input type="radio" <?php if( $params['setting'] == 'setting_sda' ){ ?> checked="" <?php } ?> value="setting_sda" name="setting" onclick="setDefaultFree(1)" >指定配送地区和费用</label> 
		</div> 
		</td>
		</tr>
		</tbody>
		</table>	


		<?php //////////////// 统一设置物流费用 //////////////////////// ?>

		<table class="formtable <?php if( $params['setting'] != 'setting_hda' ){ ?>  hide <?php } ?>" id="globalFree"  style="margin-top:10px;" > 
		<input type="hidden" value="0" name="price"> 
		<tbody>
		<tr> 
		<td class="form_text"  >配送费用:</td> 
		<td> 
		<div class="deliveryexpbox" style="line-height: 30px;"> 
			<div style="" class="deliveryexp"> 
				首重费用 
				<input type="text" caution="该项必填且只允许填写数字金额"  class="_x_ipt" value="<?php echo $params['firstprice'];?>" name="firstprice" style="width: 30px;">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 

				续重费用 
				<input type="text" caution="该项必填且只允许填写数字金额" class="_x_ipt" value="<?php echo $params['continueprice'];?>" name="continueprice" style="width: 30px;"> 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span onclick="chaexps(this)" class="lnk chgexp">使用公式</span> 
			</div> 
			
			<div style="display: none;" class="deliveryexp"> 
				配送公式 
				<input type="text" vtype="required&amp;&amp;checkExp1&amp;&amp;checkExp2" class="_x_ipt" value="" name="confexpressions" style="width: 300px;">
				<span onclick="checkExp(this);" class="checkexp sysiconBtnNoIcon">验证</span>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span onclick="chaexps(this)" class="lnk chgexp">取消公式</span> 
				<input type="hidden" value="0" name="dt_useexp"> 
			</div>  
		</div> 
		</td> 
		</tr> 
		</tbody>
		</table>


		<?php ////////////////////////// 为不同地区设置不同的运费 ///////////////////// ?>
		<table class="formtable setfree <?php if( $params['setting'] != 'setting_sda' ){ ?>  hide <?php } ?> "  style="margin-top:10px;" >
		<tbody> 
		<tr> <td class="form_text"   > </td>
		<td> 
		 <input name="defAreaFee" value="1" type="checkbox"  onclick="if( this.checked == true ){ $('#areaFee').show(); }else{ $('#areaFee').hide(); }" <?php if( $params['defAreaFee'] == 1 ){ ?> checked="" <?php } ?>   >
		 启用默认费用
		 <span class="notice-inline">注意：未启用默认费用时，不在指定配送地区的顾客不能使用本配送方式下订单</span>

		</td>
		</tr> 

		<tr id="areaFee" <?php if( $params['defAreaFee'] != 1 ){ ?> class="hide" <?php } ?>  > 
		<td class="form_text" > </td>
		<td> 
			 <div class="deliveryexpbox"> 
			 <div class="deliveryexp" style=""> 
				 首重费用 
				 <input name="firstprice2" id="firstprice2" value="<?php echo $params['firstprice'];?>" style="width: 30px;" class="_x_ipt"  caution="该项必填且只允许填写数字金额" type="text">
				 续重费用
				 <input name="continueprice2" id="continueprice2" value="<?php echo $params['continueprice'];?>" style="width: 30px;" class="_x_ipt"  caution="该项必填且只允许填写数字金额" type="text"> 
 			 </div> 
 
			 </div>  
		</td>
		</tr> 

		</tbody>
		</table>


		<?php //////////////////////////  不同地区设置  ///////////////////// ?>
		<table class="formtable setfree <?php if( $params['setting'] != 'setting_sda' ){ ?>  hide <?php } ?>" style="margin-top:10px;"  > 
		<tbody>
		<tr> 
		<td class="form_text"   >支持的配送地区:</td> 
		<td> 
		<div class="deliveryArea" id="deliveryArea-9">

 
		<input type="hidden" name="delidgroup">
		<ol>


		<li style="display:none;" class="division">
 			<div class="deliverycity"> 
				<span onclick="deleteDelivery(this)" style="float: right;">
					<img class="imgbundle" title="删除" alt="删除" style="width: 16px; height: 16px; background-position: 0pt -214px; cursor: pointer;" src="templates/default/images/transparent.gif">
				</span> 

				配送地区 
				<input type="text"  class="_x_ipt" value=""  name="areaGroupName[]" style="width: 300px;"> 
				<input type="hidden" value="" class="areaGroupId" name="areaGroupId[]" >
				<input type="hidden" value="" class="areaGroupConfigName" name="areaGroupConfigName[]" >
				<input type="button" onclick="sAdr(this)"  class="opener imgbundle" value=""  style="width: 16px; height: 16px; background-position: 0pt -284px; cursor: pointer;"   alt="index.php?com=shippings&task=selectarea&tmpl=component" title="选择地区" dialogheight="280" dialogwidth="660" dialogscroll="auto"  /> 
 			</div> 
			<div class="selectCell" ></div> 
			<div class="deliveryexpbox">
 				<div style="" class="deliveryexp"> 
					首重费用 
					<input type="text" class="_x_ipt" value="" name="firstFee[]" style="width: 30px;"> 
					续重费用 
					<input type="text" class="_x_ipt" value="" name="continueFee[]" style="width: 30px;">
  				</div>
 			</div>
		</li> 


		<?php

		/////////////////////已添加的地区费用设置////////////////////
		if( is_array($deliverys) ){
		foreach( $deliverys as $k=>$v ){
			$pas = unserialize( $v['config'] );
		?>
		<li class="division" did="<?php echo $v['id'];?>" >
			<input type="hidden" name="idgroup[]" value="<?php echo $v['id'];?>" >	
			<div class="deliverycity"> 
				<span onclick="deleteDelivery(this)" style="float: right;">
					<img class="imgbundle" title="删除" alt="删除" style="width: 16px; height: 16px; background-position: 0pt -214px; cursor: pointer;" src="templates/default/images/transparent.gif">
				</span> 
				配送地区
				<input type="text"  class="_x_ipt" value="<?php echo $v['name'];?>"  name="areaGroupName[<?php echo $v['id'];?>]" style="width: 300px;"> 
				<input type="hidden" value="<?php echo $v['areaid_group'];?>" class="areaGroupId" name="areaGroupId[<?php echo $v['id'];?>]" >
				<input type="hidden" value="<?php echo $v['areaname_group'];?>" class="areaGroupConfigName" name="areaGroupConfigName[<?php echo $v['id'];?>]" >
				<input type="button"   class="opener imgbundle" value=""  style="width: 16px; height: 16px; background-position: 0pt -284px; cursor: pointer;"   alt="index.php?com=shippings&task=selectarea&tmpl=component" title="选择地区" dialogheight="280" dialogwidth="660" dialogscroll="auto"  /> 
 			</div> 

			<div class="selectCell" >
			<?php
			$select_a_name = explode( ',',$v['areaname_group'] );
			$select_a_id = explode( ',',$v['areaid_group'] );
			
			if( count($select_a_id) > 0 ){
				foreach( $select_a_id as $y=>$z ){
					?>
					<input type="checkbox" title="<?php echo $select_a_name[$y];?>" onclick="reSelArea(this)" value="<?php echo $z;?>" checked  /> 
					<label><?php echo $select_a_name[$y];?></label>
					<?php
				}
			}
			?>
			</div> 

			<div class="deliveryexpbox">
 				<div style="" class="deliveryexp"> 
					首重费用 
					<input type="text" class="_x_ipt" value="<?php echo $pas['firstFee'];?>" name="firstFee[<?php echo $v['id'];?>]" > 
					续重费用 
					<input type="text" class="_x_ipt" value="<?php echo $pas['continueFee'];?>" name="continueFee[<?php echo $v['id'];?>]" > 
  				</div>
 			</div>
		</li> 
		<?php
			}

		}
		?>
		</ol>

		<input type="button" onclick="copyDelivery()" class="btn2" value="为指定的地区设置运费"  /> 
		</div> 

		</td> 
		</tr>
		</tbody>
		</table>



		<table class="formtable"  style="margin-top:10px;" >
		<tbody> 
		<tr> <td class="form_text"   >排序：</td>
		<td> 
		 <input type="text"   value="<?php echo $item['ordering'];?>" size=3 name="ordering" />
		</td>
		</tr>

		<tr> <td class="form_text"   >状态：</td>
		<td><input type="radio" value="1" <?php if( $item['published'] == 1 ){ ?> checked="" <?php } ?> name="published">启用<input type="radio" value="0" name="published" <?php if( $item['published'] == 0 ){ ?> checked="" <?php } ?> >关闭</td>
		</tr> 
		</tbody>
		</table>	



		<table class="formtable"  style="margin-top:10px;" >
		<tbody> 
		<tr>
		<td class="form_text"  valign=top >详细介绍：</td>
		<td  >
 		<?php
		echo $editor->display('desc',$item['desc'],'99%','200');
		?> 
		</td>
		</tr>

		<tr>
		<td > </td>
		<td>
				<input type="button" class="submit_btn"  value="提交" />
				<input type="button" class="apply_btn"  value="应用" />
				<input type="button" class="cancel_btn"  value="取消" />
				<input type="hidden" value="save" name="task" id="task" />
				<input type="hidden" value="<?php echo $item['id'];?>" name="id" />
 				<input type="hidden" value="" name="return" id="return"  />
		</td>
		</tr>
		</tbody>
		</table>		
 
 
	</li>
	</ul>
	</div>
</form>
<style type="text/css" >
ul li.division{ width:100%; display:block; line-height:30px; margin-bottom:10px;
min-height:0px; border:1px solid #ccc; *height:30px;
}
</style>

<script language="javascript" >
	var selectDelivery=null;
 	$(function(){
		$('.submit_btn').click(function(){
 			$('#menage_form').get(0).submit();
			return true;
 		});

		$('.apply_btn').click(function(){	
			$('#return').attr('value','<?php echo URI::current();?>');
			$('#menage_form').get(0).submit();
 		});

		$('.cancel_btn').click(function(){	
			location.href='<?php echo $this->baseuri;?>';
 		});

		setOpener();

	});

	function setOpener(){  

	 
		$('.opener').click(function(){

			
			selectDelivery = this.parentNode.parentNode; 
			var url = $(this).attr('alt')+'&ids='+$('.areaGroupId',selectDelivery).attr('value'); 
			// 继承属性
			var options = {title:$(this).attr('title'),width:$(this).attr('dialogwidth'),height:$(this).attr('dialogheight'),url:url,isget:true,reload:true,iframe:true};
			$.w.createDialog(options,3);
		});  
	}

	function sAdr(obj){
	selectDelivery = obj.parentNode.parentNode; 
	var url = $(obj).attr('alt')+'&ids='+$('.areaGroupId',selectDelivery).attr('value'); 
	// 继承属性
	var options = {title:$(obj).attr('title'),width:$(obj).attr('dialogwidth'),height:$(obj).attr('dialogheight'),url:url,isget:true,reload:true,iframe:true};
	$.w.createDialog(options,3);
	}

	function setDefaultFree(s){
		if( s == 1 ){ $('.setfree').show(); $('#globalFree').hide(); }else{ $('.setfree').hide(); $('#globalFree').show();}
	}

	//加入选择添加的地区
	function selectarea(html){
		if( selectDelivery ){ 
			$('.selectCell', selectDelivery).get(0).innerHTML = html;
			var ids = '',n = '';
			$('input[type=checkbox]', selectDelivery).each(function(k,o){
				if( o.checked ){
					ids+=','+o.value; 
					n+=','+$(o).attr('title');
				}
			});
			setGroupID(ids); 
			setGroupConfigName(n);
		}
	}

	function setGroupID(ids){
 		if( selectDelivery ){ $('.areaGroupId', selectDelivery).attr('value',ids); }
	}
	function setGroupConfigName(n){
  		if( selectDelivery ){ $('.areaGroupConfigName', selectDelivery).attr('value',n); }
	}
	//删除添加的地区
	function deleteDelivery(obj){
		$(obj.parentNode.parentNode).remove();
		var v = $('input[name=delidgroup]').attr('value');
		$('input[name=delidgroup]').attr('value',parseInt( $(obj.parentNode.parentNode).attr('did') ) +','+v );
		//alert( $('input[name=delidgroup]').attr('value') );
	}

	//重新加载选择的地区
	function reSelArea(obj){
		selectDelivery = obj.parentNode.parentNode;
		var ids = '', n = '';
		$('input[type=checkbox]', selectDelivery).each(function(k,o){
			if( o.checked ){
				ids+=','+o.value; 
				n+=','+$(o).attr('title');
			}
		});
		setGroupID(ids); 
		setGroupConfigName(n);
	}

	
	function copyDelivery(){
		var o = $('.division').get(0);
		$(o.parentNode).append( '<li class="division" >'+o.innerHTML+'</li>' );
 	}

	//弹出选择地区框时，加载已选择的地区
	function getSelArea(){ 
 		 if( selectDelivery ){ return $('.selectCell', selectDelivery).get(0).innerHTML; }
	}


	//使用公式
	function chaexps(obj){
		alert('暂不可以使用公式,此功能待开发');
	}

	function checkExp(obj){
		alert('验证公式对话框');
	}
</script>