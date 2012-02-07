<?php
import('application.component.model');
class OrdersModel extends Model
{
	var $menuid;

	var $nav = null;
	function OrdersModel()
	{
		parent::__construct();
		$this->tableName = '#__order ';
 	}


	function getPays(){
		$sql= "select id,name from w_plugins where folder='pay' ";
		$this->db->query( $sql ) ;
		return $this->db->getResult('id');
	}

	function getList()
	{
		global $app;
		
		$context = $_REQUEST['com'];

		$order = $app->getUserStateFromRequest( 'filter_order',		'',		$context);
		$order_dir = $app->getUserStateFromRequest('filter_order_dir',		'',		$context  );
		$key =	 trim($_REQUEST['key']);
		$t_begin =	 trim($_REQUEST['t_begin']);
		$t_end =	 trim($_REQUEST['t_end']);

		$lists['key'] = $key;
		$lists['t_begin'] = $t_begin;
		$lists['t_end'] = $t_end;
		$lists['order'] = $order;
		$lists['order_dir'] = $order_dir;

 		$where = array();
 
		$s = (int)$_REQUEST['s'];
		switch($s){
			case 2:
				$where[]=" c.pay_status='0' ";$where[]=" c.order_status='active' ";
				
				break;
			case 3:
				$where[]=" c.pay_status='1' ";
				$where[]=" c.ship_status='0' ";
				$where[]=" c.order_status='active' ";
				break;
			case 4:
				$where[]=" c.ship_status='1' ";
				break;
			case 5:
				$where[]=" c.order_status='finish' ";
				break;
			case 7:
				$where[]=" c.pay_status='2' ";
				break;
			case 8:
				$where[]=" c.ship_status='2' ";
				break;
			case 9:
				$where[]=" c.order_status='dead' ";
				break;

		}

		if( !empty($t_begin) ){ $where[]=" c.created_date>='".$t_begin."' "; }
		if( !empty($t_end) ){ $where[]=" c.created_date<='".$t_end."' "; }

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
			$order = " order by c.id desc ";
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
	function getStatus(){
		$sql = " select id,order_status,pay_status,ship_status from ".$this->tableName;
		$this->db->query($sql);
		$result = $this->db->getResult();
		
 		$status = array();
		foreach( $result as $k=>$v ){
				if( $v['pay_status']==0 && $v['order_status'] =='active' ){
					$status[2]++;
				}
				if( $v['pay_status']==1 && $v['ship_status']==0 && $v['order_status'] =='active' ){
					$status[3]++;
				}

				if( $v['ship_status']==1 ){
					$status[4]++;
				}
				if( $v['order_status']=='finish' ){
					$status[5]++;
				}

				if( $v['pay_status']==2 ){
					$status[7]++;
				}


				if( $v['ship_status']==2 ){
					$status[8]++;
				}

				if( $v['order_status']=='dead' ){
					$status[9]++;
				}
				$status[0]++;
		}
		return $status;
	}
	function getRecycleList()
	{
 		$where = " where uid='".$this->uid."' and menuid=0 ";
 
		$order = " order by id desc ";

 
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName;
		$sql .= $where;
		

		$this->db->query($sql);
		$result = $this->db->getRow();
		$this->nav = new Navigations(20,$result['n']);
		$this->nav->setRequest(array('task','tmpl'));

 
 		$sql = " select thumbnail,title,id from ".$this->tableName;
		$sql .= $where;
		$sql .= $order;

		$sql.= $this->nav->getLimit($_REQUEST['page']);

		$this->db->query($sql);
		return $this->db->getResult();

	}


	function getNav(){
		return $this->nav;
	}


	/** 解锁和锁定 **/
	function unlock( $f = null )
	{
		global $app;

 		$ids =  $this->_filterID( $_REQUEST['ids'] );

 		if( count($ids) )
		{
			if( $f ){
				$sql = " update ".$this->tableName." set ".$f."=1 where uid = ".$this->uid." and id in (".implode(',',$ids).") ";
			}else{
				$sql = " update ".$this->tableName." set published=1 where uid = ".$this->uid." and id in (".implode(',',$ids).") ";
			}
			//echo $sql;exit;
			$this->db->query($sql);
 			$app->enqueueMessage(' 操作成功,共解锁 '.$this->db->getAffectedRows().'项.');
		}
		return true;
		 
	}
	function lock(  $f = null)
	{
		global $app;
		$ids =  $this->_filterID( $_REQUEST['ids'] );
 		if( count($ids) )
		{
			if( $f ){
				$sql = " update ".$this->tableName." set ".$f."=0 where uid = ".$this->uid." and id in (".implode(',',$ids).") ";
			}else{
				$sql = " update ".$this->tableName." set published=0 where uid = ".$this->uid." and id in (".implode(',',$ids).") ";
			}
			//echo $sql;exit;
			$this->db->query($sql);
 			$app->enqueueMessage(' 操作成功,共锁定 '.$this->db->getAffectedRows().'项.');
		}
		return true;
	}
}
?>