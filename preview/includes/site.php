<?php


//定义当前用户的ID
$GLOBALS['USERID'] = 89;



/**
 * 管理应用类
 */
class SiteApplication extends Application
{


	function SiteApplication($name)
	{
		parent::Application($name);
		$this->client_id = 0;
		//$this->uid = $GLOBALS['USERID']; 
		//$GLOBALS['USERID'] = 1;	
  	}

	/** 初始化 **/
	function init(){
		//分析当前URL
 
		//print_r($params);
		//如果是登陆用户，取当前会员的信息
 		import('cache.cache');
		$config = Cache::getConfigCache();
		//反系列化
		$config['options'] = unserialize($config['options']);

		//print_r($config);
		$template = $GLOBALS['config']['template'];
		$GLOBALS['config'] = array_merge($GLOBALS['config'],(array)$config);
		//$GLOBALS['config']['template'] = $template;
		//if( !$GLOBALS['config']['template'] ){
		//	$GLOBALS['config']['template'] = 'default';
		//}

 		/** 解析MENU  **/
		//$menu = $this->getMenu();
		$route = Router::getInstance($this->name);
  		$username = RouterSite::getMemberName();
		
		if( !empty( $username ) ){
			$sql =" select default_uid from #__area where alias='".$username."' ";
			$db = &Factory::getDB();
			$db->query( $sql );
			$db->next_record();
			$uid = (int) $db->Record['default_uid'];
			
			if( $uid>0 ) $GLOBALS['USERID']=$uid;
		}
		//echo $GLOBALS['USERID'];


		/**
		$sql =" select id,parent_id,name from #__area order by lft";
		$db->query($sql);
		$rows = $db->getResult('id');
		foreach( $rows as $k=>$v ){
			if( $v['parent_id']>0 ){
				$rows[$k]['depth'] = $rows[$v['parent_id']]['depth']+1;
			}else{
				$rows[$k]['depth'] = 1;
			}
			$data= array('depth'=>$rows[$k]['depth']);
			//print_r($data);
			$db->updateArray('#__area',$data," id='".$k."' ");
		}
		**/

		//print_r($rows);
		//exit;



		//echo $username;
 		$vars = $route->parse();
		//print_r($vars);
 
		//定义模块绝对路径
		//define('PATH_MODULES',PATH_TEMPLATE.DS.$this->getTemplate().DS.'modules');

		define('PATH_MODULES',PATH_BASE.DS.'modules');


  		//菜单对象
		$menu = &$this->getMenu();
 		$document = &Factory::getDocument();

		/**
		if( $menu->catid > 0 ){ 
			$active_cat = $menu->getCategoryItem($menu->catid);
 			if( $active_cat['title'] ){
				$document->setTitle($active_cat['title']);
			}else{
 				$document->setTitle($active_cat['name'].'-'.$GLOBALS['config']['title']);
			}
 			if( $active_cat['metakey'] ){
					$document->setKeywords( $active_cat['metakey']);	
			}else{
					$document->setKeywords($GLOBALS['config']['metakey']);		
			}
			if( $active_cat['metadesc'] ){
					$document->setDescription( $active_cat['metadesc']);	
			}else{ 
					$document->setDescription($GLOBALS['config']['metadesc']);	
			}
 		
		} 
		**/

	 
		//获得当前菜单对象
		if( $active_menu = $menu->getActive() ){

			//print_r($active_menu);
 			if( $active_menu['title'] ){
				$document->setTitle($active_menu['title']);
			}else{
 				$document->setTitle($active_menu['name'].'-'.$GLOBALS['config']['title']);
			}
 			if( $active_menu['metakey'] ){
					$document->setKeywords( $active_menu['metakey']);	
			}else{
					$document->setKeywords($GLOBALS['config']['metakey']);		
			}

			if( $active_menu['metadesc'] ){
					$document->setDescription( $active_menu['metadesc']);	
			}else{ $document->setDescription($GLOBALS['config']['metadesc']);	

			}
		}elseif( $vars['catid']>0 ){
			$cats = $menu->getCategroyInfo( $vars['catid']);
			$document->setTitle( $cats['name'].'-'.$GLOBALS['config']['title']);
			$document->setKeywords( empty($cats['metakey'])?$GLOBALS['config']['metakey']:$cats['metakey']);
			$document->setDescription( empty($cats['metadesc'])?$GLOBALS['config']['metadesc']:$cats['metadesc'] );
		}else{
 			$document->setTitle($GLOBALS['config']['title']);
			$document->setKeywords($GLOBALS['config']['metakey']);
			$document->setDescription($GLOBALS['config']['metadesc']);
		}
 	}




