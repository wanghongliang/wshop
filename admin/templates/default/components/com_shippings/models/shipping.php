<?php
import('application.component.model');
class ShippingModel extends Model
{
  	function ShippingModel()
	{
		parent::__construct();
		$this->tableName = '#__shipping';
  	}
	

	/**
	 * 取当前编辑项
	 */
	function getItem()
	{
		$id =intval($_REQUEST['id']);
		if( $id < 1 )
		{

 			$row = array(
 			);

			//print_r($row);
		}else{

			$sql = " select * from ".$this->tableName." where id='".$id."' ";
			$this->db->query($sql);
			$row = $this->db->getRow();	//获取一条数据 
		}
  		
		return $row;
	}

	function getDelivery($id){
		$sql = " select * from #__shopping_area where shipping_id='".(int)$id."' ";
		$this->db->query($sql);
		$rows = $this->db->getResult();	//获取一条数据  
		return $rows;
	}


	/**
	 * 保存
	 */
	function save()
	{
		global $app;

 
		$data = array(
			'name'=>trim($_POST['name']),
			'desc'=>trim($_POST['desc']),
			'protect'=>(int)$_POST['protect'],
			'has_cod'=>(int)$_POST['has_cod'],	//货支付款
			'ordering'=>(int)$_POST['ordering'], 
			'published'=>(int)$_POST['published'],
			'protect_rate'=>round($_POST['protect_rate'],2),
			'minprice'=>round($_POST['minprice'],2),

		);
		
 		$params = array(
			'firstprice'=>round($_POST['firstprice'],2),	
			'firstunit'=>(int)$_POST['firstunit'],	
			'continueprice'=>round($_POST['continueprice'],2),
			'continueunit'=>(int)$_POST['continueunit'],
			'setting'=>$_POST['setting'],	//统一设置费用，还是按地区设置费用
			'dt_useexp'=>$_POST['dt_useexp'], //是否设置公式
			'defAreaFee'=>$_POST['defAreaFee'], //如果是地区设置不同的运费，是否设置默认的地区费用
		);

		if( $params['defAreaFee'] == 1 && $params['setting'] == 'setting_sda' ){
			 $params['firstprice'] = round($_POST['firstprice2'],2); 
			 $params['continueprice'] = round($_POST['continueprice2'],2); 
		}

		$data['config']  = serialize( $params );

		$id=$_REQUEST['id'];
		if($id > 0)
		{
			$this->db->updateArray( $this->tableName, $data , " id='{$id}' " );
		} 
		//unset($data);
		
		$delidgroup = trim( $_POST['delidgroup'],',' );
		if( !empty( $delidgroup ) ){
			$sql =" delete from #__shopping_area where id in (".implode(',',$this->_filterID($delidgroup)).") ";
			$this->db->query($sql);
		}


		//地区配送的选择
		$areaGroupName = $_POST['areaGroupName'];
		$areaGroupConfigName = $_POST['areaGroupConfigName'];
		$areaGroupId = $_POST['areaGroupId'];

		$firstFee = $_POST['firstFee'];
		$continueFee = $_POST['continueFee'];
		$useexp = $_POST['useexp'];

		//地区配送的金额
		$firstFee = $_POST['firstFee'];
		$continueFee = $_POST['continueFee'];


		//已存在的货运方式
		$idgroup = $_POST['idgroup'];
		
		//添加区域信息
		foreach( $areaGroupId as $k=>$v ){
			if( !empty($v) && !empty( $areaGroupName[$k] ) ){
 
				$data = array(
				  'shipping_id'=>$id,
				   'name'=>$areaGroupName[$k], 
				   'areaname_group'=>trim($areaGroupConfigName[$k],','),
				   'areaid_group'=>trim($areaGroupId[$k],','),
				);

				$data['config'] = serialize(array(
					'firstFee'=>$firstFee[$k],
					'continueFee'=>$continueFee[$k],
					'useexp'=>$useexp[$k],
				));

				//更新
				if( $k>0 && in_array($k,$idgroup) ){
					$this->db->updateArray('#__shopping_area',$data," id='".$k."' ");
				}else{ //添加
					$this->db->insertArray('#__shopping_area',$data);
				}
				//exit;
			}
		}

 
		return true;
	}

	/**
	 * 锁定一条记录
	 */
	function lock()
	{
		$id =intval($_REQUEST['id']);
		$lock =intval($_REQUEST['value']);
		
		$sql = " update ".$this->tableName." set published='".$lock."' where id='".$id."' ";
		$this->db->query($sql);
		 		
		return true;
	}

	/** 删除一条记录 **/
	function delete()
	{
		$id =intval($_REQUEST['id']);
		
		$sql = "delete from ".$this->tableName." where id='".$id."'";
		$this->db->query($sql);
		$sql = "delete from #__shopping_area where shipping_id='".$id."'";
		$this->db->query($sql);
		return true;		
	}

	/** 全部删除 **/
	function deleteall(){
		
		global $app;

		$copy_ids =  $this->_filterID( $_REQUEST['ids'] );

 		if( count($copy_ids) )
		{
			$sql = " delete from ".$this->tableName." where  id in (".implode(',',$copy_ids).") ";

			$this->db->query($sql);
			$sql = "delete from #__shopping_area where shipping_id in (".implode(',',$copy_ids).") ";
			$this->db->query($sql);
			$app->enqueueMessage(' 删除成功,共删除 '.count($copy_ids).'项.');
		}
		return true;
	}
	/** 锁定所有 **/
	function lockall(){
		
		global $app;

		$copy_ids =  $this->_filterID( $_REQUEST['ids'] );

 		if( count($copy_ids) )
		{
			$sql = " update ".$this->tableName." set published=0 where  id in (".implode(',',$copy_ids).") ";

			$this->db->query($sql);

			$app->enqueueMessage(' 锁定成功,共锁定 '.count($copy_ids).'项.');
		}
		return true;
	}

	/** 解锁所有 **/
	function unlockall(){
		
		global $app;

		$copy_ids =  $this->_filterID( $_REQUEST['ids'] );

 		if( count($copy_ids) )
		{
			$sql = " update ".$this->tableName." set published=1 where  id in (".implode(',',$copy_ids).") ";

			$this->db->query($sql);

			$app->enqueueMessage(' 解锁成功,共解锁 '.count($copy_ids).'项.');
		}
		return true;
	}

	/**分割ID**/
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

 }
?>