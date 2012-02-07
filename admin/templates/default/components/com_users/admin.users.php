<?php
class UsersController extends Controller{
 
	var $baseuri = null;
	function UsersController(){
		parent::__construct();
		$this->baseuri = 'index.php?com=users';

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
		$model = $this->getModel('users');
	
		//��ͼģ��
		$view = $this->getView('users');

		//����ģ��
		$view->setModel($model);
		//��ʾ
		$view->display();
	}

	/** ��� **/
	function add()
	{
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('user');
	
		//��ͼģ��
		$view = $this->getView('user');

		//����ģ��
		$view->setModel($model);

		//��ʾ
		$view->display();
	}

	/** ��� **/
	function edit()
	{
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('user');
	
		//��ͼģ��
		$view = $this->getView('user');

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
		$model = $this->getModel('user');
		$model->save();

		if( $_REQUEST['return'] ){ $this->redirect($this->baseuri);
		}else{
		//echo $_REQUEST['return'];exit;
		//��ͼģ��
		$view = $this->getView('user');
		$view->success();
		}
	}

 
	/**
	 * ɾ��
	 */
	function del()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
			$model = $this->getModel('user');
			$model->delete($id);
		}
		$this->redirect($this->baseuri);
	}


	/** ����һ�� **/
	function copy()
	{
		$model = $this->getModel('user');
		$model->copy();
 		//��ͼģ��
		$this->redirect($this->baseuri);
	}

	function deleleall(){
		$model = $this->getModel('user');
		$model->deleleall();
 		//��ͼģ��
		$this->redirect($this->baseuri);
	}

	/** ���� **/
	function moveup()
	{
 
	}

	/** �������� **/
	function movedown()
	{
 
	}

	/** ���ѡ���ģ������ **/
	function selectadd()
	{
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('user');
		//��ͼģ��
		$view = $this->getView('user');
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