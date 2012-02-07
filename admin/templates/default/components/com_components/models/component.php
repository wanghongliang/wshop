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
	 * ȡ��ǰ�༭��
	 */
	function getItem()
	{
		$id =intval($_REQUEST['id']);
		if( $id < 1 )
		{
			Error::throwError('��Ч��ID!');
		}

		$sql = " select * from ".$this->tableName." where id='".$id."' ";
		$this->db->query($sql);

		$row = $this->db->getRow();	//��ȡ�˵�������
 
		return $row;
	}

	/**
	 * ����
	 */
	function save()
	{
		global $app;
	 
		$data = array(
			'title'=>$_REQUEST['title'],
			'fulltext'=>$_REQUEST['fulltext']
		);
		
		if( is_array($_REQUEST['params'] ) )	//��������б�
		{
			//import('html.format.ini');
			//$data['params'] = FormatINI::arrayToString($_REQUEST['params']);
		}

		$parent_id = intval($_REQUEST['parent_id']);	//����Ŀ��ID
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


	/** ɾ������ **/
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