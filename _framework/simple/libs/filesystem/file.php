<?php
 
/**
 * 文件处理类
 */
class WFile
{
	/**
	 * 取文件生缀名
	 */
	function getExt($file) {
		$dot = strrpos($file, '.') + 1;
		return substr($file, $dot);
	}

	/**
	 * 去掉文件扩展名
	 */
	function stripExt($file) {
		return preg_replace('#\.[^.]*$#', '', $file);
	}

	/**
	 * 检测是否为一个安全的文件名称
	 */
	function makeSafe($file) {
		$regex = array('#(\.){2,}#', '#[^A-Za-z0-9\.\_\- ]#', '#^\.#');
		return preg_replace($regex, '', $file);
	}

	/**
	 * 复制文件
	 */
	function copy($src, $dest, $path = null)
	{
		// 用FTP操作文件
		wimport('core.client.helper');
		$FTPOptions = WClientHelper::getCredentials('ftp');

		// 如果设定 path 将追加
		if ($path) {
			$src = WPath::clean($path.DS.$src);
			$dest = WPath::clean($path.DS.$dest);
		}

		//Check src path
		if (!is_readable($src)) {
			WError::raiseWarning(21, 'WFile::copy: '.('Cannot find or read file' . ": '$src'"));
			return false;
		}

		if ($FTPOptions['enabled'] == 1) {
			// Connect the FTP client
			wimport('core.client.ftp');
			$ftp = & WFTP::getInstance($FTPOptions['host'], $FTPOptions['port'], null, $FTPOptions['user'], $FTPOptions['pass']);

			// If the parent folder doesn't exist we must create it
			if (!file_exists(dirname($dest))) {
				wimport('core.filesystem.folder');
				WFolder::create(dirname($dest));
			}

			//Translate the destination path for the FTP account
			$dest = WPath::clean(str_replace(WPath_ROOT, $FTPOptions['root'], $dest), '/');
			if (!$ftp->store($src, $dest)) {
				// FTP connector throws an error
				return false;
			}
			$ret = true;
		} else {
			if (!@ copy($src, $dest)) {
				WError::raiseWarning(21, ('Copy failed'));
				return false;
			}
			$ret = true;
		}
		return $ret;
	}

	/**
	 * 删除文件
	 */
	function delete($file)
	{
		// Initialize variables
		wimport('core.client.helper');
		$FTPOptions = WClientHelper::getCredentials('ftp');

		if (is_array($file)) {
			$files = $file;
		} else {
			$files[] = $file;
		}

		// Do NOT use ftp if it is not enabled
		if ($FTPOptions['enabled'] == 1)
		{
			// Connect the FTP client
			wimport('core.client.ftp');
			$ftp = & WFTP::getInstance($FTPOptions['host'], $FTPOptions['port'], null, $FTPOptions['user'], $FTPOptions['pass']);
		}

		foreach ($files as $file)
		{
			$file = WPath::clean($file);

			// Try making the file writeable first. If it's read-only, it can't be deleted
			// on Windows, even if the parent folder is writeable
			@chmod($file, 0777);

			// In case of restricted permissions we zap it one way or the other
			// as long as the owner is either the webserver or the ftp
			if (@unlink($file)) {
				// Do nothing
			} elseif ($FTPOptions['enabled'] == 1) {
				$file = WPath::clean(str_replace(WPath_ROOT, $FTPOptions['root'], $file), '/');
				if (!$ftp->delete($file)) {
					// FTP connector throws an error
					return false;
				}
			} else {
				$filename	= basename($file);
				WError::raiseWarning('SOME_ERROR_CODE', ('Delete failed') . ": '$filename'");
				return false;
			}
		}

		return true;
	}

	/**
	 * 移动一个文件
	 */
	function move($src, $dest, $path = '')
	{
		// Initialize variables
		wimport('core.client.helper');
		$FTPOptions = WClientHelper::getCredentials('ftp');

		if ($path) {
			$src = WPath::clean($path.DS.$src);
			$dest = WPath::clean($path.DS.$dest);
		}

		//Check src path
		if (!is_readable($src) && !is_writable($src)) {
			return ('Cannot find source file');
		}

		if ($FTPOptions['enabled'] == 1) {
			// Connect the FTP client
			wimport('core.client.ftp');
			$ftp = & WFTP::getInstance($FTPOptions['host'], $FTPOptions['port'], null, $FTPOptions['user'], $FTPOptions['pass']);

			//Translate path for the FTP account
			$src	= WPath::clean(str_replace(WPath_ROOT, $FTPOptions['root'], $src), '/');
			$dest	= WPath::clean(str_replace(WPath_ROOT, $FTPOptions['root'], $dest), '/');

			// Use FTP rename to simulate move
			if (!$ftp->rename($src, $dest)) {
				WError::raiseWarning(21, ('Rename failed'));
				return false;
			}
		} else {
			if (!@ rename($src, $dest)) {
				WError::raiseWarning(21, ('Rename failed'));
				return false;
			}
		}
		return true;
	}

