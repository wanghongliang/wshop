<?php

$GLOBALS['itemid'] = 0;
/**
 * �˵�������
 */
class Menu
{
	var $menus = array();

	var $_active = null;
	var $_default = null;
	var $_uid = null; 
	var $catid = null;

	var $productsMenu = null;	//����Ϣ 

	function Menu()
	{
 		$this->load();
	} 
	function getItem($id)
	{
		return $this->menus[$id];
	} 
	function &getItems($attr,$value)
	{
		static $data = array();
		$name = $attr.$value;
		if( !isset($data[$name]) ){
			$data[$attr] = array();
			/** �����˵�·�� **/
			foreach($this->menus as $key => $menu)
			{
				if($menu[$attr] == $value){
					$data[$name][] = $menu;
				}
			}
		} 
		return $data[$name]; 
	}
	/**
	 * ���ز˵�
	 */
	function load()
	{
 		$uid = intval($GLOBALS['USERID']); 
 		//��ʼ������
		$db		= & Factory::getDB();
		
		/**
		if( $lname = RouterSite::getLanguageName() )
		{
			$sql	= 'SELECT m.* , d.menu_name as name  ' .
					' FROM #__menu AS m' .
					' left join #__menu_description as d on m.id=d.menu_id '.
					' WHERE m.uid='.$db->Quote($uid).' and m.published = 1'.
					' and d.language_id='.intval( $lname ).
					' ORDER BY  m.parent_id, m.lft ';
		}else{
		}

		**/

		 $sql	= 'SELECT m.id,m.name,m.elite,m.metakey,m.metadesc,m.parent_id,m.alias,m.component,m.tid,m.home,m.link ,m.lft,m.rgt,m.type ,m.params ' .
					' FROM #__menu AS m' .
					' WHERE  m.published = 1'.
					' ORDER BY  m.parent_id, m.lft ';

		$db->query($sql);

		$menus = $db->getResult('id');
		
 
 		/** �����˵�·�� **/
		foreach($menus as $key => $menu)
		{
			//��ȡ����Ŀ��Ϣ
			$parent_route = '';
			$parent_tree  = array(); 
			if(($parent = $menus[$key]['parent_id']) && (isset($menus[$parent])) && (isset($menus[$parent]['route'])) && isset($menus[$parent]['tree'])) {
				//$parent_route = $menus[$parent]['route'].'/';
				$parent_tree  = $menus[$parent]['tree'];
 			}

			//�������˵���ID��
			array_push($parent_tree, $menus[$key]['id']);

			//��ID����
			$menus[$key]['tree']   = $parent_tree;

			//����·��
			$route = $parent_route.$menus[$key]['alias'];
			$menus[$key]['route']  = $route;

			//��������URL����
			$url = str_replace('index.php?', '', $menus[$key]['link']);
			if(strpos($url, '&amp;') !== false)
			{
			   $url = str_replace('&amp;','&',$url);
			}

			parse_str($url, $menus[$key]['query']);

			if( $menus[$key]['home'] == 1 )
			{
				$this->_default = $key;
				$GLOBALS['itemid'] = $menu['id'];

 			}else if( $menus[$key]['query']['com'] == 'products' && $menus[$key]['query']['view'] == 'category' ){
				$this->productsMenu = $menus[$key];
			} 
		} 
		//print_r($menus); 
 		$this->menus = $menus;
	}

	function build()
	{
		$router = Router::getInstance('site');
		$results = $this->menus;
		for($i=0,$count=count($results);$i<$count;$i++ )
		{
			//$results[$i]['link'] = $this->route(&$results[$i]);//Router::_( $results[$i]['link'] );
			$data[$results[$i]['tid']][] = $results[$i];
		}
 	}

	function getMenus($tid = 0 )
	{
	
		if( $tid > 0 ){
			$menus = array();
			foreach( $this->menus as $m)
			{
				if( $tid == $m['tid'] ){
					$menus[] = $m;
				}
			}
		}else{
			$menus = $this->menus;
		}
		return $menus;
	}

 
	function buidTree($menus)
	{

		
		$arr = array();
		foreach( $menus as $m )
		{
			if( $m['home'] == 1 ){
  				$m['link'] ='/'.RouterSite::getMemberName();
			}else if( $m['type'] == 'component' ){
 			//�ڲ�����
			$m['link'] = Router::_( $m['link'].'&itemid='.$m['id']);
 			}else if( $m['type'] == 'menulink' ){
				$m['link'] = Router::_( $m['link']);
			}


			$arr[$m['parent_id']][] = $m;
		}


		unset($menus);
 
		return $arr;
	}

	function buildLink(&$m)
	{
		if( $m['home'] == 1 ){
			$m['link'] ='/'.RouterSite::getMemberName();
 		}else if( $m['type'] == 'component' ){//�ڲ�����
 					//�ڲ�����
					$m['link'] = Router::_( $m['link'].'&itemid='.$m['id']);
 		}else if( $m['type'] == 'menulink' ){
			$m['link'] = Router::_( $m['link']);
		}
	}
	/**
	 * ���ò˵���
	 */
	function setDefault($id)
	{
		if(isset($this->menus[$id])) {
			$this->_default = $id;
			return true;
		}

		return false;
	}

