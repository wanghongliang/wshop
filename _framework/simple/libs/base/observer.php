<?php

class Observer
{

	/**
	 * Event object to observe
	 *
	 * @access private
	 * @var object
	 */
	var $_subject = null;

	/**
	 * Constructor
	 */
	function __construct(& $subject)
	{
		// Register the observer ($this) so we can be notified
		$subject->attach($this);

		// Set the subject to observe
		$this->_subject = & $subject;
	}

	/**
	 * Method to update the state of observable objects
	 *
	 * @abstract Implement in child classes
	 * @access public
	 * @return mixed
	 */
	function update() {
		return Error::raiseError('9', 'JObserver::update: Method not implemented', 'This method should be implemented in a child class');
	}
}