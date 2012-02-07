<?php
class LanguagesController extends Controller{
 
	var $baseuri = null;
	function LanguagesController(){
		parent::__construct();
		$this->baseuri = 'index.php?com=languages';
	}
 
	/**
	 * ��ʾ�б�
	 */
	function display()
	{
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('languages');
	
		//��ͼģ��
		$view = $this->getView('languages');

		//����ģ��
		$view->setModel($model);
		//��ʾ
		$view->display();
	}

	function type(){
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('languages');
	
		//��ͼģ��
		$view = $this->getView('languages');

		//����ģ��
		$view->setModel($model);
		//��ʾ
		$view->typelist();
	}


	function setDefault()
	{
		$model = $this->getModel('languages');
		$model->setDefault();
 		$this->redirect($this->baseuri.'&task=type');

	}
	function addtype(){
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('languages');
	
		//��ͼģ��
		$view = $this->getView('languages');

		//����ģ��
		$view->setModel($model);
		//��ʾ
		$view->addtype();
	}
 	/** ��� **/
	function edittype()
	{
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('languages');
	
		//��ͼģ��
		$view = $this->getView('languages');

		//����ģ��
		$view->setModel($model);

		//��ʾ
		$view->edittype();
	}

	/** ���� **/
	function savetype()
	{
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('languages');
		$model->savetype();
		
		if( $_REQUEST['return']  )
		{
 			$this->redirect($_REQUEST['return']);
		}else{

 			$this->redirect($this->baseuri.'&task=type');
		}
	}	

	/** ����/���� **/
	function unlock()
	{
		$model = $this->getModel('languages');
		$model->unlock();
 		$this->redirect($this->baseuri.'&task=type');

	}

	function lock()
	{
		$model = $this->getModel('languages');
		$model->lock();
 		$this->redirect($this->baseuri.'&task=type');

	}

	/** �޸�״̬ **/
	function toggle()
	{
		$model = $this->getModel('languages');
		$model->toggle();
 		//��ͼģ��
		$this->redirect($this->baseuri.'&task=type');
	}
	/**
	 * ɾ��
	 */
	function deltype()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
			$model = $this->getModel('languages');
			$model->delete($id);
		}
		$this->redirect($this->baseuri.'&task=type');
	}
	/** ���� **/
	function save()
	{
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('languages');
		$model->save();

 		$this->redirect($this->baseuri);
 	}	

	/** ���� **/
	function moveorder()
	{
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('languages');
		$model->moveorder();

	}
}	
?>