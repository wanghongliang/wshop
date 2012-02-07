<?php
import( 'application.component.view');
class UsersView extends View
{

	var $baseurl = null;
	var $categroy = array();
 	function display($tpl = null)
	{
		global $app,$com;
		
		$doc = &Factory::getDocument();
 		$layout = $this->getLayout();//当前布局
		

		$this->lists = $this->get('list');
		
		//print_r($lists);
		if( $layout == 'default' ){
			$_REQUEST['tmpl'] = 'categorys';	//设定模板名称
		}else{
			$_REQUEST['tmpl'] = 'categorys';	//设定模板名称
			
			//样式路径
			$this->baseurl = URI_PATH.'templates/'.$app->getTemplate().'/';//components/com_'.$com;
				


			$doc->addStyleSheet($this->baseurl.'/css/register.css');

		}
		
  
   		parent::display($tpl);
	}
 
}
?>
