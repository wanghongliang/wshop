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
 		$layout = $this->getLayout();//��ǰ����
		

		$this->lists = $this->get('list');
		
		//print_r($lists);
		if( $layout == 'default' ){
			$_REQUEST['tmpl'] = 'categorys';	//�趨ģ������
		}else{
			$_REQUEST['tmpl'] = 'categorys';	//�趨ģ������
			
			//��ʽ·��
			$this->baseurl = URI_PATH.'templates/'.$app->getTemplate().'/';//components/com_'.$com;
				


			$doc->addStyleSheet($this->baseurl.'/css/register.css');

		}
		
  
   		parent::display($tpl);
	}
 
}
?>
