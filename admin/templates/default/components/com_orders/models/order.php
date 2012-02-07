<?php
import('application.component.model');
class OrderModel extends Model
{
	var $menuid = 0;

	var $nav = null;
	function OrderModel()
	{
		parent::__construct();
		$this->tableName = '#__order';
 	}
	
	function getSelectList()
	{
		if( $this->menuid > 0 ){
			$where = " where menuid='".$this->menuid."'";
		}else{
			$where = "";
		}

		$order = " order by id desc ";

 
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName;
		$sql .= $where;
		

		$this->db->query($sql);
		$result = $this->db->getRow();
		$this->nav = new Navigations(20,$result['n']);
		

 
 		$sql = " select * from ".$this->tableName;
		$sql .= $where;
		$sql .= $order;

		$sql.= $this->nav->getLimit($_REQUEST['page']);

		$this->db->query($sql);
		return $this->db->getResult();

	}


	/**
	 * 取当前编辑项
	 */
	function getItem()
	{
		global $app;
		$id = intval($_GET['id']);

		if( $id> 0 ){
			$sql = "select o.*,u.username,u.nickname,u.email from ".$this->tableName." as o ";
			$sql .=" left join #__users as u on u.id=o.mid ";

			$sql .=" where o.id=".$id;
 			$this->db->query($sql);
			$order_data = $this->db->getRow(); 
		}
		return $order_data;

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
	function getInfo($id){
		//$sql = "select username from #__users where id=".$id;
		//$this->db->query($sql);
		//return $this->db->getRow();
	}

	function getOrderProducts($id){

		$rows = array();
		if( $id> 0 ){
			$sql = "select * from #__order_goods where order_id=".$id;
			$this->db->query($sql);
			$rows = $this->db->getResult('product_id');
		}	
		return $rows;
	}
 

	//保存订单付款信息
	function savePay(){

		$order_id = (int)$_POST['id'];
		//print_r($_POST);exit;
		$data = array(
			'order_id'=>$order_id ,//订单ID
			'order_sn'=>$_POST['order_sn'],
			'uid'=>$this->uid,//会员ID
			'money'=>$_POST['money'],
			'cur_money'=>$_POST['cur_money'],
			'currency'=>'CNY',


			'account'=>$_POST['account'],
			'bank'=>$_POST['bank'],
			'pay_account'=>$_POST['pay_account'],
			'payment'=>$_POST['payment'],
			'memo'=>$_POST['memo'],
			't_begin'=>time(),
			't_end'=>time(),
			'pay_type'=>$_POST['pay_type'],
			'status'=>'succ',
		);
		$this->db->insertArray('#__payments',$data);


		//修改订单的支付状态
		$data = array('pay_status'=>1,'user_status'=>'payed');
		$this->db->updateArray('#__order',$data," id='".$order_id."' ");


		//记录付款记录
		$this->log($order_id, '付款','填写付款单，并确认付款');
 	}

	//保存退款信息
	function saveRefund(){
		$order_id = (int)$_POST['id'];
		//print_r($_POST);exit;
		$data = array(
			'order_id'=>$order_id ,//订单ID
			'order_sn'=>$_POST['order_sn'],
			'uid'=>$this->uid,//会员ID
			'money'=>$_POST['money'], 
			'currency'=>'CNY',

			'account'=>$_POST['account'],
			'bank'=>$_POST['bank'],
			'pay_account'=>$_POST['pay_account'],
			'payment'=>$_POST['payment'],
			'memo'=>$_POST['memo'],
			't_ready'=>time(),
			't_sent'=>time(),
			'pay_type'=>$_POST['pay_type'],
			'status'=>'ready',
		);
		$this->db->insertArray('#__refunds',$data);


		//修改订单的支付状态
		$data = array('pay_status'=>2);
		$this->db->updateArray('#__order',$data," id='".$order_id."' ");

		//记录付款记录
		$this->log($order_id,'退款','填写退款单，并确认退款');

	}

	//保存发货单信息
	function saveShip(){
		//print_r($_POST);exit;

		$order_id = (int)$_POST['id'];
		//print_r($_POST);exit;
		$data = array(
			'order_id'=>$order_id ,//订单ID
			'uid'=>$this->uid,//会员ID
			'order_sn'=>$_POST['order_sn'],
			'invoice_no'=>$_POST['invoice_no'],	//发票号
			'add_time'=>time(), //添加时间
			'shipping_id'=>$_POST['shipping_id'],	//货运方式
			'shipping_name'=>$_POST['shipping_name'], //货运公司
			'shipping_sn'=>$_POST['shipping_sn'], //货单号
			'shipping_fee'=>$_POST['shipping_fee'], //货运费用
			'insure'=>$_POST['insure'], //是否投保
			'insure_fee'=>$_POST['insure_fee'], //投保费用

			'action_user'=>$_POST['action_user'], // 订货人
			'consignee'=>$_POST['consignee'],	//收货人
			'address'=>$_POST['address'], //收货地址
			'country'=>(int)$_POST['country'],
			'province'=>(int)$_POST['province'],
			'city'=>(int)$_POST['city'],
			'district'=>(int)$_POST['district'],
			'email'=>$_POST['email'],
			'zipcode'=>$_POST['zipcode'],
			'tel'=>$_POST['tel'],
			'mobile'=>$_POST['mobile'],
			'best_time'=>$_POST['best_time'], //最佳送货时间
			'postscript'=>$_POST['postscript'],//备注

		
			'update_time'=>time(),	//更新时间 
			'suppliers_id'=>$_POST['suppliers_id'], //供应商ID
			'status'=>0, 
			'how_oos'=>'',//	等待所有商品备齐后再发

		);
		$this->db->insertArray('#__delivery_order',$data);
		$delivery_id = $this->db->insertid();		//发货单ID

		$product_lists = $this->getOrderProducts( $order_id );


		$send_number = (array)$_POST['qty'];
		foreach( $product_lists as $k=>$value ){
		//发货单商品
	    $delivery_product = array('delivery_id' => $delivery_id,
 								'product_id' => $value['product_id'],
								'product_sn' => $value['product_sn'],
 								'product_name' => $value['product_name'],
								'brand_name' => $value['brand_name'],
 								'send_number' => (int)$send_number[$k],
								'parent_id' => 0,
								'is_real' => (int)$value['is_real'],
								'product_attr' => $value['params']
								);
		 $this->db->insertArray('#__delivery_items',$delivery_product);
		}

		//修改订单的发货状态
		$data = array('ship_status'=>1,'user_status'=>'shipped');
		$this->db->updateArray('#__order',$data," id='".$order_id."' ");


		//记录发货记录
		$this->log($order_id,'发货','填写发货单，并确认发货');

	}



	//保存退货单信息
	function saveBack(){
		//print_r($_POST);exit;

		$order_id = (int)$_POST['id'];
		//print_r($_POST);exit;
		$data = array(
			'order_id'=>$order_id ,//订单ID
			'uid'=>$this->uid,//会员ID
			'order_sn'=>$_POST['order_sn'],
			'invoice_no'=>$_POST['invoice_no'],	//发票号
			'type'=>'back',
			'add_time'=>time(), //添加时间
			'shipping_id'=>$_POST['shipping_id'],	//货运方式
			'shipping_name'=>$_POST['shipping_name'], //货运公司
			'shipping_sn'=>$_POST['shipping_sn'], //货单号
			'shipping_fee'=>$_POST['shipping_fee'], //货运费用
			'insure'=>$_POST['insure'], //是否投保
			'insure_fee'=>$_POST['insure_fee'], //投保费用

			'action_user'=>$_POST['action_user'], // 订货人
			'consignee'=>$_POST['consignee'],	//收货人
			'address'=>$_POST['address'], //收货地址
			'country'=>(int)$_POST['country'],
			'province'=>(int)$_POST['province'],
			'city'=>(int)$_POST['city'],
			'district'=>(int)$_POST['district'],
			'email'=>$_POST['email'],
			'zipcode'=>$_POST['zipcode'],
			'tel'=>$_POST['tel'],
			'mobile'=>$_POST['mobile'],
			'best_time'=>$_POST['best_time'], //最佳送货时间
			'postscript'=>$_POST['postscript'],//备注
			'reason'=>$_POST['reason'],
		
			'update_time'=>time(),	//更新时间 
			'suppliers_id'=>$_POST['suppliers_id'], //供应商ID
			'status'=>0, 
			'how_oos'=>'',//	等待所有商品备齐后再发

		);
		$this->db->insertArray('#__delivery_order',$data);
		$delivery_id = $this->db->insertid();		//发货单ID

		$product_lists = $this->getOrderProducts( $order_id );


		$send_number = (array)$_POST['qty'];
		foreach( $product_lists as $k=>$value ){
		//发货单商品
	    $delivery_product = array('delivery_id' => $delivery_id,
 								'product_id' => $value['product_id'],
								'product_sn' => $value['product_sn'],
 								'product_name' => $value['product_name'],
								'brand_name' => $value['brand_name'],
 								'send_number' => (int)$send_number[$k],
								'parent_id' => 0,
								'is_real' => (int)$value['is_real'],
								'product_attr' => $value['params']
								);
		 $this->db->insertArray('#__delivery_items',$delivery_product);
		}

		//修改订单的退货状态
		$data = array('ship_status'=>2);
		$this->db->updateArray('#__order',$data," id='".$order_id."' ");

		//记录发货记录
		$this->log($order_id,'退货','填写退货单，并确认退货');

	}


	/**
	 * 保存
	 */
	function save()
	{
		global $app;
	 
 		$data = array(
			'order_status'=>$_REQUEST['order_status'],			//商品名称
			'pay_status'=>$_REQUEST['pay_status'],			//商品型号
 		);


		if( is_array($_REQUEST['params'] ) )	//保存参数列表
		{
			//import('html.format.ini');
			//$data['params'] = FormatINI::arrayToString($_REQUEST['params']);
		}

 		$id = intval( $_REQUEST['id'] );

		if( $id > 0 )
		{
			$this->db->updateArray( $this->tableName, $data , " id='{$id}' " );
 		} 

 
		return true;
	}

	function getLog($id){
		$sql =" select * from #__order_action where order_id=".(int)$id;
		$this->db->query($sql);
		return $this->db->getResult();
	}

	function savestatus(){
		
		global $app;
		$s = trim($_POST['status']);
		

		
		$status = array( 'dead','finish' );

		if( in_array($s,$status) ){
			$data = array(
				'order_status'=>$s, 
			);
 			$id = intval( $_REQUEST['id'] );

			if( $id > 0 )
			{
				$this->db->updateArray( $this->tableName, $data , " id='{$id}' " );
			} 

			if( $s == 'dead' ){
 				$this->log($order_id,'作废','作废订单');
				$app->enqueueMessage(' 已作废 ');
			}else{
				$this->log($order_id,'完成','完成订单');
				$app->enqueueMessage(' 已完成 ');
			}
		
		}
		
		return true;
	}

	/** 删除内容 **/
	function delete($id)
	{	global $app;
		if( $id > 0 )
		{
			

			//删除订单信息
			$sql = "delete from ".$this->tableName." where id=".$id;
			$this->db->query($sql);
  			//删除相关联订单产品
  			$sql = "delete from #__order_goods where order_id=".$id;
			$this->db->query($sql);
			//删除相关联的日志信息
  			$sql = "delete from #__order_action where order_id=".$id;
			$this->db->query($sql);

			//删除相关联的收款单，退款单，退货单信息，发货单
  			$sql = "delete from #__payments where order_id=".$id;
			$this->db->query($sql);

  			$sql = "delete from #__refunds where order_id=".$id;
			$this->db->query($sql);

  			$sql = "delete from #__delivery_items where delivery_id in( select delivery_id from #__delivery_order where order_id=".$id." ) ";
			$this->db->query($sql);

  			$sql = "delete from #__delivery_order where order_id=".$id;
			$this->db->query($sql);

			$app->enqueueMessage(' 删除成功,共删除 1 项.');
			return true;
		}

		return false;
	}

 
 
	/** 全部删除 **/
	function deleleall(){
		global $app;
		$copy_ids =  $this->_filterID( $_REQUEST['ids'] );

 		if( count($copy_ids) )
		{
			$sql = " delete from ".$this->tableName." where id in (".implode(',',$copy_ids).") ";
			//echo $sql;exit;
			$this->db->query($sql); 

  			//删除相关联订单产品
  			$sql = "delete from #__order_goods where order_id in (".implode(',',$copy_ids).") ";
			$this->db->query($sql);

			//删除相关联的日志信息
  			$sql = "delete from #__order_action where order_id  in (".implode(',',$copy_ids).") ";
			$this->db->query($sql);

			//删除相关联的收款单，退款单，退货单信息，发货单
  			$sql = "delete from #__payments where order_id  in (".implode(',',$copy_ids).") ";
			$this->db->query($sql);

  			$sql = "delete from #__refunds where order_id  in (".implode(',',$copy_ids).") ";
			$this->db->query($sql);

  			$sql = "delete from #__delivery_items where delivery_id in( select delivery_id from #__delivery_order where order_id  in (".implode(',',$copy_ids).") ) ";
			$this->db->query($sql);

  			$sql = "delete from #__delivery_order where order_id   in (".implode(',',$copy_ids).") ";
			$this->db->query($sql);


			$app->enqueueMessage(' 删除成功,共删除 '.count($copy_ids).'项.');
		}
		return true;
	}
	
 
	function  _filterID($string){
		if( $string )
		{
			$id_array = explode( ',',$string);
			$copy_ids = array();
			foreach( $id_array as $id )
			{
				if( $id = intval($id) )
				{
					$copy_ids[] = $id;
				}
			}
		}

		return $copy_ids;
	}

	function getNav(){
		return $this->nav;
	}
	/** 修改状态 **/
	function toggle()
	{
		if( ($id = intval($_REQUEST['id']) )>0 && $_REQUEST['attr'] )
		{
			$arr = array( $_REQUEST['attr'] =>$_REQUEST['value'] );
			$this->db->updateArray($this->tableName,$arr," id='".$id."' and uid='".$this->uid."' ");
		}
	}

	/** 修改排序值 **/
	function ordering()
	{
		global $app;
		$id = intval( $_REQUEST['id'] );
		$from = intval( $_REQUEST['from'] );
		$to = intval( $_REQUEST['to'] );
		
		if( $id>0 && $to>0 )
		{
			$sql = "select ordering,menuid from ".$this->tableName." where uid=".$this->uid." and id=".$id;
			$this->db->query($sql);

			$row = $this->db->getRow();
			$from = $row['ordering'];	//更新排序值
			$menuid = $row['menuid'];

			$sql = " select count(*) as n from ".$this->tableName;
			$this->db->query($sql);
			$result = $this->db->getRow();
			
			$count = $result['n'];

			if( $count < $to )
			{
				$app->enqueueMessage(' 排序失败，排序值大于最大值.');
				return false;
			}
			if( $from > $to ){		//向上移
				$sql = " update ".$this->tableName." set ordering = ordering+1 where uid=".$this->uid." and ordering>=".$to." and ordering<".$from;
 			}else if( $from < $to )//向后移
			{
				$sql = " update ".$this->tableName." set ordering = ordering-1 where uid=".$this->uid." and ordering>".$from." and ordering<=".$to;
 			}
			//echo $sql;exit;
			$this->db->query($sql);

			$data = array('ordering'=>$to);
			$this->db->updateArray($this->tableName,$data," uid=".$this->uid." and id=".$id." ");
			$app->enqueueMessage(' 排序成功.');

		}
	}

	//记录订单操作 
	/**
	 * @order_id 订单ID
	 * @order_status 订单的状态
	 * @behavior 操作的行为
	 * @action_note 备注
	 */
	function log($order_id,$behavior,$action_note){
		
		$s = &Factory::getSession();
		$username = $s->get('username');
		$uid = $this->uid;
		$data = array(
			'order_id'=>$order_id,
			'uid'=>$uid,
			'action_user'=>$username,
 			'behavior'=>$behavior,
			'action_note'=>$action_note,
			'log_time'=>time()
				
		);
		$this->db->insertArray(" #__order_action ",$data);
	}


 }



?>