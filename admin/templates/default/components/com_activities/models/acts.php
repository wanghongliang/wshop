<?php
import('application.component.model');
class ActsModel extends Model
{
	var $nav = null;
	function ActsModel()
	{
		parent::__construct();
		$this->tableName = '#__activities';
	}
	function getList()
	{
		global $app;
		
		$context = $_REQUEST['com'];

		$order = $app->getUserStateFromRequest( 'filter_order',		'',		$context);
		$order_dir = $app->getUserStateFromRequest('filter_order_dir',		'',		$context  );
		$key =	 trim($_REQUEST['key']);
		$lists['key'] = $key;
		$lists['order'] = $order;
		$lists['order_dir'] = $order_dir;
 
  
		if( $key )
		{
			$where[] = "  c.name like ('%".$key."%')  ";
		}
 
		$where = count($where)>0 ? " where ".implode(' and ',$where):'';
		//����
		if( $order )
		{
			$order  = " order by ".$order." ".$order_dir;

			if( $order !='c.ordering' ){
				$order.=" , c.ordering ";
			}
		}else{
			$order = " order by c.id desc ";
		}

 
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName." as c "; 
		$sql .= $where;
		

		$this->db->query($sql);
		$result = $this->db->getRow();
		$this->nav = new Navigations(20,$result['n']);


		
		$this->nav->setRequest(array('key','tmpl'));

 

		//���˲˵���
 		$sql = " select * from ".$this->tableName." as c "; 
		
		$sql .= $where;
		$sql .= $order;
		$sql.= $this->nav->getLimit($_REQUEST['page']); 
 		$this->db->query($sql);
 
		$lists['rows'] =$this->db->getResult();
		return $lists;
	}
	function getNav(){
		return $this->nav;
	}

}
?>