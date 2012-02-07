<?php
define('GROUP_DEALER',17);

class DealerController extends Controller{
 
	var $baseuri = null;
	function DealerController(){
		parent::__construct();
		$this->baseuri = 'index.php?com=dealer';

		if( $_REQUEST['return'] )
		{
			$this->baseuri = $_REQUEST['return'];
		}
	}
 
	/**
	 * ��ʾ�б�
	 */
	function display()
	{
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('dealers');
	
		//��ͼģ��
		$view = $this->getView('dealers');

		//����ģ��
		$view->setModel($model);
		//��ʾ
		$view->display();
	}

	/** ��� **/
	function add()
	{
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('dealer');
	
		//��ͼģ��
		$view = $this->getView('dealer');

		//����ģ��
		$view->setModel($model);

		//��ʾ
		$view->display();
	}

	/** ��� **/
	function edit()
	{
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('dealer');
	
		//��ͼģ��
		$view = $this->getView('dealer');

		//����ģ��
		$view->setModel($model);

		//��ʾ
		$view->edit();
	}
 
	/**
	 * ���
	 */
	function save()
	{
		$model = $this->getModel('dealer');
		if( !$model->save() ){
			//$this->redirect($this->baseuri.'&task=add');
			$this->add();
		}else{
			$this->redirect($this->baseuri);
		}
	 
	}
	function save2()
	{
		$model = $this->getModel('dealer');
		$model->save2(); 
		if( $_REQUEST['return'] ){ 
			$this->redirect($this->baseuri);
		}else{
			//echo $_REQUEST['return'];exit;
			//��ͼģ��
			$view = $this->getView('dealer');
			$view->success();
		}
	}

	function setdefault(){
		$model = $this->getModel('dealer');
		$model->setDefault();
 		$this->redirect($this->baseuri);
 	}


	/**
	 * ɾ��
	 */
	function del()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
			$model = $this->getModel('dealer');
			$model->delete($id);
		}
		$this->redirect($this->baseuri);
	}


	/** ����һ�� **/
	function copy()
	{
		$model = $this->getModel('dealer');
		$model->copy();
 		//��ͼģ��
		$this->redirect($this->baseuri);
	}

	function deleleall(){
		$model = $this->getModel('dealer');
		$model->deleleall();
 		//��ͼģ��
		$this->redirect($this->baseuri);
	}

	/** ���� **/
	function ajax()
	{
 		$model = $this->getModel('dealer');
		$model->ajax();
	}

	/** ���ѡ���ģ������ **/
	function selectadd()
	{
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('dealer');
		//��ͼģ��
		$view = $this->getView('dealer');
		//����ģ��
		$view->setModel($model);
		$view->select();		//ѡ��ģ������
	}


	
	/** ��Ա�˳� **/
	function logout()
	{
		$session =& Factory::getSession();
		$session->destroy();
		$this->redirect('/');
	}

}	
?>