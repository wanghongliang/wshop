<?php
class RecycleController extends Controller{

	var $menuid;	//��ǰ�˵�����
	var $baseuri = null;
	function RecycleController(){
		parent::__construct();
		$this->menuid = intval( $_REQUEST['menuid'] );

		$this->baseuri = 'index.php?com=recycle&menuid='.$this->menuid;

		if( isset($_REQUEST['tmpl']) ){
			$this->baseuri.="&tmpl=".$_REQUEST['tmpl'];
		}
	}
	/**
	 * ��ʾ�б�
	 */
	function display()
	{
		//ȡ��Ӧ�˵��б�ģ��
		$model = $this->getModel('recycles');
		//��ͼģ��
		$view = $this->getView('recycles');
		//����ģ��
		$view->setModel($model);
		//��ʾ
		$view->display();
	}
}
?>