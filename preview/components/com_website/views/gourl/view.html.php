<?php
import( 'application.component.view');
class GourlView extends View
{
	function display($tpl = null)
	{
		global $app;
		$item = $this->get('item');
		$_REQUEST['no_html']=1;
		//echo $raw;exit;
		if( strpos($item['http'],'http') === false ){
			$gourl=('http://'.$item['http']);
		}else{
			$gourl=($item['http']);
		}
  
		include(dirname(__FILE__).DS.'tmpl'.DS.'default.php');
		exit;
	}

}
?>
