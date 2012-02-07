<?php
 
 
class URI 
{
	/**
	 * 初始化URI
	 */
	var $_uri = null;

	/**
	 * 协议 HTTP / FTP
	 */
	var $_scheme = null;

	/**
	 * 主机
	 */
	var $_host = null;

	/**
	 * 端口号
	 */
	var $_port = null;

	/**
	 * 用户名,一般是隐藏名
	 */
	var $_user = null;

	/**
	 * 密码
	 */
	var $_pass = null;

	/**
	 * 文件路径
	 */
	var $_path = null;
	var $_initPath=null;

	/**
	 * 请求的参数串
	 */
	var $_query = null;

	/**
	 * 锚点
	 */
	var $_fragment = null;

	/**
	 * 变量数组
	 */
	var $_vars = array ();

	/**
	 * 构造器，你可以通过指定的URI，初始化肥厂
	 */
	function __construct($uri = null)
	{
		if ($uri !== null) {
			$this->parse($uri);
		}
	}

	/**
	 * 返回URI实例对象
	 */
	function &getInstance($uri = 'SERVER')
	{
		static $instances = array();

		if (!isset ($instances[$uri]))
		{
			// 我们从服务器获得的URI
			if ($uri == 'SERVER')
			{
				// 是否要求通过SSL （ HTTPS）
				if (isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) != 'off')) {
					$https = 's://';
				} else {
					$https = '://';
				}

				/*
				 * 服务器是 apache or IIS
				 */
				if (!empty ($_SERVER['PHP_SELF']) && !empty ($_SERVER['REQUEST_URI'])) {

					/*
					 * URI 字符串
					 */
					$theURI = 'http' . $https . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

				/*
				 * 如果不是工作在 apache 上，需要用其它的方法构建URI
				 */
				}
				 else
				 {
					// IIS使用的SCRIPT_NAME变量，而不是REQUEST_URI变量 
					$theURI = 'http' . $https . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];

					// 加上查询字符串
					if (isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING'])) {
						$theURI .= '?' . $_SERVER['QUERY_STRING'];
					}
				}

