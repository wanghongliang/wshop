<?php
import( 'application.component.view');
class AjaxView extends View
{
	var $lists = null;
	function display($tpl = null)
	{
		global $app;
		
 		switch($_GET['act']){
			case 'savfav':
				$model=$this->getModel();
				$model->savfav();
				include(dirname(__FILE__).DS.'tmpl'.DS.'success.php');
				break;
			case 'senderror':
				$model=$this->getModel();
				$status = $model->senderror();

				include(dirname(__FILE__).DS.'tmpl'.DS.'senderror.php');
				break;

			case 'addweb':
				include(PATH_ROOT.DS.'preview'.DS.'includes'.DS.'option.php');
 				$lists['ids'] = array();
				$lists['paths'] = array();
				$cats = $this->get('cat');
				include(dirname(__FILE__).DS.'tmpl'.DS.'addweb.php');
				break;

			case 'saveweb':
				$model=$this->getModel();
				$list = $model->saveajaxweb();
				switch($list['status']){
					case 0:
						include(dirname(__FILE__).DS.'tmpl'.DS.'addweb_status_0.php');
						break;
					case 1:
						include(dirname(__FILE__).DS.'tmpl'.DS.'addweb_status_1.php');
						break;
 
					default:
						include(dirname(__FILE__).DS.'tmpl'.DS.'addweb_success.php');

				}
  				break;

			default:
				$this->lists = $this->get('favorite');
				parent::display($tpl);
		}
	}
}
?>
 