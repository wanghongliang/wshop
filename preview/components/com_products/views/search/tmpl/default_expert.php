<?php
$baseurl = '/'.$GLOBALS['config']['preview_directory'].'/'.URI_DIRECTORY.'/'.$app->getTemplate();

/**
include($app->getPreviewComponentPath().DS.'com_banners'.DS.'helper.php');
$banner = getBanner(18); 
$params = unserialize( $banner['params'] );

//print_r($params);

**/
?>
<link href="<?php echo $baseurl;?>/style/search.css" type="text/css" rel="stylesheet"/>
 

<div id="root">
<?php
$module	=& ModuleHelper::getModule('mod_breadcrumbs'); 
echo ModuleHelper::renderModule($module); 
?>
<a name="filter" ></a>
</div>

 
<div class="flv mag-t5"><img src="<?php echo $baseurl;?>/cache/sbanner.jpg" alt="" /></div>
<div class="flv sback">
	<div id="searchdiv">
		<h3 class="stitle">智能搜索</h3>
		<div id="sform">
			<form action="" method="">
				<h5 class="sftitle">您的位置：</h5>
				<div class="sfdiv">
					<p>
						<label class="slab">地理区域：</label>
						<select name="">
							<option value="1">中国</option>
						</select>
						<select name="">
							<option value="1">广东省</option>
						</select>
						<select name="">
							<option value="1">深圳市</option>
						</select>
					</p>
					<p style="display:none" >
						<label  class="slab">城乡：</label>
						<input type="radio" name="wal" id="" checked="true"/> <label for="">市中心</label>
						<input type="radio" name="wal" id=""/> <label for="">县镇中心</label>
						<input type="radio" name="wal" id=""/> <label for="">乡村</label>
					</p>
				</div>
				<h5 class="sftitle">使用房型：</h5>
				<div class="sfdiv">
					<p>
						<label  class="slab">房型：</label>
						<select name="">
							<option value="1">三室二厅</option>
						</select>
						<label>面积</label><input type="text" name="" size="8" />平米
					</p>
					<p>
						<label class="slab">使用厅数：</label>
						<select>
							<?php
							    for($i=1; $i < 10; $i++)
							    {
							        echo '<option value="'.$i.'">'.$i.'厅</option>';
							    }
							?>
						</select>
					</p>
					<p>
						<label class="slab">厅类型：</label>
						<select>
							<option value="1">客厅</option>
							<option value="2">卧室</option>
							<option value="3">书房</option>
						</select>
					</p>
					<p>
						<label class="slab">房间朝向：</label>
						<select>
							<option value="1">东</option>
							<option value="2">南</option>
							<option value="3">西</option>
							<option value="3">北</option>
						</select>
					</p>
				</div>
				<p style="margin:20px 0px 10px 140px;">
					<input type="submit" class="sbtn" value="立即搜索" />
				</p>
			</form>
		</div>
	</div>
</div>