	/**
	 * 读取文件
	 */
	function read($filename, $incpath = false, $amount = 0, $chunksize = 8192, $offset = 0)
	{
		// Initialize variables
		$data = null;
		if($amount && $chunksize > $amount) { $chunksize = $amount; }
		if (false === $fh = fopen($filename, 'rb', $incpath)) {
			WError::raiseWarning(21, 'WFile::read: '.('Unable to open file') . ": '$filename'");
			return false;
		}
		clearstatcache();
		if($offset) fseek($fh, $offset);
		if ($fsize = @ filesize($filename)) {
			
			if($amount && $fsize > $amount) {
		
				$data = fread($fh, $amount);
			
			} else {
				$data = fread($fh, $fsize);
		
			}
		} else {
			$data = '';
	
				$x = 0;
			
				// While its:
			
			// 1: Not the end of the file AND
			
			// 2a: No Max Amount set OR
			
			// 2b: The length of the data is less than the max amount we want
			while (!feof($fh) && (!$amount || strlen($data) < $amount)) {
		
				$data .= fread($fh, $chunksize);
			}
		}
		fclose($fh);

		return $data;
	}

	/**
	 * 写入文件
	 */
	function write($file, $buffer)
	{
		// Initialize variables
		wimport('core.client.helper');
		$FTPOptions = WClientHelper::getCredentials('ftp');

		// If the destination directory doesn't exist we need to create it
		if (!file_exists(dirname($file))) {
			wimport('core.filesystem.folder');
			WFolder::create(dirname($file));
		}

		if ($FTPOptions['enabled'] == 1) {
			// Connect the FTP client
			wimport('core.client.ftp');
			$ftp = & WFTP::getInstance($FTPOptions['host'], $FTPOptions['port'], null, $FTPOptions['user'], $FTPOptions['pass']);

			// Translate path for the FTP account and use FTP write buffer to file
			$file = WPath::clean(str_replace(WPath_ROOT, $FTPOptions['root'], $file), '/');
			$ret = $ftp->write($file, $buffer);
		} else {
			$file = WPath::clean($file);
			$ret = file_put_contents($file, $buffer);
		}
		return $ret;
	}

	/**
	 * 上传一个文件
	 */
	function upload($src, $dest)
	{
		// Initialize variables
		wimport('core.client.helper');
		$FTPOptions = WClientHelper::getCredentials('ftp');
		$ret		= false;

		// Ensure that the path is valid and clean
		$dest = WPath::clean($dest);

		// Create the destination directory if it does not exist
		$baseDir = dirname($dest);
		if (!file_exists($baseDir)) {
			wimport('core.filesystem.folder');
			WFolder::create($baseDir);
		}

		if ($FTPOptions['enabled'] == 1) {
			// Connect the FTP client
			wimport('core.client.ftp');
			$ftp = & WFTP::getInstance($FTPOptions['host'], $FTPOptions['port'], null, $FTPOptions['user'], $FTPOptions['pass']);

			//Translate path for the FTP account
			$dest = WPath::clean(str_replace(WPath_ROOT, $FTPOptions['root'], $dest), '/');

			// Copy the file to the destination directory
			if ($ftp->store($src, $dest)) {
				$ftp->chmod($dest, 0777);
				$ret = true;
			} else {
				WError::raiseWarning(21, ('WARNFS_ERR02'));
			}
		} else {
			if (is_writeable($baseDir) && move_uploaded_file($src, $dest)) { // Short circuit to prevent file permission errors
				if (WPath::setPermissions($dest)) {
					$ret = true;
				} else {
					WError::raiseWarning(21, ('WARNFS_ERR01'));
				}
			} else {
				WError::raiseWarning(21, ('WARNFS_ERR02'));
			}
		}
		return $ret;
	}

	/**
	 * 	包装标准file_exists功能
	 *
	 */
	function exists($file)
	{
		return is_file(WPath::clean($file));
	}

	/**
	 * 返回一个文件名
	 */
	function getName($file) {
		$slash = strrpos($file, DS) + 1;
		return substr($file, $slash);
	}
}
