 
<link href="templates/default/js/upload/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/default/js/upload/upload.js"></script>
<script type="text/javascript" src="templates/default/js/upload/upload.swfobject.js"></script>
<script type="text/javascript" src="templates/default/js/upload/upload.queue.js"></script>
<script type="text/javascript" src="templates/default/js/upload/fileprogress.js"></script>
<script type="text/javascript" src="templates/default/js/upload/handlers.js"></script>
<script type="text/javascript">
var swfu;


SWFUpload.onload = function () {
	var settings = {
		flash_url : "templates/default/js/upload/swfupload.swf",
		upload_url: "<?php echo $this->baseuri;?>&task=save&no_html=1",
		post_params: {
			"PHPSESSID" : "<?php echo session_id();?>", 
			"iscom":"<?php echo $_REQUEST['iscom'];?>",
			"mode":"flash",
			"iname":"<?php echo $_REQUEST['iname'];?>",
			"rename":"<?php echo $_REQUEST['rename'];?>"
		}, 

		file_post_name : "filename", 
		file_size_limit : "100 MB",
		file_types : "*.jpg;*.gif;*.png;*.dmp",
	 
		file_types_description : "图片文件",
		file_size_limit : "102400",	// 100MB
		file_queue_limit : 5,
		custom_settings : {
			progressTarget : "fsUploadProgress",
			cancelButtonId : "btnCancel"
		},
		debug: false,

		// Button Settings
		button_image_url : "templates/default/js/upload/61x22.png",
		button_placeholder_id : "spanButtonPlaceholder",
		button_width: 61,
		button_height: 22,

		// The event handler functions are defined in handlers.js
		swfupload_loaded_handler : swfUploadLoaded,
		file_queued_handler : fileQueued,
		file_queue_error_handler : fileQueueError,
		file_dialog_complete_handler : fileDialogComplete,
		upload_start_handler : uploadStart,
		upload_progress_handler : uploadProgress,
		upload_error_handler : uploadError,
		upload_success_handler : uploadSuccess,
		upload_complete_handler : uploadComplete,
		queue_complete_handler : queueComplete,	// Queue plugin event
		
		
		// SWFObject settings
		minimum_flash_version : "9.0.28" 

		/**
		swfupload_pre_load_handler : swfUploadPreLoad,
		swfupload_load_failed_handler : swfUploadLoadFailed

		**/
	};

	swfu = new SWFUpload(settings);
}

</script> 

<div class="editor-tabs" >
	<ul class="switch_btn" >
		<li class="active" >高级上传模式</li>
		<li>普能上传模式</li> 
	</ul>
</div>

<div class="con2" >

<ul class="switch_con" >
	<li class="con active" >

<div id="content"> 
	<form id="form1" action="index.php" method="post" enctype="multipart/form-data">
		 
		<div id="divSWFUploadUI">
		
			<div class="divheader" >
				

				<div class="fr" >
				<span id="spanButtonPlaceholder"></span>
				<input id="btnCancel" type="button" value="取消上传" disabled="disabled" style="margin-left: 2px; height: 22px; font-size: 8pt;" />
				</div>

				<span class="legend">上传队列</span> 
			</div>
			
			<div class="fieldset  flash" id="fsUploadProgress">
			
			</div>
			<div id="divStatus">已上传 0 个文件. </div>

		</div>
		<noscript>
			<div style="background-color: #FFFF66; border-top: solid 4px #FF9966; border-bottom: solid 4px #FF9966; margin: 10px 25px; padding: 10px 15px;">
				多个文件上传组件不能使用，需要您的浏览器支持 javascript 脚本功能.
			</div>
		</noscript>


		<div id="divLoadingContent" class="content" style="background-color: #FFFF66; border-top: solid 4px #FF9966; border-bottom: solid 4px #FF9966; margin: 10px 25px; padding: 10px 15px; display: none;">
			正在加载上传组件...
		</div>


		<div id="divLongLoading" class="content" style="background-color: #FFFF66; border-top: solid 4px #FF9966; border-bottom: solid 4px #FF9966; margin: 10px 25px; padding: 10px 15px; display: none;">
			多个文件上传组件加载时间过长或者加载失败，请确认您的浏览器已安装 flash player 插件,谢谢.
		</div>


		<div id="divAlternateContent" class="content" style="background-color: #FFFF66; border-top: solid 4px #FF9966; border-bottom: solid 4px #FF9966; margin: 10px 25px; padding: 10px 15px; display: none;">
			多个文件上传组件不可用.  您需要升级您的 Flash Player.
			可以访问官方网站 <a href="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash">Adobe </a> 下载升级.
		</div>
	</form>
</div>

	</li>

	<li class="con"  >

		<div class="normal"   >

			<table  >
			<tr>
			<td class="db-padding10" >

			<form action="index.php?com=uploads" name="form1" method=post onSubmit="return check()" enctype="multipart/form-data" >
				请选择文件：
				<input type="file" name="filename" size=30 />
				<input type="submit" value="上传" />
				<Input type="hidden" name="task" value="save" />
				<Input type="hidden" name="tmpl" value="component_noscript" />
				<Input type="hidden" name="iname" value="<?php echo $_REQUEST['iname'];?>" />
				<Input type="hidden" name="rename" value="<?php echo $_REQUEST['rename'];?>" />
				<Input type="hidden" name="iscom" value="<?php echo $_REQUEST['iscom'];?>" />
			</form>

			</td>
			</tr> 
			</table>

		</div>

	</li>
	</ul>

</div>

<SCRIPT language=javascript>
function check() 
{
	var strFileName=document.form1.filename.value;
	if (strFileName=="")
	{
    	alert("请选择要上传的文件");
		document.form1.filename.focus();
    	return false;
  	}
}

 
</SCRIPT>