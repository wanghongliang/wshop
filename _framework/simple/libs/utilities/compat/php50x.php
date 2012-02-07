<?php


 /**
 * PHP 5.0.x Compatibility functions
 * ���ļ���֧��PHP5���µ�ĳЩ����
 * @since		1.5
 */
 //����һЩ����
if (!defined('FILE_USE_INCLUDE_PATH')) {
	define('FILE_USE_INCLUDE_PATH', 1);
}

if (!defined('FILE_APPEND')) {
	define('FILE_APPEND', 8);
}

/**
 * Replace file_put_contents()
 *
 * @link		http://php.net/function.file_put_contents
 * @author		Aidan Lister <aidan@php.net>
 * @version	 	$Revision: 47 $
 * @internal	resource_context is not supported
 * @since		PHP 5
 */
if (!function_exists('file_put_contents')) {
	function file_put_contents($filename, $content, $flags = null, $resource_context = null)
	{
		// If $content is an array, convert it to a string
		//���д����ļ������飬��ת���ַ���
		if (is_array($content)) {
			$content = implode('', $content);
		}

		// If we don't have a string, throw an error
		//���д���ļ��������Ƿ��Ǳ�׼��������string integer float boolean 
		if (!is_scalar($content)) {
			//����һ���û���������ʾ,����Ҫ��һ���Ƿ����лص�����
			trigger_error('file_put_contents() The 2nd parameter should be either a string or an array', E_USER_WARNING);
			return false;
		}

		// Get the length of date to write
		$length = strlen($content);

		// Check what mode we are using
		//Ҫ��һ�� & ���ص�ֵ
		$mode = ($flags & FILE_APPEND) ?
					$mode = 'a' :
					$mode = 'w';

		// Check if we're using the include path
		$use_inc_path = ($flags & FILE_USE_INCLUDE_PATH) ?
					true :
					false;

		// Open the file for writing
		if (($fh = @fopen($filename, $mode, $use_inc_path)) === false) {
			trigger_error('file_put_contents() failed to open stream: Permission denied', E_USER_WARNING);
			return false;
		}

		// Write to the file
		$bytes = 0;
		if (($bytes = @fwrite($fh, $content)) === false) {
			//��ʽ�������Ӧ��ʾ��Ϣ
			$errormsg = sprintf('file_put_contents() Failed to write %d bytes to %s',
							$length,
							$filename);
			trigger_error($errormsg, E_USER_WARNING);
			return false;
		}

		// Close the handle
		@fclose($fh);

		// Check all the data was written
		if ($bytes != $length) {
			//����ļ��Ƿ�ȫ������д��
			$errormsg = sprintf('file_put_contents() Only %d of %d bytes written, possibly out of free disk space.',
							$bytes,
							$length);
			trigger_error($errormsg, E_USER_WARNING);
			return false;
		}

		// Return length
		return $bytes;
	}
}

/**
 * Ported PHP5 function to PHP4 for forward compatibility
 */
if (!function_exists('clone')) {

	 
	function clone($object) {
		return unserialize(serialize($object));
	}
}