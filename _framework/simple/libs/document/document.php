<?php

/**
* @ 版本		$Id: document.php 2009-6-26
* @ 作用		文档类，输出各种格式的文档
* @ 包			libraries
* @ 团队        团队One网
* @ copyright   Copyright (c) 2006-2009 TuanduiOne Inc. All rights reserved {@link http://www.TuanduiOne.com}
* @ 作者        王洪亮
* @ E-mail      tuanduione@yahoo.cn
* @ 认证		需商业许可认证,详细请查看根目录下 LICENSE.txt
* @ 备注：本框架基于团队协作开发
*/
 
//Loader::register('WDocumentRenderer', dirname(__FILE__).DS.'renderer.php');


class Document
{

	//文档类型
	var $_type;

	//文档模板
    var $template;

	//文档文件路径
	var $_file;


	//文档内容
	var $_buffer;


	
	/**
	 * 文档的标题
	 */

	var $title;

	/**
	 * 文档的描述信息
	 */
	var $description;

	/**
	 * 文档的关键词
	 */
	var $keywords;


	/**
	 * 每一行的结束字符
	 */
	var $_lineEnd = "\12";


	/**
	 * 文档的链接
	 */
	var $link;


	/**
	 *
	 */
	var $_links = array();

	/*
	 * 文档编码方法
	 */
	var $_charset = 'utf-8';

	/**
	 *	外部链接脚本的数组
	 */
	var $_scripts = array();

	/**
	 * 脚本程序
	 */
	var $_script = array();


	/**
	 * 外部链接的样式文件
	 */
	var $_styleSheets = array();


	/**
	 * 样式文件脚本
	 */
	 var $_style = array();

	
	/**
	 *	meta描述信息
	 */
	var $_metaTags = array();


	var $_mime = 'text/html';

	function __construct( $options = array())
	{
 
		if (array_key_exists('charset', $options)) {
			$this->setCharset($options['charset']);
		}
		if (array_key_exists('link', $options)) {
			$this->setLink($options['link']);
		}
	}
	/*
	 * 获取文档类实例
	 */
	function getInstance($type='html')
	{
		static $instances;

		if( empty($instances[$type]) )
		{
			//$this->_type = $type;

			//文档子类，文件路径
			$path	= dirname(__FILE__).DS.$type.DS.$type.'.php';
			$class = 'WDocument'.ucfirst($type);
			if(!class_exists($class))
			{
				if (file_exists($path)) {
					require($path);
					$instances[$type]=new $class();
				} else {
					Error::throwError('不能够加载具体的文档类!');
				}
			}
		}
		return $instances[$type];
	}


	/**
	 * Get the document head data
	 *
	 * @access	public
	 * @return	array	The document head data in array form
	 */
	function getHeadData() {
		// Impelemented in child classes
	}


	/**
	* 加载一个解析器
	*
	* @access	public
	* @param	string 类型字符串
	* @return	object
	*/
	function &loadRenderer( $type )
	{
		$null	= null;
		$class	= 'DocumentRender'.$type;

		if( !class_exists( $class ) )
		{
			$path = dirname(__FILE__).DS.$this->_type.DS.'render'.DS.$type.'.php';

			if(file_exists($path)) {
				require($path);
			} else {
				Error::throwError('不能够加载文档解析器类!');
			}
		}

		if ( !class_exists( $class ) ) {
			return $null;
		}

		$instance = new $class($this);
		return $instance;
	}

 
	/**
	 * Set the document head data
	 *
	 * @access	public
	 * @param	array	$data	The document head data in array form
	 */
	function setHeadData($data) {
		// Impelemented in child classes
	}


 
	function getBuffer() {
		return $this->_buffer;
	}


	function setBuffer($content) {
		$this->_buffer = $content;
	}
	
	/**
	 * Gets a meta tag.
	 *
	 * @param	string	$name			Value of name or http-equiv tag
	 * @param	bool	$http_equiv	 META type "http-equiv" defaults to null
	 * @return	string
	 * @access	public
	 */
	function getMetaData($name, $http_equiv = false)
	{
		$result = '';
		$name = strtolower($name);
		if($name == 'generator') { 
			$result = $this->getGenerator();
		} elseif($name == 'description') {
			$result = $this->getDescription();
		} else {
			if ($http_equiv == true) {
				$result = @$this->_metaTags['http-equiv'][$name];
			} else {
				$result = @$this->_metaTags['standard'][$name];
			}
		}
		return $result;
	}
 
	function addScript($url, $type="text/javascript") {
		$this->_scripts[$url] = $type;
	}

