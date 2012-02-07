<?php
import( 'application.component.view');
require(dirname(PATH_COMPONENT).DS.'com_products'.DS.'helpers'.DS.'route.php');

class SpecialView extends View
{
	function display($tpl = null)
	{
		global $app;
		$params 	   =& $app->getParams('com_products');


 		if( $this->_layout == 'category' ){
			$this->lists = $this->get('typelist');
			$catid = $this->lists['catid']; 
			if( $catid == 0 ){
				$tpl = "list";
			} 
 		}else{  
			$this->lists = $this->get('list');
		}
		
		parent::display($tpl);
	}
 
}
?>