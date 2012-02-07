<?php
import('application.component.view');
class QuestionsView extends View
{
 	var $rows;
	var $baseuri;	//URI
	var $depth = 0;
	var $nav = null;
	function QuestionsView()
	{
		$this->baseuri = 'index.php?com=questions';
	}

	function display()
	{
		$lists = $this->get('list');
		$this->nav = $this->get('nav');
		$this->path = dirname(__FILE__);  

		include($this->path.DS.'tmpl'.DS.'toolbar.php');
		include($this->path.DS.'tmpl'.DS.'list.php');
	}
 
 
}
?>