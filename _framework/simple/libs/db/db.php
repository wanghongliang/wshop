<?php
 
class DB {
	/** 资源链接ID **/
	var $_resource = null;

	/** 表前缀 **/
	var $_prefix = null;

	/**
	 *  默认的时间格式
	 */
	var $_nullDate		= '0000-00-00 00:00:00';

	/**
	 * 引用字段的符号
	 */
	var $_nameQuote		= '`';
	var $Auto_Free     = 1;     ## 设置为1则自动执行 mysql_free_result()

	 /** 
	  * 行记录
	  */
	var $Record = array();


	/** 当前的限止 **/
	var $_limit = 0;
	var $_offset = 0;


	/** SQL 语句 **/
	var $_sql = null;

	/** 当前查询的游标 **/
	var $_cursor = null;


	/** 错误总数 **/
	var $_errorNum = 0;

	/** 错误信息 **/
	var $_errorMsg = null;


	function DB($options){ DB::__construct($options);	}	//PHP5以下的构造器
	function __construct( $options )
	{
		$host		= array_key_exists('host', $options)	? $options['host']		: 'localhost';
		$user		= array_key_exists('user', $options)	? $options['user']		: '';
		$password	= array_key_exists('password',$options)	? $options['password']	: '';
		$database	= array_key_exists('database',$options)	? $options['database']	: '';
		$prefix		= array_key_exists('prefix', $options)	? $options['prefix']	: 'w_';
		$select		= array_key_exists('select', $options)	? $options['select']	: true;

 		//if (!function_exists( 'mysql_connect' )) {
		//	Error::throwError(' 没有安装MYSQL链接函数库! ');
		//	return;
		//}
		$this->_debug = DEBUG;

		//表前缀
		$this->_prefix = $prefix;

		if (!($this->_resource = @mysql_connect( $host, $user, $password, true ))) {
			header('Content-Type:text/html;charset=utf-8');
			exit(' 数据库出现小问题，请<a href="javascript:location.reload()" >刷新页面</a>试试，如果还有问题请联系 QQ：308221710 谢谢! ');
			//Error::throwError ;
			return;
		}

 		if ( $select ) {
			$this->select($database);
		}

		$this->setUTF();	//设字符集
	}

	/** 析构方法 **/
	function __destruct()
	{
		$return = false;
		if (is_resource($this->_resource)) {
			$return = mysql_close($this->_resource);
		}
		return $return;
	}


	/** 选择一个指定的数据库 **/
	function select($database)
	{
		if ( ! $database )
		{
			return false;
		}

		if ( !mysql_select_db( $database, $this->_resource )) {
			Error::throwError(' 选择数据库失败! ：'.$database);
			return;
		}

 		if ( strpos( $this->getVersion(), '5' ) === 0 ) {
			//$this->query( "SET sql_mode = 'MYSQL40'"  );
		}
		return true;
	}

	/** 获取当前MYSQL版本信息 **/
	function getVersion()
	{
		return mysql_get_server_info( $this->_resource );
	}
	
	/** 判断当前数据库链接是否存在 **/
	function connected()
	{
		if(is_resource($this->_resource)) {
			return mysql_ping($this->_resource);
		}
		return false;
	}

	/** 判断是否支持UTF字符 **/
	function hasUTF()
	{
		$verParts = explode( '.', $this->getVersion() );
		return ($verParts[0] == 5 || ($verParts[0] == 4 && $verParts[1] == 1 && (int)$verParts[2] >= 2));
	}

	/** 设置为UTF8字符集 **/
	function setUTF()
	{
		mysql_query( "SET NAMES 'utf8'", $this->_resource );
	}
	
 
		/** 执行查询语句 **/
	function query($sql=null,$silent = false)
	{
		if (!is_resource($this->_resource)) {
			return false;
		}

		if(!is_null($sql)){
			$this->setQuery($sql);
		}
		
		if ($this->_limit > 0 || $this->_offset > 0) {
			$this->_sql .= ' LIMIT '.$this->_offset.', '.$this->_limit;
		}

		//echo $this->_sql;
 
		if ($this->_debug) {
			$this->_ticker++;
			$this->_log[] = $this->_sql;
		}
		$this->_errorNum = 0;
		$this->_errorMsg = '';
	 
		//echo $this->_sql;exit;


		$this->_cursor = mysql_query( $this->_sql, $this->_resource );

		if (!$this->_cursor && $silent == false )
		{
			$this->_errorNum = mysql_errno( $this->_resource );
			$this->_errorMsg = mysql_error( $this->_resource )." SQL=$this->_sql";
	 
			Error::throwError('WDatabaseMySQL::query: '.$this->_errorNum.' - '.$this->_errorMsg,'error' );
	 
			return false;
		}

 		return $this->_cursor;
	}
	/** 设置当前的查询语句 **/
	function setQuery( $sql, $offset = 0, $limit = 0, $prefix='#__' )
	{
		$this->_sql		= $this->replacePrefix( $sql, $prefix );
		$this->_limit	= (int) $limit;
		$this->_offset	= (int) $offset;
	}

