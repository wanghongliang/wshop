<?php
import( 'application.component.model');

class SenderrorModel extends Model
{
	function getItem()
	{
		global $app;
		if( $id = intval($_REQUEST['id']) ){
			$session = &Factory::getSession();
			$data = array(
				'website_id'=>$id,
				'uid'=>intval($session->get('uid')),
				'type'=>1,
				'created'=>date('Y-m-d H:i:s'),
			);
			$this->db->insertArray('#__website_notice',$data);

			//$sql = " select * from #__website where id=".$id;
			//$this->db->query($sql);

			//当前求购信息
			//$row = $this->db->getRow();
 

			return true;
		}
	}
}
?>