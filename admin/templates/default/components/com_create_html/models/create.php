<?php
import('application.component.model');
class CreateModel extends Model
{
	var $menuid = 0;

	var $nav = null;
	function CreateModel()
	{
		parent::__construct();
 	}
	/**
	 * 取当前编辑项
	 */
	function getItem()
	{
		$act = trim($_REQUEST['act']);
		include(dirname(__FILE__).DS.'data'.DS.'type.php');
		
		$data = array();
		switch( $act ){
			case 'home':
				$data =$this->getHome();
				break;

			case 'menu':
				$data =$this->getMenu();
				break;

			case 'allwebsite':
				$data =$this->getAllWebsites();
				break;
			case 'category':
				$data =$this->getCategory();
				break;
		}
		return array('data'=>$data,'type'=>$lists['act']);
 	}
	

	function getHome(){}

	function getAllWebsites(){
		 $sql	= 'SELECT count(*) as num  ' .
					' FROM #__website AS m' .
					' WHERE  m.uid>0 '.
					'  ';

		$this->db->query($sql);

		$row = $this->db->getRow();
		

		$data = array(
			array('url'=>'websites',
			'page'=>ceil($row['num']/20),
			'text'=>'所有酷站列表',
			)
		);

		@unlink(PATH_BASE.DS.'index.html');

		return $data;
	}
	function getMenu(){
		 $sql	= 'SELECT m.name,m.type,m.component,m.alias,m.id,m.link  ' .
					' FROM #__menu AS m' .
					' WHERE  m.published = 1'.
					' ORDER BY  m.parent_id, m.lft ';

		$this->db->query($sql);

		$menus =$this->db->getResult('id');
		
 
 		/** 分析菜单路径 **/
		foreach($menus as $key => $menu)
		{
			//获取父栏目信息
			$parent_route = '';
			$parent_tree  = array();


			if(($parent = $menus[$key]['parent_id']) && (isset($menus[$parent])) && (isset($menus[$parent]['route'])) && isset($menus[$parent]['tree'])) {
				$parent_route = $menus[$parent]['route'].'/';
 			}


			//创建路径
			$route = $parent_route.$menus[$key]['alias'];
			$menus[$key]['route']  = $route;
			//加上说明
			$menus[$key]['text']=$menus[$key]['name'];

			if( $menu['type'] == 'url' ){
				//$menus[$key]['url'] = $menus[$key]['link'];
				unset($menus[$key]);
			}else{
				$menus[$key]['url'] = $menus[$key]['route'].'.html';
			}
		}
		return $menus;

	}
	function getCategory(){
		$sql	= 'SELECT m.name, m.component,m.alias,m.id ' .
						' FROM #__category AS m ' .
						' WHERE  m.published = 1'.
						'    ORDER BY m.lft';
		$this->db->query($sql);

		
		$menus =$this->db->getResult('id');
		
		$sql = "select count(id) as num,catid from #__website group by catid ";
		$this->db->query($sql);
 		$rows =$this->db->getResult('catid');
 
 		/** 分析菜单路径 **/
		foreach($menus as $key => $menu)
		{
			//获取父栏目信息
			$parent_route = '';
			$parent_tree  = array();


			if(($parent = $menus[$key]['parent_id']) && (isset($menus[$parent])) && (isset($menus[$parent]['route'])) && isset($menus[$parent]['tree'])) {
				$parent_route = $menus[$parent]['route'].'/';
 			}


			//创建路径
			$route = $parent_route.$menus[$key]['alias'];
			$menus[$key]['route']  = $route;
			//加上说明
			$menus[$key]['text']=$menus[$key]['name'];
 			$menus[$key]['url'] = $menus[$key]['route'].'.html';
			$menus[$key]['page'] = ceil($rows[$menu['id']]['num']/20);
 		}
		return $menus;

	}


