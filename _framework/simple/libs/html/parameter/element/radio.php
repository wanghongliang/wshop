<?php
 
class ElementRadio extends Element
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

 	 
		$str = '';
 
		foreach( $params['optoins'] as $option )
		{
			$str .= '<input type=radio name="'.$control_name.'['.$name.']" value="'.$option['attr']['value'].'" ';
			if( $value == $option['attr']['value'] )
			{
				$str .= ' checked ';
			}
			$str .= ' />';//,$value);	//��ѡ��
			$str .= $option['text'];
		}
		return $str;
	}
}
