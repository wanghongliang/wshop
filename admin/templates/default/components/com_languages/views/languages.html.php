<?php
import('application.component.view');
class LanguagesView extends View
{
 	var $rows;
	var $path = null;
	var $depth = 0;
	function LanguagesView()
	{
		$this->path = dirname(__FILE__);
 		$this->baseuri = 'index.php?com=languages';
	}

	function display()
	{
		$this->rows = $this->get('languages');
 		include($this->path.DS.'tmpl'.DS.'list.php');
	}


	function typelist()
	{
		$this->rows = $this->get('list');
		$this->path = dirname(__FILE__);
		$nav = $this->get('nav');
		include($this->path.DS.'tmpl'.DS.'typelist.php');

	}
 

 	function addtype()
	{ 
		include($this->path.DS.'tmpl'.DS.'typeform.php');

	}
  	function edittype()
	{ 
		$this->rows = $this->get('item');
		include($this->path.DS.'tmpl'.DS.'typeform.php');

	}

}
?>