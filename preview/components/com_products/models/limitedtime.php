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
		

		$catid = intval($_REQUEST['catid']);  	//没有指定菜单,将以ID为分类ID
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
				$t = date('Y-m-d',time()-24*3600*date('w')); //本周新品
				$where[] = " created>'".$t."' ";
				break;
			case 2:
				$t = date('Y-m-d',time()-24*3600*date('d')); //本月新品
				$where[] = " created>'".$t."' ";
				break;
			case 3:
				$t = date('Y')-1; //本年新品
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
		$catid = intval($_REQUEST['catid']);  	//没有指定菜单,将以ID为分类ID
		$itemid  = intval($_REQUEST['itemid']);
 
 		/**
	    $sql = " select  c.*,count(p.id) as num  from #__category as c left join #__products as p on p.catid=c.id where c.parent_id=".$catid." group by c.id ";
		$this->db->query($sql);
		$lists['rows'] = $this->db->getResult();
		
		**/

		$lists = array();
 

		$menu = &SiteApplication::getMenu();

		$categroys = &$menu->getCategory();
		
 		//是否为产品目录全部列表
		if( $catid == 0 )
		{
			$cats = array();
			foreach( $categroys as $cat )
			{
				$cats[$cat['parent_id']][] = $cat;
			}
			$lists = array('rows'=>$cats,'child'=>$child_num,'catid'=>0);
		}else{
			
			$start=false;	//标记开始
			$cats = array();

			$child_num = 0;

			/**
			 * 目标:　找出所有相关的子分类,及子子分类
			 *　条件:　必需是按树状排列表数组
			 *  算法:　当找出对应分类时开始记录 ------- 直到下一个父级分类时结束
			 */
			foreach( $categroys as $cat )
			{
				if( $cat['id'] == $catid )
				{
					$start=true;	//标记开始
				}else if( $start && $cat['id'] != $catid && $cat['parent_id'] == 0 ){
					break;
				}

				if( $start)
				{
					$cats[] = $cat;

					if( $cat['parent_id'] == $catid ){ $child_num++; }	//记录当前目录下有多少子目录
				}	

			}

			array_shift($cats);
			$lists = array('rows'=>$cats,'child'=>$child_num,'catid'=>$catid);
		}
		return $lists;
	}
}
?>