<?php


import( 'event.event' );


class Plugin extends Event
{

	var	$params	= null;

	/**
	 * The name of the plugin
	 *
	 * @var		sring
	 * @access	protected
	 */
	var $_name	= null;

	/**
	 * The plugin type
	 *
	 * @var		string
	 * @access	protected
	 */
	var $_type	= null;


	function Plugin(& $subject, $config = array())  {
		parent::__construct($subject);
	}

	/**
	 * Constructor
	 */
	function __construct(& $subject, $config = array())
	{
		//Set the parameters
		if ( isset( $config['params'] ) ) {

			if(is_a($config['params'], 'JParameter')) {
				$this->params = $config['params'];
			} else {
				$this->params = new JParameter($config['params']);
			}
		}

		if ( isset( $config['name'] ) ) {
			$this->_name = $config['name'];
		}

		if ( isset( $config['type'] ) ) {
			$this->_type = $config['type'];
		}

		parent::__construct($subject);
	}

	/**
	 * Loads the plugin language file
	 *
	 * @access	public
	 * @param	string 	$extension 	The extension for which a language file should be loaded
	 * @param	string 	$basePath  	The basepath to use
	 * @return	boolean	True, if the file has successfully loaded.
	 * @since	1.5
	 */
	function loadLanguage($extension = '', $basePath = PATH_BASE)
	{

	}


}
