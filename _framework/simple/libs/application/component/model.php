<?php
/**
* @ 版本		$Id: index.php 2009-6-26
* @ 作用		系统入口文件
* @ 包			libraries
* @ 团队        团队One网
* @ copyright   Copyright (c) 2006-2009 TuanduiOne Inc. All rights reserved {@link http://www.daybillion.com}
* @ 作者        王洪亮
* @ E-mail      daybillion@yahoo.com.cn
* @ 认证		需商业许可认证,详细请查看根目录下 LICENSE.txt
* @ 备注：		本系统基于团队协作开发
 */
 
/**
 * 模型类
 */
class Model
{

	/**
	 * 模型对应的表名称
	 */
	var $tableName;

	/**
	 * 模型类的名称
	 */
	var $_name;

	/**
	 * 数据库查询类
	 */
	var $db;

	/**
	 * 对象的状态
	 */
	var $_state;


	/**
	 * 模型的相关信息对象
	 */
	var $_meta;



	/**
	 * 模型定义类
	 */

	 var $_defineClass;


	var $uid;
	
	function Model( $config = array() )
	{
		$this->__construct( $config );
	}
	/**
	 * 构造器
	 */
	function __construct($config = array())
	{
		global $app;

		//设置视图的名称
		if (empty( $this->_name ))
		{
			if (array_key_exists('name', $config))  {
				$this->_name = $config['name'];
			} else {
				$this->_name = $this->getName();
			}
		}

		//设置模型的附加属性状态数组
		if (array_key_exists('state', $config))  {
			$this->_state = $config['state'];
		} else {
			$this->_state = array();
		}

		//设置模型的数据库操作对象
		if (array_key_exists('dbo', $config))  {
			$this->db = $config['dbo'];
		} else {
			$this->db = &Factory::getDB();
		}

		// 设置搜索视图类的文件路径
		if (array_key_exists('table_path', $config)) {
			$this->addTablePath($config['table_path']);
		} else if (defined( 'PATH_COMPONENT' )){
			$this->addTablePath(PATH_COMPONENT_ADMIN.DS.'tables');
		}

 		$this->uid = $app->uid;		//设会员ID
		
		/** 创建Meta对象 **/
		//$this->meta = WMeta::getInstance(get_class($this));

		//print_r($this->meta);
	    
		//echo $this->_name;
	}


	 
 

	/**
	 * 设置模型状的属性值方法
	 *
	 * @param	string	属性名称
	 * @param	mixed	不同类型的变量
	 * @return	mixed	返回提供的值
	 */
	function setState( $property, $value=null )
	{
		return $this->_state[$property] = $value;
	}

	/**
	 * 获取状态相关的属性值
	 *
	 * @param	string	名称
	 * @return	object	返回指定属性的值
	 */
	function getState($property = null)
	{
		return $property === null ? $this->_state : $this->_state[$property];
	}

	/**
	 * 取数据库对象
	 */
	function &getDB()
	{
		return $this->_db;
	}

	/**
	 * 设置数据库连接对象
	 */
	function setDB(&$db)
	{
		$this->_db =& $db;
	}

	/**
	 * 获取模型对象的名称
	 */
	function getName()
	{
		$name = $this->_name;

		if (empty( $name ))
		{
			$r = null;
			if (!preg_match('/(.*)Model/i', get_class($this), $r)) {
				Error::throwError (500, "WModel::getName() : Can't get or parse class name.");
			}
			$name = strtolower( $r[1] );
		}
		return $name;
	}



	/**
	 * 获取一个表对象，如果有必需就加载它
	 *
	 * @param	string  表名称
	 * @param	string  类的前缀
	 * @param	array	模型相关的配置信息
	 * @return	object	表对象
	 */
	function &getTable($name='', $prefix='WTable', $options = array())
	{
		if (empty($name)) {
			$name = $this->getName();
		}

		if( $table = &$this->_createTable( $name, $prefix, $options ) )  {
			return $table;
		}

		WError::raiseError( 0, 'Table ' . $name . ' not supported. File not found.' );
		$null = null;
        return $null;
	}


	/**
	 * 取得一个 WActiveRecord 对象用于表的操作
	 */

	function &getDefine()
	{
		return $this->_defineObject;
	}


	/**
	 * 取表名称，通过定义类对象来取
	 */

	function getTableName()
	{
		return $this->tableName;
	}

