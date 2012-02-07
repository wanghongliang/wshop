<?php
import('application.component.model');
class StyleModel extends Model
{
	var $nav = null;
	function StyleModel()
	{
		parent::__construct();
 
	}
	function getTemplateList()
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

		//ȡ����ǰ��Ա��������Ϣ
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

				//�Ƿ�ΪĬ�ϵ�ģ���ļ�
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

	/**
	 * ȡ��ǰ�༭��
	 */
	function setDefaultTemplate($t)
	{
		global $app;
 
		$data = array('template'=>$t);
		$this->db->updateArray("#__configs" , $data ," uid='".$app->uid."' ");

		import('cache.cache');	//���뻺�泣���ļ�
		Cache::cacheConfig();	//���ɻ���������Ϣ
 
	}







	///////////////////// ������ģ����� //////////////////////





	function getModuleList()
	{
		
		$where = " where uid =".$this->uid." and client_id=0 ";
 		$sql = " select * from #__modules ";
		$sql .= $where;
		$sql .= " order by  position, ordering ";

		$this->db->query($sql);
		return $this->db->getResult();
	}

	/** ģ��Ŀ¼ **/
	function &getSelect()
	{
		global $app;	
		import('filesystem.dir');
		import('filesystem.xml');
		$dir = new WDir();

 		$directory = $app->getPreviewModulePath();
 
 
		$modules = array();
		if( $data = $dir->getFolders($directory) ){
			foreach( $data as $mod ){
				$xmlFile = $directory.DS.$mod['name'].DS.$mod['name'].'.xml';

				if( file_exists($xmlFile) ){
					$params = XML_unserialize( file_get_contents($xmlFile) );
					//print_r($params);
					$title = $params['install']['name'];
				}else{
					$title = $mod['name'];
				}

				$modules[] = array(
					'name'=>$mod['name'],
					'title'=>$title, 
					'description'=>''
				);
			}
			unset( $data, $xmlFile, $params ,$title );
		}
		unset( $dir ,$directory );

		return $modules;
	}


	/**
	 * ȡ����ģ��
	 */
	function getFrontModule()
	{
		global $app;

		$id = intval($_REQUEST['id']);
		if( $id > 0 )
		{
			//���ָ����ģ����Ϣ
			$sql = " select * from #__modules where uid='".$this->uid."' and id='".$id."' ";
			$this->db->query($sql);
			$obj = $this->db->loadObjectList();
			
			$module = $obj[0];
			//print_r($obj);
			import('html.format.ini');
			$params = FormatINI::stringToArray( $module->params );
			$module->module = preg_replace('/[^A-Z0-9_\.-]/i', '', $module->module);

			$path = $app->getPreviewModulePath().DS.$module->module.DS.$module->module.'.php';
			
			//�Զ������ݺ������Զ�������
			if ( file_exists( $path )  )
			{
				$content = '';
				ob_start();
				require $path;
				$module->content = ob_get_contents().$content;
				ob_end_clean();
			}

			unset($obj);

			return $module;

		}
 	}
 

	/**
	 * ������ʽ
	 */
	function savelayout()
	{
		/** ���ֵ��ַ��� **/
		$param = trim($_REQUEST['param'],',');
		if( $param )
		{
			$lay = explode( ',',$param );	//�ֽ������


 
			
			//����ģ������
			foreach( $lay as $id=>$s)
			{
				
				$attr = explode(':',$s);
				$data = array(
					'published'=>intval($attr[2]),
 					'ordering'=>$attr[4]
				);
				if( $attr[3] )
				{
					$data['position'] = $attr[3];
				}
				$this->db->updateArray("#__modules",$data," id=".intval($attr[0]));
				//echo '__________',$attr[1],'-',$attr[3],'-',$orders[$attr[3]];
 			}


			if( $t = trim($_REQUEST['t']) )
			{
				$this->setDefaultTemplate($t);
			}

			echo '1';
		}
	}
}
?>