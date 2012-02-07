<?php
import('application.component.model');
class PresentModel extends Model
{
  	function PresentModel()
	{
		parent::__construct();
		$this->tableName = '#__products_activity'; 
  	}
	

	/**
	 * 取当前编辑项
	 */
	function getItem()
	{
		$id =intval($_REQUEST['id']);
 
		$sql = " select a.*,a.img as thumb from ".$this->tableName." as a left join #__products as p on a.products_id=p.id where act_id='".$id."' ";

 		$this->db->query($sql);
		$list['row'] = $this->db->getRow();	//获取一条数据  
		return $list;
	}
	
	function getUser(){
		global $app;
		$sql = "select username,email from #__users where id=".$app->uid;
		$this->db->query($sql);
		return $this->db->getRow();
	}


	/**
	 * 保存
	 */
	function save()
	{
		global $app;
		
		$data = array(
 			'act_name'=>$_POST['act_name'],
			'products_id'=>$_POST['products_id'],
  			'products_name'=>$_POST['products_name'],
			'uid'=>$app->uid, 
			'img'=>$_POST['thumb'],
			'market_price'=>$_POST['market_price'],
			'shop_price'=>$_POST['shop_price'],
			'product_amount'=>$_POST['product_amount'],
			'catid'=>(int)$_POST['catid'],
		);

		
		$thumbs = array();
		import('filesystem.dir');
		import('utilities.image');

		$files = $_FILES['uploadimg'];

		if( !empty($files['name']) ){
			$path = WDir::uploadFile($files,PATH_UPLOAD.DS.$app->uid.DS.'tuan'); 
			thumbIMG($path['file_path'],$path['file_path'],420,280);

			$img_s = substr($path['file_path'],0,-4).'_s.jpg';//.substr($path['file_path'],-4); 
 			thumbIMG($path['file_path'],$img_s,195,130);
			$data['img'] = $path['uri_path'];
		}
				//print_r($f);
 

		import('utilities.date');
		$start_date = new WDate($_POST['start_time']);
		$data['start_time'] = $start_date->_date;
		$end_date = new WDate($_POST['end_time']);
		$data['end_time'] = $end_date->_date;

		$param = array('deposit'=>(int)$_POST['deposit'],
				'restrict_amount'=>(int)$_POST['restrict_amount'],
				'gift_integral'=>(int)$_POST['gift_integral'],
				'ladder_amount'=>$_POST['ladder_amount'],
				'ladder_price'=>$_POST['ladder_price']
			);

		$data['ext_info'] = serialize($param);
		
		$id = (int)$_POST['id'];
 
		if( $id > 0 ){
			$this->db->updateArray( $this->tableName, $data ,"act_id='".$id."' "); 
		}else{
			$data['act_type']=2;
			$this->db->insertArray( $this->tableName, $data ); 
		}
		unset($data);
		return true;
	}

	/**
	 * 锁定一条记录
	 */
	function setstatu()
	{
		$id =intval($_GET['id']);
		$v =intval($_GET['value']);
		
		$sql = " update ".$this->tableName." set is_finished='".$v."' where 	act_id='".$id."' ";
		$this->db->query($sql);
		 		
		return true;
	}

	/** 删除一条记录 **/
	function delete()
	{
		$id =intval($_REQUEST['id']);
		
		$sql = "delete from ".$this->tableName." where 	act_id='".$id."'";
		$this->db->query($sql);

		return true;		
	}

	/** 全部删除 **/
	function deleteall(){
		
		global $app;

		$copy_ids =  $this->_filterID( $_REQUEST['ids'] );

 		if( count($copy_ids) )
		{
			$sql = " delete from ".$this->tableName." where  	act_id in (".implode(',',$copy_ids).") ";

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
			$sql = " update ".$this->tableName." set published=0 where  	act_id in (".implode(',',$copy_ids).") ";

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
			$sql = " update ".$this->tableName." set published=1 where  	act_id in (".implode(',',$copy_ids).") ";

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