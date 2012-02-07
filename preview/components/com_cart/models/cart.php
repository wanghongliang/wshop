<?php
import( 'application.component.model');

class CartModel extends Model
{
 

	//获取会员的地址
	function getAddress(){
		global $app;
		$uid = intval($app->uid);
		//数据列表
		$list = array();
 			
		$query = "select a.*,p.name as pname,c.name as cname from #__users_address as a ";
		$query .=" left join #__area as p on a.province=p.id ";
		$query .=" left join #__area as c on a.city=c.id "; 
		$query .=" where a.uid=".$uid." order by a.defaulted desc ";
		 
		$this->db->query($query);
		$rows = $this->db->getResult();
		return $rows;
	}
 	function getProvince($area=1){
 		//数据列表
 		$query = "select id,name,parent_id from #__area where lft>1 and rgt<784  order by lft ";
		$this->db->query($query);
		$lists = $this->db->getResult();
		return $lists;
	}

	function getDefalutAttribute($id){
 
		/**
		//取属性 
		$sql = "select av.attr_id,av.attr_value,av.attr_price,av.products_id from  #__products_attribute as at , #__products_attr as av where at.attr_id = av.attr_id and  av.products_id=".$id." and at.attr_type =2 group by av.attr_id  order by at.ordering ";
		 
		$this->db->query($sql);
		$attrs = $this->db->getResult('attr_id',true);
		
		 
		$a = '';
		foreach( $attrs as $v ){ $a.=','.$v[0]['attr_value']; $price=$v[0]['attr_price']; }
		$a = substr($a,1);
		**/
		$sql =" select shop_price from #__products where id=".(int)$id;
		$this->db->query($sql);
		$row = $this->db->getRow();

  
		return array('price'=>$row['shop_price']);
	}

	
	function getShipping(){
 		$query = "select s.id as id,s.name,s.has_cod,s.desc,s.config as cg,a.areaid_group,a.config from #__shipping as s left join #__shopping_area as a on s.id=a.shipping_id where s.published=1 order by s.ordering ";
		$this->db->query($query);
		$lists = $this->db->getResult('id',true);
		return $lists;
	}

	function getPayItem($id){
 		$sql = " select * from #__plugins where id=".(int)$id;
		$this->db->query($sql);
		$rows = $this->db->getRow();
		$rows['params'] = FormatINI::stringToArray( $rows['params'] ); 
		return $rows;
	}


