<?php
import('html.form');
class Element
{
	var	$_name = null;
	var	$_parent = null;

	var $_elements = array(); //ÎÞËØÁÐ±í

	var $_path = null;

	function Element()
	{
		$this->_path = dirname(__FILE__).DS.'element';
	}

	function getName() {
		return $this->_name;
	}

	function &loadElement( $type, $new = false )
	{
		$false = false;
		$signature = md5( $type  );

		if( (isset( $this->_elements[$signature] ) && !is_a($this->_elements[$signature], '__PHP_Incomplete_Class'))  && $new === false ) {
			return	$this->_elements[$signature];
		}

		$elementClass	=	'Element'.$type;
		if( !class_exists( $elementClass ) )
		{
			$file = $this->_path.DS.$type.'.php';
			if( file_exists( $file ) ){
				include( $file ); 
			}
		}

		if( !class_exists( $elementClass ) ) {
			return $false;
		}

		$this->_elements[$signature] = new $elementClass();

		return $this->_elements[$signature];
	}

	function render(&$xmlElement, $value, $control_name = 'params')
	{
		$name	= $xmlElement['name'];
		$label	= $xmlElement['label'];
		$descr	= $xmlElement['description'];



		//make sure we have a valid label
		$label = $label ? $label : $name;
		$result[0] = $this->fetchTooltip($label, $descr, $xmlElement, $control_name, $name);
		$result[1] = $this->fetchElement($name, $value, $xmlElement, $control_name);
		$result[2] = $descr;
		$result[3] = $label;
		$result[4] = $value;
		$result[5] = $name;
		return $result;
	}

	function fetchTooltip($label)
	{
		return $label;
	}
 
	function fetchElement($name, $value, &$xmlElement, $control_name) {
		return;
	}
}
