<?php
class CpanelController extends Controller{
	function CpanelController(){
		parent::__construct();
	}

	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('cpanel');
	
		//视图模型
		$view = $this->getView('cpanel');

		//设置模型
		$view->setModel($model);

		//显示
		$view->display();
	}
 
}
?>