<?php
class UploadsController extends Controller{
 	function UploadsController(){
		parent::__construct();
 	}
 
	/**
	 * 显示列表
	 */
	function display()
	{
 		//视图模型
		$view = $this->getView('uploads');

 		//显示
		$view->display();
	}


	/**
	 * 保存
	 */
	function save()
	{
		$model = $this->getModel('uploads');	
		$view = $this->getView('uploads');
		$view->setModel($model);
		if( $model->save() ){ 
			//显示
			$view->uploadSuccess();
		}
	}
  
}	
?>