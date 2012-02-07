<?php
import( 'application.component.view');
class UserView extends View
{

	var $baseurl = null;
	function display($tpl = null)
	{
		global $app,$com;
		
		$doc = &Factory::getDocument();
		$_REQUEST['tmpl'] = 'component';	//设定模板名称
		
		//样式路径
		$this->baseurl = URI_PATH.'templates/'.$app->getTemplate().'/components/com_'.$com;
			
		$layout = $this->getLayout();//当前布局
		if( $layout == 'registor' or $layout == 'registor2' )
		{
			$doc->addStyleSheet($this->baseurl.'/css/system.css');
			$doc->addStyleSheet($this->baseurl.'/css/register.css');
		}else{
			$doc->addStyleSheet($this->baseurl.'/css/system.css');
			$doc->addStyleSheet($this->baseurl.'/css/index.css');
		}
   		parent::display($tpl);
	}

	function activateemail()
	{
		global $app,$com;
		$doc = &Factory::getDocument();
		$_REQUEST['tmpl'] = 'component';	//设定模板名称


		//样式路径
		$this->baseurl = URI_PATH.'templates/'.$app->getTemplate().'/components/com_'.$com;
		$doc->addStyleSheet($this->baseurl.'/css/system.css');
		$doc->addStyleSheet($this->baseurl.'/css/register.css');
			
		include(dirname(__FILE__).DS.'tmpl'.DS.'activateemail.php');
 	}
	function activateemail_success()
	{
		global $app,$com;
		$doc = &Factory::getDocument();
		$_REQUEST['tmpl'] = 'component';	//设定模板名称


		//样式路径
		$this->baseurl = URI_PATH.'templates/'.$app->getTemplate().'/components/com_'.$com;
		$doc->addStyleSheet($this->baseurl.'/css/system.css');
		$doc->addStyleSheet($this->baseurl.'/css/register.css');
			
		include(dirname(__FILE__).DS.'tmpl'.DS.'activateemail_success.php');
 	}
}
?>
