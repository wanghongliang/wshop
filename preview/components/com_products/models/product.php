<?php
import( 'application.component.model');

class ProductModel extends Model
{
	function getItem()
	{
		global $app;
		if( $id = intval($_REQUEST['id']) ){

			/* 记录浏览历史 */
			if (!empty($_COOKIE['TMP']['history']))
			{
				$history = explode(',', $_COOKIE['TMP']['history']);

				array_unshift($history, $id);
				$history = array_unique($history);

				while (count($history) > 10)
				{
					array_pop($history);
				}

				setcookie('TMP[history]', implode(',', $history),time()+3600*24,'/');
			}
			else
			{
				setcookie('TMP[history]', $id,time()+3600*24,'/');
			}


			/* 更新点击次数 */
			$this->db->query("UPDATE #__products SET hits = hits + 1 WHERE id ='".$id."' "); 

			$lists = array();
			$sql = " select p.*   from #__products as p  where p.id='".$id."'  ";
 
 			$this->db->query($sql); 
			$lists['row'] = $this->db->getRow();	//获取菜单项数据
			
			if( count($lists['row'])<1 ){
				$app->redirect('/');
				return false;
			}
			$ids = array();
			$paths = array();

			$catid =intval($lists['row']['catid']);
			if( $catid >0 )
			{
				$sql = " select * from #__category where id='".$catid."' ";
				$this->db->query($sql);
				$row = $this->db->getRow();	//获取菜单项数据

				$lft=intval($row['lft']);
				$rgt=intval($row['rgt']);
				$sql = " select * from #__category where `lft`<$lft AND `rgt`>$rgt order by lft";
				//echo $sql;
				$this->db->query($sql);
				$rows= $this->db->getResult();	//获取菜单项数据
				foreach( $rows as $v )
				{
					$ids[] = $v['id'];
					$paths[] = $v['name'];
				}
				$ids[] = $row['id'];
				$paths[] = $row['name'];
			}

			$lists['ids'] = $ids ;
			$lists['paths'] = $paths;

	  
 


			return $lists;
		}
	}


	//活动信息
	function getAct($id){
		$sql =" select * from #__products_activity where products_id=".(int)$id."  and act_type=2  and end_time>'".time()."' and product_amount>0 ";
		$this->db->query($sql);
		return $this->db->getRow();
	}

	function getTotal($uid){
		if( $uid > 0 ){
		$sql =" select  id,catid,title  from #__products where uid=".$uid;
		$this->db->query($sql);
		$rows = $this->db->getResult();
		}else{ $rows=array();}
 		return $rows;
	}

	function getLink($id){
		//return array();
		if( $id > 0 ){
			$sql =" select  p.id, p.catid,p.name,p.thumbnail,p.market_price,p.shop_price  from #__products as p , #__products_link as l where ( p.id=l.products_link_id and l.products_id=".$id." ) or ( p.id=l.products_id  and l.products_link_id=".$id." and l.is_double=1 ) limit 3 ";
			$this->db->query($sql);
			$rows = $this->db->getResult();

			if(count($rows)<1 ){
				$sql = " SELECT  p.id as id, p.catid,p.name,p.thumbnail,p.market_price,p.shop_price  FROM #__products as p JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM #__products   )-( SELECT MIN(id) FROM #__products  ))+(SELECT MIN(id) FROM #__products )) AS id) AS t2 WHERE p.id >= t2.id and p.id <> ".$id." ORDER BY p.id LIMIT 3;";
				$this->db->query($sql);
				$rows = $this->db->getResult();
			}
		}else{ $rows=array();}
 		return $rows;
	}

	

	//点评
	function getComment(){
		$id = (int)$_GET['product_id'];
		
		$lists =array();
 		if( $id > 0 ){
			$sql =" select  star  from #__evaluation where product_id=".$id;
			$this->db->query($sql);
			$rows = $this->db->getResult();
			

			//总数量
			$count = count($rows);
			import('html.navigations');
			$lists['nav'] = new Navigations(10,$count);
			$lists['rows'] = array();
			$lists['info'] = array();
			if( $count>0 ){
				$info =array();
				 
				$total = 0;
				foreach( $rows as $v ){
					$info[$v['star']]++;

					$total += $v['star'];
				} 
				$info[1] = ceil( ($info[1]/$count)*100 );
				$info[2] = ceil( ($info[2]/$count)*100 );
				$info[3] = ceil( ($info[3]/$count)*100 );

				$info[8] = ceil( ($total/($count*3))*100 );
				$lists['info'] = $info;
				unset($rows);
				
				//
				$order=" order by e.id desc ";
		

				$sql = " select * from #__evaluation as e where e.product_id=".$id;
	  
				$sql .= $order;
				$sql.= $lists['nav']->getLimit($_REQUEST['page']);
				 
				$this->db->query($sql);
				$lists['rows'] = $this->db->getResult();
			}


		}else{  $rows=array(); }
 		return $lists;
	}


	//识询

	function getAdvisory(){
		$id = (int)$_GET['product_id'];

		

		$lists =array();
 		if( $id > 0 ){
			$sql =" select  count(*) as num from #__products_comment where products_id=".$id." and parent_id=0 ";
			$this->db->query($sql);
			$rows = $this->db->getRow(); 
 			import('html.navigations');
			$lists['nav'] = new Navigations(10,$rows['num']);
			$lists['rows'] = array();
		 
			$order=" order by e.comment_id desc ";
			$sql = " select e.*,re.content as recontent from #__products_comment as e left join #__products_comment as re on e.comment_id=re.parent_id where e.products_id=".$id." and e.parent_id=0 ";
			$sql .= $order;
			$sql.= $lists['nav']->getLimit($_REQUEST['page']);
			 
			$this->db->query($sql);
			$lists['rows'] = $this->db->getResult();
		 

		}else{

			echo 1;exit;//没有产品ID
		}


 		return $lists;
	}

	function saveAdvisory(){
		$id = (int)$_GET['product_id'];
					
		if( $this->uid < 1 )
		{
			echo 0;exit; //没有登陆
		}

  		if( $id > 0 ){
			$con = trim($_GET['contents']); 
			$s = &Factory::getSession();
			$author = $s->get('username');

			$data = array('content'=>$con,'created'=>time(),'uid'=>$this->uid,'products_id'=>$id,'author'=>$author,'parent_id'=>0);
			$this->db->insertArray('#__products_comment',$data);
			return true;
		}else{ 
			echo 1;exit;//没有产品ID
		}

		return false; 
	}


 
	function getPrev($id){
		global $app;
		$sql =" select  id,catid from #__products where  id<".(int)$id."  order by id desc limit 1 ";
		$this->db->query($sql);
		$rows = $this->db->getRow(); 
		return $rows;
	}

	function getNext($id){
		global $app;
		$sql =" select  id,catid from #__products where  id>".(int)$id." limit 1 ";
		$this->db->query($sql);
		$rows = $this->db->getRow(); 
		return $rows;
	}
 


	function useless(){
		$id = (int)$_GET['id'];
		$sql = "update  #__evaluation set useless =useless+1 where id=".$id;
		$this->db->query( $sql );
	}

	function useful(){
		$id = (int)$_GET['id'];
		$sql = "update  #__evaluation set useful =useful+1 where id=".$id;
		$this->db->query( $sql );
	}
}
?>