<?php
import( 'application.component.model');

class PointsModel extends Model
{
 
	
	function PointsModel(){
		parent::__construct();
		$this->tableName='#__point_log';
	}


	function getList(){

		global $app; 
		$uid = $app->uid; 
 		$where = " where f.uid=".$uid;
 		$order = " order by f.id desc ";
 
		import('html.navigations');
		$sql = " select points from ".$this->tableName." as f ";
		$sql .= $where;
		
		$this->db->query($sql);
		$result = $this->db->getResult();
		$count = count($result);
		foreach( $result as $k=>$v ){
			if( $v['points']>0 ){
			$total1 +=$v['points'];
			}else{
			$total2 +=$v['points'];
			}
		}

		$lists['nav'] = new Navigations(20,$result['n']);
		if( $key ){
			$lists['nav']->setRequest(array('com','view','tmpl','key'));
		}
 
		$sql = " select  *  from ".$this->tableName." as f ";
 		$sql .= $where;
		$sql .= $order;
		
		$sql.= $lists['nav']->getLimit($_REQUEST['page']); 
		$this->db->query($sql); 
		$lists['rows'] = $this->db->getResult();
		$lists['total1'] = $total1;
		$lists['total2'] = $total2;

		return  $lists;
	}
 	function getProvince($area=1){
 		//数据列表
		$list = array();
		$query = "select id,name,parent_id from #__area where lft>1 and rgt<784  order by lft ";
		$this->db->query($query);
		$lists = $this->db->getResult();
		return $lists;
	}

	function getItem(){
		$product_id = intval($_GET['product_id']);
		$sql =" select product_name,product_id,iscomment from #__order_goods where uid=".$this->uid." and product_id = ".$product_id."  ";
		$this->db->query($sql);
		$row = $this->db->getResult();

		return $row;
	}
	function save(){
		global $app;
		$star = intval($_POST['star']);
		$product_id = intval($_POST['product_id']);
 
		if( $star > 0  && $product_id > 0 ){

			//先计算星星等级
			$sql =" select count(id) as n, sum(star) as total from ".$this->tableName." where product_id=".$product_id;
			$this->db->query($sql);
			$result = $this->db->getRow();
			
			$total = $result['total']+$star;
			$star_level = ($result['total']+$star)/($result['n']+1);

			$sql =" update #__products set star ='".(int)$star_level."',	postnum='".(int)$result['n']."' where id=".$product_id;
			$this->db->query($sql);

			$content = $_POST['content'];

			$session = &Factory::getSession();
			$uname = $session->get('username');
			$data = array('product_id'=>$product_id,'star'=>$star,'contents'=>$content,'uid'=>$this->uid,'uname'=>$uname,'created'=>date('Y-m-d H:i:s'));
			$this->db->insertArray($this->tableName,$data);
				 
			
			$sql =" update #__order_goods set iscomment=1 where uid=".$this->uid." and  product_id = ".$product_id;
			$this->db->query($sql);
		}
	}



	function ajaxGetInfo(){
		$id = intval($_GET['id']);
		$sql = "select * from ".$this->tableName." where address_id=".$id;
		$this->db->query($sql);
		$data = $this->db->getRow();

		return $data;
	}
	function getOrder(){
		global $app;
		$id = intval($_GET['id']);

		if( $id> 0 ){
			$sql = "select * from ".$this->tableName." where id=".$id;
 			$this->db->query($sql);
			$order_data = $this->db->getRow();

		

			$sql = "select * from #__order_goods where order_id=".$id;
			$this->db->query($sql);
			$rows = $this->db->getResult('product_id');
		}

		return array('order'=>$order_data,'goods'=>$rows);
	}

	//删除 
	function delete(){
		global $app;
		$id = intval($_GET['id']);

		if( $id> 0 ){
			$sql = "delete from  ".$this->tableName." where	id=".$id." and uid=".intval($app->uid);
 			$this->db->query($sql);
		}
		return true;
	}
	//删除 
	function delall(){
		global $app;
		$ids = $this->filter(trim($_GET['ids']));


		if( count($ids)>0 ){
		$sql = "delete from  ".$this->tableName." where	id in (".implode(',',$ids).") and uid=".intval($app->uid);
 		$this->db->query($sql);
		}
		return true;
	}
	function filter($ids){
		$s = explode(',',$ids);
		$i = array();
		foreach( $s as $v ){
			if( ($v=(int)$v)>0 ){
				$i[] = $v;
			}

		}
		unset($ids,$s);
		return $i;
	}

	function setdefault(){
		global $app;
		$id = intval($_GET['id']);

		if( $id> 0 ){
			$sql = "update ".$this->tableName." set defaulted=0 where uid='".$app->uid."' ";
			$this->db->query($sql);



			$sql = "update ".$this->tableName." set defaulted=1 where address_id=".$id." and uid=".intval($app->uid);
 			$this->db->query($sql);
		}
		return true;
	}
}
?>