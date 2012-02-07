<?php
class TemplatesController extends Controller{
 
	var $baseuri = null;
	function TemplatesController(){
		parent::__construct();
		$this->baseuri = 'index.php?com=templates&client_id='.intval($_REQUEST['client_id']);
	}
 
	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('templates');
	
		//视图模型
		$view = $this->getView('templates');

		//设置模型
		$view->setModel($model);
		//显示
		$view->display();
	}

	function setDefault(){
			//取对应菜单列表模型
		$model = $this->getModel('template');
		$model->setDefault();
		$this->redirect($this->baseuri);
	}

}	
?>