	/**
	 * Adds a script to the page
	 *
	 * @access   public
	 * @param	string  $content   Script
	 * @param	string  $type	Scripting mime (defaults to 'text/javascript')
	 * @return   void
	 */
	function addScriptDeclaration($content, $type = 'text/javascript')
	{
		if (!isset($this->_script[strtolower($type)])) {
			$this->_script[strtolower($type)] = $content;
		} else {
			$this->_script[strtolower($type)] .= chr(13).$content;
		}
	}

	/**
	 * Adds a linked stylesheet to the page
	 *
	 * @param	string  $url	URL to the linked style sheet
	 * @param	string  $type   Mime encoding type
	 * @param	string  $media  Media type that this stylesheet applies to
	 * @access   public
	 */
	function addStyleSheet($url, $type = 'text/css', $media = null, $attribs = array())
	{
		$this->_styleSheets[$url]['mime']		= $type;
		$this->_styleSheets[$url]['media']		= $media;
		$this->_styleSheets[$url]['attribs']	= $attribs;
	}

	 /**
	 * Adds a stylesheet declaration to the page
	 *
	 * @param	string  $content   Style declarations
	 * @param	string  $type		Type of stylesheet (defaults to 'text/css')
	 * @access   public
 	 */
	function addStyleDeclaration($content, $type = 'text/css')
	{
		if (!isset($this->_style[strtolower($type)])) {
			$this->_style[strtolower($type)] = $content;
		} else {
			$this->_style[strtolower($type)] .= chr(13).$content;
		}
	}

	function setMime($m)
	{
 		$this->_mime = $m;
	}

	function getType()
	{
		return $this->_type;
	}

	/**
	 * 取标题信息
	 */
	function getTitle()
	{
		return $this->title;
	}

	/**
	 * 设标题信息
	 */
	function setTitle($title)
	{
		$this->title = $title;
	}



	/* 取描述信息
	 */
	function getDescription()
	{
		return $this->description;
	}

	/*
	 * 设定描述信息
	 */
	function setDescription($description) {
		$this->description = $description;
	}


	/**
	 * 行结速字符
	 */
	function _getLineEnd()
	{
		return $this->_lineEnd;
	}


	function setBase($base) {
		$this->base = $base;
	}



	/**
	 * 取文档编码方式
	 */
	function setCharset($type = 'utf-8') {
		$this->_charset = $type;
	}




	/**
	 * 设定或修改 meta 标签
	 */
	function setMetaData($name, $content, $http_equiv = false)
	{
		if ($http_equiv == true) {
			$this->_metaTags['http-equiv'][$name] = $content;
		} else {
			$this->_metaTags['standard'][$name] = $content;
		}
	}


	/**
	 * 设定关键词
	 */
	function setKeywords($key)
	{
		$this->keywords = $key;
	}

	
	/**
	 * 取关键词
	 */
	function getKeywords()
	{
		return $this->keywords;
	}
	/**
	 * 设定文档的链接
	 */
	function setLink($url) {
		$this->link = $url;
	}


	/**
	 * Returns the document base url
	 *
	 * @access public
	 * @return string
	 */
	function getLink() {
		return $this->link;
	}

	 /**
	 * Sets the document generator
	 *
	 * @param   string
	 * @access  public
	 * @return  void
	 */
	function setGenerator($generator) {
		$this->_generator = $generator;
	}

	/**
	 * Returns the document generator
	 *
	 * @access public
	 * @return string
	 */
	function getGenerator() {
		return $this->_generator;
	}

	 /**
	 * Sets the document modified date
	 *
	 * @param   string
	 * @access  public
	 * @return  void
	 */
	function setModifiedDate($date) {
		$this->_mdate = $date;
	}

	/**
	 * Returns the document modified date
	 *
	 * @access public
	 * @return string
	 */
	function getModifiedDate() {
		return $this->_mdate;
	}

	/**
	 * Outputs the document
	 *
	 * @access public
	 * @param boolean 	$cache		If true, cache the output
	 * @param boolean 	$compress	If true, compress the output
	 * @param array		$params		Associative array of attributes
	 * @return 	The rendered data
	 */
	function render( $cache = false, $params = array())
	{
		//WResponse::setHeader( 'Expires', gmdate( 'D, d M Y H:i:s', time() + 900 ) . ' GMT' );
		//if ($mdate = $this->getModifiedDate()) {
		//	WResponse::setHeader( 'Last-Modified', $mdate /* gmdate( 'D, d M Y H:i:s', time() + 900 ) . ' GMT' */ );
		//}
		//WResponse::setHeader( 'Content-Type', $this->_mime .  '; charset=' . $this->_charset);
 		header('Content-Type:'.$this->_mime.';charset='. $this->_charset);
 	}
}
?>