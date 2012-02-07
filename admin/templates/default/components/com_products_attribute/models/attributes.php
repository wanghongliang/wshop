<?php
import('application.component.model');
class AttributesModel extends Model
{
	var $nav = null;

	function AttributesModel()
	{
		parent::__construct();
		$this->tableName = '#__products_attribute';
	}
	function getList()
	{
		$type_id = (int)$_GET['type_id'];

		global $app;
		
		$context = $_REQUEST['com'];

		$order = $app->getUserStateFromRequest( 'filter_order',		'',		$context);
		$order_dir = $app->getUserStateFromRequest('filter_order_dir',		'',		$context  );
		$key =	 $_REQUEST['key'];
		$lists['key'] = trim($key);
		$lists['order'] = $order;
		$lists['order_dir'] = $order_dir;
 

		$where = array(" c.type_id='".$type_id."' ");
 
		if( $key )
		{
			$where[] = "  c.title like ('%".$key."%')  ";
		}


		$where = count($where)>0 ? " where ".implode(' and ',$where):'';
		//排序
		if( $order )
		{
			$order  = " order by ".$order." ".$order_dir;
		}else{
			$order = " order by c.attr_id desc  ";
		}

 
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName." as c ";
 		$sql .= $where;
		

		$this->db->query($sql);
		$result = $this->db->getRow();
		$this->nav = new Navigations(30,$result['n']);
		

 

		//过滤菜单项
 		$sql = " select  * from ".$this->tableName." as c ";
 	
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

	function getType(){
		$sql = " select id,name from #__products_type  ";
		$this->db->query($sql);
		$rows = $this->db->getResult('id'); 
		return $rows;
	}
	/** 全部删除 **/
	function deleleall(){
		global $app;
		$copy_ids =  $this->_filterID( $_REQUEST['ids'] );

 		if( count($copy_ids) )
		{
			$sql = " delete from ".$this->tableName." where attr_id in (".implode(',',$copy_ids).") ";
			//echo $sql;exit;
			$this->db->query($sql);  
			$app->enqueueMessage(' 删除成功,共删除 '.count($copy_ids).'项.');
		}
		return true;
	}
}
?>