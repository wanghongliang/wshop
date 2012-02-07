<?php
import('application.component.model');
class MenutypeModel extends Model
{
	function MenutypeModel()
	{
		parent::__construct();
		$this->tableName = '#__menu_types';

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

		$sql = " select * from ".$this->tableName." where uid=".$this->db->Quote($this->uid)." and id='".$id."' ";
		$this->db->query($sql);
		return $this->db->getRow();
	}
	/**
	 * 删除
	 */
	function delete($id)
	{

		global $app;
		$sql=" select count(*) as n from #__menu where  uid=".$this->db->Quote($this->uid)." and tid='".$id."' ";
		$this->db->query($sql);
		$row = $this->db->getRow();

		if( $row['n'] > 0 ){
			//有子菜单
			$app->enqueueMessage(' 删除失败，请先删除当前分类下的所有菜单.','error');
			return false;
		}

		$sql=" delete from ".$this->tableName." where  uid=".$this->db->Quote($this->uid)." and id='".$id."' ";
		$this->db->query($sql);


		$sql=" delete from #__menu where  uid=".$this->db->Quote($this->uid)." and tid='".$id."' ";
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
			'title'=>$_REQUEST['title'],
			'ordering'=>$_REQUEST['ordering'],
			'description'=>$_REQUEST['description']
		);

 		$id = intval( $_REQUEST['id'] );

		if( $id > 0 )
		{
			$this->db->updateArray($this->tableName,$data," id='$id' " );
 		}else{
			$data['uid'] = $app->uid;
			$this->db->insertArray($this->tableName,$data);
 		}
		return true;
	}

}
?>