<?php
 

class ElementTextarea extends Element
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'Text';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$attr = ( $node['rows'] ? ' rows="'.$node['rows'].'" ' : '' );
		$attr .= ( $node['cols'] ? ' cols="'.$node['cols'].'" ' : '' );
		$attr .= ( $node['class'] ? ' class="'.$node['class'].'" ' : '' );
        /*
         * Required to avoid a cycle of encoding &
         * html_entity_decode was used in place of htmlspecialchars_decode because
         * htmlspecialchars_decode is not compatible with PHP 4
         */
        $value = htmlspecialchars(html_entity_decode($value, ENT_QUOTES), ENT_QUOTES);

		return '<textarea  '.$attr.' name="'.$control_name.'['.$name.']" id="'.$control_name.$name.'" >'.$value.'</textarea>';
	}
}