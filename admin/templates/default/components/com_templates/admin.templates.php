<?php
class TemplatesController extends Controller{
 
	var $baseuri = null;
	function TemplatesController(){
		parent::__construct();
		$this->baseuri = 'index.php?com=templates&client_id='.intval($_REQUEST['client_id']);
	}
 
	/**
	 * ��ʾ�б�
	 */
	function display()
	{
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('templates');
	
		//��ͼģ��
		$view = $this->getView('templates');

		//����ģ��
		$view->setModel($model);
		//��ʾ
		$view->display();
	}

	function setDefault(){
			//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('template');
		$model->setDefault();
		$this->redirect($this->baseuri);
	}

}	
?>