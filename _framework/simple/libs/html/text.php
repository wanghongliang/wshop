<?php
class Text
{
 
	function _($string, $jsSafe = false)
	{
		$lang = & Factory::getLanguage();
		return $lang->_($string, $jsSafe);
	}

 
	function sprintf($string)
	{
		$lang = &Factory::getLanguage();
		$args = func_get_args();
		if (count($args) > 0) {
			$args[0] = $lang->_($args[0]);
			return call_user_func_array('sprintf', $args);
		}
		return '';
	}

 
	function printf($string)
	{
		$lang = &Factory::getLanguage();
		$args = func_get_args();
		if (count($args) > 0) {
			$args[0] = $lang->_($args[0]);
			return call_user_func_array('printf', $args);
		}
		return '';
	}

}

?>