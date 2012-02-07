<?php
import( 'application.component.view');
require(dirname(PATH_COMPONENT).DS.'com_products'.DS.'helpers'.DS.'route.php');

class CompareView extends View
{

	var $params = null;


	function display($tpl = null)
	{
		global $app;
		$this->params 	   =& $app->getParams('products');
		//print_r($params);
		//$this->prev = $this->get('prev');
		//$this->next = $this->get('next');
 		$lists = $this->get('item');  
		$this->lists = &$lists;

		$document = &Factory::getDocument();
 		 
 
		//print_r($this->item);
 		if( $this->item['introtext'] )
		{
			$document->setDescription(String::substr( strip_tags($this->item['introtext']),0,160));

		}
		if( $this->item['metakey'] )
		{
			$document->setKeywords($this->item['metakey']);

		}

		$document->setTitle('产品对比-'.$GLOBALS['config']['title']);
 
		
		$pathway = &$app->getPathWay();
		$pathway->addItem('产品对比','#');
 
   		parent::display($tpl);
	}

 
 
 

}
?>