	/**
	 * ͨ��IDȡĬ�ϵĲ˵���
	 */
	function &getDefault()
	{
 		$item =& $this->menus[$this->_default];
		return $item;
	}

	/**
	 * ͨ��ID�趨��ǰ�˵�
	 */
	function &setActive($id)
	{
		if(isset($this->menus[$id]))
		{
			$this->_active = $id;
			$result = &$this->menus[$id];

			//����ģ�����õĵ�ǰ�˵�ID
			$GLOBALS['itemid'] = $id;

			return $result;
		}
		
		$result = null;
		return $result;
	}

	/**
	 * ȡ��ǰ�˵���
	 */
	function &getActive()
	{
		if ($this->_active) {
			$item =& $this->menus[$this->_active];
			return $item;
		}

		$result = null;
		return $result;
	}



	/**
	��*�����ز�ƷĿ¼
	��*/
	function &getCategory()
	{

		static $menus;

		if( empty($menus) ){
			$uid = intval($GLOBALS['USERID']);

			//��ʼ������
			$db		= & Factory::getDB();

			//$sql	= 'SELECT m.*,count(p.id) as num ' .
			//			' FROM #__category AS m left join #__website as p on m.id=p.catid ' .
			//			' WHERE  m.published = 1 group by m.id '.
			//			' ORDER BY m.lft ';
			$sql	= 'SELECT m.id,m.name,m.alias,m.lft,m.rgt,m.type_id,m.parent_id ' .
						' FROM #__category AS m  ' .
						' WHERE  m.published = 1'.
						' ORDER BY m.lft ';
 			$db->query($sql);
			$menus = $db->getResult("id");

 
			/** �����˵�·�� **/
			foreach($menus as $key => $menu)
			{
				//��ȡ����Ŀ��Ϣ
				$parent_route = '';
				$parent_tree  = array();

				$depth = 1;
				if(($parent = $menus[$key]['parent_id']) && (isset($menus[$parent])) && (isset($menus[$parent]['route'])) && isset($menus[$parent]['tree'])) {
					//$parent_route = $menus[$parent]['route'].'/';
					$parent_tree  = $menus[$parent]['tree'];
					$depth += $menus[$parent]['depth'];
					$menus[$parent]['num'] += $menus[$key]['num'];
				}
				//�������˵���ID��
				array_push($parent_tree, $menus[$key]['id']);

				//��ID����
				$menus[$key]['tree']   = $parent_tree;

				$menus[$key]['depth']   = $depth;

				//����·��
				$route = $menus[$key]['alias'];//$parent_route.$menus[$key]['alias'];
				$menus[$key]['route']  = $route;
			}  
		} 
 		return  $menus;
	}
	
	function getCategoryItem($id)
	{
		$cat = & $this->getCategory();
		return $cat[$id];
	}

	function getCategroyInfo($id)
	{
		$db		= & Factory::getDB();
		$sql	= 'SELECT *  FROM #__category AS m   WHERE  m.id = '.$id;
		$db->query($sql);
		$row = $db->getRow();
		return $row;
	}

	function getChildItem($pid)
	{
		$cat = & $this->getCategory();

		$childs =array();
		foreach( $cat as $c )
		{
			if( $c['parent_id'] == $pid )
			{
				$childs[] = $c;
			}
		}

		return $childs;

	}
	/** ����Ϊ��ƷĿ¼������ **/
	function bLink($route)
	{

		if( ROUTER_MODE==3 || ROUTER_MODE==2 ){
			return $this->suffixLink("/".$route);
		}else{
			//�ڲ�����
			return $this->suffixLink("/index.php/".$route);
		}
		
	}


 
	function link($route)
	{

		//echo $this->buysMenu['route'];
		$m = RouterSite::getMemberName();
		if( !empty($m) ){
			$m = '/'.$m.'/'.$route;
		}else{
			$m = '/'.$route;
		}

		return $m;		
	}


	/** ��������Ϣ�ķ���URL **/
	function bProductsLink($route){
		//echo $this->buysMenu['route'];
		$m = RouterSite::getMemberName();
		if( !empty($m) ){
			//$m = '/'.$m.'/'.$this->productsMenu['route'].'/'.$route;
			$m = '/'.$m.'/'.$route;
		}else{
			//$m = '/'.$this->productsMenu['route'].'/'.$route;
			$m = '/'.$route;
		}
		if( ROUTER_MODE==3 || ROUTER_MODE==2 ){
			return $this->suffixLink($m);
		}else{
			//�ڲ�����
			return $this->suffixLink('/index.php'.$m);
		} 
	}


	//��ǰ�˵��µķ���ṹ�����繫˾
	function CATELink($route){ 
		$m=&$this->getActive(); 
		return $this->suffixLink("/index.php/".$m['route'].'/'.$route);

	}

	//ȡ�󹺵Ĳ˵�
	function getBuysMenu(){
		return $this->buysMenu;
	}


	function suffixLink($link){
		return $link.'.html';
	}
	function getCategoryByAlias($route){ 
		if( $route ){
			//print_r($this->getCategory());
			$cats = &$this->getCategory();
			foreach( $cats as $cat ){
				if( strpos( $cat['route'], $route) === 0 ){
					return $cat;
				}
			}
		}
		return array();
	}
}

?>