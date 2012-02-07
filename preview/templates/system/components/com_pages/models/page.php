<?php
import( 'application.component.model');

class PageModel extends Model
{

	function getItem()
	{
		$id = intval( $_REQUEST['id'] );
		
	 
		if( $id > 0 )
		{
			$sql = "select * from #__pages where menuid='".$id."' ";
			$this->db->query($sql);
  			return $this->db->getRow();
		}
	}
}
?>