	function &getMenu()
	{
		static $menu = null; 

 		if( empty( $menu ) )
		{
			include(dirname(__FILE__).DS.'menu.php');
			$menu = new Menu();

		}else{
			if( !is_object($menu) ){
 				//Error::throwError('asfd');
			}
		}

 		return $menu;
	}
	function rander()
	{
		
		$document = &Factory::getDocument();
  		$file 		=  'index';
 		if( $_REQUEST['tmpl'] )
		{
			$file = $_REQUEST['tmpl'];
		}
   		$params = array(
					'template' 	=> $this->getTemplate(),
					'file'		=> $file.'.php',
					'directory'	=> PATH_TEMPLATE 
				);
  
  		return $document ->render(false,$params);
	}


	function &getParams($option = null)
	{
		static $params;
 		if (!is_array($params))
		{
			// Get component parameters
			if (!$option) {
				$option = $_REQUEST['com'];
			}
			import('application.component.helper');

			//这里有个bug，当为引用时，会随着方法调用需消失
			$params =  WComponentHelper::getParams($option);//array();
			
 
			// Get menu parameters
			$menus	= &SiteApplication::getMenu();
			$menu	= $menus->getActive();

			$title       = $GLOBALS['config']['sitename'];
			$description = $GLOBALS['config']['MetaDesc'];

			// Lets cascade the parameters if we have menu item parameters
			if (is_array($menu))
			{
				$param = FormatINI::stringToArray($menu['params']);
				unset($menu['params']);
 				$params=  array_merge($params,$menu,$param); 
				$title = $menu['name'];
				$params['menuid'] = $menu['id'];

			}

			$params['page_title']  =  $title ;
			$params['page_description'] = $description;
			
			//$this->showTrace();
 		}

		return $params;
	}

	//定义组件的路径
	function defineComponentPath($com)
	{
		if( !defined('PATH_COMPONENT') ){
			//定义组件量,以方便后面路径的引用
			//define('PATH_COMPONENT',PATH_TEMPLATE.DS.$this->getTemplate().DS.'components'.DS.'com_'.$com);
			define('PATH_COMPONENT',PATH_BASE.DS.'components'.DS.'com_'.$com);
 		}

		//echo PATH_COMPONENT;
	}

	function getPreviewModulePath()
	{
		return PATH_BASE.DS.'modules';
	}

	/**
	 * 前台组件路径
	 */
	function getPreviewComponentPath()
	{
		return PATH_BASE.DS.'components';
	}

	function getTemplate(){
		//echo $GLOBALS['config']['template'];
 		return $GLOBALS['config']['template'];
	}
	function &getPathWay()
	{
		import( 'application.pathway' );
		$pathway =& Pathway::getInstance('site');
 
		return $pathway;
 	}
 
	function buildMemberLink($uname )
	{
		static $ulink;
		if( empty($ulink) ){
			$session = & Factory::getSession();

			if( ROUTER_MODE > 1 ){
				$ulink = '/i/';
			}else{
				$ulink = '/i/index.php/';
			}
		}
		return $ulink.$uname;
	}
 

	//返回会员路径
	function getMemberOptionPath()
	{
		return PATH_BASE.DS.'includes'.DS.'option.php';
	}


}
?>