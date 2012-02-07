<?php
import('application.component.view');
class UploadsView extends View
{
	var $path = null;
 	function UploadsView()
	{
		parent::__construct();
		$this->path = dirname(__FILE__);
		$this->baseuri = "index.php?com=uploads";
 	}

	function uploadSuccess()
	{	
		
		$lists = $this->get('list');
 		//显示上传界面
		include($this->path.DS.'tmpl'.DS.'success.php');
	}

	function display()
	{
	
		//显示上传界面
		include($this->path.DS.'tmpl'.DS.'default.php');
	}
}
?>