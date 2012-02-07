<?php
 /**
 * ǰ̨����·����
 */
class RouterSite extends Router
{
 
	function RouterSite($options = array()) {
		parent::Router($options);
	}


	/** ��Ҫ�Ƿ������� **/
	function parse()
	{
		
		//��ȡ�˵�����
		$menu = &SiteApplication::getMenu();

		//URI����
		$uri = &URI::getInstance();

		//��ǰӦ���������������
		$vars = array();

		

		//��ǰ������query
 		$route = $uri->getPath();

		$index_php_pos = strpos($route,'index.php');
 		if( ROUTER_MODE < 2 ){
			$n = 10;
		}else{
			$n=1;

			//���ض���ʱ���Ƿ���index.php,������ں������Ҫȥindex.php 
			if( $index_php_pos !== false ){ $n =10; }
		}
		

		
		if( $pos = strpos($route,'.html') ){
			//ȥ.html
			$route = substr($route,0,-5);
		} 

  
		//�Ƿ��г���
		if( $memberName = RouterSite::getMemberName() ){
 
			//============= ��ע =============
			$n += strlen($memberName)+1;	//������ȡ��ǰ��Ա��
		}

		//�Ƿ������԰汾
		if( $lanName = $this->getLanguageName() ){
			//============= ��ע =============
			$n += strlen($lanName)+1;	//������ȡ��ǰ������
		}
		
   		$route = substr($route,$index_php_pos+$n );
		 
 
		//����·��Ϊ������ֹѭ������ /asfd/asfda/asfd/
		$uri->setPath(URI::base(true).'/');

 		
		//���ڼ�¼��Ʒ����Ĳ���
		$route2=null; 
		$vars = array('com'=>$_REQUEST['com'],'view'=>$_REQUEST['view']);


		 
  		//��ΪSEOģʽʱ�����ҳ���ǰ�˵�����������ǰ�˵��Ĳ���
 		if( ROUTER_MODE > 0 && $route ){

			/*
			 * ����Ӧ��·��,��û�ж�Ӧ�Ĳ˵�ʱ��ֱ���� component/contents/article/1 , 2,3
			 */
 			if(substr($route, 0, 9) == 'component')
			{
				//�������飬ÿ2������Ϊ�������
				$segments	= explode('/', $route);
				$route      = str_replace('component/'.$segments[1], '', $route);
 
				//�� vars['option'] ��Ϊ vars['com']
				//�� = 'com_'.$segments[1] ��Ϊ = $segments[1]
				$vars['com'] = $segments[1];	//���
				$vars['itemid'] = null;			//�˵�IDΪ��

				//echo $route;
				//print_r($vars); 
			}
			else
			{

				//����Ƿ��ҵ���ǰ�˵�
				$do = true; 

 				if( $do )
				{
 					$items = array_reverse($menu->getCategory());
					foreach ($items as $item)
					{
						$lenght = strlen($item['route']); //get the lenght of the route


						//�ҵ������Ѳ˵��Ĳ�������ֵ����ǰ���������
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


				////////////�����������//////////////
				if( $do )
				{
				//����Ͳ˵����������ҳ���Ӧ�Ĳ˵���
				$items = array_reverse($menu->getMenus());
				foreach ($items as $item)
				{
					$lenght = strlen($item['route']); //get the lenght of the route

					//echo $route.'|'.$item['route'].'<br/>';
					//�ҵ������Ѳ˵��Ĳ�������ֵ����ǰ���������
					if($lenght > 0 && strpos($route.'/', $item['route'].'/') === 0 && $item['type'] != 'menulink')
					{
						$route   = substr($route, $lenght);
						
						//echo $route;
						$vars['itemid'] = $item['id'];

						//�� vars['option'] ��Ϊ vars['com']
						//$vars['com'] = $item['component'];//$item->component;

						$vars = array_merge($vars , $item['query'] );
 
						$do = false;
						break;
					}
				}
				}

				////////////�����˵����//////////////
				
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


		// ���õ�ǰ�Ĳ˵���
		if ( isset($vars['itemid']) ) {
			$menu->setActive(  $vars['itemid'] );
		}else if( empty($route) ){

			if( $route2 ){
				$vars = $route2;
			}else{
				$item = &$menu->getDefault();
				$menu->setActive(  $item['id'] ); 
				settype($item['query'],'array');
 				//��URL�еı�����д����ǰ�˵���
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
		 * ��������·��,��Ҫ�����ÿ�������������ͬ�Ĳ��ֲ���
		 *
		 * ���� [��ǰ���������]�������router���½���
		 * �����ǲ˵�Ĭ�ϵ�·��֮�⻹�в���
		 */
		if(!empty($route) && isset($vars['com']) )
		{
 			$segments = explode('/', $route); 
			array_shift($segments);
			//print_r($segments);
			// 	�����ֺ���
			$component = preg_replace('/[^A-Z0-9_\.-]/i', '', $vars['com']);
 			// 	ʹ�����·�ɴ����������
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
 				//ԭ com_content �� substr($component,4) 
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
			//����ֱ�Ӹ�ȫ���������
			$_REQUEST = array_merge( $_REQUEST , $vars);

		} 
 		return $vars;
	}

	function &build(&$param)
	{
		$uri =&URI::getInstance();
		// ȡ��·������
		$route = $uri->getPath();

		//���ǰ׺��·��
		if( ROUTER_MODE > 0 && $route ) //$route ��ָ��ʽ����� /asfd/asfd/asfd
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
				//ת��Ϊһ����дURL���ַ�
				$route = str_replace('index.php/', '', $route);
			}else{
				if( strpos( $route ,'index.php' )===false )
				{
					$route .= "index.php";
				}
			}

			/**
			//============= ��ע =============	
			//�Ƿ������԰汾
			if( $lanName = $this->getLanguageName() ){
 				$route .= '/'.$lanName;

			}
			**/
			//============= ��ע =============
			//��һ����Ա����	
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


		//������Դ���ROUTER���н���,���ҵ��˵������ڴ˲˵���ʱ���᷵�ض���Ĳ���
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
 		 * �Ӳ˵��ķ�ʽ
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
		 * û�в˵���ֱ���������ʽ����URL
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

	//��һ����Ա����
	function getMemberName()
	{
		static $name;

		if( empty($name)){
			//URI����
			$uri = &URI::getInstance();
 			//��ǰ������query
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


	//��һ����ȡ��ǰ���԰汾����
	function getLanguageName()
	{

		return null;
		/**
		static $name;

		if( empty($name)){
			//URI����
			$uri = &URI::getInstance();
 			//��ǰ������query
			$route = $uri->getPath();
			
			$uri_param = explode('/',$route);
			if( ROUTER_MODE == 2 )
			{
				$name = $uri_param[1];
			}else{
				$name = $uri_param[2];
			}
		

			//�Ƿ��и����Է���
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
