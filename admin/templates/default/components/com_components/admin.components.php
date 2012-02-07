<?php
class ComponentsController extends Controller{
 
	var $baseuri = null;
	function ComponentsController(){
		parent::__construct();
		$this->baseuri = 'index.php?com=components';
	}
 
	/**
	 * ��ʾ�б�
	 */
	function display()
	{
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('components');
	
		//��ͼģ��
		$view = $this->getView('components');

		//����ģ��
		$view->setModel($model);
		//��ʾ
		$view->display();
	}

	/** ��� **/
	function add()
	{
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('component');
	
		//��ͼģ��
		$view = $this->getView('component');

		//����ģ��
		$view->setModel($model);

		//��ʾ
		$view->display();
	}

	/** ��� **/
	function edit()
	{
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('component');
	
		//��ͼģ��
		$view = $this->getView('component');

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
		$model = $this->getModel('component');
		$model->save();
		//echo $_REQUEST['return'];exit;
		if( $_REQUEST['return'] )
		{
			$this->redirect($_REQUEST['return']);
		}else{
			$this->redirect($this->baseuri);
		}
	}

	/**
	 * ɾ��
	 */
	function del()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
			$model = $this->getModel('component');
			$model->delete($id);
		}
		$this->redirect($this->baseuri);
	}


	/** ���� **/
	function moveup()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
			import('application.tree');
			$tree = new Tree();
			$tree->moveup($id);
		}
		$this->redirect($this->baseuri);
	}

	/** �������� **/
	function movedown()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
			import('application.tree');
			$tree = new Tree();
			$tree->movedown($id);
		}
		$this->redirect($this->baseuri);
	}
}	
?>