<?php

class WDocumentRAW extends Document
{

 
	function __construct($options = array())
	{
		parent::__construct($options);

		//set mime type
		$this->_mime = 'text/html';

		//set document type
		$this->_type = 'raw';
	}

 
	function render( $cache = false, $params = array())
	{
		parent::render();
	
		
		return $this->getBuffer();
	}

	function randerModule(){
 
 	}
}