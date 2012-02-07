<?php
import('application.component.view');
class UninstallsView extends View
{
 	var $rows;
 
	var $depth = 0;
	function UninstallsView()
	{
		$this->menuid = intval( $_REQUEST['menuid'] );
		$this->baseuri = 'index.php?com=uninstall&client_id='.intval($_REQUEST['client_id']);
	}

	function display()
	{
		switch( $_REQUEST['type'] ){
			case 'component':

				$this->rows = $this->get('listComponents');
				$nav = $this->get('nav');
				$this->path = dirname(__FILE__);
				include($this->path.DS.'tmpl'.DS.'listcomponent.php');



				break;
				
			default:
				$this->rows = $this->get('list');
				$nav = $this->get('nav');
				$this->path = dirname(__FILE__);
				include($this->path.DS.'tmpl'.DS.'list.php');
		}
	}
 
}
?>