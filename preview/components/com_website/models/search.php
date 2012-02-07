<?php
import( 'application.component.model');

class SearchModel extends Model
{
	function SearchModel()
	{
		parent::__construct();
		$this->tableName = '#__website';
	}
	function getList()
	{
		global $app;
		$params 	   =& $app->getParams('com_sites');
		

		$catid = intval($_REQUEST['catid']);  	//û��ָ���˵�,����IDΪ����ID
		$area = intval($_REQUEST['area']);
		$topic = intval($_REQUEST['topic']);
		$color = intval($_REQUEST['color']);


 		$key = trim($_REQUEST['key']);
		$sort = trim($_REQUEST['sort']);
		$by = trim($_REQUEST['by']);


		$menu = &$app->getMenu();
		$cat = $menu->getCategoryItem($catid);





 		$lists = array();
		$where = array();
		if( $catid > 0 ){
			$where[]="  p.catid='".$catid."' ";
		}
		if( $area > 0 ){
			$where[]="  p.areaid='".$area."' ";
		}


		if( $topic > 0 ){
			$where[]="  p.topicid='".$topic."' ";
		}

		if( $color > 0 ){
			$where[]="  p.colorid='".$color."' ";
		}


		if( $key )
		{
			$where[] =  " p.name like('%".$key."%') ";
		}

		$where = count($where)?" where ".implode(" and ",$where):"";
		
 		//$order = "   order by p.id desc ";

 		switch($by){
			case 'news':
				$order = "   order by p.created desc ";
				break;
			case 'star':
				$order = "   order by p.id ";
				break;
			case 'hits':
				$order = "   order by p.hits desc ";
				break;
		}

 
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName." as p ";
		//$sql.= " inner join #__category as m on m.id = p.catid ";
		
		$sql .= $where;
		

		//echo $sql;
 
		$this->db->query($sql);
		$result = $this->db->getRow();
		$lists['nav'] = new Navigations(20,$result['n']);
		if( $key ){
			$lists['nav']->setRequest(array('com','view','tmpl','key'));
		}


  
 		$sql = " select p.thumbnail,p.name,p.id,p.catid,p.hits   from ".$this->tableName." as p ";
		//$sql.= " inner join #__category as m on m.id = p.catid ";
 		$sql .= $where;

	
		$sql .= $order;
		
		$sql.= $lists['nav']->getLimit($_REQUEST['page']);
		
		//echo $sql;
 		$this->db->query($sql);
		$lists['rows'] = $this->db->getResult();

		//print_r($lists['rows']);
		$lists['cat'] = $cat;
		return $lists;
	}

	function getTypelist()
	{
		$catid = intval($_REQUEST['catid']);  	//û��ָ���˵�,����IDΪ����ID
		$itemid  = intval($_REQUEST['itemid']);
 
 		/**
	    $sql = " select  c.*,count(p.id) as num  from #__category as c left join #__products as p on p.catid=c.id where c.parent_id=".$catid." group by c.id ";
		$this->db->query($sql);
		$lists['rows'] = $this->db->getResult();
		
		**/

		$lists = array();
 

		$menu = &SiteApplication::getMenu();

		$categroys = &$menu->getCategory();
		
 		//�Ƿ�Ϊ��ƷĿ¼ȫ���б�
		if( $catid == 0 )
		{
			$cats = array();
			foreach( $categroys as $cat )
			{
				$cats[$cat['parent_id']][] = $cat;
			}
			$lists = array('rows'=>$cats,'child'=>$child_num,'catid'=>0);
		}else{
			
			$start=false;	//��ǿ�ʼ
			$cats = array();

			$child_num = 0;

			/**
			 * Ŀ��:���ҳ�������ص��ӷ���,�����ӷ���
			 *������:�������ǰ���״���б�����
			 *  �㷨:�����ҳ���Ӧ����ʱ��ʼ��¼ ------- ֱ����һ����������ʱ����
			 */
			foreach( $categroys as $cat )
			{
				if( $cat['id'] == $catid )
				{
					$start=true;	//��ǿ�ʼ
				}else if( $start && $cat['id'] != $catid && $cat['parent_id'] == 0 ){
					break;
				}

				if( $start)
				{
					$cats[] = $cat;

					if( $cat['parent_id'] == $catid ){ $child_num++; }	//��¼��ǰĿ¼���ж�����Ŀ¼
				}	

			}

			array_shift($cats);
			$lists = array('rows'=>$cats,'child'=>$child_num,'catid'=>$catid);
		}
		return $lists;
	}
}
?>