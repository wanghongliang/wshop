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
			
			$status = 0;	//0 Ϊ�û�û�е�½��1Ϊ�ɹ���2Ϊ���ղ�
			if( $uid > 0 ){

				//�Ƿ����ղ�
				$sql = " select count(*) as num from #__website_favorites where website_id=".$id." and uid=".$uid;
				$this->db->query($sql);
 				$row = $this->db->getRow();

				if( $row['num'] < 1 ){

					$sql = " select name,http from #__website where id=".$id;
					$this->db->query($sql);
					//��ǰ����Ϣ
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