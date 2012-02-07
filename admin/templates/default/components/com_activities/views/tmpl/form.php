<?php
include($this->path.DS.'tmpl'.DS.'toolbar_form.php');
?>
<div class="clr" ></div>
<script type="text/javascript" src="templates/default/js/calendar/calendar.js"></script>
<link href="templates/default/js/calendar/calendar.css" rel="stylesheet" type="text/css" />

<form action="<?php echo $this->baseuri;?>"  method="post"  name="menage_form" id="menage_form" >
	<table class="formtable" >
		<tr>
			<td class="form_text" >活动规则</td>
			<td>
				<?php
				echo Form::dropdown('act_type',$this->actOptions(),$item['act_type'],' onchange="loadParams(this)" ');
				?>
				<div id="params"  class="params" >
				<?php
				$params = unserialize( $item['params'] );
				$path = dirname(__FILE__).DS.'params'.DS.$item['act_type'].'.php';
				
				if( file_exists($path) ){
					include($path);
				}
				?>
				</div>
			</td>
		</tr>
		<tr>
			<td class="form_text" >促销活动名称</td>
			<td>
				<input type="text" name="name" size=70 value="<?php echo $item['name'];?>" />
			</td>
		</tr>  
 
 		 <tr>
            <td class="form_text" >是否发布</td>
            <td><input type="radio" name="published" value="1" <? echo ( $item['published'] || !$_REQUEST['id'])?' checked':''; ?>/>是 <input type="radio" name="published" value="0" <? echo (!$item['published'] && $_REQUEST['id'])?' checked':''; ?>/>否</td>
        </tr>
  		<tr  >
			<td class="form_text" >活动开始时间:</td>
			<td>
				<input type="text" name="start_time" size=30 value="<?php echo date('Y-m-d H:i',$item['start_time']); ?>" id="start_time"  />
				<input type="button" class="btn" value="选择" onclick="return showCalendar('start_time', '%Y-%m-%d %H:%M', '24', false, 'selbtn1');" id="selbtn1" name="selbtn1" >
			</td>
		</tr>
  		<tr  >
			<td class="form_text" >活动结束时间:</td>
			<td>
				<input type="text" name="end_time"  id="end_time"  size=30 value="<?php echo date('Y-m-d H:i',$item['end_time']); ?>"  />
				<input type="button" class="btn" value="选择" onclick="return showCalendar('end_time', '%Y-%m-%d %H:%M', '24', false, 'selbtn2');" id="selbtn2" name="selbtn2">
			</td>
		</tr>


	</table>


	<table class="formtable" style="margin-top:10px;" >
		<tr>
			<td class="form_text" >允许参加会员等级</td>
			<td>
				 <?php
				 $levs = (array)$params['lev'];
				 //print_r($params);
					foreach( $levels as $k=>$v ){


						?>
						<input type="checkbox" name="param[lev][]" value="<?php echo $v['id'];?>" <?php if( in_array($v['id'],$levs)){?> 
						checked <?php } ?>  /><?php echo $v['name'];?>&nbsp;
						<?php
					}
				 ?>
			</td>
		</tr>

		<tr>
			<td class="form_text" >活动期间是否允许使用优惠券</td>
			<td>
            <input type="radio" name="ifcoupon" value="1" <? echo ( $item['ifcoupon'] || !$_REQUEST['id'])?' checked':''; ?>/>是 <input type="radio" name="ifcoupon" value="0" <? echo (!$item['ifcoupon'] && $_REQUEST['id'])?' checked':''; ?>/>否</td>

			</td>
		</tr>
		<tr  >
			<td class="form_text" >活动说明:</td>
			<td>
			<textarea name="remark" cols="80" rows="5" ><?php echo $item['remark'];?></textarea> 
 			</td>
		</tr>


		<tr class="bordernone" >
			<td  >
			</td>
			<td>
				<input type="button" class="submit_btn" value="保存"/>
				<input type="button" class="apply_btn" value="应用" />
				<input type="reset" class="cancel_btn" value="取消" />

				<input type="hidden" value="" name="return" id="return" />
				<input type="hidden" value="save" name="task" />
				<input type="hidden" value="<?php echo $item['id'];?>" name="id" />
			</td>
		</tr>


	</table>
</form>

<script language="javascript" >

	var url_current ='<?php echo URI::current();?>';
	

	$(function(){

			$('.submit_btn').click(function(){	
				 
					$('#menage_form').get(0).submit();
				 
			});

			$('.apply_btn').click(function(){	
				$('#return').attr('value',url_current);
				$('#menage_form').get(0).submit();
 			});

			$('.cancel_btn').click(function(){
				location.href='index.php?com=activities<?php if( $_REQUEST['tmpl'] != '' ){ echo "&tmpl=".$_REQUEST['tmpl'];}?>&menuid=<?php echo $this->menuid;?>';
			});
			loadClick();

			
		});
	

	//加载相关的属性列表
	function loadParams(obj){
		var t = obj.value;

		if( parseInt(t)>0 ){
 		var url = '<?php echo $this->baseuri;?>&task=ajax&act=getparam&no_html=1&tid='+t;
		//alert(url);
		$.get(url,function(data){
			$('#params').html(data);
			loadClick();
		});

		}
	}
	function loadClick(){
		
			$('.opener').click(function(){
				var url = $(this).attr('alt');
				// 继承属性
				var options = {title:$(this).attr('title'),width:$(this).attr('dialogwidth'),height:$(this).attr('dialogheight'),url:url,isget:true,reload:true,iframe:true};$.w.createDialog(options,3);
				
				}); 

		
	}

function selectProduct(id,title,thumb,catid){
	try{
		$('#products_name').val(title);
		$('#products_id').val(id);
		$('#thumb').val(thumb);

		$('.p_thumb').html('<img src="'+thumb+'" width=200 />');
		$.w.closeN(3);
	}catch(e){
	}
}

</script>