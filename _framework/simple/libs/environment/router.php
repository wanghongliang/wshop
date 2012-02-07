<?php

/**
 * 此路由器主要是格式化URL信息，并输出对应的链接信息
 */

class Router
{
	//当前系统的相关参数
	var $option = array();

	/**
	 * 构造方法
	 */
	function Router()
	{
		//初始化url默认的选项
		$this->option = array('com'=>$_REQUEST['com'],'task'=>$_REQUEST['task']);
	}


	/**
	 * 返回一个 路由器的实例, 单例工厂
	 * @param string  $client  应用名称
	 * @param array   $options 相关联的选项数组
	 * @return	WRouter	一个路由对象
	 */
	function &getInstance($client, $options = array())
	{
		static $instances;

		if (!isset( $instances )) {
			$instances = array();
		}

		if ( empty($instances[$client]) )
		{
			//加载一个路由对象
			$path = PATH_PREVIEW.DS.'includes'.DS.'router.php';
    			if(file_exists($path))
			{
 				require_once $path;

				// 创建一个路由对象
				$classname = 'Router'.ucfirst($client);
  				$instance = new $classname($options);
			}
			else
			{
				Error::throwError( '不能够加载客户端: '.$path);
 			}

			$instances[$client] = & $instance;
		}

		return $instances[$client];
	}
	
	/**
	 * 格式化URL链接
	 */
	function _( $param )
	{
		static $router;
 		//数组格式传参
		if( !is_array($param) )
		{	
			$t = parse_url($param);
			parse_str( $t['query'] , $output );
 			unset($t);
			$param = $output;
		}



 		//如果定义路由器模式，将解析路由

		if( defined('ROUTER_MODE') )
		{
			if( empty($router) ){
				global $app;
  				$router = &Router::getInstance($app->getName());
			}
			return $router->build($param);
		}

	   

		$this->option = array_merge ($this->option , $param);


		//格式化当前的链接
		$link = 'index.php';
		
		/**
		
		$link .= '/'.$this->option['com'];
		$link .= '/'.$this->option['act'];
		
		//把其它参数转为URL链接
		foreach( $param as $v )
		{
			$link .='/'.$v;
		}
		**/
		$link .= '?com='.$this->option['com'];


		if( $this->option['task'] )
		{
			$link .= '&task='.$this->option['task'];
		}
		
		//把其它参数转为URL链接
		foreach( $param as $k=>$v )
		{
			$link .='&'.$k.'='.$v;
		}
		
		return $link;
	}

	/**
	 * 编码部分路由
	 *
 
 	 */
	function _encodeSegments($segments)
	{
		$total = count($segments);
		for($i=0; $i<$total; $i++) {
			$segments[$i] = str_replace('/', '-', $segments[$i]);
		}

		return $segments;
	}

	/**
	 * 解码
 
 	 */
	function _decodeSegments($segments)
	{
		$total = count($segments);
		for($i=0; $i<$total; $i++)  {
			$segments[$i] = preg_replace('/-/', '/', $segments[$i], 1);
		}

		return $segments;
	}
}
?>