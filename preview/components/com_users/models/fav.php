<?php
import( 'application.component.model');

class FavModel extends Model
{
 
	
	function FavModel(){
		parent::__construct();
		$this->tableName='#__products_fav';
	}


	function getList(){

		global $app; 
		$uid = $app->uid; 
 		$where = " where f.mid=".$uid;
 		//$order = " order by p.address_id desc ";
 
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName." as f ";
		$sql .= $where;
		
		$this->db->query($sql);
		$result = $this->db->getRow();
		$lists['nav'] = new Navigations(10,$result['n']);
		if( $key ){
			$lists['nav']->setRequest(array('com','view','tmpl','key'));
		}
 
		$sql = " select f.*,s.price,p.thumbnail,p.name,p.catid  from ".$this->tableName." as f "; 
		$sql .= " left join #__s_products as s on f.products_id=s.products_id and f.uid=s.uid ";
		$sql .=" left join #__products as p on f.products_id= p.id ";
		$sql .= $where;
		$sql .= $order;
		
		$sql.= $lists['nav']->getLimit($_REQUEST['page']);
		
		$this->db->query($sql);
		$lists['rows'] = $this->db->getResult();

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

	function save(){
		global $app;
		$id = (int)$_GET['pid'];
		$data=array(
			'products_id'=>$id,
			'uid'=>$GLOBALS['USERID'],
			'mid'=>$app->uid 
		); 
		$sql = "insert into ".$this->tableName." set products_id='".$id."' , uid='".$GLOBALS['USERID']."',mid='".$app->uid."' ,created='".date('Y-m-d H:i:s')."' ";
		$this->db->query($sql,true);
		
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
			$sql = "delete from  ".$this->tableName." where	id=".$id." and mid=".intval($app->uid);
			//echo $sql;exit;
 			$this->db->query($sql);
		}
		return true;
	}
	//删除 
	function delall(){
		global $app;
		$ids = $this->filter(trim($_GET['ids']));


		if( count($ids)>0 ){
		$sql = "delete from  ".$this->tableName." where	id in (".implode(',',$ids).") and mid=".intval($app->uid);
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