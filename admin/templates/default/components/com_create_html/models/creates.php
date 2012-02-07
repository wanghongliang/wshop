<?php
import('application.component.model');
class CreatesModel extends Model
{
	var $menuid = 0;

	var $nav = null;
	function CreatesModel()
	{
		parent::__construct();
		$this->tableName = '#__configs';
		$this->menuid = intval($_REQUEST['menuid']);
	}

	function getList(){
		include(dirname(__FILE__).DS.'data'.DS.'type.php');

		return $lists;
	}
 


  }






?>