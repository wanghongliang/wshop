<?php
import('application.component.model');
class InstallerModel extends Model
{
 	function InstallerModel()
	{
		parent::__construct();
		$this->tableName = '#__components';
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

		$sql = " select * from ".$this->tableName." where id='".$id."' ";
		$this->db->query($sql);

		$row = $this->db->getRow();	//获取菜单项数据
 
		return $row;
	}

	/**
	 * 保存
	 */
	function save()
	{
		global $app;
	 
		$data = array(
			'title'=>$_REQUEST['title'],
			'fulltext'=>$_REQUEST['fulltext']
		);
		
		if( is_array($_REQUEST['params'] ) )	//保存参数列表
		{
			//import('html.format.ini');
			//$data['params'] = FormatINI::arrayToString($_REQUEST['params']);
		}

		$parent_id = intval($_REQUEST['parent_id']);	//父栏目的ID
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


	/** 删除内容 **/
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


	function uploadinstaller()
	{
		if( is_array( $file = $_FILES['upload'] ) )
		{
			$tmps = explode('.',$file['name'] );

			$ext = $tmps[1];	//后缀文件
			$mod_name = $tmps[0]; //
			//echo $ext;print_r( $file );
			if( $ext == 'zip' )
			{
				import('filesystem.dir');
				$dir =  WDir::getInstance();
				if( $result = $dir->uploadFile( $file , PATH_TMP ) )
				{

					$zip = new ZipArchive();
					$rs = $zip->open($result['file_path']);

					if($rs !== TRUE)
					{
						Error::throwError('解压失败!  Error Code:'. $rs);
					}

					$extractPath = substr($result['file_path'],0,-4);
					$zip->extractTo($extractPath);
					$zip->close();
					

					unset( $dir,$tmps,$ext,$mod_name );
						
					//print_r($zip);
					$this->install( $extractPath );
					
					

					/**
					import('filesystem.pclzip');
					$zip = new PclZip($result['file_path']);
 					if( !$zip->extract() )
					{
						print_r($zip->errorCode()); 
					}
					**/
				}

				//print_r($result);
 			}else{
				Error::throwError('上传的文件必需是zip格式文件!');
			}
		}

	}


	function install($path)
	{
		import('filesystem.xml');
		
		$dir =  WDir::getInstance();

		$folders = $dir->getFolders($path);	//取文件夹

		if( count($folders) == 1 )	//是否在子文件夹中
		{
			$path .= DS.$folders[0]['name'];
		}
		
		//print_r( $folders );

		//读取配置文件
		$xmlFiles = $dir->getFiles($path,'xml');
		//print_r( $xmlFiles );

		if( count( $xmlFiles ) )
		{
			$xmlpath =$path . DS.$xmlFiles[0]['name'];
			$xmlData = &XML_unserialize( file_get_contents($xmlpath) );

			if( !isset($xmlData['install']) )
			{
				Error::throwError('安装配置 xml 文件,没有对应的 install 标签.');
			}

			if( !isset($xmlData['install attr']) )
			{
				Error::throwError('安装配置 xml 文件,没有对应的安装 install 属性，些项对应安装类型.');
			}

			switch( $xmlData['install attr']['type'] )
			{
				case 'module':
					$this->installModule( &$xmlData['install'] , $path , intval($xmlData['install attr']['client_id']) );
					break;	//安装模块完成

				case 'component':
					$this->installComponent( &$xmlData['install'] , $path );
					break;	//安装模块完成


				default:
					Error::throwError('未知的安装类型.');
			}
		}


	}


	/**
	 * 安装模块
	 */
	function installModule( $params ,$path , $client_id = 0)
	{
		//print_r( $params);
		global $app;
		
		if( is_array($params['files']['filename']) )
		{
			$mod_name = $params['files']['filename']['0 attr']['module'];
		}else{
			$mod_name = $params['files']['filename attr']['module'];
		}
		if( $client_id == 0 ){
			$module_dir = $app->getPreviewModulePath().DS.$mod_name;//.DS.$row['module'].DS.$row['module'].'.xml';
		}else{
			$module_dir = PATH_BASE.DS.'modules'.DS.$mod_name;//.DS.$row['module'].DS.$row['module'].'.xml';
		}
		if( is_dir( $module_dir ) )
		{
			$app->enqueueMessage('该模块目录已经存在，需要删除该目录:'.$module_dir,'error');
			return;
		}
		$dir =  WDir::getInstance();
		$dir->mkdir($module_dir );	//把目录内容移过来
		$dir->moveDir($path,$module_dir);

		//模块属性
		$module = array(
			'title'=>$params['name'],
			'module'=>$mod_name,
			'client_id'=>$client_id,
			'published'=>0,
			'position'=>'',
			'uid'=>$this->uid
		);

 		$this->db->insertArray( '#__modules',$module );
		$app->enqueueMessage('模块安装成功.');
	}

	/** 安装组件 **/
	function installComponent( $params ,$path)
	{
		global $app;

		$com_name = basename($path);		//解压的目录名称为组件名称，！重要
		$option = substr($com_name,4);		//组件原名

		
		$preview_component_dir = PATH_PREVIEW.DS.'components'.DS.$com_name;
		$menage_component_dir = dirname(PATH_COMPONENT).DS.$com_name;
		
 		if( is_dir( $preview_component_dir ) || is_dir( $menage_component_dir ) )
		{
			$app->enqueueMessage(' 该组件目录已经存在，需要删除该目录 ! ','error');
			return;
		}
		$dir =  WDir::getInstance();
		if( isset($params['folder']) )
		{
			$dir->mkdir($preview_component_dir );	//把目录内容移过来
			$dir->moveDir($path.DS.$params['folder'],$preview_component_dir);
 		}

		//管理文件夹
		if( isset($params['admin']['folder']) )
		{
			$dir->mkdir($menage_component_dir );	//把目录内容移过来
			$dir->moveDir($path.DS.$params['admin']['folder'],$menage_component_dir);
 			$dir->moveFile($path.DS.$option.'.xml',$menage_component_dir.DS.$option.'.xml');
		}

 
 		//模块属性
		$component = array(
			'name'=>$params['name'],
			'link'=>'com='.$option,
			'admin_menu_link'=>'com='.$option,
			'option'=>$option,
			'enabled'=>1,
			'uid'=>$this->uid
		);

 		$this->db->insertArray( '#__components',$component );

 		$app->enqueueMessage('组件安装成功.');

 
	}


 }
?>