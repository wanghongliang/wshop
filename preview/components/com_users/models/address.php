<?php
import( 'application.component.model');

class AddressModel extends Model
{
 
	
	function AddressModel(){
		parent::__construct();
		$this->tableName='#__users_address';
	}


	function getList(){

		global $app;
 
		$uid = intval($app->uid);
		
 		$where = $where?$where." and p.uid=".$uid:" where p.uid=".$uid;
 		//$order = " order by p.address_id desc ";
 
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName." as p ";
		$sql .= $where;
		
		$this->db->query($sql);
		$result = $this->db->getRow();
		$lists['nav'] = new Navigations(10,$result['n']);
		if( $key ){
			$lists['nav']->setRequest(array('com','view','tmpl','key'));
		}
 
		$sql = " select p.*,pro.name as proname,cit.name as citname from ".$this->tableName." as p ";
		$sql .=" left join #__area as pro on p.province=pro.id ";
		$sql .=" left join #__area as cit on p.city=cit.id ";

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
		$id = (int)$_POST['address_id'];
		$data=array(
			'consignee'=>$_POST['txt_ship_man'],
			'email'=>$_POST['email'],
			'country'=>$_POST['country'],
			'province'=>(int)$_POST['province'],
			'city'=>(int)$_POST['city'],
			'district'=>$_POST['consignee'],
			'goods_address'=>$_POST['txt_addr_detail'],
			'zipcode'=>$_POST['txt_ship_zip'],
			'tel'=>$_POST['txt_ship_tel'],
			'goods_mobile'=>$_POST['txt_ship_mb'],
			'defaulted'=>(int)$_POST['check_default'],
		);

		if( $_POST['check_default'] == '1' ){
			$sql = "update ".$this->tableName." set defaulted=0 where uid='".$app->uid."' ";
			$this->db->query($sql);
		}


		
		if( $id > 0 ){
			$this->db->updateArray("#__users_address",$data," address_id='".$id."' ");
		}else{
			$data['uid'] = $app->uid;
			$this->db->insertArray("#__users_address",$data);
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
			$sql = "delete from  ".$this->tableName." where address_id=".$id." and uid=".intval($app->uid);
 			$this->db->query($sql);
		}
		return true;
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