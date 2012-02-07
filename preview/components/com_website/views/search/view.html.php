<?php
import( 'application.component.view');
require(dirname(PATH_COMPONENT).DS.'com_website'.DS.'helpers'.DS.'route.php');

class SearchView extends View
{
	function display($tpl = null)
	{
		global $app;
		$GLOBALS['body_id'] = 'cate2';
		$this->lists = $this->get('list');		
  		parent::display($tpl);
	}
}
?>
