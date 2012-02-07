<?php
class CacheController extends Controller{
 
	var $baseuri = null;
	function CacheController(){
		parent::__construct();
		$this->baseuri = 'index.php?com=cache&client_id='.intval($_REQUEST['client_id']);
	}
 
	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('caches');
	
		//视图模型
		$view = $this->getView('caches');

		//设置模型
		$view->setModel($model);
		//显示
		$view->display();
	}

	function update(){
			//取对应菜单列表模型
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

	//恢复
	function restore(){
		$model = $this->getModel('cache');
		$model->restore();
	}
}	
?>