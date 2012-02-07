<?php
import('application.component.model');
class PaymentModel extends Model
{
  	function PaymentModel()
	{
		parent::__construct();
		$this->tableName = '#__plugins';
  	}
	

	/**
	 * 取当前编辑项
	 */
	function getItem()
	{
		$id =intval($_REQUEST['id']);
		if( $id < 1 )
		{

 			$row = array(
 			);

			//print_r($row);
		}else{

			$sql = " select * from ".$this->tableName." where id='".$id."' ";
			$this->db->query($sql);
			$row = $this->db->getRow();	//获取一条数据

 			$xmlFile = PATH_PLUGINS.DS.$row['folder'].DS.$row['element'].DS.$row['element'].'.xml';
			//分析属性
			if( file_exists( $xmlFile ) )	//分析对应的参数
			{	
				import('html.parameter'); 
				$parameter = new Parameter( $xmlFile );
				$parameter->bind( $row['params'] );		 
				$row['parameter'] = $parameter->render();
				unset($parameter,$xmlFile);
			}else{
				$row['parameter']='<i>此项没有对应的参数.</i>';
			}

		}
  		
		return $row;
	}

	/**
	 * 保存
	 */
	function save()
	{
		global $app;

 
		$data = array();
 		if( is_array($_REQUEST['params'] ) )	//保存参数列表
		{
			import('html.format.ini');
			$data['params'] = FormatINI::arrayToString($_REQUEST['params']);
		}

		$id=$_REQUEST['id'];
		if($id > 0)
		{
			$this->db->updateArray( $this->tableName, $data , " id='{$id}' " );
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
		
		$sql = " update ".$this->tableName." set published='".$lock."' where id='".$id."' ";
		$this->db->query($sql);
		 		
		return true;
	}

	/** 删除一条记录 **/
	function delete()
	{
		$id =intval($_REQUEST['id']);
		
		$sql = "delete from ".$this->tableName." where id='".$id."'";
		$this->db->query($sql);

		return true;		
	}

	/** 全部删除 **/
	function deleteall(){
		
		global $app;

		$copy_ids =  $this->_filterID( $_REQUEST['ids'] );

 		if( count($copy_ids) )
		{
			$sql = " delete from ".$this->tableName." where  id in (".implode(',',$copy_ids).") ";

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
			$sql = " update ".$this->tableName." set published=0 where  id in (".implode(',',$copy_ids).") ";

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
			$sql = " update ".$this->tableName." set published=1 where  id in (".implode(',',$copy_ids).") ";

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