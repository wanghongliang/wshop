<?php
import('application.component.model');
class TypeModel extends Model
{
	function TypeModel()
	{
		parent::__construct();
		$this->tableName = '#__products_type';

	}
	
	function getList()
	{
 
		
	}
	/**
	 * 取当前编辑项
	 */
	function getItem()
	{
 		$id =intval($_REQUEST['id']);
		if( $id < 1 )
		{
			Error::throwError('无效的ID!');
		}

		$sql = " select * from ".$this->tableName." where  id='".$id."' ";
		$this->db->query($sql);
		return $this->db->getRow();
	}
	/**
	 * 删除
	 */
	function delete($id)
	{

		global $app;
 
		$sql=" delete from ".$this->tableName." where  id='".$id."' ";
		$this->db->query($sql);

		$sql=" delete from #__products_attribute where   type_id='".$id."' ";
		$this->db->query($sql);
		$app->enqueueMessage(' 删除成功.');
 	}

	/**
	 * 保存
	 */
	function save()
	{
		global $app;
		$data = array(
			'name'=>$_POST['name'],
 		);

 		$id = intval( $_REQUEST['id'] );

		if( $id > 0 )
		{
			$this->db->updateArray($this->tableName,$data," id='$id' " );
 		}else{ 
			$data['published'] = 1;
			$this->db->insertArray($this->tableName,$data);
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