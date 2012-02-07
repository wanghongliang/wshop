<?php
import('application.component.model');
class CouponModel extends Model
{
	function CouponModel()
	{
		parent::__construct();
		$this->tableName = '#__coupons';

	}
	
	function getLevel()
	{
		$sql="select id,name from #__level ";
		$this->db->query($sql);
		return $this->db->getResult();
		
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
		$params = serialize( (array)$_POST['param'] );

		$data = array(
			'name'=>$_POST['name'],
			'remark'=>$_POST['remark'],
  			'published'=>(int)$_POST['published'],
			'act_type'=>(int)$_POST['act_type'],
			'params'=>$params,
  		);
		import('utilities.date');
		$start_date = new WDate($_POST['start_time']);
		$data['start_time'] = $start_date->_date;
		$end_date = new WDate($_POST['end_time']);
		$data['end_time'] = $end_date->_date;


 		$id = intval( $_REQUEST['id'] );
 
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