<?php
 
class WElementFilelist extends WElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'Filelist';

	function fetchElement($name, $value, &$node, $control_name)
	{
		wimport( 'core.filesystem.folder' );
		wimport( 'core.filesystem.file' );

		// path to images directory
		$path		= PATH_ROOT.DS.$node->attributes('directory');
		$filter		= $node->attributes('filter');
		$exclude	= $node->attributes('exclude');
		$stripExt	= $node->attributes('stripext');
		$files		= WFolder::files($path, $filter);

		$options = array ();

		if (!$node->attributes('hide_none'))
		{
			$options[] = WHTML::_('select.option', '-1', '- '.WText::_('Do not use').' -');
		}

		if (!$node->attributes('hide_default'))
		{
			$options[] = WHTML::_('select.option', '', '- '.WText::_('Use default').' -');
		}

		if ( is_array($files) )
		{
			foreach ($files as $file)
			{
				if ($exclude)
				{
					if (preg_match( chr( 1 ) . $exclude . chr( 1 ), $file ))
					{
						continue;
					}
				}
				if ($stripExt)
				{
					$file = WFile::stripExt( $file );
				}
				$options[] = WHTML::_('select.option', $file, $file);
			}
		}

		return WHTML::_('select.genericlist',  $options, ''.$control_name.'['.$name.']', 'class="inputbox"', 'value', 'text', $value, "param$name");
	}
}
