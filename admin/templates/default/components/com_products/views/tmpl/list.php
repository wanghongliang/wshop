<form action="<?php echo $this->baseuri;?>" method="post" name="listform" >
 <?
import('html.html'); 
include($this->path.DS.'tmpl'.DS.'toolbar.php');

 
?>


<table class="listtable"  >
	<thead>
		<tr>
			<th width=10 ><input type="checkbox" class="selectall" /></th>

			<th width=74 >
			<?php 
				echo HTML::_('grid.sort',   '商品图片', 'c.thumbnail', $lists['order_dir'], $lists['order'] ); 
			?>
			
			</th>
			<th width=30% >
			<?php 
				echo HTML::_('grid.sort',   '商品名称', 'c.name', $lists['order_dir'], $lists['order'] ); 
			?>
			</th>
 			<th width=10% >
 			<?php 
				echo HTML::_('grid.sort',   '价格', 'c.shop_price', $lists['order_dir'], $lists['order'] ); 
			?>
			</th>
 			<th width=10% >
 			<?php 
				echo HTML::_('grid.sort',   '库存', 'c.store', $lists['order_dir'], $lists['order'] ); 
			?>
			</th>

			<th>
			<?php 
				echo HTML::_('grid.sort',   '上架', 'c.published', $lists['order_dir'], $lists['order'] ); 
			?>
			
			</th>
			
			<th>
			<?php 
				echo HTML::_('grid.sort',   '排序', 'c.ordering', $lists['order_dir'], $lists['order'] ); 
			?>
	
			</th>


			<th>
			<?php 
				echo HTML::_('grid.sort',   '分类', 'c.catid', $lists['order_dir'], $lists['order'] ); 
			?>
			
			</th>
			<th > 操作 </th>
			<th>
			<?php 
				echo HTML::_('grid.sort',   '序号', 'c.id', $lists['order_dir'], $lists['order'] ); 
			?>
			</th>
		</tr>
	</thead>

	<?php 

 	if( is_array($this->rows) ){
		$i = 0;

 		foreach($this->rows as $k=>$row )
		{
		?>
			<tr  class="trbg<?echo $i;?> tr<?php echo $row['id'];?>" >
				<td>
					<input type="checkbox" name="id[]" value="<?php echo $row['id'];?>" class="ids" />
				</td>
				<td align=center >
				<?php if( $row['thumbnail'] ){ ?>
					<a  class="img" href="<?php echo $row['thumbnail'];?>"   >
					<img src="<?php echo $row['thumbnail'];?>" width="60" />
					</a>
				<?php }else{ ?>
					无图
				<?php } ?>
				</td>
				<td >
				<a href="javascript:edit(<?php echo $row['id'];?>)" >
					<?php echo $row['name'];?>
				</a>	
				</td>
				<td>
				<?php 
				echo $row['shop_price'];
				?>
				</td>

				<td>
				<?php 
				echo $row['store'];
				?>
				</td>

				<td>
				<?php
				if($row['published'] == 1 ){
					?>
					<a href="<?php echo $this->baseuri;?>&task=toggle&attr=published&value=0&id=<?php echo $row['id'];?>" >
					<img src="templates/default/images/tick.png" >
					</a>
					<?php
				}else{
					?>
					<a href="<?php echo $this->baseuri;?>&task=toggle&attr=published&value=1&id=<?php echo $row['id'];?>" >
					<img src="templates/default/images/publish_x.png" >
					</a>
					<?php
				}?>

				</td>

				<td>
				<input type="text" name="ordering" value="<?php echo $row['ordering'];?>" size=5 class="ordering" />
				</td>

				<td><?php echo $row['typename'];?></td>

 				<td>
				<a href="javascript:edit(<?php echo $row['id'];?>)" >
				快编
				</a>

				&nbsp;
 				<a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $row['id'];?>" >
				编辑
				</a>

				&nbsp;
				<a href="javascript:del('<?php echo $this->baseuri;?>&task=del&id=<?php echo $row['id'];?>');" >
				删除
				</a>

		 
				</td>

				<td>
					<?php echo $row['id'];?>
				</td>
			</tr>
		<?

			$i = 1-$i;

		}
	}
	?>

		<tr class="navigations" >
			<td colspan=10 >
				<?php
				echo $nav->showFilePage2();
				
				?>
			</td>
		</tr>
</table>

		<input type="hidden" name="filter_order" value="<?php echo $lists['order']; ?>" />
		<input type="hidden" name="filter_order_dir" value="<?php echo $lists['order_dir']; ?>" />
		<input type="hidden" name="com" value="<?php echo $_REQUEST['com'];?>" />
		<input type="hidden" name="tmpl" value="<?php echo $_REQUEST['tmpl'];?>" />
		<input type="hidden" name="mtid" value="<?php echo $_REQUEST['mtid'];?>" />
		<input type="hidden" name="menuid" value="<?php echo $this->menuid;?>" />
</form>
<script type="text/javascript" src="templates/default/js/jquery.imagePreview.1.0.js"></script>
<script type="text/javascript">
$(function(){
	$("a.img").preview();	  
});
var tr;
function edit(id){

    tr = $('.tr'+id).get(0); 
  	// 继承属性
	var options = {title:'编辑产品基本信息',width:850,height:500,top:20,
		url:'index.php?com=products&tmpl=component&task=edit&id='+id,
		iframe:true,
		reload:true,
		isget:true,
		loadAfter:function(obj){
 
		}
	};

	//打开配置对话框
	var d =  $.w.createDialog(options,3 );
}
function saveForm(url,data){
	$.w.closeN(3);
	var panel = Message();
	 
	$.post(url,data,function(d){ 
		//alert(d);
		$(panel).html('<div class="ms" >保存成功!</div>'); 
		setTimeout(function(){$(panel).fadeOut("fast");},300);  

 		var td =$('td',tr);//.html(data.name);
		$(td[2]).html(data.name);
		$(td[3]).html(data.shop_price);
		$(td[4]).html(data.store); 
	});

	 
}
function cancel(){
	$.w.closeN(3);
}

function Message(){
	var panel = $('#am').get(0);
	if( !panel ){
		//alert('LOAD.');
		$('body').append('<div id="am" ></div>');
		panel = $('#am').get(0);
	}
	var s = clint(); 
	//$(obj).css('top',s.h/2-$(obj).height()/2 + s.t -10);
	var t = s.h/2-$(panel).height()/2 + s.t -10;
	t = t<1?0:t;
	$(panel).css({'top':t,'left':(document.body.clientWidth -$(panel).width()) /2});
	$(panel).show();
	return panel;
}
</script>