	/**
	 * 添加一个搜索模型类文件的目录，参数可以是字符，也可以是一个包含多个路径的数组
	 *
	 * @param	string	目录
	 * @return	array	返回一个包含目录的数组
	 */
	function addIncludePath( $path='' )
	{
		static $paths;

		if (!isset($paths)) {
			$paths = array();
		}
		if (!empty( $path ) && !in_array( $path, $paths )) {
			wimport('core.filesystem.path');
			array_unshift($paths, WPath::clean( $path ));
		}
		return $paths;
	}

	/**
	 * 添加表类文件搜索的路径
	 */
	function addTablePath($path)
	{
		import('db.table');
		Table::addIncludePath($path);
	}

	/**
	 * 返回一个数据库查询列表
	 *
	 * @param	SQL查询语句
	 * @param	int 查询记录的开始处
	 * @param	int 记录的类类
	 * @return	返回一个对象数组
	 */
	function &_getList( $query, $limitstart=0, $limit=0 )
	{
		$this->_db->setQuery( $query, $limitstart, $limit );
		$result = $this->_db->loadObjectList();

		return $result;
	}

	/**
	 * 返回记录的数量
	 */
	function _getListCount( $query )
	{
		$this->_db->setQuery( $query );
		$this->_db->query();
		return $this->_db->getNumRows();
	}

	/**
	 * Method to load and return a model object.
	 *
	 * @access	private
	 * @param	string	The name of the view
	 * @param   string  The class prefix. Optional.
	 * @return	mixed	Model object or boolean false if failed
	 * @since	1.5
	 */
	function &_createTable( $name, $prefix = 'WTable', $config = array())
	{
		$result = null;

		// Clean the model name
		$name	= preg_replace( '/[^A-Z0-9_]/i', '', $name );
		$prefix = preg_replace( '/[^A-Z0-9_]/i', '', $prefix );

		//Make sure we are returning a DBO object
		if (!array_key_exists('dbo', $config))  {
			$config['dbo'] =& $this->getDBO();;
		}

		//if( strpos($name,'hello')!== false )
		//{
			//echo $name;exit;
		//}
		$instance =& WTable::getInstance( $name, $prefix, $config );
		return $instance;
	}

	/**
	 * 创建不同类型的文件名称
	 *
 	 * @param	string 	$type  资源类型
	 * @param	array 	$parts 文件信息
	 * @return	返加文件名
	 */
	function _createFileName($type, $parts = array())
	{
		$filename = '';

		switch($type)
		{
			case 'model':
				$filename = strtolower($parts['name']).'.php';
				break;

		}
		return $filename;
	}

	/** 排序 **/
	function reorder( $tbl_key = "id" , $where='' )
	{
		$tbl = $this->tableName;
 
		$order2 = "";
 
		$query = 'SELECT '.$tbl_key.', ordering'
		. ' FROM '. $tbl
		. ' WHERE ordering >= 0' . ( $where ? ' AND '. $where : '' )
		. ' ORDER BY ordering'.$order2
		;

		$this->db->query( $query );
		if (!($orders = $this->db->loadObjectList()))
		{
			//Error::throwError('没有找到要排序的值.');
			return false;
		}

		// compact the ordering numbers
		for ($i=0, $n=count( $orders ); $i < $n; $i++)
		{
			if ($orders[$i]->ordering >= 0)
			{
				if ($orders[$i]->ordering != $i+1)
				{
					$orders[$i]->ordering = $i+1;
					$query = 'UPDATE '.$tbl
					. ' SET ordering = '. (int) $orders[$i]->ordering
					. ' WHERE '. $tbl_key .' = '. $this->db->Quote($orders[$i]->$tbl_key)
					;
					$this->db->query($query);
				}
			}
		}

		return true;
	}

	function getNextOrder( $where = "")
	{
		$sql = " select max(ordering) as m from ".$this->tableName;

		if( $where ){ $sql.=" where ".$where; }

		$this->db->query($sql);
		$row = $this->db->getRow();
		return (int)$row['m']+1;
	}




	function  _filterID($string){
		if( $string )
		{
			$id_array = explode( ',',$string);
			$copy_ids = array();
			foreach( $id_array as $id )
			{
				if( $id = intval($id) )
				{
					$copy_ids[] = $id;
				}
			}
		}

		return $copy_ids;
	}




	function __define(){ return false;}
}