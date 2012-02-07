<?php
import('application.component.model');
class Order_shipModel extends Model
{ 
	var $nav = null;
	function Order_shipModel()
	{
		parent::__construct();
		$this->tableName = '#__delivery_order ';
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

 		$where = array(" type='delivery' ");
 
		
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
			$order = " order by c.delivery_id desc ";
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
			$sql = "select * from ".$this->tableName." as o   where o.delivery_id=".$id;
 			$this->db->query($sql);
			$order_data = $this->db->getRow(); 
		}
	 
		return $order_data;

	}
	function getDeliveryProducts($id){

		$data = array();
		if( $id> 0 ){
			$sql = "select * from #__delivery_items  where delivery_id=".$id;
 			$this->db->query($sql);
			$data = $this->db->getResult(); 
		}
	 
		return $data;
	}

	function getNav(){
		return $this->nav;
	}
 	/** 删除内容 **/
	function delete($id)
	{
		if( $id > 0 )
		{
 
			$sql = "delete from ".$this->tableName." where delivery_id=".$id;
			$this->db->query($sql); 
			return true;
		}

		return false;
	}

}
?>