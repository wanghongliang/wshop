<?php
class UploadsController extends Controller{
 	function UploadsController(){
		parent::__construct();
 	}
 
	/**
	 * ��ʾ�б�
	 */
	function display()
	{
 		//��ͼģ��
		$view = $this->getView('uploads');

 		//��ʾ
		$view->display();
	}


	/**
	 * ����
	 */
	function save()
	{
		$model = $this->getModel('uploads');	
		$view = $this->getView('uploads');
		$view->setModel($model);
		if( $model->save() ){ 
			//��ʾ
			$view->uploadSuccess();
		}
	}
  
}	
?>