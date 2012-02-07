<?php
import( 'application.component.model');

class SeckillModel extends Model
{
	function SeckillModel()
	{
		parent::__construct();
		$this->tableName = '#__products';
	}
	function getItem()
	{
		global $app;
		if( $id = intval($_REQUEST['aid']) ){ 
			$sql = "select a.*,p.images,p.catid from #__products_activity  as a left join #__products as p on a.products_id=p.id where a.act_id=".$id."  ";
			
   			$this->db->query($sql); 
			$row = $this->db->getRow();	//获取菜单项数据 
		}		
		if( !isset($row['act_id']) ){
			$app->redirect('/');
			return false;
		} 
		return $row;
	}


	function getQuestions(){ 
		$sql = " SELECT  p.*  FROM #__questions as p JOIN ( SELECT ROUND(RAND() * ( (SELECT MAX(id) FROM #__questions   )-( SELECT MIN(id) FROM #__questions  ))+(SELECT MIN(id) FROM #__questions )) AS id) AS t2 WHERE p.id >= t2.id  ORDER BY p.id LIMIT 5;";
		$this->db->query($sql);
		return $this->db->getResult();
	}


	//主要检测答案是否正确
	function check(){
		$ids = array();
		foreach( $_POST as $k=>$v ){
			if( substr($k,0,1) == 'q' ){
				$ids[(int)substr($k,1)] = $v;
			}
		}

		if( count($ids) < 1 ){ return false; }
		$sql = "select id,defaulted from #__questions where id in (".implode(',',array_keys($ids)).") ";
		$this->db->query($sql);
		$data = $this->db->getResult();
		foreach( $data as $k=>$v ){
			if( $ids[$v['id']] == $v['defaulted'] ){
			}else{
				return false;
			}
		}

		return true;

	}

	//更新购买人数，及购买数量
	function updateSkill($id){
		$sql =" update #__products_activity set purchase_num=purchase_num+1,purchase_people=purchase_people+1 where act_id=".$id;
		$this->db->query($sql);
	}


	function recordBoard($id){
		$session = &Factory::getSession();
		$data = array('act_id'=>$id,
			'uid'=>$this->uid,
			'uname'=>$session->get('username'),
			'created'=>date('Y-m-d H:i:s')
			);
		$this->db->insertArray('#__seckill_board',$data);
	}


	function getBoard($id){
		$sql = "select * from #__seckill_board where act_id=".(int)$id."  ";
		$this->db->query($sql);
		return $this->db->getResult();
	}

}
?>