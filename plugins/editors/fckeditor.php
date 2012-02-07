<?php

include(dirname(__FILE__).DS.'fckeditor_2_6'.DS.'fckeditor.php');
 
/**
 * ¸ß¼¶±à¼­Æ÷
 */
class plgEditorfckeditor extends Editor
{
	var $_editor = null;	//EDITORÊµÀý
	function plgEditorfckeditor()
	{
		$this->_editor = new FCKEditor();
	}

	function display($name,$html,$width,$height)
	{

		$this->_editor->InstanceName	= $name ;
		$this->_editor->BasePath		= '/plugins/editors/fckeditor_2_6/' ;
		$this->_editor->Width		= $width ;
		$this->_editor->Height		= $height ;
		$this->_editor->ToolbarSet	= 'Default' ;
		$this->_editor->Value		= $html ;
		echo $this->_editor->CreateHtml();
	
	}
}
 
?>