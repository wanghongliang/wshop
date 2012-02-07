<?php
 /**
 * 前台程序路由器
 */
class RouterSite extends Router
{
 
	function RouterSite($options = array()) {
		parent::Router($options);
	}


	/** 主要是分析作用 **/
	function parse()
	{
		
		//获取菜单对象
		$menu = &SiteApplication::getMenu();

		//URI对象
		$uri = &URI::getInstance();

		//当前应用请求参数，数组
		$vars = array();

		

		//当前的请求query
 		$route = $uri->getPath();

		$index_php_pos = strpos($route,'index.php');
 		if( ROUTER_MODE < 2 ){
			$n = 10;
		}else{
			$n=1;

			//当重定向时，是否有index.php,如果有在后面就需要去index.php 
			if( $index_php_pos !== false ){ $n =10; }
		}
		

		
		if( $pos = strpos($route,'.html') ){
			//去.html
			$route = substr($route,0,-5);
		} 

  
		//是否有城市
		if( $memberName = RouterSite::getMemberName() ){
 
			//============= 备注 =============
			$n += strlen($memberName)+1;	//这里是取当前会员名
		}

		//是否有语言版本
		if( $lanName = $this->getLanguageName() ){
			//============= 备注 =============
			$n += strlen($lanName)+1;	//这里是取当前语言名
		}
		
   		$route = substr($route,$index_php_pos+$n );
		 
 
		//设置路由为根，防止循环调用 /asfd/asfda/asfd/
		$uri->setPath(URI::base(true).'/');

 		
		//用于记录产品分类的参数
		$route2=null; 
		$vars = array('com'=>$_REQUEST['com'],'view'=>$_REQUEST['view']);


		 
  		//当为SEO模式时，将找出当前菜单，并分析当前菜单的参数
 		if( ROUTER_MODE > 0 && $route ){

			/*
			 * 剖析应用路由,当没有对应的菜单时，直接用 component/contents/article/1 , 2,3
			 */
 			if(substr($route, 0, 9) == 'component')
			{
				//分析数组，每2个参数为组件名称
				$segments	= explode('/', $route);
				$route      = str_replace('component/'.$segments[1], '', $route);
 
				//把 vars['option'] 改为 vars['com']
				//把 = 'com_'.$segments[1] 改为 = $segments[1]
				$vars['com'] = $segments[1];	//组件
				$vars['itemid'] = null;			//菜单ID为空

				//echo $route;
				//print_r($vars); 
			}
			else
			{

				//标记是否找到当前菜单
				$do = true; 

 				if( $do )
				{
 					$items = array_reverse($menu->getCategory());
					foreach ($items as $item)
					{
						$lenght = strlen($item['route']); //get the lenght of the route


						//找到，并把菜单的参数，赋值给当前，请求参数
						if($lenght > 0 && strpos($route.'/', $item['route'].'/') === 0 )
						{
							$route   = substr($route, $lenght);

							$route2 = array('com'=>'products','view'=>'category','catid'=>$item['id'],'itemid'=>0); 
								 
 							if( $item['parent_id'] == 0 )
							{
								$route2['layout'] = 'category';
							}
							$vars = $route2;
							$do = false;
  							//print_r($item);
						}
					}
				}


				////////////分析分类完成//////////////
				if( $do )
				{
				//如果和菜单关联，将找出对应的菜单项
				$items = array_reverse($menu->getMenus());
				foreach ($items as $item)
				{
					$lenght = strlen($item['route']); //get the lenght of the route

					//echo $route.'|'.$item['route'].'<br/>';
					//找到，并把菜单的参数，赋值给当前，请求参数
					if($lenght > 0 && strpos($route.'/', $item['route'].'/') === 0 && $item['type'] != 'menulink')
					{
						$route   = substr($route, $lenght);
						
						//echo $route;
						$vars['itemid'] = $item['id'];

						//把 vars['option'] 改为 vars['com']
						//$vars['com'] = $item['component'];//$item->component;

						$vars = array_merge($vars , $item['query'] );
 
						$do = false;
						break;
					}
				}
				}

				////////////分析菜单完成//////////////
				
				if( $do ){
					$url = '/404.html';
					if (headers_sent()) {
						echo "<script>document.location.href='$url';</script>\n";
					} else {
						header( 'HTTP/1.1 301 Moved Permanently' );
						header( 'Location: ' . $url );
						exit;
					}
				}


			}

		}


		//print_r($vars);


		// 设置当前的菜单项
		if ( isset($vars['itemid']) ) {
			$menu->setActive(  $vars['itemid'] );
		}else if( empty($route) ){

			if( $route2 ){
				$vars = $route2;
			}else{
				$item = &$menu->getDefault();
				$menu->setActive(  $item['id'] ); 
				settype($item['query'],'array');
 				//把URL中的变量重写到当前菜单中
				$item['query']=array_merge($item['query'],$_GET);
				//print_r($item);
				if( isset($vars['com']) ){
					$c = $vars['com'];
					$v = $vars['view'];
 					$vars = $item['query'];

 					$vars['com'] = $c;
					$vars['view'] = $v;
					unset($c,$v);
				}else{
					$vars = $item['query'];
				}
			}
			//$item = &$menu->getDefault();
			//$menu->setActive(  $item['id'] );
		}
		

	 
  
 		/*
		 * 剖析部分路由,主要是针对每个组件，解析不同的布局参数
		 *
		 * 根据 [当前的请求参数]，用组件router重新解析
		 * 条件是菜单默认的路由之外还有参数
		 */
		if(!empty($route) && isset($vars['com']) )
		{
 			$segments = explode('/', $route); 
			array_shift($segments);
			//print_r($segments);
			// 	处理部分航线
			$component = preg_replace('/[^A-Z0-9_\.-]/i', '', $vars['com']);
 			// 	使用组件路由处理如果存在
			$path = PATH_BASE.DS.'components'.DS.'com_'.$component.DS.'router.php';
			
 
   			/**
			 * 
			 */
  			if (file_exists($path) && count($segments))
			{
				if ($component != "search") { // Cheep fix on searches
					//decode the route segments
					//$segments = $this->_decodeSegments($segments);
				}
				require $path;
 				//原 com_content 加 substr($component,4) 
				$function =  $component.'ParseRoute';
				$vars2 =  $function($segments);
				$vars = array_merge($vars,$vars2);
			}


		}
		else
		{
			//Set active menu item
			//if($item =& $menu->getActive()) {
				//$vars = $item->query;
			//}
		}
 		$uri->setVars( $vars );
 		if( is_array($vars) ){
			if( isset($_REQUEST['com'])  )
			{
				$vars['com'] = $_REQUEST['com'];
			}
			//这里直接给全局请求变量
			$_REQUEST = array_merge( $_REQUEST , $vars);

		} 
 		return $vars;
	}

