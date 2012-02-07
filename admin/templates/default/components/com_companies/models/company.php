<?php
import('application.component.model');
class CompanyModel extends Model
{
	var $menuid = 0;

	var $nav = null;
	function CompanyModel()
	{
		parent::__construct();
		$this->tableName = '#__companies';
		$this->menuid = intval($_REQUEST['menuid']);
	}
	/**
	 * 取当前编辑项
	 */
	function getItem()
	{
 
		$sql = " select * from ".$this->tableName." where uid='".$this->uid."' ";

 		$this->db->query($sql);
		$row = $this->db->getRow();	//获取菜单项数据
		return $row;
	}

	function save()
	{
		global $app;
	 
		$data = array(
			'name'=>$_REQUEST['name'],
			'contact'=>$_REQUEST['contact'],
			'contact_jobs'=>$_REQUEST['contact_jobs'],
			'phone'=>$_REQUEST['phone'],
			'mobile'=>$_REQUEST['mobile'],
			'fax'=>$_REQUEST['fax'],	
			'http'=>$_REQUEST['http'],
			'address'=>$_REQUEST['address'],
 		);
		
		if( is_array($_REQUEST['params'] ) )	//保存参数列表
		{
			//import('html.format.ini');
			//$data['params'] = FormatINI::arrayToString($_REQUEST['params']);
		}

 		$id = intval( $_REQUEST['id'] );
		if( $id > 0 )
		{
			$this->db->updateArray( $this->tableName, $data , " id='{$id}' " );
 		}else{
 			$data['uid'] = $this->uid;
			$this->db->insertArray( $this->tableName, $data  );
 		}


		$app->enqueueMessage(' 保存成功.');

		return true;
	}


  }



?>