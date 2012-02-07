<?php
import('application.component.model');
class QuestionModel extends Model
{
	function QuestionModel()
	{
		parent::__construct();
		$this->tableName = '#__questions'; 
	}
	
	function getList()
	{
 
		
	} 
	/**
	 * 取当前编辑项
	 */
	function getItem()
	{
 		$id =intval($_GET['id']);
		if( $id < 1 )
		{
			Error::throwError('无效的ID!');
		}

		$sql = " select * from ".$this->tableName." where id='".$id."' ";
		$this->db->query($sql);
		return $this->db->getRow();
	}
 

	/**
	 * 删除
	 */
	function delete($id)
	{
 		$sql = "delete from ".$this->tableName." where id='".(int)$_GET['id']."' ";
		$this->db->query($sql);	 
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

			$data = array('ordering'=>$to);
			$this->db->updateArray($this->tableName,$data," id=".$id." ");
			$app->enqueueMessage(' 排序成功.');

		}
	}
	/**
	 * 保存
	 */
	function save()
	{
		global $app;
		$data = array(
			'title'=>$_POST['title'],
			'published'=>$_POST['published'], 
			'ordering'=>$_POST['ordering'],'defaulted'=>$_POST['defaulted'],
 		);


		$options =  $_POST['value'] ;
		$data['contents'] = serialize( $options );
		
 
   		$id = intval( $_POST['id'] );
		if( $id > 0 )
		{
			$this->db->updateArray($this->tableName,$data," id='$id' " );
 		}else{  
			$this->db->insertArray($this->tableName,$data);
			$id = $this->db->insertid();
 		}

		return true;
	}
	/** 修改状态 **/
	function toggle()
	{
		if( ($id = intval($_REQUEST['id']) )>0 && $_REQUEST['attr'] )
		{
			$arr = array( $_REQUEST['attr'] =>$_REQUEST['value'] );
			$this->db->updateArray($this->tableName,$arr," id='".$id."' ");
		}
	}
}
?>