	function start(){

		
		//$_REQUEST['no_html'] = 1;

		//传入的URL
		$ur = trim($_REQUEST['url']);

		//生成默认的网站列表
		if( strstr($ur, 'websites') !== false  ){
			return $this->startAllWebsite($ur);
		}



		$ur2 = $ur;
		
		if(  strlen($ur)<6 ){
			echo $ur.'不需要生成!';
			return;
		}	

		if( ( $position = strpos( $ur,'?') )  !== false ){
			//$part_1  = substr($ur,0,$position-5);
			parse_str(substr($ur,$position+1),$output);
			//print_r($output);
			$ur2 = substr($ur,0,$position-5).'_'.$output['page'].'.html';
 			//return;
		}

		$uri = &URI::getInstance();
 		$url_root = $uri->toString( array('scheme', 'host', 'port'));
		$file_root = PATH_ROOT.DS;
		
	 
		if( substr($ur,0,1) == '/' ){ $ur = substr($ur,1); }
		$url =  $url_root.'/index.php/'.$ur;
		$file = $file_root.$ur2;

		//echo $url;
		$content = $this->getfile($url);
		//echo $file;
		file_put_contents($file,preg_replace('|\s+|',' ',$content));

		echo $url.'|'.$file . '生成成功!';

	}


	function startAllWebsite($ur){

 		$output = array();
		if( ( $position = strpos( $ur,'?') )  !== false ){
			//$part_1  = substr($ur,0,$position-5);
			parse_str(substr($ur,$position+1),$output);
			//print_r($output);
			$ur2 = substr($ur,0,$position).'_'.$output['page'].'.html';

 			//return;
		}else{
			echo '需要生成页面。';
			echo $ur;
			return;
		}


 		$uri = &URI::getInstance();
 		$url_root = $uri->toString( array('scheme', 'host', 'port'));
		$file_root = PATH_ROOT.DS;
		
	 
		if( substr($ur,0,1) == '/' ){ $ur = substr($ur,1); }
		$url =  $url_root.'/?page='.$output['page'];
		$file = $file_root.$ur2;

		//echo $url;
		$content = $this->getfile($url);
		//echo $file;
		file_put_contents($file,preg_replace('|\s+|',' ',$content));

		echo $url.'|'.$file . '生成成功!';
	}



	
	//生成静态页
	function create(){
		//$_REQUEST['no_html'] = 1;
		$act = trim($_REQUEST['act']);
		$uri = &URI::getInstance();
 		$url_root = $uri->toString( array('scheme', 'host', 'port'));
		$file_root = PATH_ROOT.DS;
		
		switch($act){
 			case 'home':
				$url = "/";
				$html_file = "index.html";
				break;
		}
		
		$url = $url_root.$url;
		$file = $file_root.$html_file;

		//echo $url;
		$content = $this->getfile($url);
		//echo $file;
		file_put_contents($file,preg_replace('|\s+|',' ',$content));

		echo '生成成功!';

		
	}

    function getfile($url) // 获取目标
    {
		
    	//parse_url 解析一个 URL 并返回一个关联数组
        $url_parsed = parse_url($url);

        //主机
        $host = $url_parsed["host"];

		//端口号
        $port = $url_parsed["port"];
        if ($port==0)  $port = 80;

		//访问的URI文件路径
        $path = $url_parsed["path"];
        if (empty($path))
        $path="/";

		//URI参数
        if ($url_parsed["query"] != "")
           $path .= "?".$url_parsed["query"];

		//输出
        $out = "GET $path HTTP/1.0\r\nHost: $host\r\n\r\n";

        $fp = fsockopen($host, $port, $errno, $errstr, 30);
        fwrite($fp, $out);
        $body = false;
        while (!feof($fp))
        {
          $s = fgets($fp, 1024);
          if ( $body )  $in .= $s;
          if ( $s == "\r\n" )
               $body = true;
        }
		//echo $in.$path.__LINE__;
		//exit;
        fclose($fp);
		//echo $in.$path.__LINE__;
		//exit;
        return $in;
   }


  }






?>