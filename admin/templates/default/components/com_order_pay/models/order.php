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
			$sql = "select o.*,u.username from ".$this->tableName." as o left join #__users as u on u.id=o.mid where o.id=".$id;
 			$this->db->query($sql);
			$order_data = $this->db->getRow(); 
		}
	 
		return $order_data;

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
			'uid'=>$this->uid,//会员ID
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
 	}

	//保存退款信息
	function saveRefund(){
		$order_id = (int)$_POST['id'];
		//print_r($_POST);exit;
		$data = array(
			'order_id'=>$order_id ,//订单ID
			'uid'=>$this->uid,//会员ID
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

		//修改订单的支付状态
		$data = array('ship_status'=>1,'user_status'=>'shipped');
		$this->db->updateArray('#__order',$data," id='".$order_id."' ");
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

		//修改订单的支付状态
		$data = array('ship_status'=>2);
		$this->db->updateArray('#__order',$data," id='".$order_id."' ");
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


	/** 删除内容 **/
	function delete($id)
	{
		if( $id > 0 )
		{

			//删除前，先把其它排序值减一
			$sql = "select ordering,menuid from ".$this->tableName." where uid=".$this->uid." and id=".$id;
			$this->db->query($sql);
			$row = $this->db->getRow();
			$sql =" update ".$this->tableName." set ordering = ordering-1 where ordering > ".$row['ordering'];
			$this->db->query($sql);

			$sql = "delete from ".$this->tableName." where id=".$id." and uid=".$this->uid;
			$this->db->query($sql);

			$sql = "delete from #__products_accessories where product_id=".$id." and uid=".$this->uid;
			$this->db->query($sql);


			return true;
		}

		return false;
	}


	/** 移动所选择的文章到指定菜单 **/
	function moveall()
	{
		global $app;
		$ids =  $this->_filterID( $_REQUEST['ids'] );
		$moveToID = intval(  $_REQUEST['movetoid'] );
 		if( count($ids) && $moveToID>0 )
		{
			$sql = " update ".$this->tableName." set menuid=".$moveToID." where uid = ".$this->uid." and id in (".implode(',',$ids).") ";
			//echo $sql;exit;
			$this->db->query($sql);

			$app->enqueueMessage(' 移动成功,共移动 '.count($ids).'项.');
		}
		return true;
	}

	/** 拷贝一份 **/
	function copy()
	{
 		global $app;
		$copy_ids = &$this->_filterID( $_REQUEST['ids'] );
		if( count($copy_ids) )
		{
			$sql = " select * from ".$this->tableName." where id in (".implode(',',$copy_ids).") ";
			$this->db->query($sql);
			$rows = $this->db->getResult();
			foreach( $rows as $row )
			{
				unset($row['id']);
				$row['title'] = "新建 ".$row['title'];
				$row['introtext'] = addslashes($row['introtext']);
				$row['fulltext'] = addslashes($row['fulltext']);
				//$row['ordering'] =  (int)($this->getNextOrder(" position='".$row['position']."' "));
				$this->db->insertArray( $this->tableName,$row );

 			}

			$this->reorder();	//重新排序

			$app->enqueueMessage(' 复制成功,共复制 '.count($copy_ids).'项.');
		}
 		return true;
	}
	/** 全部删除 **/
	function deleleall(){
		global $app;
		$copy_ids =  $this->_filterID( $_REQUEST['ids'] );

 		if( count($copy_ids) )
		{
			$sql = " delete from ".$this->tableName." where uid = ".$this->uid." and id in (".implode(',',$copy_ids).") ";
			//echo $sql;exit;
			$this->db->query($sql);

			$this->reorder();	//重新排序


			$app->enqueueMessage(' 删除成功,共删除 '.count($copy_ids).'项.');
		}
		return true;
	}
	
	function movetorecycle()
	{
		global $app;
		$copy_ids =  $this->_filterID( $_REQUEST['ids'] );

 		if( count($copy_ids) )
		{
			$sql = " update ".$this->tableName." set menuid=0 where uid = ".$this->uid." and id in (".implode(',',$copy_ids).") ";
			//echo $sql;exit;
			$this->db->query($sql);
			$app->enqueueMessage(' 放入回收站成功,共移动 '.count($copy_ids).'项.');
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


 }



?>