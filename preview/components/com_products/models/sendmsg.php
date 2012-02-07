<?php
import( 'application.component.model');

class SendmsgModel extends Model
{
	function SendmsgModel()
	{
		parent::__construct();
		$this->tableName = '#__products';
	}
	function getItem()
	{

 		if( $id = intval($_REQUEST['pid']) ){
			$sql = " select id,title from #__products where id=".$id;
			//echo $sql;	
			$this->db->query($sql);
			return $this->db->getRow();
		}
	}
}
?>