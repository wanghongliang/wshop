<?php
import( 'application.component.view');
require(dirname(PATH_COMPONENT).DS.'com_buys'.DS.'helpers'.DS.'route.php');

class CategoryView extends View
{
	function display($tpl = null)
	{
		global $app;
		$params 	   =& $app->getParams('com_buys');
		$_REQUEST['tmpl'] = 'buys';

  		if( $this->_layout == 'category' ){
 			//$tpl = "list"; //ื๎ะย
			$this->lists = $this->get('list');
 		}else{ 
 			$this->lists = $this->get('list');
		}
		
		parent::display($tpl);
	}
 
}
?>