<?php
import( 'application.component.model');

class GourlModel extends Model
{
	function getItem()
	{
		global $app;
		if( $id = intval($_REQUEST['id']) ){
			$sql = "update #__website set hits=hits+1 where id='".$id."' ";
			$this->db->query($sql);


			$sql = " select http from #__website where id=".$id;
			$this->db->query($sql);
 			//��ǰ����Ϣ
			$row = $this->db->getRow();
 
			return $row;
		}
	}
 
}
?>