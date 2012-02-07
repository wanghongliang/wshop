<?php
import( 'application.component.model');

class CategoryModel extends Model
{
	function CategoryModel()
	{
		parent::__construct();
		$this->tableName = '#__website';
	}
	function getList()
	{
		global $app;
		$params 	   =& $app->getParams('com_sites');
		

		$catid = intval($_REQUEST['catid']);  	//没有指定菜单,将以ID为分类ID
		$area = intval($_REQUEST['area']);
		$topic = intval($_REQUEST['topic']);
		$color = intval($_REQUEST['color']);


 		$key = trim($_REQUEST['key']);
		$sort = trim($_REQUEST['sort']);
		$by = trim($_REQUEST['by']);

		$page = intval($_REQUEST['page']);
 		
		$document = &Factory::getDocument();

 		//如果指定当前分类，将重新SEO设置
		if( $catid > 0 ){
			$menu = &$app->getMenu();
			$cat = $menu->getCategoryItem($catid);
  			if( $cat['title'] ){
				$title = $cat['title'];
 			}else{
				$title = $cat['name'];
			}
 			if( $cat['metakey'] ){
				$metakey = $cat['metakey'];
 			}else{
				$metakey = $title;
			}
			if( $cat['metadesc'] ){
				$metadesc = $cat['metadesc'];
 			}else{
				$metadesc = $title;
			}

			$title .=  $GLOBALS['config']['title'];
			$metakey .=  $GLOBALS['config']['metakey'];
			$metadesc .=  $GLOBALS['config']['metadesc'];
 		}else{
			$title = $document->getTitle();
			$metakey = $document->getKeywords();
			$metadesc = $document->getDescription();
  		}


		

		if( $area > 0  || $topic > 0 ||  $color > 0 ){
			include($app->getMemberOptionPath());
  		}

 		$lists = array();
		$where = array();
		$where[]="  p.uid>0 ";
		if( $catid > 0 ){
			$where[]="  p.catid='".$catid."' ";
		}
		if( $area > 0 ){
			$where[]="  p.areaid='".$area."' ";
			$title = $areas[$area].'+'.$title;
			$metakey = $areas[$area].'+'.$metakey;
			$metadesc = $areas[$area].'+'.$metadesc;
		}


		if( $topic > 0 ){
			$where[]="  p.topicid='".$topic."' ";
			$title = $topics[$topic].'+'.$title;
			$metakey = $topics[$topic].'+'.$metakey;
			$metadesc = $topics[$topic].'+'.$metadesc;
		}

		if( $color > 0 ){
			$where[]="  p.colorid='".$color."' ";

			foreach( $colors as $c ){ if( $c['id'] == $color ){ $col = $c; break; } }
			$title = $col['text'].'+'.$title;
			$metakey = $col['text'].'+'.$metakey;
			$metadesc = $col['text'].'+'.$metadesc;
		}


		if( $key )
		{
			$where[] =  " p.name like('%".$key."%') ";
			$title = $key.'+'.$title;
			$metakey = $key.'+'.$metakey;
			$metadesc = $key.'+'.$metadesc;
		}


		if( $page>0 ){ $title.=',第'.$page.'页'; $metadesc  .=',第'.$page.'页'; }
		$document->setTitle($title);
		$document->setKeywords($metakey);		
		$document->setDescription( $metadesc);	


		$where = count($where)?" where ".implode(" and ",$where):"";
		
 		//$order = "   order by p.id desc ";

 		switch($by){
			case 'news':
				$order = "   order by p.modified desc ";
				break;
			case 'star':
				$order = "   order by p.star desc ";
				break;
			case 'hits':
				$order = "   order by p.hits desc ";
				break;
			case 'favs':
				$order = "   order by p.favs desc ";
				break;
			default:
				$order = " order by p.modified desc ";

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


  
 		$sql = " select p.thumbnail,p.name,p.id,p.catid,p.hits,p.uid,p.star,p.http   from ".$this->tableName." as p ";
		//$sql.= " inner join #__category as m on m.id = p.catid ";
 		$sql .= $where;

	
		$sql .= $order;
		
		$sql.= $lists['nav']->getLimit($page);
		
		//echo $sql;
 		$this->db->query($sql);
		$lists['rows'] = $this->db->getResult();

		//print_r($lists['rows']);
		$lists['cat'] = $cat;
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