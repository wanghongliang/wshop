<?php
class CompaniesController extends Controller{

 	var $baseuri = null;
	function CompaniesController(){
		parent::__construct();
 
		$this->baseuri = 'index.php?com=companies';

 

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
		$model = $this->getModel('company');
	
		//��ͼģ��
		$view = $this->getView('company');

		//����ģ��
		$view->setModel($model);
		//��ʾ
		$view->display();
	}

	function save()
	{
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('company');
		$model->save();
		$this->redirect($this->baseuri);
	}


 
}	
?>