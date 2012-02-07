<?php

/**
* @ �汾		$Id: html.php 2009-6-26
* @ ����		�ĵ��࣬������ָ�ʽ���ĵ�
* @ ��		libraries
* @ �Ŷ�        �Ŷ�One��
* @ copyright   Copyright (c) 2006-2009 TuanduiOne Inc. All rights reserved {@link http://www.TuanduiOne.com}
* @ ����        ������
* @ E-mail      tuanduione@yahoo.cn
* @ ��֤		����ҵ�����֤,��ϸ��鿴��Ŀ¼�� LICENSE.txt
* @ ��ע������ܻ����Ŷ�Э������
*/
import('application.module.helper');
class WDocumentHtml extends Document
{
	/**
	 * �ĵ���URL
	 */
	var $baseurl;



	/**
	 * HTML�ĵ�������
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
	 * �����ļ�����
	 *
	 */

	function getBuffer($type = null, $name = null, $attribs = array())
	{
		$result = null;

 
		// û��ָ����������������
		if ($type === null) {
			return $this->_buffer;
		}

		if(isset($this->_buffer[$type][$name])) {
			$result = $this->_buffer[$type][$name];
		}

		//����趨ĳһ��ģ�鲻�ü���,��ֱ�ӷ��ؿ�
 		if ($result === false) {
			return null;
		}
  
		//����Ӧ���������������ģ������
		if( $renderer =& $this->loadRenderer( $type )) {
 			$result = $renderer->render($name, $attribs, $result);
		}

		return $result;
	}

	/**
	 * �趨һ������
	 */
	function setBuffer($contents, $type, $name = null)
	{
		$this->_buffer[$type][$name] = $contents;
	}

	/**
	 * ִ���ĵ�����ȡ�ĵ���Ҫ����
	 */
	function render( $caching = false, $params = array())
	{
		global $app; 

		//ģ�����ز���
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
 		// ����
		$data = $this->_loadTemplate($directory.DS.$template, $file);
 		// ����
		$data = $this->_parseTemplate($data);
 		// ���
		parent::render();
		return $data;
	}

	function addCustomTag( $html )
	{
		$this->_custom[] = trim( $html );
	}

	/**
	 * ����ģ������
	 */
	function _loadTemplate( $directory, $filename )
	{
		$contents = '';
		//�Ƿ����ģ��
		if ( file_exists( $directory.DS.$filename ) )
		{
			//�����ļ�·��
			$this->_file = $directory.DS.$filename;

			//ȡ���ļ�����
			ob_start();
			require_once $directory.DS.$filename;
			$contents = ob_get_contents();
			ob_end_clean();
		}
		return $contents;
	}

	/**
	 * ����ģ������
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
	 * ���ַ��ֽ�Ϊһ������
	 */

	function parseAttributes( $string )
	{
	 	//��ʼ������
		$attr		= array();
		$retarray	= array();

		//������ƥ��
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