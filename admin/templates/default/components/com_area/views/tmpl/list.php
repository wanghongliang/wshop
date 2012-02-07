<?
include($this->path.DS.'tmpl'.DS.'toolbar.php');
?>
<form action="<?php echo $this->baseuri;?>" method="post" name="listform" >

<table class="listtable"  >
	<thead>
		<tr class="trbg1"  >
			<th width=15 ><input type="checkbox" class="selectall" /></th>
 
			<th width=30% >名称</th>
			<th>别名</th>
			<th>
				子栏目数量
			</th>
			<th>
				发布
			</th> 

			<th colspan=2 >   </th>
 
			<th   > 操作 </th>
			<th> ID </th>
		</tr>
	</thead>

	<?php 
 
	foreach( $rows as $item ){
	?>
			<tr >
				<td>
					<input type="checkbox" name="id[]" class="ids" value="<?php echo $item['id'];?>" />
				</td>
				<td>
				<?php
				if( $item['n']>0 ){
				?>
				<div class="plus" onclick="createTR(this,0)" > + 
				</div>
				<?php
				}else{
				}
				?>
				 
					<?php

					for($i=1;$i<$depth;$i++){
						echo '&nbsp;<font color=#aaaaaa > </font>&nbsp;';
					}

					?>
					<?php
						//echo $item['id'];
						echo $item['name'];// 名称
						//echo $item['parent_id'];
					?>
				</td>
				<td> 
					<?php
					echo $item['alias'];// 名称
					?>
				</td>
				<td> 
					(<?php
					echo $item['n'];// 名称
					?>)
				</td>

				<td>
				<?php
				if($item['published'] == 1 ){
					?>
					<a href="<?php echo $this->baseuri;?>&task=toggle&attr=published&value=0&id=<?php echo $item['id'];?>" >
					<img src="templates/default/images/tick.png" >
					</a>
					<?php
				}else{
					?>
					<a href="<?php echo $this->baseuri;?>&task=toggle&attr=published&value=1&id=<?php echo $item['id'];?>" >
					<img src="templates/default/images/publish_x.png" >
					</a>
					<?php
				}?>

				</td> 
					<td>
						<?php
						if( $k>0){
						?>
						<a href="<?php echo $this->baseuri;?>&task=moveup&id=<?php echo $item['id'];?>" >
						<img src="templates/default/images/uparrow.gif" />
						</a>
						<?php
						}
						?>
					</td>

					<td>
						<?php
						if( $k<$len){
						?>
						<a href="<?php echo $this->baseuri;?>&task=movedown&id=<?php echo $item['id'];?>" >

						<img src="templates/default/images/downarrow.gif" />
						 
						</a>
						<?php
						}
						?>
					</td>
 						<td>
							<a  url="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $item['id'];?>&tmpl=component" class="v list_edit">
							编辑
							</a>&nbsp;<?php
							//是否有子栏
							if( is_array( $this->rows[$item['id']] ) ){

							}else{
							?><a href="javascript:del('<?php echo $this->baseuri;?>&task=del&id=<?php echo $item['id'];?>');"  class="list_del" > 删除
							</a>
							<?php 
							}
							?>
						</td>
			 
					<td>
						<?php
						echo $item['id'];
						?>
					</td>

				</tr>
	<?php
	}
	?>


	<tr class="navigations">
		<td colspan=10 >
			&nbsp;
		</td>
	</tr>
</table>
 

</form>
<script language="javascript" >
var baseuri = '<?php echo $this->baseuri;?>';
  $(function(){
	 $('.v').wDialog({title:'编辑内容',width:960,height:520,top:2,iframe:true});
	 $('.plus').click(function(){

	 });
 });

 
function createTR(obj,depth){ 
	 depth++;
 	 var tr = obj.parentNode.parentNode;
	 var id = $('.ids',tr).val(); 
	 var d;

	 if( tr.open ){ 
		 alert('已加载过..');
		 //$(".pid"+id).hide();
		 return;
	 }else{
		 tr.open =1 ;
		 $(obj).html('-');
	 }
	 
 
	 $.get('<?php echo $this->baseuri;?>&task=ajax&no_html=1&act=subarea&id='+id,function(data){
 		d = eval(data); 
 		var n = d.length;
		for(var i=0;i<n;i++){
			var trn = "<tr class='pid"+d[i][0]+"'><td><input type='checkbox' name='id[]' class='ids' value='"+d[i][0]+"' /></td>";
			if( d[i][2]>0 ){
				trn+="<td><div class='plus m"+depth+"' onclick='createTR(this,"+(depth)+")' >+</div> ";
				trn+=d[i][1]+"</td><td>"+d[i][4]+"</td><td>";
				trn+="("+d[i][2]+")";
			}else{
				trn+="<td><div class='plus_n m"+depth+"' ></div>  ";
				trn+=d[i][1]+"</td><td>"+d[i][4]+"</td><td>";
			}
			
			
			trn+="</td><td>";
			
 			if( d[i][3] == '1' ){
				trn+="<a onclick='toggle(this, 0,"+d[i][0]+")' ><img src='templates/default/images/tick.png' ></a>";
			}else{
				trn+="<a onclick='toggle(this, 1,"+d[i][0]+")' ><img src='templates/default/images/publish_x.png' ></a>";
			}
			trn+="</td><td></td><td></td><td>";
			trn+="<a  url='"+baseuri+"&task=edit&id="+d[i][0]+"&tmpl=component' class='v list_edit' >编辑</a>&nbsp;&nbsp;<a href=\"javascript:delArea('"+d[i][0]+"');\"  class=\"list_del\" > 删除 </a></td><td>";
			trn+= d[i][0];
			trn+="</td></tr>";
			//$('.listtable').append(tr);
			$(tr).after(trn);
		}

		$('.v').wDialog({title:'编辑内容',width:960,height:520,top:2,iframe:true});
		addTREvent();
	 });
}


function delArea(id){
	var href= baseuri+"&task=del&id="+id+'&no_html=1';
	
	//alert(href);return;
	if( confirm("请确认是否删除？") ){
		$.get(href,function(data){
				$('.pid'+id).remove();
		});
	}else{
		
	}
 
}

function toggle(obj,v,id){
	var href=baseuri+"&task=toggle&attr=published&value="+v+"&no_html=1&id="+id;
	var td = obj.parentNode;
	

	 

	$.get(href,function(data){
		if( parseInt(v) == 0 ){
		$(td).html("<a onclick='toggle(this,1,"+id+")' ><img  src='templates/default/images/publish_x.png' ></a>");
		}else{
			$(td).html("<a onclick='toggle(this,0,"+id+")' ><img src='templates/default/images/tick.png' ></a>");	
		}
	});
}
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