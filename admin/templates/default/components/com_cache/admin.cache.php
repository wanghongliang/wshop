<?php
class CacheController extends Controller{
 
	var $baseuri = null;
	function CacheController(){
		parent::__construct();
		$this->baseuri = 'index.php?com=cache&client_id='.intval($_REQUEST['client_id']);
	}
 
	/**
	 * ��ʾ�б�
	 */
	function display()
	{
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('caches');
	
		//��ͼģ��
		$view = $this->getView('caches');

		//����ģ��
		$view->setModel($model);
		//��ʾ
		$view->display();
	}

	function update(){
			//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('cache');
		$model->update();
	}


	function delete(){
		$model = $this->getModel('cache');
		$model->delete();
	}

	function upload(){
		$model = $this->getModel('cache');
		$model->upload();
		$this->redirect($this->baseuri);
	}

	//�ָ�
	function restore(){
		$model = $this->getModel('cache');
		$model->restore();
	}
}	
?>