	/**
	 * 替换表前缀信息
	 */
	function replacePrefix( $sql, $prefix='#__' )
	{
		$sql = trim( $sql );

		$escaped = false;
		$quoteChar = '';

		$n = strlen( $sql );

		$startPos = 0;
		$literal = '';
		while ($startPos < $n) {
			$ip = strpos($sql, $prefix, $startPos);
			if ($ip === false) {
				break;
			}

			$j = strpos( $sql, "'", $startPos );
			$k = strpos( $sql, '"', $startPos );
			if (($k !== FALSE) && (($k < $j) || ($j === FALSE))) {
				$quoteChar	= '"';
				$j			= $k;
			} else {
				$quoteChar	= "'";
			}

			if ($j === false) {
				$j = $n;
			}

			$literal .= str_replace( $prefix, $this->_prefix,substr( $sql, $startPos, $j - $startPos ) );
			$startPos = $j;

			$j = $startPos + 1;

			if ($j >= $n) {
				break;
			}

			// quote comes first, find end of quote
			while (TRUE) {
				$k = strpos( $sql, $quoteChar, $j );
				$escaped = false;
				if ($k === false) {
					break;
				}
				$l = $k - 1;
				while ($l >= 0 && $sql{$l} == '\\') {
					$l--;
					$escaped = !$escaped;
				}
				if ($escaped) {
					$j	= $k+1;
					continue;
				}
				break;
			}
			if ($k === FALSE) {
				// error in the query - no end quote; ignore it
				break;
			}
			$literal .= substr( $sql, $startPos, $k - $startPos + 1 );
			$startPos = $k+1;
		}
		if ($startPos < $n) {
			$literal .= substr( $sql, $startPos, $n - $startPos );
		}
		return $literal;
	}
	/***
	 * 添加的查询方式
	 */
	function next_record() {
		if (!is_resource($this->_cursor)) {
			return false;
		}
		$this->Record = mysql_fetch_array($this->_cursor);


		//用一个行属性记录所移到的行数
		$this->Row   += 1;
 
		$stat = is_array($this->Record);
		if (!$stat && $this->Auto_Free) {
		  $this->free();
		}
		return $stat;
	  }

	  /* public:释放查询结果 */
	  function free() {
		  @mysql_free_result($this->_cursor);
		  $this->_cursor = false;
	  }

	/**
	 * 当更新后，影响的列表
	 */
	function getAffectedRows()
	{
		return mysql_affected_rows( $this->_resource );
	}


	/** 批量执行查询语句,  **/
  	function queryBatch( $abort_on_error=true, $p_transaction_safe = false)
	{
		$this->_errorNum = 0;
		$this->_errorMsg = '';
		if ($p_transaction_safe) {
			$this->_sql = rtrim($this->_sql, '; \t\r\n\0');
			$si = $this->getVersion();
			preg_match_all( "/(\d+)\.(\d+)\.(\d+)/i", $si, $m );
			if ($m[1] >= 4) {
				$this->_sql = 'START TRANSACTION;' . $this->_sql . '; COMMIT;';
			} else if ($m[2] >= 23 && $m[3] >= 19) {
				$this->_sql = 'BEGIN WORK;' . $this->_sql . '; COMMIT;';
			} else if ($m[2] >= 23 && $m[3] >= 17) {
				$this->_sql = 'BEGIN;' . $this->_sql . '; COMMIT;';
			}
		}
		$query_split = $this->splitSql($this->_sql);
		$error = 0;
		foreach ($query_split as $command_line) {
			$command_line = trim( $command_line );
			if ($command_line != '') {
				$this->_cursor = mysql_query( $command_line, $this->_resource );
				if (!$this->_cursor) {
					$error = 1;
					$this->_errorNum .= mysql_errno( $this->_resource ) . ' ';
					$this->_errorMsg .= mysql_error( $this->_resource )." SQL=$command_line <br />";
					if ($abort_on_error) {
						return $this->_cursor;
					}
				}
			}
		}
		return $error ? false : true;
	}

