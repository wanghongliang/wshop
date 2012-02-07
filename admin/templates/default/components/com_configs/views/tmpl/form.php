<?php

include($this->path.DS.'tmpl'.DS.'toolbar_form.php');

import('html.editor');
$editor = Editor::getInstance($GLOBALS['config']['editor']);
?>
 
<form action="index.php?com=configs<?php if( isset($_REQUEST['tmpl']) ){ echo '&tmpl='.$_REQUEST['tmpl']; } ?>"  method="post"  id="menage_form" enctype="multipart/form-data" >
 
	<ul class="switch_con" >
	<li class="con active" >  
	<table class="formtable" > 
		<tr   >
			<td class="form_text" >商店标题</td>
			<td>
				<input type="text" id="title"  name="title" size=50 value="<?php echo $item['title'];?>" />
			</td>
		</tr>

		<tr   >
			<td class="form_text" >商店的LOGO</td>
			<td>
				<?php if($item['logo'] ){ ?>
				<img src="<?php echo $item['logo'];?>" /><br/>
				<?php } ?>
				<input type="file" name="logo" >
				&nbsp; 根据前台模板的不同，图片的大小也不同，可查看前台LOGO图片大小，再上传
			</td>
		</tr>
		<tr  >
			<td class="form_text" >管理员邮箱</td>
			<td>
				<input type="text" id="email"  name="email" size=50 value="<?php echo $item['email'];?>" />
			</td>
		</tr>


		<tr>
			<td   class="form_text"   >
			网站关键字
			</td>
		 
			<td  class="db-padding10" >
			<textarea cols=60 rows=2 name="metakey" ><?php echo $item['metakey'];?></textarea>
			 
			</td>
		</tr>



		<tr>
			<td  class="form_text"  >
			网站描述
			</td>
 
			<td    class="db-padding10" >
			<textarea cols=60 rows=5 name="metadesc" ><?php echo $item['metadesc'];?></textarea>
			 
			</td>
		</tr>
 
	</table>

		</li>

<?php/**
	<li class="con" >

		<table class="formtable" >
 
		<tr>
			<td class="form_text" >时间格式</td>
			<td>
				<input type="text" name="dateformat" size=50 value="<?php echo $item['dateformat'];?>" />
			</td>
		</tr>
		<tr>
			<td class="form_text" >货币格式</td>
			<td>
				<input type="text"  name="currencyformat" size=50 value="<?php echo $item['currencyformat'];?>" />
			</td>
		</tr>
		<tr>
			<td class="form_text" >缩略图宽度</td>
			<td>
				<input type="text" name="thumbwidth" size=50 value="<?php echo $item['thumbwidth'];?>" />
			</td>
		</tr>
		<tr>
			<td class="form_text" >缩略图高度</td>
			<td>
				<input type="text" name="thumbheight" size=50 value="<?php echo $item['thumbheight'];?>" />
			</td>
		</tr>
		<tr>
			<td class="form_text" >商品图片宽度:</td>
			<td>
				<input type="text" name="imgwidth" size=50 value="<?php echo $item['imgwidth'];?>" />
			</td>
		</tr>
		<tr>
			<td class="form_text" >商品图片高度:</td>
			<td>
				<input type="text" name="imgheight" size=50 value="<?php echo $item['imgheight'];?>" />
			</td>
		</tr> 

		</table>


	</LI>
**/?>

		<?php
		$option_value = unserialize($item['options']);
		$coms = $this->get('com');
 
		foreach( $coms as $k=>$v ){ $coms[$k]['params'] = unserialize($v['params']); } 
 
 		foreach( $option as $v ){
			
			if( empty($v['com_name']) ){
				$name = null;
			}else{
				$name = 'com_'.$v['com_name'];
			}

 			$options = unserialize($v['attr_group']);

			
 			$options['opt_name'] = (array)$options['opt_name'];
			?>
			<li class="con" >
			<table class="formtable" > 
			<?php
			foreach( $options['opt_name'] as $k2=>$v2 ){
				?>
				<tr>
				<td class="form_text" ><?php echo $v2;?></td>
				<td>
					<?php 
					$data = array(
						'type'=>$options['opt_way'][$k2],
						'field'=>$options['opt_field'][$k2],
						'values'=>$options['opt_value'][$k2],
					);

					if( !empty($name) ){
 
 						$this->optionForm( $data,stripslashes($coms[$v['com_name']]['params'][$options['opt_field'][$k2]]),$name);
					}else{
 						$this->optionForm( $data,$option_value[$options['opt_field'][$k2]],$name);
					}
					?>
					<div class="prompt" >
					<?php echo $options['opt_remark'][$k2]?>
					</div>
				</td>
				</tr>
				<?php
			}
			?>
			</table>
			</li>
			<?php
		}
		?>
	</UL>	
<div class="formbtn" >	
	<input type="button" class="submit_btn"  value="保存" />
	<input type="hidden" value="save" name="task" id="task" />
	<input type="hidden" value="<?php echo $item['id'];?>" name="id" />
	<input type="hidden" value="<?php echo $this->menuid;?>" name="menuid" />
	<input type="hidden" value="" name="return" id="return"  />
	<input type="hidden" value="<?php echo $_REQUEST['tmpl'];?>" name="tmpl" />
</DIV>
</form>

<script language="javascript" >
 
 	$(function(){
  
		$('.submit_btn').click(function(){	
			$('#menage_form').get(0).submit();
 		});

 	});
</script>