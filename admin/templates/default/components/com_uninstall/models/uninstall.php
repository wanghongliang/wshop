<?php
import('application.component.model');
class UninstallModel extends Model
{
	var $client_id = 0;

	
	function UninstallModel()
	{
		parent::__construct();
		$this->tableName = '#__modules';
		$this->client_id = intval($_REQUEST['client_id']);
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
		global $app;
		if( $id > 0 )
		{
			switch( $_REQUEST['type'] )
			{
				case 'component':

					$sql = "select m.option from #__components as m where ( id=".$id." or parent=".$id." ) and uid=".$this->uid;
					$this->db->query($sql);
					if( $row = $this->db->getRow() )
					{
						$com_admin = dirname(PATH_COMPONENT).DS.'com_'.$row['option'];
						$com = PATH_PREVIEW.DS.'components'.DS.'com_'.$row['option'];

						import('filesystem.dir');$dir = WDir::getInstance();
						if( is_dir( $com_admin ) ){
							$dir->deleteDir($com_admin);
						}

						if( is_dir( $com ) ){
							$dir->deleteDir($com);
						}
						$sql = "delete from #__components where id=".$id." and uid=".$this->uid;
						$this->db->query($sql);
						return true;
					}

					break;
				default:
				
				if( $_REQUEST['type'] && $_REQUEST['type']!='module' ){ return; } //�Ƿ�Ϊ�������� ?

				$sql = "select module from ".$this->tableName." where id=".$id." and uid=".$this->uid;
				$this->db->query($sql);
				if( $row = $this->db->getRow() )
				{
					if( $this->client_id == 0 ){
						$mod_directory = $app->getPreviewModulePath().DS.$row['module'];//.DS.$row['module'].DS.$row['module'].'.xml';
					}else{
						$mod_directory = PATH_BASE.DS.'modules'.DS.$row['module'];//.DS.$row['module'].DS.$row['module'].'.xml';
					}



					if( file_exists( $mod_directory ) ){
						import('filesystem.dir');
						$dir = WDir::getInstance();
						$dir->deleteDir($mod_directory);
					}
					$sql = "delete from ".$this->tableName." where module='".$row['module']."' and uid=".$this->uid;
					$this->db->query($sql);
					return true;
			 

				}

				

			}



			

		}

		return false;
	}

 }
?>