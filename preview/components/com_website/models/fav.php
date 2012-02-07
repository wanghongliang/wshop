<?php
import( 'application.component.model');

class FavModel extends Model
{
	function getFavorite()
	{
		global $app;
		if( $id = intval($_REQUEST['id']) ){


			$session = &Factory::getSession();
			
 			$uid= intval($session->get('uid'));
			
			$status = 0;	//0 为用户没有登陆，1为成功，2为已收藏
			if( $uid > 0 ){

				//是否已收藏
				$sql = " select count(*) as num from #__website_favorites where website_id=".$id." and uid=".$uid;
				$this->db->query($sql);
 				$row = $this->db->getRow();

				if( $row['num'] < 1 ){

					$sql = " select name,http from #__website where id=".$id;
					$this->db->query($sql);
					//当前求购信息
					$row = $this->db->getRow();



					$data = array(
						'name'=>$row['name'],
						'http'=>$row['http'],
						'website_id'=>$id,
						'uid'=>$uid,
						'tid'=>1,
						'created'=>date('Y-m-d H:i:s'),
					);
					$this->db->insertArray('#__website_favorites',$data);
					$status = 1;
				}else{
					$status = 2;
				}
			} 

 
			return $status;
		}
	}
}
?>