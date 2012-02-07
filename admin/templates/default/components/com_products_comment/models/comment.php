<?php
import('application.component.model');
class CommentModel extends Model
{
  	function CommentModel()
	{
		parent::__construct();
		$this->tableName = '#__products_comment';
  	}
	

	/**
	 * 取当前编辑项
	 */
	function getItem()
	{
		$id =intval($_REQUEST['id']);
 
		$sql = " select cm.*,p.name as product_name,p.thumbnail from ".$this->tableName." as cm left join #__products as p on cm.products_id=p.id  where comment_id='".$id."' ";
		$this->db->query($sql);
		$list['row'] = $this->db->getRow();	//获取一条数据 

		$sql = "select * from ".$this->tableName." where parent_id=".$id;
		$this->db->query($sql);
		$list['replay'] = $this->db->getResult();

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
 			'content'=>$_POST['reply_content'],
			'products_id'=>$_POST['products_id'],
			'author'=>$_POST['reply_name'],
			'email'=>$_POST['reply_email'],
 			'parent_id'=>$_POST['id'],
			'uid'=>$app->uid,
			'created'=>time(),
 		); 

		$reply_id = (int)$_POST['reply_id'];
		if( $reply_id > 0 ){
			$this->db->updateArray( $this->tableName, $data ," comment_id='".$reply_id."' "); 
		}else{
			//$this->db->updateArray( $this->tableName, array(''=>1) ," comment_id='".(int)$_POST['id']."' "); 
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
		
		$sql = " update ".$this->tableName." set published='".$lock."' where 	comment_id='".$id."' ";
		$this->db->query($sql);
		 		
		return true;
	}

	/** 删除一条记录 **/
	function delete()
	{
		$id =intval($_REQUEST['id']);
		
		$sql = "delete from ".$this->tableName." where 	comment_id='".$id."' or parent_id = '".$id."' ";
		$this->db->query($sql);

		return true;		
	}

	/** 全部删除 **/
	function deleteall(){
		
		global $app;

		$copy_ids =  $this->_filterID( $_REQUEST['ids'] );

 		if( count($copy_ids) )
		{
			$sql = " delete from ".$this->tableName." where  	comment_id in (".implode(',',$copy_ids).") or parent_id in (".implode(',',$copy_ids).") ";

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
			$sql = " update ".$this->tableName." set published=0 where  	comment_id in (".implode(',',$copy_ids).") ";

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
			$sql = " update ".$this->tableName." set published=1 where  	comment_id in (".implode(',',$copy_ids).") ";

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