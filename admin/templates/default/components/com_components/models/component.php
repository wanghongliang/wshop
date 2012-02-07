<?php
import('application.component.model');
class ComponentModel extends Model
{
 	function ComponentModel()
	{
		parent::__construct();
		$this->tableName = '#__components';
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

		$sql = " select * from ".$this->tableName." where id='".$id."' ";
		$this->db->query($sql);

		$row = $this->db->getRow();	//获取菜单项数据
 
		return $row;
	}

	/**
	 * 保存
	 */
	function save()
	{
		global $app;
	 
		$data = array(
			'title'=>$_REQUEST['title'],
			'fulltext'=>$_REQUEST['fulltext']
		);
		
		if( is_array($_REQUEST['params'] ) )	//保存参数列表
		{
			//import('html.format.ini');
			//$data['params'] = FormatINI::arrayToString($_REQUEST['params']);
		}

		$parent_id = intval($_REQUEST['parent_id']);	//父栏目的ID
		$id = intval( $_REQUEST['id'] );

		if( $id > 0 )
		{
			$this->db->updateArray( $this->tableName, $data , " id='{$id}' " );
 		}else{
			$data['menuid'] = $this->menuid;
			$data['uid'] = $this->uid;
			$this->db->insertArray( $this->tableName, $data  );
 		}
		return true;
	}


	/** 删除内容 **/
	function delete($id)
	{
		if( $id > 0 )
		{
			$sql = "delete from ".$this->tableName." where ( id=".$id." or parent=".$id." ) and uid=".$this->uid;
			$this->db->query($sql);
			return true;
		}

		return false;
	}

 }
?>