	function splitSql( $queries )
	{
		$start = 0;
		$open = false;
		$open_char = '';
		$end = strlen($queries);
		$query_split = array();
		for($i=0;$i<$end;$i++) {
			$current = substr($queries,$i,1);
			if(($current == '"' || $current == '\'')) {
				$n = 2;
				while(substr($queries,$i - $n + 1, 1) == '\\' && $n < $i) {
					$n ++;
				}
				if($n%2==0) {
					if ($open) {
						if($current == $open_char) {
							$open = false;
							$open_char = '';
						}
					} else {
						$open = true;
						$open_char = $current;
					}
				}
			} 
			if(($current == ';' && !$open)|| $i == $end - 1) {
				$query_split[] = substr($queries, $start, ($i - $start + 1));
				$start = $i + 1;
			}
		}

		return $query_split;
	}
	/** 调试方法 **/
	function explain()
	{
		$temp = $this->_sql;
		$this->_sql = "EXPLAIN $this->_sql";

		if (!($cur = $this->query())) {
			return null;
		}
		$first = true;

		$buffer = '<table id="explain-sql">';
		$buffer .= '<thead><tr><td colspan="99">'.$this->getQuery().'</td></tr>';
		while ($row = mysql_fetch_assoc( $cur )) {
			if ($first) {
				$buffer .= '<tr>';
				foreach ($row as $k=>$v) {
					$buffer .= '<th>'.$k.'</th>';
				}
				$buffer .= '</tr>';
				$first = false;
			}
			$buffer .= '</thead><tbody><tr>';
			foreach ($row as $k=>$v) {
				$buffer .= '<td>'.$v.'</td>';
			}
			$buffer .= '</tr>';
		}
		$buffer .= '</tbody></table>';
		mysql_free_result( $cur );

		$this->_sql = $temp;

		return $buffer;
	}

	/** 返加当前查询的行记录数量 **/
	function getNumRows( $cur=null )
	{
		return mysql_num_rows( $cur ? $cur : $this->_cursor );
	}


	/** 加载一行记录 **/
	function getRow()
	{
		if (!($cur = $this->_cursor)) {
			return null;
		}
		$ret = null;
		if ($row = mysql_fetch_assoc( $cur )) {
			$ret = $row;
		}
		mysql_free_result( $cur );
		return $ret;
	}
 

	/** 加载一个多维数组的结果 **/
 	function getResult( $key=null,$flag=false )
	{
		if (!($cur = $this->_cursor)) {
			return null;
		}


 		$array = array();
		if ($key !== null) {
			if( $flag ){
				while ($row = mysql_fetch_assoc( $cur )) {
					$array[$row[$key]][] = $row;
				}
			}else{
				while ($row = mysql_fetch_assoc( $cur )) {
				$array[$row[$key]] = $row;
				}
			}
		} else {
			while ($row = mysql_fetch_assoc( $cur )) {
				$array[] = $row;
			}
		}
 
		mysql_free_result( $cur );
		return $array;
	} 


	/** 加载一个对象列表数组 **/
 	function loadObjectList( $key='' , $multi = false )
	{
		if (!($cur = $this->_cursor)) {
			return null;
		}
		$array = array();

		//多维数组
		if($multi && $key )
		{
			while ($row = mysql_fetch_object( $cur )) {
				$array[$row->$key][] = $row;
			}
		}else{
			if($key)
			{
				while ($row = mysql_fetch_object( $cur )) {
 					$array[$row->$key] = $row;
				}
			}else
			{
				while ($row = mysql_fetch_object( $cur )) {
					$array[] = $row;
				}
			}
		}
		mysql_free_result( $cur );
		return $array;
	}

	/** 插入后的ID **/
	function insertid()
	{
		return mysql_insert_id( $this->_resource );
	}

