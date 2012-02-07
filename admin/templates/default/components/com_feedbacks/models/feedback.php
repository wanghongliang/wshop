<?php
import('application.component.model');
class FeedbackModel extends Model
{
  	function FeedbackModel()
	{
		parent::__construct();
		$this->tableName = '#__feedbacks';
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

	/**
	 * 保存
	 */
	function save()
	{
		global $app;

		if($_REQUEST['reply_content']!='')
		{
			$reply_date=$_REQUEST['reply_date'];

			if($_REQUEST['reply_date']=='')
			{
				$reply_date=date("Y-m-d H:i:s");
			}
		}else{
			$reply_date='';
		}
		
		$data = array(
			'title'=>$_REQUEST['title'],
			'content'=>$_REQUEST['content'],
			'author'=>$_REQUEST['author'],
			'release_date'=>$_REQUEST['release_date'],
			'company'=>$_REQUEST['company'],
			'phone'=>$_REQUEST['phone'],
			'email'=>$_REQUEST['email'],
			'address'=>$_REQUEST['address'],
			'reply_content'=>$_REQUEST['reply_content'],
			'reply_date'=>$reply_date,
			'reply_author'=>$_REQUEST['reply_author'],
			'published'=>$_REQUEST['published']
 		);
		$id=$_REQUEST['id'];
		if($id > 0)
		{
			$this->db->updateArray( $this->tableName, $data , " id='{$id}' " );
		}else{
			$this->db->insertArray( $this->tableName, $data );
		}
 		
		unset($data);
		return true;
	}

	/**
	 * 锁定一条记录
	 */
	function lock()
	{
		$id =intval($_REQUEST['id']);
		$lock =1-intval($_REQUEST['published']);
		
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