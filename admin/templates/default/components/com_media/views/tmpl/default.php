<html>
<head>
<style type="text/css" >
body{ font-size:12px; margin:0px;padding:0px; font:9pt Tahoma,"宋体",Arial,Helvetica,Sans-Serif;  }
.msg{ background:yellow;float:left;	}
.path{ float:left;color:blue;}
.folder3{
	margin:0px auto;
	padding:5px  0px 0px  0px; 
	
	cursor:pointer;
	text-align:center;
	height:30px;
	width:60px;
}
.foldername{
	font-size:11px; padding:0px;padding-top:53px;
	text-align:center; height:20px; overflow:hidden;
	color:red;
}
.view,.view2{
	width:120px;
	height:100px;
	margin-top:5px;
	float:left;
	margin-left:5px;
	overflow:hidden;
	text-align:center;
}
.view2{
	width:100px; height:70px;   background:#fcfcfc;
	margin-left:20px;	background:url("templates/default/components/com_media/views/tmpl/s.jpg") no-repeat center top;
	cursor:pointer;
}
.operater_menu{
	text-align:right;
	padding:0px 10px;
	line-height:22px;	
	border-bottom:1px solid #cccccc;
}
div.view{
	color:#555;
}
div.view a{
	color:#555;
}

div.filename{
	font-size:10px;
	margin-top:5px;color:#aaa;
}
.picstyle{ margin:auto;border:1px solid #e0e0e0; width:82px;height:50px; padding:2px;}
div.picstyle img{
	
}
.opt_remark{ padding:4px 5px;line-height:20px; height:20px; margin-bottom:10px; background:#f9f9f9; color:#999; border-bottom:1px solid #cccccc; }

.sper{ width:100%; border-bottom:1px solid #ccc; clear:both; height:10px; overflow:hidden; margin-bottom:5px;	}
.fr{ float:right;}
.page2 a{ text-decoration:none; }

</style>
<script type="text/javascript" src="templates/default/js/jquery-1.3.1.js"></script>
</head>
<body>
<div class="operater_menu">

	<div class="path" >
	当前目录：<?echo $currentPU;?>
	</div>
	<div class="msg" id="statu" ></div>
	<?php
	//操作按钮

	$pos = strpos($url,'&picurl'); 
	if( $pos>0){
		$url_home = substr( $url,0,$pos);
	}
	?>
	<a href="javascript:self.location.replace('<?echo $url_home; ?>');" >根目录</a> <a href="javascript:self.location.replace('<?echo $url; ?>&picurl=<?echo $prevfolder;?>');"   > 返回上一级</a>
</div>

<div class="opt_remark" >
	<div class="fr">
	<input type="checkbox" onclick="$('.ids').attr('checked',this.checked);" />
	<lable>全选</lable>
	<input type="button" style="border:1px solid #aaa;cursor:pointer;vertical-align:top;" value="删除选中项" onclick="delall2()" /> 
	</div>
	<font color=red >说明：</font>双击文件夹，可查看文件夹内的图片文件，双击图片文件可以选择该图片。
</div>


<?
$wdir = WDir::getInstance();

$arr=$wdir->getFolders($dir_path);
if(is_array($arr)){
	foreach($arr as $v){

		//链接的符号为 -|-
	?><div class=view2 ondblclick="self.location.replace('<?echo  $url.'&picurl='.$_GET['picurl'].'-|-'.$v['name'];?>');">
		<div class="foldername" ><?echo $v['name'];?></div>
		 
		 
		
	 </div>
	<?
	}
}

?>
<div class="sper"></div>
<?php

//文件分页显示
$arr = $wdir->getFiles($dir_path);

//总个数
$num=count($arr);
if($num>0){

	//每页的个数
	$percent=30;

	//总页数
	$totalPage=ceil($num/$percent);

	//echo $totalPage;

	//当前页
	$currentPage=$_GET['page'];
	$currentPage=$currentPage?$currentPage:1;
	
	//当前页的最大数
	$endNumber=$currentPage*$percent;

	$endNumber=$endNumber>$num?$num:$endNumber;

	//当前页的开始数
	$startNumber=$currentPage*$percent-$percent;
	$startNumber=$startNumber<1?0:$startNumber;
	if($currentPage<2){
		$startNumber=0;
	}

	//文件的相对目录
	$file_path=str_replace(preg_replace('|[\\\/]+|','/',PATH_ROOT),'',$dir_path);


	
	echo '<div style="clear:both;" >';
	for($i=$startNumber;$i<$endNumber;$i++){
		$v='/'.$arr[$i]['name'];
		
		$file_p = str_replace( '/','-|-',$file_path.$v );
		//echo $i;
	//foreach($arr as $v){
	?>
		<div class=view id=view<?echo $i;?> ondblclick="success('/<?echo substr($file_path.$v,1);?>')">
			<div class=picstyle ><img src='<?echo $file_path.$v;?>' border=0 width=82 height=50 class=pic_select /></div>
			<div class="filename"  ><?echo $arr[$i]['name'];?></div>
			<div > 
			<input type="checkbox" name="f[]" class="ids"  value="<?echo $file_p;?>" />
			<?//echo $v['filesize'];?>&nbsp;&nbsp;<a href="javascript:deletePic('<?echo $i;?>','<?echo $file_p;?>');" >删除</a></div>
		</div>
	<?
	}

	echo '</div>';
	?>
<div style="clear:both;background:#fcfcfc;margin-top:10px;font-size:18px;font-weight:bold;" >

		<?
		 echo '<div style="font-size:12px;font-weight:normal;clear:both;text-align:left;line-height:30px; height:25px;padding-left:10px;float:left;">';
		 echo '每页',$percent,'个图片&nbsp;&nbsp;&nbsp;';
		 echo '共:'.$num.'个图片</div>';
		?>

		<div class="page2 fr" >
		<?php
		for($i=1;$i<=$totalPage;$i++){

			echo '<a href="',$url.'&page=',$i,'&picurl=',$_GET['picurl'],'" ';
			if($currentPage==$i){
				echo ' style="font-size:14px;color:red;" ';
			}
			echo '>',$i,'</a>	&nbsp;&nbsp;&nbsp';
		}
		?>
		</div>	


</div>

<?
}

?>

<script language="" >
function success(x){
	try{
		if( window.parent.selectSuccess ){	//如果是弹出子框，将关闭
			//alert(x);
			iframe = window.parent;
			iframe.selectSuccess('<?php echo $_REQUEST['iname'];?>',x);
		}else{
			
			 window.open(x, 'newwindow', 'toolbar=no, menubar=no, scrollbars=no,status=no');
		}
	}catch(e){
		 
		window.open(x, 'newwindow', 'toolbar=no, menubar=no, scrollbars=no,status=no');


	}
}

function deletePic(n,str){
	if( confirm("确定要删除信息吗？本操作将直接删除信息，不可恢复！"))
	{

		obj=document.getElementById('view'+n);
		//obj=obj.parentNode;
		//obj.removeNode(true);
		str='<?echo $url;?>&task=delfile&d='+str;

		//alert(str);
		remoteDelete(obj,str)
	}
}

function delall2(){
	
 	$('#statu').html('正在删除中..');
	$('#statu').show();
	
	var i=0,n=0; 
	$('.ids').each(function(k,o){
		if( o.checked ){
			n++;
			//alert(o.value);
			var url='<?echo $url;?>&task=delfile&no_html=1&d='+o.value;
			$.get(url,function(data){
				i++;
				$(o.parentNode.parentNode).remove();
				if( i>=n ){
					$('#statu').html('删除成功!');
					setTimeout(function(){closeStute();},1000);
				}
			});
		}
	});
 
	if( n < 1){ alert(' 没有选中项.'); closeStute(); }
}
function remoteDelete(obj,url)
{	
	$.get(url,function(data){
		//alert(data);
		if(data=='1'){
		//alert('删除成功!');
			$('#statu').html('删除成功!');
			$('#statu').show();
			setTimeout(function(){closeStute();},1000);
		}
		$(obj).remove();
	});

}

function closeStute()
{
	$('#statu').hide();
}
</script>

</body>
</html>
