<?php
 
class ElementImageList extends Element
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'ImageList';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$filter = '\.png$|\.gif$|\.jpg$|\.bmp$|\.ico$';
 		$string ='<input type="text" name="'.$control_name.'['.$name.']" id="param_'.$name.'" value="'.$value.'"   /><input type="button" onclick="upload(\'param_'.$name.'\');" value="上传" />';


		return  $string ;
	}
}
