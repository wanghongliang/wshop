<?php
class ConfigsController extends Controller{

 	var $baseuri = null;
	function ConfigsController(){
		parent::__construct();
 
		$this->baseuri = 'index.php?com=configs';

 
		if( isset($_REQUEST['tmpl']) ){
			$this->baseuri.="&tmpl=".$_REQUEST['tmpl'];
		}


		if(  is_array($_REQUEST['return']) )		//���ǻ��շ���ʱ�������ص����շ�����
		{
			if( $_REQUEST['return']['task'] )
			{
				$this->baseuri.='&task='.$_REQUEST['return']['task'];
			}
		}


	}
 
	/**
	 * ��ʾ�б�
	 */
	function display()
	{
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('config');
	
		//��ͼģ��
		$view = $this->getView('config');

		//����ģ��
		$view->setModel($model);
		//��ʾ
		$view->display();
	}

	function save()
	{
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('config');
		$model->save();
		$this->redirect($this->baseuri);
	}


 
}	
?>