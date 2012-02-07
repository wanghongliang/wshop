<?php
import( 'application.component.view');
class BuyView extends View
{
	function display($tpl = null)
	{
		global $app;
		$this->item = $this->get('item');

		//echo 'ok';
 		parent::display($tpl);
	}

}
?>
