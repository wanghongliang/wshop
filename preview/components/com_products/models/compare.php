<?php
import( 'application.component.model');

class CompareModel extends Model
{
	function getItem()
	{
		global $app;
		$s = trim($_GET['ids']); 
 
		$lists = array();
		if( $s = $this->filter($s) ){
			$sql = " select p.* ,p.shop_price as price from #__products as p where p.id in (".$s.")  "; 
			$this->db->query($sql); 
			$lists['rows'] = $this->db->getResult();	//获取菜单项数据 
	
			
			$menu = &$app->getMenu();
			$cat = $menu->getCategoryItem($lists['rows'][0]['catid']);
			$type_id  = (int)$cat['type_id'];
			$sql = " select attr_id,attr_name,	attr_input_type,attr_type,	attr_values from #__products_attribute where type_id='".$type_id."' order by ordering ";
			$this->db->query($sql); 
			$lists['attr'] = $this->db->getResult();
 
		} 
		return $lists;
	 
	}
 
	function getTotal($uid){
		if( $uid > 0 ){
		$sql =" select  id,catid,title  from #__products where uid=".$uid;
		$this->db->query($sql);
		$rows = $this->db->getResult();
		}else{ $rows=array();}
 		return $rows;
	}


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
			$lists['nav'] = new Navigations(20,$count);
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




	/***
	function getPrev(){
		global $app;
		$sql =" select  id from #__products where uid=".$app->uid." order by id limit 5 ";
		$this->db->query($sql);
		$rows = $this->db->getResult();

		return $rows;
	}

	function getNext(){
		global $app;
		$sql =" select  id from #__products where uid=".$app->uid." order by id desc limit 5 ";
		$this->db->query($sql);
		$rows = $this->db->getResult();

		return $rows;
	}
	**/

	function filter($s){
		$t = explode(',',$s);
		$ids = array();
		foreach( $t as $id ){
			if( ($id=intval($id)) > 0 ){
				$ids[] = $id;
			}
		}
		unset($t,$s);
		return implode(',',$ids);
	}
}
?>