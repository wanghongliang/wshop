<?
include($this->path.DS.'tmpl'.DS.'toolbar_form.php');
?>

<script type="text/javascript" src="templates/default/js/calendar/calendar.js"></script>
<link href="templates/default/js/calendar/calendar.css" rel="stylesheet" type="text/css" />
	<ul class="switch_con" >
	<li class="con active" > 


<form action="<?php echo $this->baseuri;?>"  method="post"  id="menage_form" name="listform"   enctype="multipart/form-data"  >
 
	<table class="formtable" width="100%" id="group-table"    >
  
 		<tr  >
			<td class="form_text" >秒杀商品:</td>
			<td> 
				<input type="text" name="products_name" id="products_name" size=50 value="<?php echo $item['products_name'];?>"  />
				<input type="button" class="opener btn" value="选择商品" alt="index.php?com=products&task=selectproduct&tmpl=component" title="请选择团购的商品" dialogheight="530" dialogwidth="860" dialogscroll="auto"    >
				<input type="hidden" name="products_id"  id="products_id" value="<?php echo $item['products_id'];?>"  />
				<input type="hidden" name="thumb"  id="thumb" value="<?php echo $item['img'];?>"  />
				<div class="p_thumb">
				<?php if( $item['thumb'] ){ ?>
					<img src="<?php echo $item['thumb'];?>" width=200 />
				<?php } ?>
				</div>
				 
			</td>
		</tr>
 		<tr  >
			<td class="form_text" >自定义秒杀图片:</td>
			<td> 
				<input type="file" name="uploadimg"  id="uploadimg" value=""  />
				<div class="help" >
					上传自定义的秒杀图片,保持宽度为420px为佳,宽度280px.
				</div>
			</td>
		</tr>
 		<tr  >
			<td class="form_text" >秒杀标题:</td>
			<td> 
				<textarea name="act_name" id="act_name" cols=50 rows=2 ><?php echo $item['act_name'];?></textarea>

			</td>
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

		<?php
		if( $item['act_id']>0 ){
		?>
  		<tr  >
			<td class="form_text" >活动状态:</td>
			<td>
			<font color=red >
				<?php
				$status = array(
					0=>'未开始',
					1=>'进行中',
					2=>'结束未处理',
					3=>'成功结束',
					4=>'失败结束',
				);
				$s = $item['is_finished'];
				if( $s == 0 ){
					if( time() > $item['end_time'] ){
						$s = 2;
 					}else if( time() > $item['start_time'] ){
 						$s = 1;
					}else {
 						$s = 0;
					} 
					echo $status[$s]; 
					//echo time(); echo '-';
					//echo $item['end_time'];
				}
				echo $status[$s]; 
			?>
			</font>

			<?php
				switch($s){ 
					case 2:
				?>	<br/>
					<input type="button" class="btn" onclick="setActivityS(<?php echo $item['act_id'];?>)" value="活动成功" />
					<input type="button" class="btn" onclick="setActivityE(<?php echo $item['act_id'];?>)" value="活动失败" />
					<div class="help" >
						活动成功: 设为活动成功状态.<br/>
						活动失败:（取消订单，保证金退回帐户余额，失败原因可以写到活动说明中） 
					</div>
				<?php
					break;
 
					case 3:
				?>
					<input type="button" class="btn"  value="发送邮件" />
					<div class="help" >
						（通知客户付清余款，以便发货）
					</div>
				<?php
					break;
				}		
				?>
			</td>
		</tr>
		
		<?php
		}
		?>



		<?php
		$param = unserialize($item['ext_info']);
		?>
 
  		<tr  >
			<td class="form_text" >活动商品数量:</td>
			<td>
				<input type="text" name="product_amount" size=30 value="<?php echo $item['product_amount'];?>"  />
				<div class="help" >
				达到此数量， 活动自动结束。0表示没有数量限制。
				</div>
			</td>
		</tr>

  		<tr  >
			<td class="form_text" >赠送积分数:</td>
			<td>
				<input type="text" name="gift_integral" size=30 value="<?php echo $param['gift_integral'];?>"  /> 
			</td>
		</tr>

  		<tr  >
			<td class="form_text" >市场价:</td>
			<td>
				<input type="text" name="market_price" size=30 value="<?php echo $item['market_price'];?>"  /> 
			</td>
		</tr>

 
  		<tr >
			<td class="form_text" >活动价:</td>
			<td>
				<input type="text" name="shop_price" size=30 value="<?php echo $item['shop_price'];?>"  /> 
			</td>
		</tr>
 

	</table> 
	<input type="hidden" value="save" name="task" id="task" /> 
	<input type="hidden" value="<?php echo $item['act_id'];?>" name="id" /> 
	<input type="hidden" value="" name="return" id="return"  />
	<input type="hidden" value="<?php echo $item['catid'];?>" name="catid" id="catid" /> 

	<div class="formbtn" >
		<input type="button" class="submit_btn" value="保存"/>
		<input type="button" class="apply_btn" value="应用" />
		<input type="reset" class="cancel_btn" value="取消" />
	</div>
</form>

</li>
</ul>

<script language="javascript" >
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
			location.href='<?php echo $this->baseuri;?>	';
 		});

		$('.opener').click(function(){
		var url = $(this).attr('alt');
		// 继承属性
		var options = {title:$(this).attr('title'),width:$(this).attr('dialogwidth'),height:$(this).attr('dialogheight'),url:url,isget:true,reload:true,iframe:true};$.w.createDialog(options,3);}); 

		});


//设置活动成功
function setActivityS(id){
	if( confirm('确定要设为成功状态吗?') ){
		location.href='<?php echo $this->baseuri;?>&task=setstatu&value=3&id='+id;
	}else{
	}
}
function setActivityE(id){
	if( confirm('确定要设为失败状态吗?此操作不可恢复.') ){
		location.href='<?php echo $this->baseuri;?>&task=setstatu&value=4&id='+id;
	}else{
	}
}


/**
 * 新增一个价格阶梯
 */
function addLadder(obj, amount, price)
{
  var src  = obj.parentNode.parentNode;
  var idx  = rowindex(src);
  var tbl  = document.getElementById('group-table');
  var row  = tbl.insertRow(idx + 1);
  var cell = row.insertCell(-1);
  cell.innerHTML = '';
  var cell = row.insertCell(-1);
  cell.innerHTML = src.cells[1].innerHTML.replace(/(.*)(addLadder)(.*)(\[)(\+)/i, "$1removeLadder$3$4-");;
}

/**
 * 删除一个价格阶梯
 */
function removeLadder(obj)
{
  var row = rowindex(obj.parentNode.parentNode);
  var tbl = document.getElementById('group-table');

  tbl.deleteRow(row);
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


function selectProduct(id,title,thumb,catid){
	try{
		$('#products_name').val(title);
		$('#products_id').val(id);
		$('#thumb').val(thumb);
$('#catid').val(catid);
		$('.p_thumb').html('<img src="'+thumb+'" width=200 />');
		$.w.closeN(3);
	}catch(e){
	}
}


</script>