	function &build(&$param)
	{
		$uri =&URI::getInstance();
		// 取得路由数据
		$route = $uri->getPath();

		//添加前缀到路由
		if( ROUTER_MODE > 0 && $route ) //$route 是指格式化后的 /asfd/asfd/asfd
		{
			$app =& Factory::getApplication();

			if( $GLOBALS['config']['sef_suffix'] && !(substr($route, -9) == 'index.php' || substr($route, -1) == '/'))
			{
				if($format = $uri->getVar('format', 'html'))
				{
					$route .= '.'.$format;
					$uri->delVar('format');
				}
			}

			if( ROUTER_MODE == 2 || ROUTER_MODE ==3 )
			{
				//转换为一个重写URL的字符
				$route = str_replace('index.php/', '', $route);
			}else{
				if( strpos( $route ,'index.php' )===false )
				{
					$route .= "index.php";
				}
			}

			/**
			//============= 备注 =============	
			//是否有语言版本
			if( $lanName = $this->getLanguageName() ){
 				$route .= '/'.$lanName;

			}
			**/
			//============= 备注 =============
			//加一个会员名称	
 			if( $memberName = RouterSite::getMemberName() ){
				if( $route == '/' ){
					$route .= $memberName.'/';
				}else{
 				$route .= '/'.$memberName.'/';
				}

			}

			$r = trim($this->_buildSefRoute($param),'/');
			if( $r ){
				return $route.$r.'.html';
			}else{
  				return $route.'.html';
			}
		}
		return $route."?".http_build_query($param);
	}

 


