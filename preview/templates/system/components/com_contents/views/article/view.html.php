<?php
import( 'application.component.view');
class ArticleView extends View
{
	function display($tpl = null)
	{
		global $app;
		
		$this->item = $this->get('item');
  		parent::display($tpl);
	}

}
?>
