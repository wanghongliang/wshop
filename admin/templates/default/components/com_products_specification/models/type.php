<?php
import('application.component.model');
class TypeModel extends Model
{
	function TypeModel()
	{
		parent::__construct();
		$this->tableName = '#__products_specification';

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

		$sql=" delete from #__products_spec_values where spec_id='".$id."' ";
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
			'spec_type'=>$_POST['spec_type'],
			'spec_show_type'=>$_POST['spec_show_type'],
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

		
		/** 商品属性管理 **/
		$sql = "select * from  #__products_spec_values	 where spec_id='".$id."' ";
		$this->db->query($sql);
		$attr_result = $this->db->getResult('spec_value_id');

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
			$sql = "delete from #__products_spec_values where spec_id='".$id."' and spec_value_id  in (".implode(',',$spec_del).")";
			$this->db->query($sql); 
			 //echo $sql;
		}

		if( count($spec_update)>0 ){
		
			foreach( $spec_update as $k=>$v ){
				//先清除没有值的属性
				$sql = "update #__products_spec_values set spec_value='".$v['spec_value']."',spec_image='".$v['spec_image']."',ordering='".$v['ordering']."' where spec_value_id='".$v['spec_value_id']."'  ";
				$this->db->query($sql); 
 
			}
		}
		//print_r($spec_news);exit;

		if( count($spec_news) > 0 ){
			foreach( $spec_news as $k=>$v ){ 
			$sql = "insert into #__products_spec_values set spec_id='".$id."', spec_value = '".$v['spec_value']."', spec_image='".$v['spec_image']."',ordering='".$v['ordering']."'  ";
			$this->db->query($sql); 
 			}
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