<?php
import( 'application.component.model');

class ArticleModel extends Model
{
	function getItem()
	{
		if( $id = intval($_REQUEST['id']) ){
			$sql = " select * from #__contents where id=".$id;
			$this->db->query($sql);
			return $this->db->getRow();
		}
	}
}
?>