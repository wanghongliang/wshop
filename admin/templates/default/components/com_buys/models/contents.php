<?php
import('application.component.model');
class ContentsModel extends Model
{
	var $menuid;

	var $nav = null;
	function ContentsModel()
	{
		parent::__construct();
		$this->tableName = '#__contents';
		$this->menuid = intval($_REQUEST['menuid']);
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

 
		$mtid = intval($_REQUEST['mtid']);

		$where = array(" c.uid='".$this->uid."' ");
		if( $this->menuid > 0  ){
			$sql =" select lft,rgt,tid from #__menu where id=".$this->menuid;
			$this->db->query($sql);
			$row = $this->db->getRow();
			$where[] = " ( m.tid=".$row['tid']." and m.lft>=".$row['lft']." and rgt<=".$row['rgt']."  ) ";
		}else if( $mtid > 0 )
		{
			$where[] = "  m.tid=".$mtid."  ";
		}else{
			 
		}
		
		if( $key )
		{
			$where[] = "  c.title like ('%".$key."%')  ";
		}


		$where = count($where)>0 ? " where ".implode(' and ',$where):'';
		//排序
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

		//过滤菜单项
		$sql .= " inner join #__menu as m on c.menuid=m.id ";
		
		$sql .= $where;
		

		$this->db->query($sql);
		$result = $this->db->getRow();
		$this->nav = new Navigations(20,$result['n']);


		
		$this->nav->setRequest(array('key','tmpl'));

 

		//过滤菜单项
 			$sql = " select c.id,c.ordering,c.title,c.published,c.attr,m.name as typename from ".$this->tableName." as c ";
			$sql .= " inner join #__menu as m on c.menuid=m.id ";
	
		
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

 
 		$sql = " select title,id from ".$this->tableName;
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


	function getAttr(){
		$attr = array(
			0=>'默认',
			1=>'置顶',
			2=>'推荐',
			3=>'关注'
		);

		return $attr;
	}
 
}
?>