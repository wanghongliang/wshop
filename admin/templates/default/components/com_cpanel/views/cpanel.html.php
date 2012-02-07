<?php
import('application.component.view');
class CpanelView extends View
{
 	var $rows;
	var $baseuri;	//URI
	var $depth = 0;
	function CpanelView()
	{
		$this->baseuri = 'index.php?com=cpanel';
		$this->path = dirname(__FILE__);
	}

	function display()
	{
		if( $GLOBALS['USERID'] > 0 ){ $_REQUEST['tmpl'] = 'cpanel';}
		//Ö§¸¶·½Ê½
		$pays = $this->get('pays'); 
  		include($this->path.DS.'tmpl'.DS.'default.php');
	}
 

}
?>