				// 过滤非法信息
				$theURI = urldecode($theURI);
				$theURI = str_replace('"', '&quot;',$theURI);
				$theURI = str_replace('<', '&lt;',$theURI);
				$theURI = str_replace('>', '&gt;',$theURI);
				$theURI = preg_replace('/eval\((.*)\)/', '', $theURI);
				$theURI = preg_replace('/[\\\"\\\'][\\s]*javascript:(.*)[\\\"\\\']/', '""', $theURI);
			}
			else
			{
				//指定的URI
				$theURI = $uri;
			}
					
			//服务器不同变量不同
			if( ROUTER_MODE > 1 ){ $theURI = str_replace('/index.php','',$theURI); }

			// 创建一个新的URI实例
			$instances[$uri] = new URI($theURI);
		}
		return $instances[$uri];
	}

	/**
	 * 返回 基本的URI
	 */
	function base($pathonly = false)
	{
		static $base;

 		if (!isset($base))
		{
		 
			$uri	         =& URI::getInstance();
			$base['prefix'] = $uri->toString( array('scheme', 'host', 'port'));

			if (strpos(php_sapi_name(), 'cgi') !== false && !empty($_SERVER['REQUEST_URI'])) {
				//Apache CGI
				$base['path'] =  rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

				if( ( $p = strpos($base['path'],'/index.php') ) !== false )
				{
					$base['path'] = substr($base['path'],0,$p);
				}
			} else {
				//Others
				$base['path'] =  rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
			}
			
		}

		return $pathonly === false ? $base['prefix'].$base['path'].'/' : $base['path'];
	}

	/**
	 * 返回URI根信息
	 */
	function root($pathonly = false, $path = null)
	{
		static $root;

		// 取协议
		if(!isset($root))
		{
			$uri	        =& URI::getInstance();
			$root['prefix'] = $uri->toString( array('scheme', 'host', 'port'));
			$root['path']    = URI::base(true);
		}

		// 设定访问的 path
		if(isset($path)) {
			$root['path']    = $path;
		}
		
		return $pathonly === false ? $root['prefix'].$root['path'].'/' : $root['path'];
	}

	/**
	 * 返回当前的URI请求信息
	 */
	function current($reset=array())
	{
		static $current;

		//得到URI
		if (!isset($current))
		{
			$uri	 = & URI::getInstance();
			$current = $uri->_uri;//$uri->toString( array('scheme', 'host', 'port', 'path','query') );
 		}

		//重设当前值
		if( count($reset) > 0 ){
			$link = parse_url($current);
			parse_str($link['query'],$linkParameter);

			foreach( $reset as $k=>$v )
			{
				$linkParameter[$k] = $v;
			}
			$current = $link['path'].'?'.http_build_query($linkParameter);
		}

		return $current;
	}

	/**
	 * 分析指定的URI
	 */
	function parse($uri)
	{
		//初始化一个变量
		$retval = false;

		// 初始化 uri
		$this->_uri = $uri;

		/*
		 * 解析URI和填充对象字段。如果正确的URI解析方法的返回值为true 。
		 */
		if ($_parts = $this->_parseURL($uri)) {
			$retval = true;
		}

 		//替换其它字符
		if(isset ($_parts['query']) && strpos($_parts['query'], '&amp;')) {
			$_parts['query'] = str_replace('&amp;', '&', $_parts['query']);
		}

		$this->_scheme = isset ($_parts['scheme']) ? $_parts['scheme'] : null;
		$this->_user = isset ($_parts['user']) ? $_parts['user'] : null;
		$this->_pass = isset ($_parts['pass']) ? $_parts['pass'] : null;
		$this->_host = isset ($_parts['host']) ? $_parts['host'] : null;
		$this->_port = isset ($_parts['port']) ? $_parts['port'] : null;

		$this->_path = $_parts['path'];
 		$this->_initPath = isset ($_parts['path']) ? $_parts['path'] : null;
 		$this->_query = isset ($_parts['query'])? $_parts['query'] : null;
		$this->_fragment = isset ($_parts['fragment']) ? $_parts['fragment'] : null;

  		//分析 QUERY 部分

		if(isset ($_parts['query'])) parse_str($_parts['query'], $this->_vars);
		return $retval;
	}

	/**
	 * 返加一个完整的URI字符串
	 */
	function toString($parts = array('scheme', 'user', 'pass', 'host', 'port', 'path', 'query', 'fragment'))
	{
		$query = $this->getQuery(); 
 
		$uri = '';
		$uri .= in_array('scheme', $parts)  ? (!empty($this->_scheme) ? $this->_scheme.'://' : '') : '';
		$uri .= in_array('user', $parts)	? $this->_user : '';
		$uri .= in_array('pass', $parts)	? (!empty ($this->_pass) ? ':' : '') .$this->_pass. (!empty ($this->_user) ? '@' : '') : '';
		$uri .= in_array('host', $parts)	? $this->_host : '';
		$uri .= in_array('port', $parts)	? (!empty ($this->_port) ? ':' : '').$this->_port : '';


		$uri .= in_array('path', $parts)	? $this->_initPath : '';
 
			
		$uri .= in_array('query', $parts)	? (!empty ($query) ? '?'.$query : '') : '';
		$uri .= in_array('fragment', $parts)? (!empty ($this->_fragment) ? '#'.$this->_fragment : '') : '';

		//echo $this->_initPath;

		return $uri;
	}

	/**
	 * 替换URI变量
	 */
	function setVar($name, $value)
	{
		$tmp = @$this->_vars[$name];
		$this->_vars[$name] = $value;

 
		$this->_query = null;

		return $tmp;
	}

	/**
	 * 通过URI变量名,返回一个变量的值
	 */
	function getVar($name = null, $default=null)
	{
		if(isset($this->_vars[$name])) {
			return $this->_vars[$name];
		}
		return $default;
	}
	function setVars( $arr ){
		if( is_array($arr) ){ $this->_vars = array_merge( $this->_vars , $arr ); }
	}
	/**
	 * 删除一个URI变量
	 */
	function delVar($name)
	{
		if (in_array($name, array_keys($this->_vars)))
		{
			unset ($this->_vars[$name]);

			 
			$this->_query = null;
		}
	}

	/**
	 * 设定 query 格式如下：
	 * 		foo=bar&x=y
	 *
	 * params array | string
	 */
	function setQuery($query)
	{
		if(!is_array($query)) {
			if(strpos($query, '&amp;') !== false)
			{
			   $query = str_replace('&amp;','&',$query);
			}
			parse_str($query, $this->_vars);
		}

		if(is_array($query)) {
			$this->_vars = $query;
		}
		$this->_query = null;
	}

	/**
	 * 返回一个QUERY字符串 或 数组
	 */
	function getQuery($toArray = false)
	{
		if($toArray) {
			return $this->_vars;
		}

        //为空的话先得到值
		if(is_null($this->_query)) {
			$this->_query = $this->buildQuery($this->_vars);
		}

		return $this->_query;
	}


	/**
	 * 根据当前的URL信息，加相应的参数
	 */
	 function getByURL($param){
		static $path;
		if( empty($path) ){
			if( ROUTER_MODE== 3 && strpos($this->_initPath,'index.php') === false ){
				$path = 'index.php';
			}else{
				$path = $this->_initPath;
			}

			if( ROUTER_MODE== 3 ){
				if( !$path ){ $path = '/index.php';}
			}else if( ROUTER_MODE== 2 ){
				$path = str_replace('/index.php','',$path);
			}
		}
		
		parse_str($this->getQuery(),$output);
		foreach( $param as $k => $v ){
			$output[$k]=$v;
		}

 		return $path. '?'.http_build_query($output);
	 }

	/**
	 * 把数组转为一个query 字符串
	 */
	function buildQuery ($params, $akey = null)
	{
		if ( !is_array($params) || count($params) == 0 ) {
			return false;
		}

		$out = array();

	 
		if( !isset($akey) && !count($out) )  {
			unset($out);
			$out = array();
		}

		foreach ( $params as $key => $val )
		{
			if ( is_array($val) ) {
				$out[] = URI::buildQuery($val,$key);
				continue;
			}

			$thekey = ( !$akey ) ? $key : $akey.'[]';
			$out[] = $thekey."=".urlencode($val);
		}

		return implode("&",$out);
	}


	function buildLink($param){
		static $path;
		if( empty($path) ){
			if( ROUTER_MODE== 3 && strpos($this->_initPath,'index.php') === false ){
				$path = 'index.php';
			}else{
				$path = $this->_initPath;
			}

			if( ROUTER_MODE== 3 ){
				if( !$path ){ $path = '/index.php';}
			}else if( ROUTER_MODE== 2 ){
				$path = str_replace('/index.php','',$path);
			}
		}
		
 			$link = $path;
 



			if( strpos($link,'?')===false ){
				$link .="?".$this->buildQuery($param);
			}else{
				$link .= $this->buildQuery($param);
			}
	 
 		return  $link;
	}
	/**
	 * 取得协议
	 */
	function getScheme() {
		return $this->_scheme;
	}

	/**
	 * 设定协议
	 */
	function setScheme($scheme) {
		$this->_scheme = $scheme;
	}

	/**
	 * 取用户名
	 */
	function getUser() {
		return $this->_user;
	}

	/**
	 * 设定用户名
	 */
	function setUser($user) {
		$this->_user = $user;
	}

	/**
	 * 取得URI password
	 */
	function getPass() {
		return $this->_pass;
	}

	/**
	 * 设定 password
	 */
	function setPass($pass) {
		$this->_pass = $pass;
	}

	/**
	 * 取URI 主机
	 */
	function getHost() {
		return $this->_host;
	}

	/**
	 * 设定URI 主机
	 */
	function setHost($host) {
		$this->_host = $host;
	}

	/**
	 * 取端口号
	 */
	function getPort() {
		return (isset ($this->_port)) ? $this->_port : null;
	}

	/**
	 * 设端口号
	 */
	function setPort($port) {
		$this->_port = $port;
	}

	/**
	 * 取URI文件路径
	 */
	function getPath() {
		return $this->_path;
	}
	/** 返回初始化路径 **/
	function getInitPath(){
		 return $this->_initPath;
	}
	/**
	 * 设URI文件路径
	 */
	function setPath($path) {
		$this->_path = $this->_cleanPath($path);
	}

	/**
	 * 取锚点
	 */
	function getFragment() {
		return $this->_fragment;
	}

	/**
	 * 设定锚点
	 */
	function setFragment($anchor) {
		$this->_fragment = $anchor;
	}

	/**
	 * 检测是否为 SSL 协议
	 */
	function isSSL() {
		return $this->getScheme() == 'https' ? true : false;
	}

	/** 
	 * Checks if the supplied URL is internal
	 *
	 * @access	public
	 * @param 	string $url The URL to check
	 * @return	boolean True if Internal
	 * @since	1.5
	 */
	function isInternal($url) {
		$uri =& URI::getInstance($url);
		$base = $uri->toString(array('scheme', 'host', 'port', 'path'));
		$host = $uri->toString(array('scheme', 'host', 'port'));
		if(stripos($base, URI::base()) !== 0 && !empty($host)) {
			return false;
		}
		return true;
	}
	/**
	 * 根据 ./ ../ 设定URI 文件路径
	 */
	function _cleanPath($path)
	{
		$path = explode('/', preg_replace('#(/+)#', '/', $path));

		for ($i = 0; $i < count($path); $i ++) {
			if ($path[$i] == '.') {
				unset ($path[$i]);
				$path = array_values($path);
				$i --;

			}
			elseif ($path[$i] == '..' AND ($i > 1 OR ($i == 1 AND $path[0] != ''))) {
				unset ($path[$i]);
				unset ($path[$i -1]);
				$path = array_values($path);
				$i -= 2;

			}
			elseif ($path[$i] == '..' AND $i == 1 AND $path[0] == '') {
				unset ($path[$i]);
				$path = array_values($path);
				$i --;

			} else {
				continue;
			}
		}

		return implode('/', $path);
	}

	/**
	 * 向后兼容函数
	 */
	function _parseURL($uri)
	{
		$parts = array();
		if (version_compare( phpversion(), '4.4' ) < 0)
		{
			$regex = "<^(([^:/?#]+):)?(//([^/?#]*))?([^?#]*)(\\?([^#]*))?(#(.*))?>";
			$matches = array();
			preg_match($regex, $uri, $matches, PREG_OFFSET_CAPTURE);

			$authority = @$matches[4][0];
			if (strpos($authority, '@') !== false) {
				$authority = explode('@', $authority);
				@list($parts['user'], $parts['pass']) = explode(':', $authority[0]);
				$authority = $authority[1];
			}

			if (strpos($authority, ':') !== false) {
				$authority = explode(':', $authority);
				$parts['host'] = $authority[0];
				$parts['port'] = $authority[1];
			} else {
				$parts['host'] = $authority;
			}

			$parts['scheme'] = @$matches[2][0];
			$parts['path'] = @$matches[5][0];
			$parts['query'] = @$matches[7][0];
			$parts['fragment'] = @$matches[9][0];
		}
		else
		{
			$parts = @parse_url($uri);
		}

		//print_r($parts);
		return $parts;
	}


}
