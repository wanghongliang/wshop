<?php
import('application.component.model');
class DatabasesModel extends Model
{
	var $nav = null;
	var $client_id=0;


 	function DatabasesModel()
	{
		parent::__construct();
		$this->tableName = '#__modules';
		$this->client_id = intval($_REQUEST['client_id']);

 	}
	function getList()
	{
		
		global $app;	
		import('filesystem.dir');
 		$dir = new WDir();

 
		$directory = PATH_CACHE.DS.'data';
  		$data = $dir->getFiles($directory,'.sql');
		unset( $dir ,$directory );

		return $data;
	}

	function getNav()
	{
		if( !$this->nav )
		{
			$this->getList();
		}
		return $this->nav;
	}
}
?>