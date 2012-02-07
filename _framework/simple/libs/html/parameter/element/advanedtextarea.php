<?php
 

class ElementAdvanedtextarea extends Element
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'Editors';

	function fetchElement($name, $value, &$node, $control_name)
	{

		$str = "";
		ob_start();
		import('html.editor');
		$editor = Editor::getInstance($GLOBALS['config']['editor']);
		$editor->display($control_name.'['.$name.']',$value,'500','300');
		$content = ob_get_contents();
		ob_clean();


		return $str.$content;

	}
}
