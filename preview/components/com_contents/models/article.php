<?php
import( 'application.component.model');

class ArticleModel extends Model
{
	function getItem()
	{
		if( $id = intval($_REQUEST['id']) ){
			$sql = " update #__contents set hits = hits+1 where id=".$id;
			$this->db->query($sql);		
			
			$sql = " select * from #__contents where id=".$id;
			$this->db->query($sql);


			return $this->db->getRow();
		}
	}


	function getComment(){
		$sql =" select  count(*) as num from #__products_comment where  parent_id=0 ";
		$this->db->query($sql);
		$rows = $this->db->getRow(); 
		import('html.navigations');
		$lists['nav'] = new Navigations(5,$rows['num']);
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
	 
		$order=" order by e.id desc ";
		$sql = " select e.*,p.id,p.catid,p.thumbnail from #__evaluation as e left join #__products as p on e.product_id=p.id		";
		$sql .= $order;
		$sql.= " limit 10 "; 
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