	/**
	 * 插入一条记录，参数以对象形式 
 	 */
	function insertObject( $table, &$object, $keyName = NULL )
	{
		$fmtsql = "INSERT INTO $table ( %s ) VALUES ( %s ) ";
		$fields = array();
		foreach (get_object_vars( $object ) as $k => $v) {
			if (is_array($v) or is_object($v) or $v === NULL) {
				continue;
			}
			if ($k[0] == '_') { // internal field
				continue;
			}
			$fields[] = $this->nameQuote( $k );
			$values[] = $this->isQuoted( $k ) ? $this->Quote( $v ) : (int) $v;
		}

		//echo  sprintf( $fmtsql, implode( ",", $fields ) ,  implode( ",", $values ) );
		//return;


		$this->setQuery( sprintf( $fmtsql, implode( ",", $fields ) ,  implode( ",", $values ) ) );
		if (!$this->query()) {
			return false;
		}
		$id = $this->insertid();
		if ($keyName && $id) {
			$object->$keyName = $id;
		}
		return true;
	}

	/**
	 *  更新一条记录，参数以对象形式 
	 */
	function updateObject( $table, &$object, $keyName, $updateNulls=true )
	{
		$fmtsql = "UPDATE $table SET %s WHERE %s";
		$tmp = array();
		foreach (get_object_vars( $object ) as $k => $v)
		{
			if( is_array($v) or is_object($v) or $k[0] == '_' ) { // internal or NA field
				continue;
			}
			if( $k == $keyName ) { // PK not to be updated
				$where = $keyName . '=' . $this->Quote( $v );
				continue;
			}
			if ($v === null)
			{
				if ($updateNulls) {
					$val = 'NULL';
				} else {
					continue;
				}
			} else {
				$val = $this->isQuoted( $k ) ? $this->Quote( $v ) : (int) $v;
			}
			$tmp[] = $this->nameQuote( $k ) . '=' . $val;
		}

		//echo sprintf( $fmtsql, implode( ",", $tmp ) , $where );
		 
		$this->setQuery( sprintf( $fmtsql, implode( ",", $tmp ) , $where ) );
		return $this->query();
	}
	/**
	 *  更新一条记录，参数以数组形式 
	 */
	function updateArray( $table, &$array, $where, $updateNulls=true )
	{
		$fmtsql = "UPDATE $table SET %s WHERE %s";
		$tmp = array();
		foreach ($array  as $k => $v)
		{
			if( is_array($v) or is_object($v) or $k[0] == '_' ) { // internal or NA field
				continue;
			}
	 
			if ($v === null)
			{
				if ($updateNulls) {
					$val = 'NULL';
				} else {
					continue;
				}
			} else {
				$val =  $this->Quote( $v );
			}
			$tmp[] = $this->nameQuote( $k ) . '=' . $val;
		}

		//echo sprintf( $fmtsql, implode( ",", $tmp ) , $where );
		 
		$this->setQuery( sprintf( $fmtsql, implode( ",", $tmp ) , $where ) );
		return $this->query();
	}
	function insertArray( $table, &$array, $updateNulls=true )
	{
		$fmtsql = "INSERT $table SET %s";
		$tmp = array();
		foreach ($array  as $k => $v)
		{
			if( is_array($v) or is_object($v) or $k[0] == '_' ) { // internal or NA field
				continue;
			}
	 
			if ($v === null)
			{
				if ($updateNulls) {
					$val = 'NULL';
				} else {
					continue;
				}
			} else {
				$val =  $this->Quote( $v );
			}
			$tmp[] = $this->nameQuote( $k ) . '=' . $val;
		}

		//echo sprintf( $fmtsql, implode( ",", $tmp ) , $where );
		 
		$this->setQuery( sprintf( $fmtsql, implode( ",", $tmp )  ) );
		return $this->query();
	}
	
	/**
	* 引用一个字段值
	*
	* @param	string	A string
	* @param	boolean	Default true to escape string, false to leave the string unchanged
	* @return	string
 	*/
	function Quote( $text, $escaped = true )
	{
		return '\''.($text).'\'';
	}
	function nameQuote( $s )
	{
		$q = $this->_nameQuote;
		if (strlen( $q ) == 1) {
			return $q . $s . $q;
		} else {
			return $q{0} . $s . $q{1};
		}
	}





	function arrayToField($data)
	{
		$str = '';
		if( is_array($data) ){
			foreach( $data as $k=>$v )
			{
				$str .= ",".$this->nameQuote($k)."=".$this->Quote($v);
			}
		}
		return $str;
	}
}
 
?>
