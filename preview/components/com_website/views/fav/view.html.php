<?php
import( 'application.component.view');
class FavView extends View
{
	function display($tpl = null)
	{
		global $app;
		$this->status = $this->get('favorite');

  		parent::display($tpl);
	}

}
?>
