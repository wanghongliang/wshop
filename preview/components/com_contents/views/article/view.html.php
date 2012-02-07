<?php
import( 'application.component.view');
class ArticleView extends View
{
	function display($tpl = null)
	{ 
		global $app;
		$document = &Factory::getDocument();
 		
		$this->item = $this->get('item');
 
		//print_r($this->item);
 		if( $this->item['introtext'] )
		{
			$document->setDescription(String::substr( strip_tags($this->item['introtext']),0,160));

		}
		if( $this->item['metakey'] )
		{
			$document->setKeywords($this->item['metakey']);

		}

		$document->setTitle($this->item['title'].$GLOBALS['config']['title']);

		//$_REQUEST['tmpl'] = 'component';

		$this->params  =& $app->getParams('com_contents');
		if( $this->params['setstyle'] == 1 ){
			parent::display('article');
		}else{
  			parent::display($tpl);
		}
	}

}
?>
