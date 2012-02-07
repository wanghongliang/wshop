<?php

/**
 *	
 */
class Session
{
	function __constract(){
		$this->Session();
	}
	//ณ๕สผปฏ
	function Session()
	{
		session_start();
	}


	function get($key)
	{
		return $_SESSION[$key];
	}

	function set($key,$value)
	{
		 $_SESSION[$key]=$value;
		 return true;
	}

	function unregister($key)
	{
		 return session_unregister($key);
	}
	function exists($key)
	{
		return isset($_SESSION[$key]);
	}

	function destroy()
	{
		return session_destroy();
	}
}
?>