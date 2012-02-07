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

	/**
	 * 取当前编辑项
	 */
	function setDefaultTemplate($t)
	{
		global $app;
 
		$data = array('template'=>$t);
		$this->db->updateArray("#__configs" , $data ," uid='".$app->uid."' ");

		import('cache.cache');	//导入缓存常用文件
		Cache::cacheConfig();	//生成缓存配置信息
 
	}







	///////////////////// 以下是模块操作 //////////////////////





	function getModuleList()
	{
		
		$where = " where uid =".$this->uid." and client_id=0 ";
 		$sql = " select * from #__modules ";
		$sql .= $where;
		$sql .= " order by  position, ordering ";

		$this->db->query($sql);
		return $this->db->getResult();
	}

	/** 模块目录 **/
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
	 * 取单个模板
	 */
	function getFrontModule()
	{
		global $app;

		$id = intval($_REQUEST['id']);
		if( $id > 0 )
		{
			//输出指定的模块信息
			$sql = " select * from #__modules where uid='".$this->uid."' and id='".$id."' ";
			$this->db->query($sql);
			$obj = $this->db->loadObjectList();
			
			$module = $obj[0];
			//print_r($obj);
			import('html.format.ini');
			$params = FormatINI::stringToArray( $module->params );
			$module->module = preg_replace('/[^A-Z0-9_\.-]/i', '', $module->module);

			$path = $app->getPreviewModulePath().DS.$module->module.DS.$module->module.'.php';
			
			//自定义内容后就输出自定义内容
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
	 * 保存样式
	 */
	function savelayout()
	{
		/** 布局的字符串 **/
		$param = trim($_REQUEST['param'],',');
		if( $param )
		{
			$lay = explode( ',',$param );	//分解成数组


 
			
			//设置模块属性
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