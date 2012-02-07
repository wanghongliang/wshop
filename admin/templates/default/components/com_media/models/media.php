<?php
import('application.component.model');
class MediaModel extends Model
{
	var $nav = null;
	var $lists = null;
 	function MediaModel()
	{
		parent::__construct();
 
 	}
	function getList()
	{
		
		return $this->lists;
	}

	function getNav()
	{
		if( !$this->nav )
		{
			$this->getList();
		}
		return $this->nav;
	}


	function save()
	{
		if( count($_FILES) > 0  )
		{
			import('filesystem.dir');
   			if( $this->lists = WDir::uploadFile( $_FILES['filename'],$GLOBALS['config']['upload_dir'] ) ){
 				return true;
			}
		}

		return false;
	}
}
?>