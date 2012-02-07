<?php
import( 'application.component.model');

class ProductModel extends Model
{
	function getItem()
	{
		if( $id = intval($_REQUEST['id']) ){
			$sql = " select * from #__products where id=".$id;
			$this->db->query($sql);
			return $this->db->getRow();
		}
	}
}
?>