<?php
 
class WHTMLForm
{
	/**
	 * Displays a hidden token field to reduce the risk of CSRF exploits
	 *
	 * Use in conjuction with WRequest::checkToken
	 *
	 * @static
	 * @return	void
	 * @since	1.5
	 */
	function token()
	{
		return '<input type="hidden" name="'.WUtility::getToken().'" value="1" />';
	}
}