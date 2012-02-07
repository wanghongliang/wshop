<?php

//include(dirname(__FILE__).DS.'ckeditor'.DS.'ckeditor.php');
 include(dirname(__FILE__).DS.'fckeditor_2_6'.DS.'fckeditor.php');

/**
 * 高级编辑器
 */
class plgEditorckeditor extends Editor
{
	var $_editor = null;	//EDITOR实例
	function plgEditorckeditor()
	{
		//$this->_editor = new CKEditor('/'.$GLOBALS['config']['preview_directory'].'/plugins/editors/ckeditor/');
		$this->_editor = new FCKEditor();

	}

	function display($name,$html,$width,$height)
	{
		$this->display2($name,$html,$width,$height);
		return;

		/** 显示高级编辑器 **/
		$config['width'] = $width;
		$config['height'] = $height;
		/*$config['toolbar'] = array(
		array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
		array( 'Image', 'Link', 'Unlink', 'Anchor' )
		);
		*/
		$config['uiColor'] = '#eeeeee';
		$events['instanceReady'] = 'function (ev) {
		 addUploadButton(ev);
		}';

		?>
		<script  type="text/javascript" >
		
			function addUploadButton(editor){
				CKEDITOR.on('dialogDefinition', function( ev ){
					var dialogName = ev.data.name;
					var dialogDefinition = ev.data.definition;
					if ( dialogName == 'image' ){
						var infoTab = dialogDefinition.getContents( 'info' );
						infoTab.add({
							type : 'button',
							id : 'upload_image',
							align : 'center',
							label : '上传',
							onClick : function( evt ){
								var thisDialog = this.getDialog();
								var txtUrlObj = thisDialog.getContentElement('info', 'txtUrl');
								var txtUrlId = txtUrlObj.getInputElement().$.id;
								 
								upload(txtUrlId);
							}
						}, 'browse'); //place front of the browser button

						infoTab.add({
							type : 'button',
							id : 'select_image',
							align : 'center',
							label : '..',
							onClick : function( evt ){
								var thisDialog = this.getDialog();
								var txtUrlObj = thisDialog.getContentElement('info', 'txtUrl');
								var txtUrlId = txtUrlObj.getInputElement().$.id;
								 
								selectImage(txtUrlId);
							}
						}, 'browse'); //place front of the browser button
					}
				});
			}

			function addUploadImage(theURLElementId){

				//alert(theURLElementId);
				 $.w.createDialog({
					title:'上传图片',
					width:500,
					height:80,
					iframe:true,
					url:'index.php?com=uploads&tmpl=component&iname='+theURLElementId,
					isget:true,
					reload:true
				},2);
				return;
				 
			}
 		</script>

		<?php
		$this->_editor->editor($name, $html, $config, $events);
		?>
		<?php


	}

	function display2($name,$html,$width,$height)
	{

		$this->_editor->InstanceName	= $name ;
		$this->_editor->BasePath		= '/'.$GLOBALS['config']['preview_directory'].'/plugins/editors/fckeditor_2_6/' ;
		$this->_editor->Width		= $width ;
		$this->_editor->Height		= $height ;
		$this->_editor->ToolbarSet	= 'Basic' ;
		$this->_editor->Value		= $html ;
		echo $this->_editor->CreateHtml();
	
	}

}
 
?>