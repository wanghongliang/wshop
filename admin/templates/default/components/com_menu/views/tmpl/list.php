<?
include($this->path.DS.'tmpl'.DS.'toolbar.php');
?>
<form action="<?php echo $this->baseuri;?>" method="post" name="listform" >

<table class="listtable"  >
	<thead>
		<tr class="trbg1"  >
			<th width=15 ><input type="checkbox" class="selectall" /></th>
			<th>名称</th>
			<th>默认</th>
			<th>
				发布
			</th>


			<th colspan=2 > 排序 </th>
			<th> 类型/管理 </th>

			<th   > 操作 </th>
			<th> ID </th>
		</tr>
	</thead>

	<?php 
	$this->_showRow(0);
	?>

 
</table>
 

</form>
<script language="javascript" >
  $(function(){
	// $('.v').wDialog({title:'编辑内容',width:980,height:520,top:2,iframe:true});
	$('.v').click(function(){
		location.href=$(this).attr('url');
	});
 });
/** 移动提示 **/
function delmenu(href){
	// 继承属性
	var options = {title:'删除提示',width:250,height:80,top:30,
		url:href,
		isget:true,
		reload:true,
		loadAfter:function(obj){
			$(obj).find('select').change(function(){
				//alert(href+'&task=moveall&movetoid='+this.value+'&ids='+ids;);
				//location.href=href+'&task=moveall&movetoid='+this.value+'&ids='+ids;;
			});
		}
	};
	var d =  $.w.createDialog(options,10 );
}
</script>