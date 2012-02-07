<?php
class DatabaseController extends Controller{
 
	var $baseuri = null;
	function DatabaseController(){
		parent::__construct();
		$this->baseuri = 'index.php?com=database&client_id='.intval($_REQUEST['client_id']);
	}
 
	/**
	 * ��ʾ�б�
	 */
	function display()
	{
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('databases');
	
		//��ͼģ��
		$view = $this->getView('databases');

		//����ģ��
		$view->setModel($model);
		//��ʾ
		$view->display();
	}

	function backup(){
			//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('database');
		$model->backup();
	}


	function delete(){
		$model = $this->getModel('database');
		$model->delete();
	}

	function upload(){
		$model = $this->getModel('database');
		$model->upload();
		$this->redirect($this->baseuri);
	}

	//�ָ�
	function restore(){
		$model = $this->getModel('database');
		$model->restore();
	}
}	
?>