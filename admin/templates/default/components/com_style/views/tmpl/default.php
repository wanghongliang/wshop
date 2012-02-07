<?php

?>
<script language="javascript" >

//打开模块
function openSelectModule(){
	$('.mlist').show();
	$('.tlist').hide();
 
}

//重新加载模块
function reloadSelectModule()
{
	var uri = "index.php?com=style&task=selectmodule&no_html=1";
	$.get(uri,function(data){
		$('.mlist').html(data);
	});
}


//打开模板选择列表
function openSelectTemplate()
{
	if( $('.tlist').html().length<10 )
	{
		$('.tlist').append($('<iframe name="tlist" id="tlist" src="index.php?com=style&task=selecttemplate&tmpl=component"  scrolling="no"  FRAMEBORDER=0  width=8500 height=200 >'));
	} 
	//alert('ok');

	$('.mlist').hide();
	$('.tlist').show();
}

//改变当前的模块
function changeTemplate(name)
{
	$('#front').get(0).src='../index.php?custom=1&template='+name;
	reloadSelectModule();//重新AJAX方式加载模块
}


function saveLayout()
{
	window.frames["front"].getLayout();

	var str = '';	//字符串

	var pos =''; var obj; var published = 0;

	var order = 0;
	 $('.md').each(function(k,v){  
 		obj = window.frames["front"].document.getElementById(v.name+'-'+v.value);//.get(0).parentNode.id;
		if( obj  ){
			pos = obj.parentNode.id;
			order = obj.order;
		}else{
			pos= '';
			order = 0;
		}

		if( v.checked )
		{
			published = 1;
		}else{
			published = 0;
		}



		str +=','+v.value+':'+v.name+':'+published+':'+pos+':'+order;
	});
	

	/**
	 * AJAX方式保存.
	 */
	var template = '';

	if( window.frames["tlist"] ){
		template = window.frames["tlist"].getTemplate();
	}

	var uri = 'index.php?com=style&task=savelayout&no_html=1&param='+str+'&t='+template;
	$.get(uri,function(data){
		if( data == '1' ){ alert(' 保存成功! '); }
	});
}


//打开和关闭按钮
$(function(){
	$('#cls').click(function(){
		 
 
		$('.mlist').hide();
		$('.tlist').hide();
		
 
 	});


	$('.style_save').click(function(){
		saveLayout();
	});


	$('.style_cancel').click(function(){
		location.href="index.php";
	});
});
</script>

<?php /** 头部的工具条 **/	?>
<div class="style_header" >

	<div class="style_btn" >
		<div class="style_save" >
 		</div>

		<div class="style_cancel" >
 		</div>

		<div class="style_preview" >
			<a href="../" target=_blank >预览</a>
		</div>
	</div>

	<div class="style_tool" >
		<ul>
			<li class="style_tool_c" >
				配置模块
			</li>
 
			<li  onclick="openSelectModule()" >
				添加模块
			</li>
			<li onclick="openSelectTemplate()" >
				选择风格
			</li>
		
		</ul>
	</div>


</div>


<?php /** 信息管理列表 **/ ?>

<div class="mlist" >

	<?php	//模块列表						?>
	<div class="module_list"  >
	<div class="m_title" >已安装模块</div>
	<div class="m_body"  >
	<ul id="exists_module" >
		<?php
		if( is_array(  $modules_list ) ){
			foreach( $modules_list as $module )
			{
				?>
					<li>
					

						<a href="#" >
							<input type="checkbox" class="md" name="<?php echo $module['module'];?>" value="<?php echo $module['id'];?>"
							<?php 
							if( $module['published'] == '1' ){
								echo 'checked';
							}
							
							?>
							onclick="javascript:toggleM('<?php echo $module['module'];?>-<?php echo $module['id'];?>','<?php echo $module['position'];?>',this)";
							/>
						</a>
					 
						<?php echo $module['title'];?>
						
					</li>
				<?
			}
		}else{
			
		}
		?>
	</ul>
	</div>
 </div>

 <div class="module_type" >
 	<div class="m_title" >推荐模块</div>
	<div class="m_body" >
		<ul >
		<?php
		if( is_array(  $modules ) ){
			foreach( $modules as $module )
			{
				?>
					<li>
						<?php echo $module['title'];?>
						&nbsp;

						<a href="javascript:openCreateMD('<?php echo $module['name'];?>')" >
						添加
						</a>
					</li>
				<?
			}
		}else{
			
		}
		?>
	</ul>
	</div>
 </div>
<?php //完成 ?>



</div>

	<div class="tlist" >
	</div>

<div class="openbtn" >
	<div class="cls" id="cls"  ></div>
</div>


<div >
<iframe id="front" FRAMEBORDER=0  name="front" scrolling="no"  src="../index.php?custom=1" width=100% height=700  >
</div>


