<?php
import('application.component.model');
class RecyclesModel extends Model
{
	var $menuid;

	var $nav = null;
	function RecyclesModel()
	{
		parent::__construct();
		$this->tableName = '#__components';
		$this->menuid = intval($_REQUEST['menuid']);
	}


	function getList()
	{
		global $app;
		
		$context = $_REQUEST['com'];

 		$where = array();
 
		if( $key )
		{
			$where[] = "  c.title like ('%".$key."%')  ";
		}
		$where[] = " c.menu_com =1 ";

		$where = count($where)>0 ? " where ".implode(' and ',$where):'';
		//����
		if( $order )
		{
			$order  = " order by ".$order." ".$order_dir;
		}else{
			$order = " order by c.id desc ";
		}

 
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName." as c ";
		$sql .= $where;
		

		$this->db->query($sql);
		$result = $this->db->getRow();
		$this->nav = new Navigations(20,$result['n']);
		
		//���˲˵���
 		$sql = " select c.* from ".$this->tableName." as c ";
		
		$sql .= $where;
		$sql .= $order;
		$sql.= $this->nav->getLimit($_REQUEST['page']);


 		$this->db->query($sql);
		$results = $this->db->getResult();

		foreach( $results as $k =>$v )
		{

			//�������վ�ж�������¼
			$tablename = $v['option'];
 			$sql=" select count(*) as n from #__".$tablename." where menuid<1 ";
			$this->db->query($sql);
			$row = $this->db->getRow();

			$results[$k]['count']= $row['n'];
		}
		$lists['rows'] = $results;


		return $lists;
	}


	function getNav(){
		return $this->nav;
	}
}
?>