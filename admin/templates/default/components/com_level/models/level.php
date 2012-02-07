<?php
import('application.component.model');
class LevelModel extends Model
{
	function LevelModel()
	{
		parent::__construct();
		$this->tableName = '#__level';

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
			'discount'=>(int)$_POST['discount'],
			'point'=>(int)$_POST['point'],
 			'defaulted'=>(int)$_POST['defaulted'],
  		);

 		$id = intval( $_REQUEST['id'] );

		//当前的会员等级如果为默认，就把其它的等级设为不是
		if( $data['defaulted'] == 1 ){
			$this->db->query( 'update '.$this->tableName.' set defaulted=0 ');
		}
		if( $id > 0 )
		{
			$this->db->updateArray($this->tableName,$data," id='$id' " );
 		}else{ 
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