<?php

/**
* @ 版本		$Id: html.php 2009-6-26
* @ 作用		文档类，输出各种格式的文档
* @ 包		libraries
* @ 团队        团队One网
* @ copyright   Copyright (c) 2006-2009 TuanduiOne Inc. All rights reserved {@link http://www.TuanduiOne.com}
* @ 作者        王洪亮
* @ E-mail      tuanduione@yahoo.cn
* @ 认证		需商业许可认证,详细请查看根目录下 LICENSE.txt
* @ 备注：本框架基于团队协作开发
*/
import('application.module.helper');
class WDocumentHtml extends Document
{
	/**
	 * 文档的URL
	 */
	var $baseurl;



	/**
	 * HTML文档构造器
	 */
	function __construct($options = array())
	{
		parent::__construct($options); 
 		$this->_type = 'html';
 		$this->_mime = 'text/html';
 		$this->setMetaData('Content-Type', $this->_mime . '; charset=' . $this->_charset , true );
		$this->setMetaData('robots', 'index, follow' );


	}

	/**
	 * 包含文件内容
	 *
	 */

	function getBuffer($type = null, $name = null, $attribs = array())
	{
		$result = null;

 
		// 没有指明，返回内容数组
		if ($type === null) {
			return $this->_buffer;
		}

		if(isset($this->_buffer[$type][$name])) {
			$result = $this->_buffer[$type][$name];
		}

		//如果设定某一个模块不用加载,将直接返回空
 		if ($result === false) {
			return null;
		}
  
		//用相应解析器，分析相关模块内容
		if( $renderer =& $this->loadRenderer( $type )) {
 			$result = $renderer->render($name, $attribs, $result);
		}

		return $result;
	}

	/**
	 * 设定一个内容
	 */
	function setBuffer($contents, $type, $name = null)
	{
		$this->_buffer[$type][$name] = $contents;
	}

	/**
	 * 执行文档，获取文档主要内容
	 */
	function render( $caching = false, $params = array())
	{
		global $app; 

		//模板的相关参数
		$directory	= isset($params['directory']) ? $params['directory'] : 'templates';
		$template	= $params['template'];
		$file		= $params['file'];

		$this->template = $template;
 		if( $app->isAdmin() ){
			$this->baseurl  =URI_DIRECTORY.'/'.$template;
		}else{
			if( $GLOBALS['config']['preview_directory'] != '/' ){
				$this->baseurl  ='/'. $GLOBALS['config']['preview_directory'].'/'.URI_DIRECTORY.'/'.$template;
			}else{
				$this->baseurl  ='/'.URI_DIRECTORY.'/'.$template;
			}
		}
 		// 加载
		$data = $this->_loadTemplate($directory.DS.$template, $file);
 		// 分析
		$data = $this->_parseTemplate($data);
 		// 输出
		parent::render();
		return $data;
	}

	function addCustomTag( $html )
	{
		$this->_custom[] = trim( $html );
	}

	/**
	 * 加载模板内容
	 */
	function _loadTemplate( $directory, $filename )
	{
		$contents = '';
		//是否存在模板
		if ( file_exists( $directory.DS.$filename ) )
		{
			//储存文件路径
			$this->_file = $directory.DS.$filename;

			//取得文件内容
			ob_start();
			require_once $directory.DS.$filename;
			$contents = ob_get_contents();
			ob_end_clean();
		}
		return $contents;
	}

	/**
	 * 分析模板内容
	 */

	function _parseTemplate($data)
	{
 		$replace = array();
		$matches = array();
		if(preg_match_all('#<wdoc:include\ type="([^"]+)" (.*)\/>#iU', $data, $matches))
		{
			$matches[0] = array_reverse($matches[0]);
			$matches[1] = array_reverse($matches[1]);
			$matches[2] = array_reverse($matches[2]);

			$count = count($matches[1]);
			
			for($i = 0; $i < $count; $i++)
			{
				$attribs = $this->parseAttributes( $matches[2][$i] );
				$type  = $matches[1][$i];

				$name  = isset($attribs['name']) ? $attribs['name'] : null;
 				$replace[$i] = $this->getBuffer($type, $name, $attribs);
			}
			$data = str_replace($matches[0], $replace, $data);
		}

		return $data;
	}

	/**
	 * 把字符分解为一个数组
	 */

	function parseAttributes( $string )
	{
	 	//初始化变量
		$attr		= array();
		$retarray	= array();

		//用正则匹配
		preg_match_all( '/([\w:-]+)[\s]?=[\s]?"([^"]*)"/i', $string, $attr );

		if (is_array($attr))
		{
			$numPairs = count($attr[1]);
			for($i = 0; $i < $numPairs; $i++ )
			{
				$retarray[$attr[1][$i]] = $attr[2][$i];
			}
		}
		return $retarray;
	}

}

?>