	function getOrder($sn){
		$sql = "select total_deposit,pay from #__order where order_sn='".$sn."' ";
		$this->db->query($sql);
		return $this->db->getRow();
	}
	function checkoutsubmit(){

		global $app;

		$uid = intval($app->uid);
		$addr_id = $_POST['adr'] ;
		
		//print_r($_POST);exit;
		//确认收货人的信息
		if( $addr_id == 'new' ){
			$data=array(
				'consignee'=>$_POST['txt_ship_man'],
				'email'=>$_POST['email'],
				'country'=>(int)$_POST['country'],
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
				$sql = "update #__users_address set defaulted=0 where uid='".$app->uid."' ";
				$this->db->query($sql);
			} 
			$data['uid'] = $app->uid;
			$this->db->insertArray("#__users_address",$data); 
			$addr_id = $this->db->insertid();

		}else{
			$addr_id = (int)$addr_id;
			$sql = "select * from #__users_address where address_id=".$addr_id;
			$this->db->query($sql);
			$data = $this->db->getRow();
		}

 
		import('utilities.cart');
		$cart =  Cart::getInstance();
		$ms = $cart->getMerchandises(); 

		//是否有物品
		if( count($ms) > 0 ){
			
			$total = 0;
			$total_price = 0;

			$total_pays = 0; //预付总金额

			foreach( $ms as $k=>$v ){
				$price = $v['attr']['actual_price'];
				if( $price<1 ){
					$price = intval($v['info']['price']);	//价格
				}
				$sub_total_price = $price * $v['number'];	//小结
				$total += $v['number'];	//总数量
				$total_price += $sub_total_price; //总价格

				$deposit = intval($v['attr']['price']);	//价格
				$sub_total_p = $deposit * $v['number'];	//小结
				$total_pays += $sub_total_p; //总价格
			}
			

	

			//货运方式
			$postage = (int)$_POST['shipping'];
			$query = "select s.id as id,s.name,s.has_cod,s.desc,s.config as cg,a.areaid_group,a.config from #__shipping as s left join #__shopping_area as a on s.id=a.shipping_id where s.id=".$postage;
			$this->db->query($query);
			$shipping = $this->db->getResult('id',true);
 			$free = 0; //当前的货运费用
			$i=0;
			foreach( $shipping as $k=>$row ){
				$free = 0;
				$v  = $row[0];
				$cg = unserialize($v['cg']);
				//指定配送地区和费用
				if( $cg['setting'] == 'setting_sda' ){
					//查找配置的地区价格
					foreach( $row as $x=>$y ){
						$aids = explode(',',$y['areaid_group']); 
						//找到后计算价格
						if( in_array( $defaultArea[2],$aids ) || in_array( $defaultArea[1],$aids ) || in_array( $defaultArea[0],$aids ) ){
							$config = unserialize($y['config']);
							$free = $config['firstFee'];
						}
					}
					if( $free == 0 ){  
						if( $cg['defAreaFee'] != 1 ){ continue; }
						$free = $cg['firstprice']; 
					 }
				}else{
					$free = $cg['firstprice'];
				}
			}



			//加上运费 
			$total_price += $free;
			$total_pays += $free;

			$order_data = array(
				'consignee'=>$data['consignee'],
				'province'=>(int)$data['province'],
				'city'=>(int)$data['city'], 
				'goods_address'=>$data['goods_address'],
				'zipcode'=>$data['zipcode'],
				'goods_mobile'=>$data['goods_mobile'],
				'tel'=>$data['tel'],
				'order_sn'=>date('YmdHis'),
				'email'=>$data['email'],

				'amount'=>$total_price,	//总金额
				'quantity'=>$total,	//总数量
				'total_deposit'=>$total_pays,	//预付总金额
				'postage'=>$postage,
				'postage_free'=>$free,
				'pay'=>(int)$_POST['payment'],	//支付方式
				'remark'=>$_POST['content'],
				'mid'=>$uid,
				'uid'=>$GLOBALS['USERID'],
				'created_date'=>date('Y-m-d H:i:s'),
				'order_status'=>'active',
				'pay_status'=>'0',
				'ship_status'=>'0',
				'user_status'=>'null',

			);
			
			//print_r( $order_data);exit;
			$query = array();
			if( $data['province'] > 0 ){
				$query[] = $data['province'];
			}

			if( $data['city'] > 0 ){
				$query[] = $data['city'];
			}


			if( count($query)>0 ){
				//给定单加一个地区文本
				$query = "select id,name,parent_id from #__area where id in (".implode(',',$query).") order by lft ";
				$this->db->query($query);

				$query = array();
				while( $this->db->next_record() ){
					$query[] = $this->db->Record['name'];
				}
				$order_data['city_text'] = implode(':',$query);
			} 

	 
			//保存定单信息
			$this->db->insertArray('#__order',$order_data);
			$order_id = $this->db->insertid();
			
	
			$total = 0;
			$total_price = 0;
			foreach( $ms as $k=>$v ){  
				$data= array(
					'product_id'=>$v['info']['id'],
					'order_id'=>$order_id,
					'product_name'=>$v['info']['name'],
					'product_thumb'=>$v['info']['thumbnail'],
					'product_quanlity'=>$v['number'],
					'product_price'=>intval($v['info']['price']),
					'act_type'=>$v['attr']['act_type'],
					'uid'=>$uid,
					'params'=>serialize($v['attr']),
				);


				if( $ms[$k]['img'] != '' ){
					$data['product_thumb']=$ms[$k]['img'];
				}

				$price = $ms[$k]['attr']['actual_price'];
				if( $price > 0 ){
					$data['product_price'] = $price;
				}

 				$this->db->insertArray('#__order_goods',$data);
			}
 			return $order_data;
		}

		return false; 

	}

	function getPayments(){
 		$sql = " select * from #__plugins where published=1  and folder = 'pay'";
		$this->db->query($sql);
		$rows = $this->db->getResult();
 		import('html.format.ini'); 
		foreach( $rows as $k=> $row )
		{ 
			$rows[$k]['params'] = FormatINI::stringToArray( $row['params'] ); 
		}

		return $rows;
	}

	
	function getEliteProducts(){
		
		$where = " where  p.published=1 ";
		//查询数据库
		$query = 'Select p.id,p.name,p.catid,p.thumbnail,p.shop_price from #__products as p    ' .
				$where;		
		$query .=" order by id desc ";
		$query .= " limit 10 "; 
		$this->db->query($query); 
		return $this->db->getResult();
 	}

	function getHistory(){

		$rows=array();
		$s = $_COOKIE['TMP']['history'];   
		if( !empty($s) ){
			$s = explode(',', $s); 
			$s = array_filter(array_unique($s),"f" );

			$sql = " select p.id,p.name,p.catid,p.thumbnail,p.shop_price  from    #__products as p   where p.id in (".implode(',',$s)." )  ";
			$this->db->query($sql); 
			$rows = $this->db->getResult();
		}
		return $rows;
 	}


	function getAct($id,$act_type){
		$sql = "select shop_price from #__products_activity where products_id='{$id}' and act_type='{$act_type}' and end_time>'".time()."' ";

 		$this->db->query($sql);
		return $this->db->getRow();
	}

}

if( !function_exists('f') ){
	function f($v)
	{
		return $v>0;
	}
}
?>