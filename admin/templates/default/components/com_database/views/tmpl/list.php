<?
include($this->path.DS.'tmpl'.DS.'toolbar.php');
//include($this->path.DS.'tmpl'.DS.'submenu.php');
?>

<div class="editor-tabs" >
	<ul class="switch_btn" >
		<li class="active" >数据库备份</li>
		<li>数据库文件上传</li> 
	</ul>
</div>


  <div class="switch_con" >
	<ul >
	<li class="active con" >
	<table class="formtable" >
		<tr class="style1" >
			<td class="form_text" style="width:12%"  >备份方式</td>
			<td    >
				<input type="radio" name="tp" value="1"  checked /> 全部备份到一个文件中<br/>
				<input type="radio" name="tp" value="2" /> 备份到多个文件中，每个文件大小为：2048K
			</td>
 
		</tr>	
		<tr class="style1" >
			<td class="form_text"  style="width:12%"  >备份文件名</td>
			<td>
				 <input type="text" name="filename" value="<?php echo $GLOBALS['config']['database'];?>" size="30" />.sql
				 <div class="backupsuccess" style="text-align:left;" >
		
				  </div>
			</td>
		</tr>

 		<tr class="style1" >
			<td colspan=2>

			 <div class="formbtn backbtn" >
				<input type="button" class="submit_btn" value="开始备份"/> 
			  </div>
			</td>
		</tr>
		<tr class="style1" >
			<td class="form_text"  style="width:12%"  >已存在的备份文件</td>
			<td>
			<div style="border-bottom:1px solid #eee;">  共有 <?php echo count($lists);?>个备份文件</div>
			<table>
				<tr>
					<th>文件名</th>
					<th>备份日期</th>
					<th>文件大小</th>
					<th>操作</th>
				</tr>
			<?php
			$directory = str_replace(DS,'/',str_replace(PATH_ROOT,'',PATH_CACHE.DS.'data'));;
			
			foreach( $lists as $k=>$v ){
				$d = explode('_',$v['name']);
				$n =  count($d)-2;
				?>
				<tr>
					
					<td class="fn" ><?php echo $v['name'];?></td>
					<td><?php echo $d[$n];?></td>
					<td><?php echo $v['filesize'];?></td>
					<td><a href="<?php echo $directory;?>/<?php echo $v['name'];?>"  target="_blank" >下载</a>
					&nbsp;
					&nbsp;
					<span class="del" onclick="javascript:deletebackup(this);"   >删除</span>
					&nbsp;
					&nbsp;
					<span class="del" onclick="javascript:resetbackup(this);"   >恢复备份</span>

					</td>
				</tr>
				<?php
			 }
			?>
			</table>
			</td>
		</tr>
	 </table>	
	</li>
	<li class="con" >
	 <form action="<?php echo $this->baseuri; ?>"  method="post"  enctype="multipart/form-data" >
	<table class="formtable" >
		<tr class="style1" >
			<td class="form_text" style="width:12%"  >上传文件</td>
			<td    >
				<input type="file" name="uploadfile" value="" size="30" >

				<div class="remark" >
				数据库文件上传后，到【已存在的备份文件】列表中进行烣复备份到数据库。
				</div>
			</td>
 
		</tr>	


 		<tr class="style1" >
			<td colspan=2>

			 <div class="formbtn" >
				<input type="submit" class="submit_btn" value="上传备份文件"/> 
				<input type="hidden" name="task" value="upload" />
			  </div>
			</td>
		</tr>
	</table>
	 </form>
	</li>

	</ul>

</div>


<style type="text/css" >
.del{ cursor:pointer; }
tr.isrestore td{ background:#CCEBCD; }
</style>
<script language="javascript" >
 	$(function(){
		$('.submit_btn').click(function(){
 			var url = '<?php echo $this->baseuri;?>&task=backup&no_html=1';
			var fn = $('input[name=filename]').val();
			var tp;
			$('input[name=tp]').each(function(k,o){ if( o.checked ){ tp=o.value; } });
		 
			$.get(url,{fn:fn,tp:tp},function(data){
				var f = $.trim(data);
				if( f.length>10 ){
					$('.backbtn').hide();
					//alert(f+'备份文件成功.');
					$('.backupsuccess').html('<br/><font color=red>备份文件成功! </font><br/>文件：<a href="'+f+'" target="_blank"  >'+f+' <font color=blue >点击下载</font></a>');
				}
			});
			return true;
 		});
 
	});

	function deletebackup(obj){
		var fn = $.trim($('.fn',obj.parentNode.parentNode).html());
		$(obj.parentNode.parentNode).remove();

		var url = '<?php echo $this->baseuri;?>&task=delete&no_html=1';
		$.get(url,{fn:fn},function(data){
			var data = $.trim(data);
			 if( data == '1' ){
				 alert(' 备份文件 '+fn+ ' 已删除.');
			 }
		});
	}

	
	function resetbackup(obj){
		var fn = $.trim($('.fn',obj.parentNode.parentNode).html());
		var url = '<?php echo $this->baseuri;?>&task=restore&no_html=1';

		$(obj).html('<div class="uploading" ></div>');
		$.get(url,{fn:fn},function(data){
			var data = $.trim(data);
			 if( data == '1' ){
				$(obj).html(' <font color=red size=5 >√</font> ');
				$(obj.parentNode.parentNode).addClass('isrestore'); 
				alert('已恢复成功');
				
			 }else{
				 alert('恢复数据库失败');
			 }
		});
	}
</script>