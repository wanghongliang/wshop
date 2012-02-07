<?php
import( 'application.component.model');

class CategoryModel extends Model
{
	function CategoryModel()
	{
		parent::__construct();
		$this->tableName = '#__products_activity';
	}
	function getList()
	{
		global $app;
		$params 	   =& $app->getParams('com_buys');
		

		$catid = intval($_REQUEST['catid']);  	//没有指定菜单,将以ID为分类ID
 		$key = trim($_REQUEST['key']);

		$menu = &$app->getMenu();
 




 		$lists = array();
		$where =" where p.act_type=1";
 		
		if( $key )
		{
			$where = $where?$where." and p.title like('%".$key."%') ":" where p.title like('%".$key."%') ";
		}
		
 		$order = "   order by p.act_id desc ";

 
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName." as p "; 
		$sql .= $where;
		 
		$this->db->query($sql);
		$result = $this->db->getRow();
		$lists['nav'] = new Navigations(20,$result['n']);
		if( $key ){
			$lists['nav']->setRequest(array('com','view','tmpl','key'));
		}


  
 		$sql = " select *  from ".$this->tableName." as p "; 
		$sql .= $where; 
		$sql .= $order;
		
		$sql.= $lists['nav']->getLimit($_REQUEST['page']);
		
 		$this->db->query($sql);
		$lists['rows'] = $this->db->getResult();

		//print_r($lists['rows']);
		$lists['cat'] = $cat;



		$t=time();
		$sql = " select * from #__products_activity where act_type=1 and  end_time>'".$t."'   order by end_time desc   ";
		$this->db->query($sql);
		$lists['today'] = $this->db->getResult();


		return $lists;
	}

	function getItem()
	{
		global $app;
	 
		$id = (int)$_GET['id'];
		if( $id>0 ){
			$sql = " select * from #__products_activity where act_id='".$id."'   ";
			$this->db->query($sql);
			$row = $this->db->getRow();
		}else{
			$t=time();
			$sql = " select * from #__products_activity  where  act_type=1   order by end_time desc   ";
 			$this->db->query($sql);
			$row = $this->db->getResult();
		}
 
		return $row;
	 
	}
 	function getProvince($area=1){
 		//数据列表
		$list = array();
		$query = "select id,name,parent_id from #__area where lft>1 and rgt<784  order by lft ";
		$this->db->query($query);
		$lists = $this->db->getResult();
		return $lists;
	}

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


	//保存邮件通知信息
	function saveSubscribe(){
		$email = trim($_POST['email']);
		$data = array(
			'email'=>$email,
			'created'=>date('Y-m-d H:i:s')
		);

		$this->db->insertArray('#__subscribe',$data);
	}

	//保存订单信息
	function saveOrder(){
		global $app;
		$uid = intval($app->uid);
		$addr_id = $_POST['adr'] ;

		//确认收货人的信息
		if( $addr_id == 'new' ){
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

		//团购商品信息
		$id = (int)$_GET['id'];
	 
		$sql = " select * from #__products_activity where act_id='".$id."' ";
		$this->db->query($sql);
		$row = $this->db->getRow();
		$param = unserialize( $row['ext_info']);


		$total = (int)$_POST['amount'];
		$total_price = (int)$param['ladder_price'][0]*$total;
		$total_pays = $total_price;

		//订单的内容
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
			'postage'=>0,
			'pay'=>0,	//支付方式
			'remark'=>$_POST['content'],
			'mid'=>$uid,
			'uid'=>$GLOBALS['USERID'],
			'order_type'=>1,//团购类型
			'created_date'=>date('Y-m-d H:i:s')
		);
			
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

	 
		//保存订单信息
		$this->db->insertArray('#__order',$order_data);
		$order_id = $this->db->insertid(); 
 

		//保存产品信息
		$data= array(
			'product_id'=>(int)$row['products_id'],
			'order_id'=>$order_id,
			'product_name'=>$row['products_name'],
			'product_thumb'=>$row['img'],
			'product_quanlity'=>$total,
			'product_price'=>intval($param['ladder_price'][0]),
			'uid'=>$uid,
			'params'=>serialize(array('params'=>'团购')),
		); 
 
		$this->db->insertArray('#__order_goods',$data);
	 
		return $order_data;
	 
 
	}
}
?>