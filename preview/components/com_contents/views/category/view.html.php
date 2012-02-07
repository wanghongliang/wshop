<?php
import( 'application.component.view');
require(dirname(PATH_COMPONENT).DS.'com_contents'.DS.'helpers'.DS.'route.php');
class CategoryView extends View
{
	function display($tpl = null)
	{
		global $app;
		$params 	   =& $app->getParams('com_contents');
		
		//print_r($params);
		//echo 'ok'; 

		if( $params['setstyle'] == 1 ){
			$this->lists = $this->get('list');
			$tpl = 'list'; 
		}else if( $params['setstyle'] == 2 ){
			$this->lists = $this->get('comment');
			$tpl = 'list2'; 

		}else if( $params['setstyle'] == 3 ){
			$this->lists = $this->get('evaluation');
			$tpl = 'list3'; 
		}else{
			if( $this->_layout == 'typelist' ){
				$this->lists = $this->get('typelist');
			}else{
				$this->lists = $this->get('list');
			}
		
		}	
		parent::display($tpl);
	}
 
}
?>