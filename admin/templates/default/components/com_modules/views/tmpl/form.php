<?php
include($this->path.DS.'tmpl'.DS.'toolbar_form.php');
?>
<div class="clr" ></div>
<form action="<?php echo $this->baseuri;?>"  method="post"  id="menage_form"  >

<table border=0 width=100%  >
	<tr>
		<td width=65%  valign=top >


			<table class="formtable" >
				<tr class="style1" >
					<td  colspan=2  >
						<b>参数配置 </b>
					</td>
				</tr>



				<tr class="style1" >
					<td class="form_text" >模块标题</td>
					<td>
						<input type="text" id="title"  name="title" size=50 value="<?php echo $item['title'];?>" />
					</td>
				</tr>

				<?php
				$lt = HTML::getLT();
				foreach( $lt as $k=>$t )
				{
				?>
				<tr class="style1" >
						<td  class="form_text" >
							<?php echo $t;?>
						</td>
						<td>
							<input type="text" name="title<?php echo $k;?>" size=50 value="<?php echo $item['title'.$k];?>" />
						</td>
					</tr>
				<?php
				}
				?>


				<tr class="style1" >
					<td class="form_text" >模块位置</td>
					<td>
						<input type="text" id="position"  name="position" size=50 value="<?php echo trim($item['position']);?>" />
					</td>
				</tr>

				<?php if( $item['id']>0 ){?>
				<tr class="style1" >
					<td class="form_text" >模块排序</td>
					<td>
						<input type="text" id="ordering"  name="ordering" size=5 value="<?php echo $item['ordering'];?>" />
					</td>
				</tr>
				<?php } ?>
				<tr class="style1" >
					<td class="form_text" >缓存</td>
					<td>
						<select name="cache_way" >
							<option value="0" <?php echo $item['cache_way']==0?' selected ':'';?> >-未缓存-</option>
							<option value="1" <?php echo $item['cache_way']==1?' selected ':'';?> >按时间缓存</option>
							<option value="2" <?php echo $item['cache_way']==2?' selected ':'';?> >手动更新缓存</option>
						 </select>
						 关联的组件 
						 <select name="cid" >
							<option value="0" >-没有关联-</option>
							<?php
							foreach( $components as $k=>$v ){
							?>
								<option value="<?php echo $v['id'];?>" <?php if( $v['id'] == $item['cid'] ){ echo ' selected ';} ?> ><?php echo $v['name'];?></option>
							<?php
							}
							?>
						 </select>
					</td>
				</tr>
				<tr class="style1" >
					<td class="form_text" >是否发布</td>
					<td>
						<input type="radio" id="published"  name="published"  value="0" <?php echo $item['published']==0?'checked':''; ?> /> 不发布

						<input type="radio" id="published"  name="published"  value="1" <?php echo $item['published']==1?'checked':''; ?> /> 发布
					</td>
				</tr>

				<tr class="style1" >
					<td class="form_text" >菜单</td>
 					<td>

					<script type="text/javascript">
					function allselections() {
						var e = document.getElementById('selections');
							e.disabled = true;
						var i = 0;
						var n = e.options.length;
						for (i = 0; i < n; i++) {
							e.options[i].disabled = true;
							e.options[i].selected = true;
						}
					}
					function disableselections() {
						var e = document.getElementById('selections');
							e.disabled = true;
						var i = 0;
						var n = e.options.length;
						for (i = 0; i < n; i++) {
							e.options[i].disabled = true;
							e.options[i].selected = false;
						}
					}
					function enableselections() {
						var e = document.getElementById('selections');
							e.disabled = false;
						var i = 0;
						var n = e.options.length;
						for (i = 0; i < n; i++) {
							e.options[i].disabled = false;
						}
					}
				</script>
						<label for="menus-all">
						<input type="radio"  onclick="allselections();" value="all" name="menus" <?php echo $selects['pages']=='all'?'checked="checked"':'';?> id="menus-all">所有</label>
						
						
						<label for="menus-none">
						<input type="radio" onclick="disableselections();" value="none" name="menus" id="menus-none" <?php echo $selects['pages']=='none'?'checked="checked"':'';?> >无</label>

						<label for="menus-select"><input type="radio" onclick="enableselections();" value="select" name="menus" id="menus-select"  <?php echo $selects['pages']=='select'?'checked="checked"':'';?> >从列表中选择菜单项</label>
 					</td>
				</tr>

				<tr>
					<td  class="form_text" >菜单选择</td>
					<td>
					<?php
					
					echo $selects['select'];
					?>
					</td>
				</tr>
				<tr>
					<td  class="form_text" >是否为自定义内容</td>
					<td>
						<label >
						<input type="radio"  onclick="showContentFrame();" value="1" name="cust" <?php echo $item['cust']=='1'?'checked="checked"':'';?> id="menus-all">是</label>

						<label>
						<input type="radio"  onclick="hideContentFrame();" value="0" name="cust" <?php echo $item['cust']=='0'?'checked="checked"':'';?> id="menus-all">否</label>


				<script type="text/javascript">
					function showContentFrame(){
						$('.customcon').show();
					}
					function hideContentFrame(){
						$('.customcon').hide();
					}
				</script>
					</td>
				</tr>

				<tr class="customcon" <?php if( $item['cust'] == 0 ){ echo 'style="display:none;"'; } ?>  >
					<td  class="form_text" >模块自定义内容</td>
					<td>
					<?php
						import('html.editor');
						$editor = Editor::getInstance($GLOBALS['config']['editor']);
						$editor->display('content',$item['content'],'100%','300');
					?>
					</td>
				</tr>

				<?php
 				foreach( $lt as $k=>$t )
				{
				?>
				<tr class="customcon" <?php if( $item['cust'] == 0 ){ echo 'style="display:none;"'; } ?>  >
						<td  class="form_text" >
							<?php echo $t;?>
						</td>
						<td>
						<?php
 							$editor->display('content'.$k,$item['content'.$k],'100%','300');
						?>

						</td>
					</tr>
				<?php
				}
				?>

		 
				
	 
						<?php /**<input type="button" class="submit_btn" post="#menage_form" url="index.php?com=modules&no_html=1" value="提交" />

						**/
						?>

			</table>


						<input type="hidden" value="<?php echo $item['module'];?>" name="module" id="module" />

						<input type="hidden" value="save" name="task" id="task" />
						<input type="hidden" value="<?php echo $item['id'];?>" name="id" />
						<input type="hidden" value="<?php echo $this->menuid;?>" name="menuid" />
						<input type="hidden" value="" name="return" id="return"  />
	 
		</td>
		
		<td valign=top width=35% >
		 
				<div style="border:1px solid #eee;padding-left:5px;border-width:1px 0px;line-height:30px;" >
					<b>参数配置</b>
				</div>
		
				<?php
					echo $item['parameter'];
				?>
			</div>
		</td>
	</tr>
</table>
 
<div class="formbtn" >
		<input type="button" class="submit_btn" value="保存"/>
		<input type="button" class="apply_btn" value="应用" />
		<input type="reset" class="cancel_btn" value="取消" />
</div>
</form>
 
<script language="javascript" >
 	$(function(){
		function submitCheck()
		{
			return true;
		}


		$('.submit_btn').click(function(){
			$('#menage_form').submit();
		});
 		$('.apply_btn').click(function(){	
			if( submitCheck() ){
				$('#return').attr('value','<?php echo URI::current(array('task'=>'edit'));?>');
				$('#menage_form').get(0).submit();
			}
 		});

		$('.cancel_btn').click(function(){	
			location.href='index.php?com=modules<?php if( $_REQUEST['tmpl']!= '' ){ echo "&tmpl=".$_REQUEST['tmpl'];}?>&menuid=<?php echo $this->menuid;?>';
 		});
	});
</script>