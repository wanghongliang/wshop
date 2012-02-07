<?php
 

class ElementUpload extends Element
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
		//global $app;
		$size = ( $node['size'] ? 'size="'.$node['size'].'"' : '' );
		$class = ( $node['class'] ? 'class="'.$node['class'].'"' : 'class="text_area"' );
        /*
         * Required to avoid a cycle of encoding &
         * html_entity_decode was used in place of htmlspecialchars_decode because
         * htmlspecialchars_decode is not compatible with PHP 4
         */
        //$value = htmlspecialchars(html_entity_decode($value, ENT_QUOTES), ENT_QUOTES);

		//$config = $app->getCfg('');

		//$config =& WFactory::getConfig();
		//print_r($config);
		
		$id = $control_name.$name;

		$string ='<input type="text" name="'.$control_name.'['.$name.']" id="'.$id.'" value="'.$value.'" '.$class.' '.$size.' /><input type="button" onclick="upload(\''.$id.'\');" value="上传" /><input name="" value=".." onclick="selectImage(\''.$id.'\')" type="button">';
		return $string;
	}
}