<?php
import('application.component.model');
class AttributeModel extends Model
{
	function AttributeModel()
	{
		parent::__construct();
		$this->tableName = '#__products_attribute';

	}
	
	function getList()
	{
 
		
	}
	function getSpec($id)
	{
		$data = array();
		if( $id > 0 ){
			$sql = " select * from #__products_attr_values where attr_id='".$id."' order by ordering ";
			$this->db->query($sql);
			$data = $this->db->getResult();
			 
		}
		return $data;
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

		$sql = " select * from ".$this->tableName." where  attr_id='".$id."' ";
		$this->db->query($sql);
		return $this->db->getRow();
	}

	function getType(){
		$sql = " select * from #__products_type  ";
		$this->db->query($sql);
		$rows = $this->db->getResult();
		$data = array();
		foreach( $rows as $row ){
			$data[$row['id']] = $row['name'];
		}
		return $data;
	}

	/**
	 * 删除
	 */
	function delete($id)
	{
 		$sql = "delete from ".$this->tableName." where attr_id='".(int)$_GET['id']."' ";
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
			$this->db->updateArray($this->tableName,$data," attr_id=".$id." ");
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
			'attr_name'=>$_POST['attr_name'],
			'type_id'=>$_POST['type_id'],
			'attr_type'=>$_POST['attr_type'],
			'attr_input_type'=>$_POST['attr_input_type'],
			'attr_values'=>$_POST['attr_values'], 
			'ordering'=>$_POST['ordering'],
 		);

 		$id = intval( $_POST['id'] );
		if( $id > 0 )
		{
			$this->db->updateArray($this->tableName,$data," attr_id='$id' " );
 		}else{  
			$this->db->insertArray($this->tableName,$data);
			$id = $this->db->insertid();
 		}


		
		/** 商品属性管理 **/
		$sql = "select * from  #__products_attr_values	 where attr_id='".$id."' ";
		$this->db->query($sql);
		$attr_result = $this->db->getResult('value_id');

		//商品规格
		$spec_value = (array)$_POST['spec_value'];
		$spec_ids = (array)$_POST['spec_id_list'];
		$spec_image = (array)$_POST['spec_image'];	
		
		//print_r($spec_value);exit;
 		$spec_news =  $spec_update  = $spec_del = array();

		foreach( $spec_value as $k=>$value ){
			$spec_id = $spec_ids[$k]; 
			//是否已经添加的该规格值
			if( $attr_result[$spec_id] ){
				//更新
				if( $spec_image[$k] || $value ){
					$spec_update[]= array(
						'spec_value_id'=>$spec_id,
						'spec_value'=>$value,
						'spec_image'=>$spec_image[$k], 
						'ordering'=>$k,
					);

					//print_r($spec_update);
				}else{
					$spec_del[]=$spec_id;
				}
			}else{
				$spec_news[] = array( 
					'spec_value'=>$value,
					'spec_image'=>$spec_image[$k], 
					'ordering'=>$k,
				);
			}
		}
			//print_r($spec_del);


		//如果设置相关属性值，则进行更新操作
		if( count($spec_del)>0 ){

			//print_r($spec_del);

			//先清除没有值的属性
			$sql = "delete from #__products_attr_values where attr_id='".$id."' and value_id  in (".implode(',',$spec_del).")";
			$this->db->query($sql); 
			 //echo $sql;
		}

		if( count($spec_update)>0 ){
		
			foreach( $spec_update as $k=>$v ){
				//先清除没有值的属性
				$sql = "update #__products_attr_values set value='".$v['spec_value']."',image='".$v['spec_image']."',ordering='".$v['ordering']."' where value_id='".$v['spec_value_id']."'  ";
				$this->db->query($sql); 
 
			}
		}
		//print_r($spec_news);exit;

		if( count($spec_news) > 0 ){
			foreach( $spec_news as $k=>$v ){ 
			$sql = "insert into #__products_attr_values set attr_id='".$id."', value = '".$v['spec_value']."', image='".$v['spec_image']."',ordering='".$v['ordering']."'  ";
			$this->db->query($sql); 
 			}
		}   


		//更新属性列表值
		$sql="select value_id,value from #__products_attr_values where attr_id='".$id."' ";
		$this->db->query($sql);
		$data = $this->db->getResult();
		
 		if( count($data) > 0 ){
			$attr_values = array();
			foreach( $data as $k=>$v ){
				$attr_values[] = $v['value_id'].':'.$v['value'];
			}
			$sql = "update ".$this->tableName." set attr_values='".implode("\n", $attr_values )."' where attr_id='".$id."' ";
			$this->db->query($sql);
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