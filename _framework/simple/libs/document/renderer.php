<?php


class WDocumentRenderer extends WObject
{
	/**
	* 文档对象的引用
	*/
	var	$_doc = null;

	/**
	 * 解析文档的默认类型
	 *
 	 */
	 var $_mime = "text/html";

 	function __construct(&$doc) {
		$this->_doc =& $doc;
	}
}


?>