<?php
include($this->path.DS.'tmpl'.DS.'toolbar_form.php');

?>
<form action="index.php?com=category"  method="post"  id="menage_form"  >
	<table class="formtable" >
 

		<tr>
			<td  class="form_text" >分类名称</td>
			<td>
				<input type="text" name="name" size=30 value="<?php echo $item['name'];?>" />
			</td>
		</tr>
		
		<?php

		/**
		$lt = HTML::getLT();
		foreach( $lt as $k=>$t )
		{
		?>
			<tr>
				<td  class="form_text" >
					<?php echo $t;?>
				</td>
				<td>
					<input type="text" name="name<?php echo $k;?>" size=30 value="<?php echo $item['name'.$k];?>" />
				</td>
			</tr>
		<?php
		}

		**/
		?>


		<tr>
			<td  class="form_text" >分类别名</td>
			<td>
					<input type="text" id="alias" name="alias" size=30 value="<?php echo $item['alias'];?>"  <?php if( !$item['alias'] ){ echo 'readonly';}?>   />
					<input type="checkbox" name="autoalias" s value="1" <?php if( !$item['alias'] ){ echo 'checked';}?>  onclick='if(this.checked){ $("#alias").get(0).setAttribute("readOnly","true");  }else{ document.getElementById("alias").removeAttribute("readOnly");    }' /> 自动生成
			</td>
		</tr>



		<tr>
			<td  class="form_text" >分类类型</td>
			<td>
				<?php echo Form::dropdown('type_id',$type,$item['type_id'],' class="select"  ');?>
			</td>
		</tr>


		<?php if(is_array($spec)){ ?>
		<tr>
			<td  class="form_text" >分类规格</td>
			<td>
				<?php 
				$spec_ids = explode(',',$item['spec_ids']);
				foreach( $spec as $k=>$v ){

					echo Form::checkbox('spec_id[]',$v['id'], in_array($v['id'],$spec_ids)  );
					echo $v['name']; 
					?>
					 
					<?
				}	
				?>
			</td>
		</tr>
		<?php }?>

		<tr>
			<td  class="form_text" >
				订金金额
			</td>
			<td>
				<input type="text" name="deposit" size=30 value="<?php echo $item['deposit'];?>" />
			</td>
		</tr>

		<tr>
			<td  class="form_text" >上级分类</td>
			<td>
				<?php echo $pid;?>
			</td>
		</tr>
		


		<tr  >
			<td class="form_text" valign=top   >TITLE
(自定义页面标题)</td>
			<td class="db-pt5 db-pb5">
				<textarea cols=50 rows=2 name="title" ><?php echo $item['title'];?></textarea>
			</td>
		</tr>

		<tr  >
			<td class="form_text" valign=top   >META_KEYWORDS
(页面关键词)</td>
			<td class="db-pt5 db-pb5">
				<textarea cols=50 rows=2 name="metakey" ><?php echo $item['metakey'];?></textarea>
			</td>
		</tr>

		<?php
		/**
 		foreach( $lt as $k=>$t )
		{
		?>
			<tr>
				<td  class="form_text db-pt5" valign=top   >
					<?php echo $t;?>
				</td>
				<td>
					<textarea cols=50 rows=2 name="metakey<?php echo $k;?>" ><?php echo $item['metakey'.$k];?></textarea>
 				</td>
			</tr>
		<?php
		}
		**/
		?>


 		<tr>
			<td  class="form_text db-pt5"  valign=top  >META_DESCRIPTION
(页面描述)</td>
			<td  class="db-pt5 db-pb5">
				<textarea cols=50 rows=5 name="metadesc" ><?php echo $item['metadesc'];?></textarea>
			</td>
		</tr>

		<?php
		/**
		foreach( $lt as $k=>$t )
		{
		?>
			<tr>
				<td  class="form_text db-pt5" valign=top   >
					<?php echo $t;?>
				</td>
				<td class="db-pt5 db-pb5">
					<textarea cols=50 rows=5 name="metadesc<?php echo $k;?>" ><?php echo $item['metadesc'.$k];?></textarea>
 				</td>
			</tr>
		<?php
		}
		**/
		?>
 


 
	</table>

	<input type="hidden" value="save" name="task" id="task" />
	<input type="hidden" value="<?php echo $item['id'];?>" name="id" />
	<input type="hidden" value="<?php echo $this->menutypeid;?>" name="mtid" />
	<input type="hidden" value="" name="return" id="return"  />
	
	<input type="hidden" value="<?php echo $item['type'];?>" name="type" />
	<input type="hidden" value="<?php echo $item['com'];?>" name="component" />
	<input type="hidden" value="<?php echo $item['view_path'];?>" name="view_path"  />

	<?php //用于保存转移当前菜单内容的方式和菜单ID?>
	<input type="hidden" value="<?php echo $_REQUEST['shiftway'];?>" name="shiftway" />
	<input type="hidden" value="<?php echo $_REQUEST['shiftmenuid'];?>" name="shiftmenuid" />

	<div class="formbtn" >
		<input type="button" class="submit_btn" value="保存"/>
		<input type="button" class="apply_btn" value="应用" />
		<input type="reset" class="cancel_btn" value="取消" />
	</div>


</form>

<script language="javascript" >
 
 	$(function(){
  
 
		$('.submit_btn').click(function(){	
		
			if( submitCheck() ){
				$('#menage_form').get(0).submit();
			}
 		});

		$('.apply_btn').click(function(){	
			if( submitCheck() ){
				$('#return').attr('value','<?php echo URI::current(array('task'=>'edit'));?>');
				$('#menage_form').get(0).submit();
			}
 		});

		$('.cancel_btn').click(function(){	
			location.href='index.php?com=category&&mtid=<?php echo $this->menutypeid;?>';
 		});
	});

	function submitCheck()
	{
		if( $('#menu_item').get(0) ){
 			if( parseInt($('#menu_item').attr('value')) < 1 ){ 
				alert('请选择菜单.');	
				return false; 
			}
		}


		return true;
	}

	/** 选择组件布局类型时，需要提交刷新表单 **/
	function submit(href,task)
	{
		//alert($('input[name=shiftway]').get(0).value);
		$('#menage_form').get(0).action=href;
		$('input[name=task]').attr('value',task);
 		$('#menage_form').get(0).submit();
	}
</script>