	function _buildSefRoute(&$query)
	{
 		$app =&Factory::getApplication();
		$menu =&$app->getMenu();
 		$component	= preg_replace('/[^A-Z0-9_\.-]/i', '', $query['com']);
		$tmp 		= '';


		//用组件自带的ROUTER进行解析,当找到菜单，并在此菜单下时，会返回额外的参数
		$path = dirname(PATH_COMPONENT).DS.'com_'.$component.DS.'router.php'; 
  		if (file_exists($path) && !empty($query))
		{
			require_once $path;
 			$function	= $component.'BuildRoute';
			$parts		= $function($query);

 			if ($component != "search") { 
				$parts = $this->_encodeSegments($parts);
			}
			$result = implode('/', $parts);
			$tmp	= ($result != "") ? '/'.$result : '';
 		} 

 
   		/*
 		 * 加菜单的方式
		 */
		$built = false;
		if (isset($query['itemid']) && !empty($query['itemid']))
		{
			$item = $menu->getItem($query['itemid']);
			//if (  $query['com'] == $item['component']) {
				//print_r($item);
				$tmp = !empty($tmp) ? $item['route'].$tmp : $item['route'];
				$built = true;
			//}
		}else if (isset($query['catid']) && !empty($query['catid']))
		{

			//echo $query['catid'];
			$item = $menu->getCategoryItem($query['catid']);

 
			//if (  $query['com'] == $item['component']) {
				//print_r($item);
				if( is_array($item) ){
					//$item['route'] = $menu->productsMenu['route'].'/'.$item['route'];
					$item['route'] = $item['route'];
					$tmp = !empty($tmp) ? $item['route'].$tmp : $item['route'];
				}else{
					$item = &$menu->getActive();
					//print_r($item);
 					$tmp = !empty($tmp) ? $item['route'].$tmp : $item['route'];
				}
				$built = true;
			//}
		}
 
		/**
		 * 没有菜单将直接以组件形式构建URL
		 */
		if(!$built) {
			//  
			$tmp = 'component/'.$query['com'].''.$tmp;
		}
		$route .= '/'.$tmp;

  		return $route;
	}
	
	function BMLink($s)
	{
		if( ROUTER_MODE == 2 ){
			$s = '/china/'.$s;
		}else{
			$s = '/china/index.php/'.$s;
		}

		return $s;
	}

	//加一个会员名称
	function getMemberName()
	{
		static $name;

		if( empty($name)){
			//URI对象
			$uri = &URI::getInstance();
 			//当前的请求query
			$route = $uri->getPath(); 
			$uri_param = explode('/',$route);
			if( ROUTER_MODE == 2 )
			{
				$name = $uri_param[1];
			}else{
				$name = $uri_param[2];
			}
			
			if( strlen($name)>4 ){
				$name = '';
			}
 		}
		return $name;
	}


	//加一个获取当前语言版本名称
	function getLanguageName()
	{

		return null;
		/**
		static $name;

		if( empty($name)){
			//URI对象
			$uri = &URI::getInstance();
 			//当前的请求query
			$route = $uri->getPath();
			
			$uri_param = explode('/',$route);
			if( ROUTER_MODE == 2 )
			{
				$name = $uri_param[1];
			}else{
				$name = $uri_param[2];
			}
		

			//是否有该语言分类
			$language = &Factory::getLanguage();
			$lanType = $language->getLanguageType();

			if(  !isset($lanType[$name]) ){
				$name = '';
			}

			 
 		}
		return $name;
		**/
	}
}
