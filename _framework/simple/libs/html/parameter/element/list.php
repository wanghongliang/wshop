<?php
 
class ElementList extends Element
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'Radio';

	function fetchElement($name, $value, &$params, $control_name)
	{
	 
		$str = '<select name="'.$control_name.'['.$name.']" >';
		
 

		//print_r($params['optoins']);
		foreach( $params['optoins'] as $option )
		{
			$str .= '<option value="'.$option['attr']['value'].'" ';
			if( $value == $option['attr']['value'] )
			{
				$str .= ' selected ';
			}

			$str .= '>';
			$str .= $option['text'];
			$str .= '</option>';
		}
		$str.='</select>';
		return $str;
	}
}
