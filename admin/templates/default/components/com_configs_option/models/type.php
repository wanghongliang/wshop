<?php
import('application.component.model');
class TypeModel extends Model
{
	function TypeModel()
	{
		parent::__construct();
		$this->tableName = '#__configs_option';

	}
	
	function getSpec($id)
	{
		$data = array();
		if( $id > 0 ){
			$sql = " select * from #__products_spec_values where spec_id='".$id."' order by ordering ";
			$this->db->query($sql);
			$data = $this->db->getResult(); 
		}
		return $data;
	}

	function getCom(){
		$data = array();
		$sql = " select c.option, c.name from #__components as c where c.enabled=1 ";

 		$this->db->query($sql);
		$data = $this->db->getResult(); 
		return $data;
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
 
		$app->enqueueMessage(' 删除成功.');
 	}

	/**
	 * 保存
	 */
	function save()
	{
		global $app;

		
		$attr = array(
			'opt_field'=>$_POST['opt_field'],
			'opt_name'=>$_POST['opt_name'],
			'opt_way'=>$_POST['opt_way'],
			'opt_value'=>$_POST['opt_value'],
			'opt_remark'=>$_POST['opt_remark']
		);
		$data = array(
			'name'=>$_POST['name'],
			'com_name'=>$_POST['com_name'],
			'attr_group'=>serialize($attr),
 		);

 		$id = intval( $_REQUEST['id'] );

		if( $id > 0 )
		{
			$this->db->updateArray($this->tableName,$data," id='$id' " );
 		}else{ 
			$data['published'] = 1;
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