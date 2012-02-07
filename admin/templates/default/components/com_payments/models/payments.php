<?php
import('application.component.model');
class PaymentsModel extends Model
{
	var $nav = null;
	var $client_id=0;

	function PaymentsModel()
	{
		parent::__construct();
		$this->tableName = '#__plugins';
		$this->client_id = intval($_REQUEST['client_id']);
	}
	function getList()
	{
		global $app;
		
		$context = $_REQUEST['com'];
		$key =	 $app->getUserStateFromRequest('key','',$context  );
        
		$where = array(" folder='pay' ");


		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName;

		if($key){
			 
		}
		$where = count($where)>0 ? " where ".implode(' and ',$where):'';

		$sql .= $where;

		$this->db->query($sql);
		$result = $this->db->getRow();
		$this->nav = new Navigations(20,$result['n']);
		

 
 		$sql = " select * from ".$this->tableName;
		$sql .= $where;
		$sql .= " order by id desc ";

		$sql.= $this->nav->getLimit($_REQUEST['page']);

		$this->db->query($sql);
		$rows = $this->db->getResult();

		import('html.format.ini'); 

		import('filesystem.dir');
		import('filesystem.xml');
		$dir = WDir::getInstance();

  
 		 

		foreach( $rows as $k=> $row )
		{
 
			$xmlFile = PATH_PLUGINS.DS.$row['folder'].DS.$row['element'].DS.$row['element'].'.xml';

			
			if( file_exists( $xmlFile ) )
			{
				$data = &XML_unserialize( file_get_contents( $xmlFile ) );
 
				//print_r($data);exit;
				//ฤฃฟ้
				$rows[$k] = array_merge($row,array(
					
					'author'=>$data['install']['author'],
					'creationDate'=>$data['install']['creationDate'],
					'copyright'=>$data['install']['copyright'],					
					'license'=>$data['install']['license'],
					'authorEmail'=>$data['install']['authorEmail'],					
					'authorUrl'=>$data['install']['authorUrl'],
					'version'=>$data['install']['version'],					
					'description'=>$data['install']['description']
				 
				));
				//print_r($data);
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
			$rows[$k]['params'] = FormatINI::stringToArray( $rows[$k]['params'] ); 

		}

		//print_r($rows);
		return $rows;
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