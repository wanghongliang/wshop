<?php
include($this->path.DS.'tmpl'.DS.'toolbar_form.php');

?>
<form action="index.php?com=menu"  method="post"  id="menage_form"  >
	<table class="formtable" >
		<tr class="style1" >
			<td class="form_text" >菜单类型</td>
			<td>
 
				<input type="button" id="selectMenuType"   value="修改菜单类型" />

			</td>
		</tr>
		<tr class="style2" >
			<td   class="form_text" >
			</td>
			<td class="menu_parameter ">
				<?php 
				echo $item['typeparameter'];
				?>
			</td>
		</tr>


		<tr>
			<td  class="form_text" >菜单名称</td>
			<td>
				<input type="text" name="name" size=30 value="<?php echo $item['name'];?>" />
				&nbsp;&nbsp;
				推荐 	 
				<input type="radio" name="elite" value="0" <?php echo $item['elite']?'':'checked';?> /> 否
				<input type="radio" name="elite" value="1" <?php echo $item['elite']?'checked':'';?> /> 是

				&nbsp;&nbsp;
				内容介绍
				<input type="radio" name="iscontent" value="0" <?php echo $item['iscontent']?'':'checked';?> /> 否
				<input type="radio" name="iscontent" value="1" <?php echo $item['iscontent']?'checked':'';?> /> 是
			</td>
		</tr>
		
		<?php
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
		?>


		<tr>
			<td  class="form_text" >菜单图标</td>
			<td>
				<input type="text" name="icon" id="icon" size=50 value="<?php echo $item['icon'];?>" />
				<input type="button" name="" value="上传图片" onclick="upload('icon')" />
				<input type="button" name="" value=".." onclick="selectImage('icon')" /> 
 			</td>
		</tr>
		
		<?php
		$lt = HTML::getLT();
		foreach( $lt as $k=>$t )
		{
		?>
			<tr>
				<td  class="form_text" >
					<?php echo $t;?>
				</td>
				<td>
					<input type="text" name="icon<?php echo $k;?>" id="icon<?php echo $k;?>" size=50 value="<?php echo $item['icon'.$k];?>" />
					<input type="button" name="" value="上传图片" onclick="upload('icon<?php echo $k;?>')" />
					<input type="button" name="" value=".." onclick="selectImage('icon<?php echo $k;?>')" /> 
				</td>
			</tr>
		<?php
		}
		?>


		<tr>
			<td  class="form_text" >菜单别名</td>
			<td>
					<input type="text" id="alias" name="alias" size=30 value="<?php echo $item['alias'];?>"     />
					<input type="checkbox" name="autoalias" s value="1"   onclick='if(this.checked){ $("#alias").get(0).setAttribute("readOnly","true");  }else{ document.getElementById("alias").removeAttribute("readOnly");    }' /> 自动生成
			</td>
		</tr>


		<tr>
			<td  class="form_text" >菜单链接</td>
			<td>
				<?php echo $linkInput;?>
			</td>
		</tr>


		<tr>
			<td  class="form_text" >父菜单</td>
			<td>
				<?php echo $pid;?>
			</td>
		</tr>	
		<tr  >
			<td class="form_text" valign=top   >META_KEYWORDS (页面关键词)</td>
			<td class="db-pt5 db-pb5">
				<textarea cols=50 rows=2 name="metakey" ><?php echo $item['metakey'];?></textarea>
			</td>
		</tr>

		<?php
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
		?>


 		<tr>
			<td  class="form_text db-pt5"  valign=top  >META_DESCRIPTION (页面描述)</td>
			<td  class="db-pt5 db-pb5">
				<textarea cols=50 rows=5 name="metadesc" ><?php echo $item['metadesc'];?></textarea>
			</td>
		</tr>

		<?php
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
				<input type="button" class="submit_btn"  value="提交" />
				<input type="button" class="apply_btn"  value="应用" />
				<input type="button" class="cancel_btn"  value="取消" />
 </div>
</form>

<script language="javascript" >
 
 	$(function(){
 		$('#selectMenuType').wDialog({isget:true,url:'index.php?com=menu&task=selectcomtype&mtid=<?php echo $this->menutypeid;?>&type=<?php echo $item['type'];?>&id=<?php echo $item['id'];?>&url[com]=<?php echo $item['com'];?>&no_html=1'}); 
 
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
			location.href='index.php?com=menu&&mtid=<?php echo $this->menutypeid;?>';
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