<?php


class WDocumentRenderer extends WObject
{
	/**
	* �ĵ����������
	*/
	var	$_doc = null;

	/**
	 * �����ĵ���Ĭ������
	 *
 	 */
	 var $_mime = "text/html";

 	function __construct(&$doc) {
		$this->_doc =& $doc;
	}
}


?>