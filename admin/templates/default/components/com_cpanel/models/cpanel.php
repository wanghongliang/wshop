<?php
import('application.component.model');
class CpanelModel extends Model
{
	function CpanelModel()
	{
		parent::__construct();
 
	}
	function getPays(){
		$sql= "select id,name from w_plugins where folder='pay' ";
		$this->db->query( $sql ) ;
		return $this->db->getResult('id');
	}
	function getList()
	{
 
		
	}
 
}
?>