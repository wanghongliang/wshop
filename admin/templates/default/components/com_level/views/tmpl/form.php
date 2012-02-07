<?php
include($this->path.DS.'tmpl'.DS.'toolbar_form.php');
?>
<div class="clr" ></div>
<form action="<?php echo $this->baseuri;?>"  method="post"  name="menage_form" id="menage_form" >
	<table class="formtable" >
		<tr>
			<td class="form_text" >等级名称</td>
			<td>
				<input type="text" name="name" size=30 value="<?php echo $item['name'];?>" />
			</td>
		</tr> 
 
        <tr>
            <td class="form_text" >优惠百分比</td>
            <td>
                <input type="text" id="discount" name="discount" size="5" value="<? echo $item['discount']?>">%
            </td>
        </tr>

 		 <tr>
            <td class="form_text" >是否为会员默认等级</td>
            <td><input type="radio" name="defaulted" value="1" <? echo ( $item['defaulted'] || !$_REQUEST['id'])?' checked':''; ?>/>是 <input type="radio" name="defaulted" value="0" <? echo (!$item['defaulted'] && $_REQUEST['id'])?' checked':''; ?>/>否</td>
        </tr>
        <tr>
            <td class="form_text" >所需积分</td>
            <td>
                <input type="text" id="point" name="point" size="5" value="<? echo $item['point']?>">
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
				location.href='index.php?com=level<?php if( $_REQUEST['tmpl'] != '' ){ echo "&tmpl=".$_REQUEST['tmpl'];}?>&menuid=<?php echo $this->menuid;?>';
			});
	 


			
		});
	
</script>