<?php
import('application.component.model');
class AccessoriesModel extends Model
{
	var $menuid;

	var $nav = null;
	function AccessoriesModel()
	{
		parent::__construct();
		$this->tableName = '#__products_accessories';
		$this->menuid = intval($_REQUEST['menuid']);
	}
	
	function dispath(){

		$task = trim($_GET['act']);
		switch($task){
			case 'add':
				$this->add();
				break;

			case 'del':
				$this->del();
				break;

		}

	}

	function add(){
			//是否有附件信息
		$download_file = trim($_REQUEST['new_downloads'],',');
		$files = explode(',',$download_file);
 		if( count($files)>0 ){
			$file = explode('|',$files);
			if( $file[0] && $file[1] && $file[2] ){
				$data = array(
					'name'=>$file[0],
					'type'=>$file[1],
					'file_path'=>$file[2]
				);

				print_r($data);
			}
 		}
	}

	function del(){
		$id =intval($_GET['file_id']);
		
		if( $id > 0 ){
			$sql ="select file_path from #__products_accessories where id=".$id;
			$this->db->query($sql);

			$row = $this->db->getRow();
			$file = PATH_ROOT.str_replace('/',DS,$row['file_path']);
			if( file_exists($file) ){
				@unlink($file);
			}
			
 			$sql ="delete from #__products_accessories where id=".$id;
			$this->db->query($sql);
		}
		return true;
	}

}
?>