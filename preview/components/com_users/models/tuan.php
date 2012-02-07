<?php
import( 'application.component.model');

class TuanModel extends Model
{ 
	function TuanModel(){
		parent::__construct();
		$this->tableName='#__order';
	}
	function getList(){

		global $app;

 		$byTime = trim($_REQUEST['s']);
		$way = (int)$_REQUEST['way'];
		$key = trim( $_REQUEST['key'] );


		$uid = $app->uid;
		$where=array("  g.uid=".$uid." and g.act_type=3 ");
		
	
		if( empty($byTime) ){ $byTime='oneWeek'; }

		switch( $byTime ){
			case 'oneWeek':
				$where[]="  p.created_date>'".date('Y-m-d H:i:s',time()-7*24*3600)."' " ;
				break;
			case 'oneMonth':
				$where[]=" p.created_date>'".date('Y-m-d H:i:s',time()-7*24*3600)."' " ;
				break;
			case 'all':
				break; 
		}
		
		if( $way>0 && !empty($key) ){
			if( $way == 1 ){
				$where[]=" g.product_name like ('%".$key."%') " ;
			}else if( $way==2 ){
				$where[]=" p.order_sn like ('%".$key."%') " ;
			}
		}
		

		if( count($where)>0 ){
			$where = "where ".implode(' and ',$where);
		}
  		$order = " order by g.order_id desc ";
		
		import('html.navigations');
		$sql = " select count(*) as n from #__order_goods as g left join ".$this->tableName." as p on g.order_id=p.id ";
		$sql .= $where;
		
		$this->db->query($sql);
		$result = $this->db->getRow();
		$lists['nav'] = new Navigations(10,$result['n']);
		if( $key ){
			$lists['nav']->setRequest(array('com','view','tmpl','key'));
		}
 
		$sql = " select * from #__order_goods as g left join ".$this->tableName." as p on g.order_id=p.id ";
		$sql .= $where;
		$sql .= $order;
		
		$sql.= $lists['nav']->getLimit($_REQUEST['page']);
		
		//echo $sql;
 		$this->db->query($sql);
		$lists['rows'] = $this->db->getResult('order_id',true);
		
		//print_r($lists);
		return  $lists;
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
	function getLog($id){
		$sql =" select * from #__order_action where order_id=".(int)$id;
		$this->db->query($sql);
		return $this->db->getResult();
	}

	function getPay($id){
 		$sql = " select * from #__plugins where id=".(int)$id;
		$this->db->query($sql);
		$rows = $this->db->getRow();
		$rows['params'] = FormatINI::stringToArray( $rows['params'] ); 
		return $rows;
	}

	function getShip($id){
 		$query = "select * from #__shipping as s  where s.id=".(int)$id;

 		$this->db->query($query);
		$row = $this->db->getRow();
		return $row;
	}
	//и╬ЁЩ╤╘╣╔пео╒
	function delete(){
		global $app;
		$id = intval($_GET['id']);

		if( $id> 0 ){
			$sql = "delete from  ".$this->tableName." where id=".$id." and uid=".intval($app->uid);
 			$this->db->query($sql);
		}
		return true;
	}

	function cancel(){
		global $app;
		$id = intval($_GET['id']);
		if( $id> 0 ){
			$sql = "update  ".$this->tableName." set order_status='dead' where id=".$id." and mid=".intval($app->uid);
  			$this->db->query($sql);
		}
		return true;
	}
}
?>