<?php
class DatabaseController extends Controller{
 
	var $baseuri = null;
	function DatabaseController(){
		parent::__construct();
		$this->baseuri = 'index.php?com=database&client_id='.intval($_REQUEST['client_id']);
	}
 
	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('databases');
	
		//视图模型
		$view = $this->getView('databases');

		//设置模型
		$view->setModel($model);
		//显示
		$view->display();
	}

	function backup(){
			//取对应菜单列表模型
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

	//恢复
	function restore(){
		$model = $this->getModel('database');
		$model->restore();
	}
}	
?>