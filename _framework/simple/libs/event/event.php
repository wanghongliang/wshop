<?php


import( 'base.observer' );


class Event extends Observer
{


	function Event(& $subject) {
		parent::__construct($subject);
	}

	/**
	 * Method to trigger events
	 *
	 * @access public
	 * @param array Arguments
	 * @return mixed Routine return value
	 * @since 1.5
	 */
	function update(& $args)
	{
		/*
		 * First lets get the event from the argument array.  Next we will unset the
		 * event argument as it has no bearing on the method to handle the event.
		 */
		$event = $args['event'];
		unset($args['event']);

		/*
		 * If the method to handle an event exists, call it and return its return
		 * value.  If it does not exist, return null.
		 */
		if (method_exists($this, $event)) {
			return call_user_func_array ( array($this, $event), $args );
		} else {
			return null;
		}
	}
}
