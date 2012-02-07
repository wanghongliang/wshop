<?
include($this->path.DS.'tmpl'.DS.'toolbar.php');
//include($this->path.DS.'tmpl'.DS.'submenu.php');
?>

<div class="editor-tabs" >
	<ul class="switch_btn" >
		<li class="active" >缓存列表</li> 
	</ul>
</div>


  <div class="switch_con" >
	<ul >
	<li class="active con" >
	<table class="formtable" >
		<tr class="style1" >
			<td class="form_text"  style="width:12%"  >需要更新的组件缓存</td>
			<td>
			<div style="border-bottom:1px solid #eee;">  共有 <span class="udn" ><?php echo count($lists);?></span>个需要更新相应缓存的组件</div>
			<table class="cachelist" >
				<tr>
					<th>组件名</th>
					<th>组件</th> 
					<th>操作</th>
				</tr>
			<?php
 			
			foreach( $lists as $k=>$v ){ 
				?>
				<tr>
					
					<td class="fn" id="<?php echo $v['id'];?>" ><?php echo $v['name'];?></td>
					<td><?php echo $v['option'];?></td> 
					<td> 
					&nbsp;
					&nbsp;
					<span class="update" onclick="javascript:updatecache(this);"   >更新关联缓存</span> 

					</td>
				</tr>
				<?php
			 }
			?>
			</table>
			</td>
		</tr>
		

		<?php
		if(  count($lists)>0 ){ 
		?>
 		<tr class="style1 updatebtntr" >
			<td colspan=2>

			 <div class="formbtn backbtn" >
				<input type="button" class="submit_btn" value="全部更新"/> 
			  </div>
			</td>
		</tr>
		<?php
		}
		?>

	 </table>	
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

 
	
	function updatecache(obj){
		var id = $.trim($('.fn',obj.parentNode.parentNode).attr('id'));
		var url = '/?com=cache&task=update&no_html=1';

 		$(obj).html('<div class="uploading" ></div>');
		$.get(url,{id:id},function(data){
 			var data = $.trim(data);

 			 if( data == '1' ){
				$(obj).html(' <font color=red size=5 >√</font> ');
				$(obj.parentNode.parentNode).addClass('isrestore'); 
				
				
				var len = $('.cachelist tr').length;
				var len2 = $('.cachelist .isrestore').length;
				
				if( (len-len2)>1 ){
					$('.udn').html( ((len-len2)-1) );
				}else{
					$('.updatebtntr').hide();
					$('.short').hide();
					$('.udn').html( '0' );
				}

				//alert('已更新成功');

			 }else{
				 alert('更新失败');
			 }
		});
	}
</script>