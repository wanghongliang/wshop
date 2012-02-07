<?php
class InstallerController extends Controller{
 
	var $baseuri = null;
	function InstallerController(){
		parent::__construct();
		$this->baseuri = 'index.php?com=installer';
	}
 
	/**
	 * ��ʾ�б�
	 */
	function display()
	{
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('installer');
	
		//��ͼģ��
		$view = $this->getView('installer');

		//����ģ��
		$view->setModel($model);
		//��ʾ
		$view->display();
	}

	/** ��� **/
	function add()
	{
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('installer');
	
		//��ͼģ��
		$view = $this->getView('installer');

		//����ģ��
		$view->setModel($model);

		//��ʾ
		$view->display();
	}

	/** ��� **/
	function edit()
	{
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('installer');
	
		//��ͼģ��
		$view = $this->getView('installer');

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
		$model = $this->getModel('installer');
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
			$model = $this->getModel('installer');
			$model->delete($id);
		}
		$this->redirect($this->baseuri);
	}

	/**
	 * ��װ�ϴ�
	 */
	function uploadinstaller()
	{
 		$model = $this->getModel('installer');
		$model->uploadinstaller();


 		$this->redirect($this->baseuri);
	}
}	
?>