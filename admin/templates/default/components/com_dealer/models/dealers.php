<?php
import('application.component.model');
class DealersModel extends Model
{
	var $nav = null;
	var $client_id=0;


 	function DealersModel()
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

		$city =  (int)$_REQUEST['city'];
		$pro  = (int)$_REQUEST['province'];
		$where = array( ' u.gid='.GROUP_DEALER);

		if( $pro > 0 ){
			$where[] = "  u.province = ".$pro."  ";
		}
		if( $city > 0 ){
			$where[] = "  u.city = ".$city."  ";
		}
		if( $key )
		{
			$where[] = "  u.username like ('%".$key."%')  ";
		}
 
		$where = count($where)>0 ? " where ".implode(' and ',$where):'';
		//排序
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
 		$sql = " select u.*,g.name as gname,ap.name as pname,a.name as areaname,a.default_uid from ".$this->tableName." as u ";
		$sql .=" left join #__group as g on u.gid = g.id ";
		$sql .=" left join #__area as a on u.city = a.id ";
		$sql .=" left join #__area as ap on u.province = ap.id ";
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
 	function getProvince($area=1){
 		//数据列表
		$list = array();
		$query = "select id,name,parent_id from #__area where lft>1 and rgt<784  order by lft ";
		$this->db->query($query);
		$lists = $this->db->getResult();
		return $lists;
	}

}
?>