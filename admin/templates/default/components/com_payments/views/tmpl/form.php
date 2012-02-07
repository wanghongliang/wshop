


<?
include($this->path.DS.'tmpl'.DS.'toolbar_form_component.php');
?>
<form action="<?php echo $this->baseuri;?>"  method="post"  id="menage_form" name="listform"  >
  <div class="switch_con" >
	<ul >
	<li class="active con" >
 
		<table cellspacing="1" width="100%" class="paramlist admintable">
		<tbody><tr>
		<td width="21%" class="paramlist_key"><span class="editlinktip">支付接口名称：</span></td>
		<td class="paramlist_value"><?php echo $item['name'];?></td>
		</tr>
		 
		</tbody>
		</table>		
		<?php
			echo $item['parameter'];
		?>
 		<table cellspacing="1" width="100%" class="paramlist admintable">
		<tbody><tr>
		<td width="21%" class="paramlist_key"> </td>
		<td class="paramlist_value">
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
			location.href='index.php?com=payments<?php if( $_REQUEST['tmpl']== 'component' ){ echo "&tmpl=component";}?>';
 		});
	});
</script>