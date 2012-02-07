<?php
import( 'application.component.model');

class LimitedtimeModel extends Model
{
	function LimitedtimeModel()
	{
		parent::__construct();
		$this->tableName = '#__products';
	}
	function getList()
	{
		global $app;
		$params 	   =& $app->getParams('com_products');
		

		$catid = intval($_REQUEST['catid']);  	//û��ָ���˵�,����IDΪ����ID
 		$key = trim($_REQUEST['key']);
		$s = trim($_GET['s']);
		
		$menu = &$app->getMenu();
  		$lists = array();
		$where= array("  a.act_type=2 " );

		if( !empty($market_time) ){
			//$where .=" and market_time='".$market_time."' ";

		}

		switch( $s ){
			case 1:
				$t = date('Y-m-d',time()-24*3600*date('w')); //������Ʒ
				$where[] = " created>'".$t."' ";
				break;
			case 2:
				$t = date('Y-m-d',time()-24*3600*date('d')); //������Ʒ
				$where[] = " created>'".$t."' ";
				break;
			case 3:
				$t = date('Y')-1; //������Ʒ
				$where[] = " created>'".$t."' ";
				break;

		}
		if( $key )
		{
			$where[]=" p.name like('%".$key."%') ";
		}
		$where = count($where)>0?" where ".implode('and',$where):'';
		
  		$order = "   order by a.act_id desc ";

 		import('html.navigations');
		$sql = " select count(*) as n from #__products_activity as a ";
		$sql .= $where; 
		$this->db->query($sql);
		$result = $this->db->getRow();
		$lists['nav'] = new Navigations(20,$result['n']);

		if( $key ){
		$lists['nav']->setRequest(array('com','view','tmpl','key'));
		} 

		$sql = "select a.*,p.thumbnail,p.name,p.price_e,p.id,p.catid,p.introtext,p.market_price ,p.shop_price from #__products_activity  as a left join ".$this->tableName." as p on a.products_id=p.id  ";
  		$sql .= $where; 
		$sql .= $order;
		
		$sql.= $lists['nav']->getLimit($_REQUEST['page']);
		
 		$this->db->query($sql);
		$lists['rows'] = $this->db->getResult(); 
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