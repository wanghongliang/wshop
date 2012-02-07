<?php
import('application.component.model');
class ProductsModel extends Model
{
	var $menuid;

	var $nav = null;
	function ProductsModel()
	{
		parent::__construct();
		$this->tableName = '#__products';
		$this->menuid = intval($_REQUEST['menuid']);
	}
	function getCat(){
		$sql = "select name,id,parent_id from #__category ";
		$this->db->query($sql);
		return $this->db->getResult('parent_id',true);
	}

	function getList()
	{
		global $app;
		
		$context = $_REQUEST['com'].'a';

		$order = $app->getUserStateFromRequest( 'filter_order',		'',		$context);
		$order_dir = $app->getUserStateFromRequest('filter_order_dir',		'',		$context  );
		$key =	 trim($_REQUEST['key']);
		$lists['key'] = $key;
		$lists['order'] = $order;
		$lists['order_dir'] = $order_dir;

 
		$catid = intval($_REQUEST['mtid']);

		$where = array();
		if( $catid  > 0  ){
			$sql =" select lft,rgt from #__category where id=".$catid;
			$this->db->query($sql);
			$row = $this->db->getRow();
			$where[] = " ( m.lft>=".$row['lft']." and rgt<=".$row['rgt']."  ) ";
		}else{
			 
		}
		
		if( $key )
		{
			$where[] = "  c.name like ('%".$key."%')  ";
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
		$sql .= " left join #__category as m on c.catid=m.id ";

 	
		$sql .= $where;
		

		$this->db->query($sql);
		$result = $this->db->getRow();
		$this->nav = new Navigations(20,$result['n']);
		

 

		//过滤菜单项
		$sql = " select c.id,c.name,c.shop_price,c.store,c.thumbnail,c.published,c.ordering,c.isfront,m.name as typename from ".$this->tableName." as c ";
		$sql .= " left join #__category as m on c.catid=m.id ";
	
		
		$sql .= $where;
		$sql .= $order;

		 
		$sql.= $this->nav->getLimit($_REQUEST['page']);
 
 		$this->db->query($sql);
 		$lists['rows'] =$this->db->getResult();
 		return $lists;
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