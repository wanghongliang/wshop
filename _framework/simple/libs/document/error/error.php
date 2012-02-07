<?php
defined('PATH_BASE') or die();

/**
 * 错误文档类，提供一个简单的接口，处理错误页
 */
class WDocumentError extends WDocument
{
	/**
	 * 错误对象
	 */
	var $_error;

	/**
	 * 类构造器
	 */
	function __construct($options = array())
	{
		parent::__construct($options);

		//文档 mime 类型
		$this->_mime = 'text/html';

		//文档类型
		$this->_type = 'error';
	}

	/**
	 * 设定错误类
	 */
	function setError($error)
	{
		if (WError::isError($error)) {
			$this->_error = & $error;
			return true;
		} else {
			return false;
		}
	}

	/**
	 * 输出文档
	 */
	function render( $cache = false, $params = array())
	{
 		if (!isset($this->_error)) {
			return;
		}

 		WResponse::setHeader('status', $this->_error->code.' '.str_replace( "\n", ' ', $this->_error->message ));

		$file = 'error.php';

 		$directory	= isset($params['directory']) ? $params['directory'] : 'templates';
		$template	= isset($params['template']) ? $params['template'] : 'system';

		if ( !file_exists( $directory.DS.$template.DS.$file) ) {
			$template = 'system';
		}

		//设定相关变量
		$this->baseurl  = WURI::base(true);

		$this->path		= $this->baseurl.'/templates/'.$template;

		$this->template = $template;
		$this->debug	= isset($params['debug']) ? $params['debug'] : false;
		$this->error	= $this->_error;

		 

 		$data = $this->_loadTemplate($directory.DS.$template, $file);
		
		parent::render();
		return $data;
	}

	/**
	 * 加载模板文件
	 */
	function _loadTemplate($directory, $filename)
	{
		$contents = '';

		//检查文件是否存在
		if ( file_exists( $directory.DS.$filename ) )
		{
			//保存文件路径
			$this->_file = $directory.DS.$filename;

			//取文件内容
			ob_start();
			require_once $directory.DS.$filename;
			$contents = ob_get_contents();
			ob_end_clean();
		}

		return $contents;
	}

	function renderBacktrace()
	{
		$contents	= null;
		$backtrace	= $this->_error->getTrace();
		if( is_array( $backtrace ) )
		{
			ob_start();
			$j	=	1;
			echo  	'<table border="0" cellpadding="0" cellspacing="0" class="Table">';
			echo  	'	<tr>';
			echo  	'		<td colspan="3" align="left" class="etitle" ><strong>调用的相关文件信息</strong></td>';
			echo  	'	</tr>';
			echo  	'	<tr>';
			echo  	'		<td class="TD"><strong>#</strong></td>';
			echo  	'		<td class="TD"><strong>函数/方法</strong></td>';
			echo  	'		<td class="TD"><strong>位置</strong></td>';
			echo  	'	</tr>';
			for( $i = count( $backtrace )-1; $i >= 0 ; $i-- )
			{
				echo  	'	<tr>';
				echo  	'		<td class="TD">'.$j.'</td>';
				if( isset( $backtrace[$i]['class'] ) ) {
					echo  	'	<td class="TD">'.$backtrace[$i]['class'].$backtrace[$i]['type'].$backtrace[$i]['function'].'()</td>';
				} else {
					echo  	'	<td class="TD">'.$backtrace[$i]['function'].'()</td>';
				}
				if( isset( $backtrace[$i]['file'] ) ) {
					echo  	'		<td class="TD">'.$backtrace[$i]['file'].':'.$backtrace[$i]['line'].'</td>';
				} else {
					echo  	'		<td class="TD">&nbsp;</td>';
				}
				echo  	'	</tr>';
				$j++;
			}
			echo  	'</table>';
			$contents = ob_get_contents();
			ob_end_clean();
		}
		return $contents;
	}
}