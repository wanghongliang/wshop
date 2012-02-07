<?php
import( 'application.component.model');

class CategoryModel extends Model
{
	function CategoryModel()
	{
		parent::__construct();
		$this->tableName = '#__contents';
	}
	function getList()
	{
		global $app,$itemid;
		$params 	   =& $app->getParams('com_contents');
		
		$menu = &$app->getMenu();

		$cmenu = $menu->getActive();

		$num = intval( $params['pagenum'] );
		$num = $num < 2?20:$num;

		//print_r($params);
		$lists = array();
		$where = " where c.uid='".$this->uid."' ";

		$where .= " and ( m.tid=".$cmenu['tid']." and m.lft>=".$cmenu['lft']." and m.rgt <=".$cmenu['rgt']." ) ";
 
		$order = " order by ordering , c.id desc ";

 
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName." as c ";
		$sql .= " left join #__menu as m on c.menuid=m.id ";

		$sql .= $where;
		

		$this->db->query($sql);
		$result = $this->db->getRow();
		$lists['nav'] = new Navigations($num,$result['n']);
		$lists['nav']->setRequest(array('task','tmpl'));

 
 		$sql = " select c.menuid,c.title,c.images,c.id,c.author,c.introtext,c.modified,m.name from  ".$this->tableName." as c ";
		$sql .= " left join #__menu as m on c.menuid=m.id ";
		$sql .= $where;
		$sql .= $order;

		$sql.= $lists['nav']->getLimit($_REQUEST['page']);


 		$this->db->query($sql);
		$lists['rows'] = $this->db->getResult();

		return $lists;
	}

	function getTypelist()
	{
		global $app,$itemid;
		$params 	   =& $app->getParams('com_contents');
		
		$menu = &$app->getMenu();

		$cmenu = $menu->getActive();

		$num = intval( $params['pagenum'] );
		$num = $num < 2?20:$num;

 
		//print_r($params);
		$lists = array();
		$where = " where c.uid='".$this->uid."' ";

		$where .= " and ( m.lft>=".$cmenu['lft']." and m.rgt <=".$cmenu['rgt']." ) ";
 
		$order = " order by c.id desc ";

 
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName." as c ";
		$sql .= " left join #__menu as m on c.menuid=m.id ";

		$sql .= $where;
		

		$this->db->query($sql);
		$result = $this->db->getRow();
		$lists['nav'] = new Navigations($num,$result['n']);
		$lists['nav']->setRequest(array('task','tmpl'));

 
 		$sql = " select c.menuid,c.author,c.title,c.id,m.name from  ".$this->tableName." as c ";
		$sql .= " left join #__menu as m on c.menuid=m.id ";
		$sql .= $where;
		$sql .= $order;

		$sql.= $lists['nav']->getLimit($_REQUEST['page']);


		$this->db->query($sql);
		$lists['rows'] = $this->db->getResult('menuid',true);

		return $lists;
	}


	function getComment(){
		$sql =" select  count(*) as num from #__products_comment where  parent_id=0 ";
		$this->db->query($sql);
		$rows = $this->db->getRow(); 
		import('html.navigations');
		$lists['nav'] = new Navigations(20,$rows['num']);
		$lists['rows'] = array();
	 
		$order=" order by e.comment_id desc ";
		$sql = " select e.*,re.content as recontent from #__products_comment as e left join #__products_comment as re on e.comment_id=re.parent_id where e.parent_id=0 ";
		$sql .= $order;
		$sql.= $lists['nav']->getLimit($_REQUEST['page']);
		 
		$this->db->query($sql);
		$lists['rows'] = $this->db->getResult();

		return $lists;
	}

	function getEvaluation(){
		$sql =" select  count(*) as num from #__evaluation   ";
		$this->db->query($sql);
		$rows = $this->db->getRow(); 
		import('html.navigations');
		$lists['nav'] = new Navigations(20,$rows['num']);
		$lists['rows'] = array();


		$order=" order by e.id desc ";
		$sql = " select e.*,p.id,p.catid,p.thumbnail from #__evaluation as e left join #__products as p on e.product_id=p.id		";
		$sql .= $order;
		$sql.= $lists['nav']->getLimit($_REQUEST['page']);
		$this->db->query($sql);
		$lists['rows'] = $this->db->getResult();

		return $lists;
	}

	function getArticle($id){ 
		$order=" order by c.id desc ";
		$sql = " select c.id,c.title,c.menuid from #__contents as c where c.menuid={$id}		";
		$sql .= $order;
		$sql.= " limit 10 "; 
		$this->db->query($sql);
		$lists['rows'] = $this->db->getResult();

		return $lists;
	}
}
?>