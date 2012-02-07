<?php
import('application.component.model');
class TemplatesModel extends Model
{
	var $nav = null;
	var $client_id=0;


 	function TemplatesModel()
	{
		parent::__construct();
		$this->tableName = '#__modules';
		$this->client_id = intval($_REQUEST['client_id']);

 	}
	function getList()
	{
		
		global $app;	
		import('filesystem.dir');
		import('filesystem.xml');
		$dir = new WDir();

		if( $this->client_id == 0 ){
			$directory = PATH_PREVIEW.DS.'templates';
			
			//PATH_PREVIEW.DS.'modules';

		}else{
			$directory = PATH_BASE.DS.'templates';
		}

		//取出当前会员的配置信息
		$sql ="select template from #__configs where uid='".$app->uid."' ";
		$this->db->query($sql);
		$row = $this->db->getRow();
 
		$template = $row['template']?$row['template']:'default';
		unset($row);

		$modules = array();
		if( $data = $dir->getFolders($directory) ){
			foreach( $data as $mod ){
				$xmlFile = $directory.DS.$mod['name'].DS.$mod['name'].'.xml';
				$params = array();
				if( file_exists($xmlFile) ){
					$params = XML_unserialize( file_get_contents($xmlFile) );
					//print_r($params);
					$title = $params['install']['name'];
				}else{
					$title = $mod['name'];
				}

				//是否为默认的模板文件
				if( $mod['name'] == $template  ){
					$isDefault = 1;
				}else{
					$isDefault = 0;
				}

				$modules[] = array(
					'name'=>$mod['name'],
					'author'=>$params['install']['author'],
					'creationDate'=>$params['install']['creationDate'],
 					'title'=>$title,
					'description'=>'',
					'default'=>$isDefault
				);
			}
			unset( $data, $xmlFile, $params ,$title );
		}
		unset( $dir ,$directory );

		return $modules;
	}

	function getNav()
	{
		if( !$this->nav )
		{
			$this->getList();
		}
		return $this->nav;
	}
}
?>