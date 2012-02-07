<?php
 

class WElementEditors extends WElement
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
		$db		= & WFactory::getDBO();
		$user	= & WFactory::getUser();

		//TODO: change to acl_check method
		if(!($user->get('gid') >= 19) ) {
			return WText::_('No Access');
		}

		// compile list of the editors
		$query = 'SELECT element AS value, name AS text'
		. ' FROM #__plugins'
		. ' WHERE folder = "editors"'
		. ' AND published = 1'
		. ' ORDER BY ordering, name'
		;
		$db->setQuery( $query );
		$editors = $db->loadObjectList();

		array_unshift( $editors, WHTML::_('select.option',  '', '- '. WText::_( 'Select Editor' ) .' -' ) );

		return WHTML::_('select.genericlist',   $editors, ''. $control_name .'['. $name .']', 'class="inputbox"', 'value', 'text', $value, $control_name.$name );
	}
}
