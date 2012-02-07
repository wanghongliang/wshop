<?php
import( 'application.component.model');

class WsModel extends Model
{
	var $id =0;
	function getItem()
	{
		global $app;
		$this->id = intval($_REQUEST['id']);
 
		if( $this->id > 0 ){
			$sql = " select * from #__website where id=".$this->id;
			$this->db->query($sql);

			//当前求购信息
			$row = $this->db->getRow();
			
			/**
			//求购分类
			$menu = &$app->getMenu();
			$cat = $menu->getCategoryItem($row['catid']);
			

			//加入路径
			$pathway = &$app->getPathWay();
 			$pathway->addItem($cat['name'],$menu->bBuysLink($cat['route']));
 			$pathway->addItem($row['title'],'#');
			**/
 			return $row;
		}
	}


	function getPost(){
 		$lists = array();
		$where = array();
		$where[]="  p.website_id ='".$this->id."' ";
 		$where = count($where)?" where ".implode(" and ",$where):"";
 
 
		import('html.navigations');
		$sql = " select count(*) as n from #__website_post as p ";
 		$sql .= $where;
 		$this->db->query($sql);
		$result = $this->db->getRow();
		$lists['nav'] = new Navigations(10,$result['n']);
  		$sql = " select p.id,p.content,p.star,p.created ,u.username,u.photo   from  #__website_post  as p ";
		$sql.= " left join #__users as u on u.id = p.uid ";
 		$sql .= $where;
 		$sql.= $lists['nav']->getLimit($_REQUEST['page']);
  		$this->db->query($sql);
		$lists['rows']= $this->db->getResult();

 		return $lists;
	}


	

	function saveview(){
		$star = intval($_POST['star']);
		$website_id = intval($_POST['website_id']);


		if( $star > 0  && $website_id > 0 ){

			//先计算星星等级
			$sql =" select count(id) as n, sum(star) as total from #__website_post where website_id=".$website_id;
			$this->db->query($sql);
			$result = $this->db->getRow();
			
			$total = $result['total']+$star;
			$star_level = ($result['total']+$star)/($result['n']+1);

			$sql =" update #__website set star ='".substr($star_level,0,3)."',postdate='".date('Y-m-d H:i:s')."' where id=".$website_id;
			$this->db->query($sql);

			$content = $_POST['content'];
			$data = array('website_id'=>$website_id,'star'=>$star,'content'=>$content,'uid'=>$this->uid,'created'=>date('Y-m-d H:i:s'));
			$this->db->insertArray('#__website_post',$data);
				 
			
	
		}
	}
}
?>