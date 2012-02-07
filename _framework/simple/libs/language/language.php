<?php
 
class Language
{
 	//当前默认的语言版本
	var $_default	= '3';

  	 
  	var $_lang = null;
 	var $_paths	= array();
 	var $_strings = null;
 
	function Language($lang = null)
	{
		$this->_strings = array ();

		if ($lang == null) {
			$lang = $this->_default;
		}

		$this->setLanguage($lang);
		//$this->load();
	}

	 
	function & getInstance($lang=3)
	{
		$instance = new Language($lang);
		$reference = & $instance;
		return $reference;
	}

 
	function _($string, $jsSafe = false)
	{
 		$key =  $string;
 		if (isset ($this->_strings[$key]))
		{
			$string =   $this->_strings[$key];
		} else {
 
		}

		if ($jsSafe) {
			$string = addslashes($string);
		}

		return $string;
	}

 
	function transliterate($string)
	{
		$string = htmlentities(utf8_decode($string));
		$string = preg_replace(
		array('/&szlig;/','/&(..)lig;/', '/&([aouAOU])uml;/','/&(.)[^;]*;/'),
		array('ss',"$1","$1".'e',"$1"),
		$string);

		return $string;
	}

 

 
	function load()
	{
		if (! $lang) {
			$lang = $this->_lang;
		}

 
	    $result = $this->_load($filename, $extension);
 
		return $result;
	}
 
	function _load()
	{
 		$db = &Factory::getDB();
		
		$sql = " select id,params from #__languages where    ( id=1 or id=".$this->_default." ) order by id ";
		
		$db->query($sql);
		$data = $db->getResult();

		if( count($data) ){
			$params = unserialize($data[0]['params']);
			$params2 = unserialize($data[1]['params']);
			foreach( $params as $k=>$p ){
				$this->_strings[$p] = $params2[$k];
			}
		}
 		return $result;
	}
 
	function get($property, $default = null)
	{
		if (isset ($this->_metadata[$property])) {
			return $this->_metadata[$property];
		}
		return $default;
	}

 
 
	function getDefault() {
		return $this->_default;
	}
 
	function setDefault($lang) {
		$previous	= $this->_default;
		$this->_default	= $lang;
		return $previous;
	}
  
	function setLanguage($lang)
	{

  		//
		$db = &Factory::getDB();
		$sql = " select id  from #__languages where   isdefault=1 ";
		$db->query($sql);
		$data = $db->getRow();
 		$this->setDefault($data['id']);
	}
 

	/** 获取语言种类 **/
	function getLanguageType()
	{
		static $data;

		if( empty($data) ){
 			$db = &Factory::getDB();
			$sql = " select id,img from #__languages where published=1 order by ordering ";
			$db->query($sql);
			$data = $db->getResult('id');
			unset($data[1]);
		}
 		return $data;
	}
}
