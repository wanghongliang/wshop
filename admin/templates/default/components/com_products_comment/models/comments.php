<?php
import('application.component.model');
class CommentsModel extends Model
{
	var $nav = null;
	var $client_id=0;

	function CommentsModel()
	{
		parent::__construct();
		$this->tableName = '#__products_comment';
		$this->client_id = intval($_REQUEST['client_id']);
	}
	function getList()
	{
		global $app;
		
		$context = $_REQUEST['com'];
		$key =	 trim($_REQUEST['key']);
        
		$where = " where c.parent_id=0 ";
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName." as c ";
		
 
		if($key){
			$where.=" and c.content like ('%".$key."%')  ";
		}

		$sql .= $where; 
		$this->db->query($sql);
		$result = $this->db->getRow();
		$this->nav = new Navigations(20,$result['n']);
		
 		$sql = " select c.*,re.content as reply_content from ".$this->tableName." as c left join ".$this->tableName." as re on c.comment_id=re.parent_id ";
		$sql .= $where;
		$sql .= " order by comment_id desc "; 
		$sql.= $this->nav->getLimit($_REQUEST['page']);
		

 		$this->db->query($sql);
		return $this->db->getResult();
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