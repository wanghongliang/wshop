<?php
import('application.component.model');
class UninstallsModel extends Model
{
	var $client_id=0;
	var $nav = null;
	function UninstallsModel()
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
		$dir = WDir::getInstance();

 		if( $this->client_id == '0' ){
			$mod_directory = $app->getPreviewModulePath();//.DS.$row['module'].DS.$row['module'].'.xml';
		}else{
			$mod_directory = PATH_BASE.DS.'modules';//.DS.$row['module'].DS.$row['module'].'.xml';
		}



		$where = " where uid =".$this->uid." and client_id=".$this->client_id;
		$where .=" group by module ";
		import('html.navigations');
		$sql = " select id from ".$this->tableName;
		$sql .= $where;

		
		$this->db->query($sql);


		$n = $this->db->getNumRows();

 		$this->nav = new Navigations(20,$n);
		

 
 		$sql = " select * from ".$this->tableName;
		$sql .= $where;
		$sql .= " order by id desc ";
		$sql.= $this->nav->getLimit($_REQUEST['page']);
		$this->db->query($sql);
		$rows = $this->db->getResult();


		//echo $mod_directory;
		$folders = $dir->getFolders($mod_directory);
 		settype( $folders, 'array' );

		$rows2= array();
		foreach( $folders as $folder )
		{
			$rows2[$folder['name']] = $folder['name'];
		}
		
		foreach( $rows as $k=> $row )
		{
			unset($rows2[$row['module']]);	//去已存在的模块
			$xmlFile = $mod_directory.DS.$row['module'].DS.$row['module'].'.xml';
			if( file_exists( $xmlFile ) )
			{
				$data = &XML_unserialize( file_get_contents( $xmlFile ) );

				//print_r($data);exit;
				//模块
				$rows[$k] = array_merge($row,array(
					
					'author'=>$data['install']['author'],
					'creationDate'=>$data['install']['creationDate'],
					'copyright'=>$data['install']['copyright'],					'license'=>$data['install']['license'],
					'authorEmail'=>$data['install']['authorEmail'],					'authorUrl'=>$data['install']['authorUrl'],
					'version'=>$data['install']['version'],					'description'=>$data['install']['description']
				 
				));
			}else{
				$rows[$k] = array_merge($row,array(
					
					'author'=>' - ',
					'creationDate'=>' - ',
					'copyright'=>' - ',		
					'license'=>' - ',
					'authorEmail'=>' - ',	
					'authorUrl'=>' - ',
					'version'=>' - ',		
					'description'=>' - '
				));
			}
			
		}


		if( count( $rows2 ) > 0 )
		{
			foreach( $rows2 as $k=>$v )
			{
				$xmlFile = $mod_directory.DS.$v.DS.$v.'.xml';
				if( file_exists( $xmlFile ) )
				{
					$data = &XML_unserialize( file_get_contents( $xmlFile ) );

					//print_r($data);exit;
					//模块
					$rows[] = array(
						'title'=>$data['install']['name'],
						'module'=>$v,
						'author'=>$data['install']['author'],
						'creationDate'=>$data['install']['creationDate'],
						'copyright'=>$data['install']['copyright'],					'license'=>$data['install']['license'],
						'authorEmail'=>$data['install']['authorEmail'],					'authorUrl'=>$data['install']['authorUrl'],
						'version'=>$data['install']['version'],					'description'=>$data['install']['description']
					 
					);
				}else{
					$rows[] = array(
						'title'=>$v,
						'module'=>$v,
						'author'=>' - ',
						'creationDate'=>' - ',
						'copyright'=>' - ',		
						'license'=>' - ',
						'authorEmail'=>' - ',	
						'authorUrl'=>' - ',
						'version'=>' - ',		
						'description'=>' - '
					);
				}
			}
		}

		//print_r($rows);

		return $rows;

	}


	function getListComponents()
	{
 		import('filesystem.xml');

		$where = " where uid =".$this->uid." and parent=0 ";
 		import('html.navigations');
		$sql = " select id from #__components ";
		$sql .= $where;

		
		$this->db->query($sql);


		$n = $this->db->getNumRows();

 		$this->nav = new Navigations(20,$n);
		$this->nav->setRequest(array('type'));

 
 		$sql = " select * from  #__components ";
		$sql .= $where;
		$sql .= " order by id desc ";
		$sql.= $this->nav->getLimit($_REQUEST['page']);
		$this->db->query($sql);
		$rows = $this->db->getResult();

		$com_directory = dirname(PATH_COMPONENT);
		foreach( $rows as $k=> $row )
		{
 			$xmlFile = $com_directory.DS.'com_'.$row['option'].DS.$row['option'].'.xml';
			if( file_exists( $xmlFile ) )
			{
				$data = &XML_unserialize( file_get_contents( $xmlFile ) );

				//print_r($data);exit;
				//模块
				$rows[$k] = array_merge($row,array(
					
					'author'=>$data['install']['author'],
					'creationDate'=>$data['install']['creationDate'],
					'copyright'=>$data['install']['copyright'],					'license'=>$data['install']['license'],
					'authorEmail'=>$data['install']['authorEmail'],					'authorUrl'=>$data['install']['authorUrl'],
					'version'=>$data['install']['version'],					'description'=>$data['install']['description']
				 
				));
			}else{
				$rows[$k] = array_merge($row,array(
					
					'author'=>' - ',
					'creationDate'=>' - ',
					'copyright'=>' - ',		
					'license'=>' - ',
					'authorEmail'=>' - ',	
					'authorUrl'=>' - ',
					'version'=>' - ',		
					'description'=>' - '
				));
			}
			
		}

		return $rows;

	}


	function getNav()
	{
		return $this->nav;
	}
}
?>