<?php
import('application.component.model');
class Order_payModel extends Model
{ 
	var $nav = null;
	function Order_payModel()
	{
		parent::__construct();
		$this->tableName = '#__payments ';
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

 		$where = array();
 
		
		if( $key )
		{
			$where[] = "  c.order_sn like ('%".$key."%')  ";
		}


		$where = count($where)>0 ? " where ".implode(' and ',$where):'';
		//排序
		if( $order )
		{
			$order  = " order by ".$order." ".$order_dir;
		}else{
			$order = " order by c.payment_id desc ";
		}

 
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName." as c "; 
		$sql .= $where;
		

		$this->db->query($sql);
		$result = $this->db->getRow();
		$this->nav = new Navigations(20,$result['n']);
		

 

		//过滤菜单项
		$sql = " select * from ".$this->tableName." as c ";
 	
		
		$sql .= $where;
		$sql .= $order;
		$sql.= $this->nav->getLimit($_REQUEST['page']);


 		$this->db->query($sql);
 
		$lists['rows'] =$this->db->getResult();
		return $lists;
	}
 
	function getItem()
	{
		global $app;
		$id = intval($_GET['id']);

		if( $id> 0 ){
			$sql = "select * from ".$this->tableName." as o   where o.payment_id=".$id;
 			$this->db->query($sql);
			$order_data = $this->db->getRow(); 
		}
	 
		return $order_data;

	}

	function getNav(){
		return $this->nav;
	}
 	/** 删除内容 **/
	function delete($id)
	{
		if( $id > 0 )
		{
 
			$sql = "delete from ".$this->tableName." where payment_id=".$id;
			$this->db->query($sql); 
			return true;
		}

		return false;
	}

}
?>