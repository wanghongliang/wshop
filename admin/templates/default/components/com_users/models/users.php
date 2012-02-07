<?php
import('application.component.model');
class UsersModel extends Model
{
	var $nav = null;
	var $client_id=0;


 	function UsersModel()
	{
		parent::__construct();
		$this->tableName = '#__users';
		$this->client_id = intval($_REQUEST['client_id']);

 	}
	function getList()
	{
		global $app;
		$context = $_REQUEST['com'];

		$order = $app->getUserStateFromRequest( 'filter_order',		'',		$context);
		$order_dir = $app->getUserStateFromRequest('filter_order_dir',		'',		$context  );
		$key =	 $_REQUEST['key'];
		$lists['key'] = trim($key);
		$lists['order'] = $order;
		$lists['order_dir'] = $order_dir;

		$where = array();
		if( $key )
		{
			$where[] = "  u.username like ('%".$key."%')  ";
		}


		$where = count($where)>0 ? " where ".implode(' and ',$where):'';
		//еепР
		if( $order )
		{
			$order  = " order by ".$order." ".$order_dir;
		}else{
			$order = " order by u.id desc ";
		}
	
		//$where = " where uid =".$this->uid."";
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName." as u ";
		$sql .= $where;

		$this->db->query($sql);
		$result = $this->db->getRow();
		$this->nav = new Navigations(20,$result['n']); 
 		$sql = " select u.*,g.name as gname from ".$this->tableName." as u ";
		$sql .=" left join #__group as g on u.gid = g.id ";
		$sql .= $where;
		$sql .= $order;

		$sql.= $this->nav->getLimit($_REQUEST['page']);

		$this->db->query($sql);
		$lists['rows']=$this->db->getResult();

		return $lists;
	}

	function getNav()
	{
		if( !$this->nav )
		{
			$this->getList();
		}
		return $this->nav;
	}
}
?>